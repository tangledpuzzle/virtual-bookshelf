<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

/**
* REST API.
* @package r2p_api
* @author Jose Uusitalo
*/
class Requests extends REST_Controller
{
	function __construct()
	{
		// Construct the parent class
		parent::__construct();

		// Configure limits on our controller methods
		// Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
		$this->methods['user_get']['limit'] = 500; // 500 requests per hour per user/key
		$this->methods['user_post']['limit'] = 100; // 100 requests per hour per user/key
		$this->methods['user_delete']['limit'] = 50; // 50 requests per hour per user/key
	}

	
	/*
	 * HELPER FUNCTIONS
	 */
	
	/**
	 * A generic private helper function to prevent duplicate code.
	 * @params string $id_type_name the type of the ID with a capital first letter (e.g. "User" or "Product")
	 * @params int|NULL $id ID to validate
	 * @returns NULL|boolean NULL if ID  is NULL,
	 * 						 TRUE if ID is valid and present in the correct table,
	 * 						 if ID is invalid the function will set a proper HTTP response and stop the execution of this function and all subsequent code
	 */
	private function check_for_valid_id($id_type_name, $id)
	{
		if ($id === NULL)
		{
			return NULL;
		}
		else
		{
			$id = (int) $id;
			
			if ($id <= 0)
			{
				$this->response(['status' => FALSE, 'message' => "Invalid " . $id_type_name . " ID."], REST_Controller::HTTP_BAD_REQUEST);
			}
			else
			{
				switch ($id_type_name)
				{
					case "User":
						$present_in_table = $this->r2pdb_model->is_valid_user_id($id);
						break;
					case "Product":
						$present_in_table = $this->r2pdb_model->is_valid_product_id($id);
						break;
					case "Review":
						$present_in_table = $this->r2pdb_model->is_valid_review_id($id);
						break;
					case "Collection":
						$present_in_table = $this->r2pdb_model->is_valid_collection_id($id);
						break;
					case "Comment":
						$present_in_table = $this->r2pdb_model->is_valid_comment_id($id);
						break;
					default:
						$this->set_response(['status' => FALSE, 'message' => "You've stumbled upon an unimplemented feature that obviously should have been implemented. Please contact the website administrator with your query."], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
				}
					
				if ($present_in_table === FALSE)
				{
					$this->set_response(['status' => FALSE, 'message' => id_type_name . " with the ID " . $id . " not found."], REST_Controller::HTTP_NOT_FOUND);
				}
				else
				{
					return TRUE;
				}
			}
		}
	}
	
	/**
	 * A generic private helper function to prevent duplicate code. Responds with all data of specified data type, if any is present.
	 * @params string $datatype the type of the data to respond with in lower case and plural (e.g. "users" or "reviews")
	 */
	private function respond_with_all($datatype)
	{
		// Get all data from the database.
		switch ($datatype)
		{
			case "users":
				$data = $this->r2pdb_model->get_users_display();
				break;
			case "products":
				$data = $this->r2pdb_model->get_products_display();
				break;
			case "reviews":
				$data = $this->r2pdb_model->get_reviews_display();
				break;
			case "collections":
				$data = $this->r2pdb_model->get_collections_display();
				break;
			case "comments":
				$data = $this->r2pdb_model->get_comments_display();
				break;
			default:
				$this->set_response(['status' => FALSE, 'message' => "You've stumbled upon an unimplemented feature that obviously should have been implemented. Please contact the website administrator with your query."], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
		}
		
		// Check if the data array contains anything.
		if (!empty($data))
		{
			$this->response($data, REST_Controller::HTTP_OK);
		}
		else
		{
			$this->response(['status' => FALSE, 'message' => 'No ' . $datatype . ' were found'], REST_Controller::HTTP_NOT_FOUND);
		}
	}
	
	/*
	 * HTTP POST: RAW DATABASE ACCESS
	 * 
	 * FIXME: WARNING: REMOVE BEFORE PRODUCTION! DEVELOPMENT ONLY!
	 * 
	 */
	public function db_post()
	{
		//$key = $this->post('key');
		//$value = $this->post('value');
		$array = $this->post('args');
		$data = $this->r2pdb_model->get_rows_by_field_display($array);
		$this->response($data, REST_Controller::HTTP_OK);
	}
	
	/*
	 * HTTP GET: USERS
	 */
	public function users_get()
	{
		// Get userid parameter from the query.
		// CodeIgniter routing rules read anything less than 0 or non-numbers as NULL.
		$id = $this->get('userid');

		// If the ID is NULL, return all users.
		if ($this->check_for_valid_id("User", $id) === NULL)
		{
			$this->respond_with_all("users");
		}
		
		// Get specific user from database.
		$data = $this->r2pdb_model->get_user_by_id_display($id);
		
		// Because of the validity check above it is certain that the user id is present in the table.
		$this->set_response($data, REST_Controller::HTTP_OK);
	}
	
	/*
	 * HTTP GET: USER DATA
	 */
	public function userdata_get()
	{
		/* Get userid parameter from the query.
		 * CodeIgniter routing rules read anything less than 0 or non-numbers as NULL which routes to users_get().
		 * Which means this must be 0 or more.
		 */
		$userid = (int) $this->get('userid');
	
		// Get collectionid parameter from the query.
		$collectionid = $this->get('collectionid');
		
		// Get commentid parameter from the query.
		$commentid = $this->get('commentid');
		
		// Get datatype parameter from the query.
		$datatype = $this->get('datatype');
		
		if ($this->check_for_valid_id("User", $userid) === TRUE)
		{
			$userid = (int) $userid;

			if ($datatype !== NULL)
			{
				switch ($datatype)
				{
					case "collections":
						$data = $this->r2pdb_model->get_user_collections_display($userid);
						break;
					case "comments":
						$data = $this->r2pdb_model->get_user_comments_display($userid);
						break;
					case "reviews":
						$data = $this->r2pdb_model->get_user_reviews_display($userid);
						break;
					default:
						// Theoretically this is not possible.
						$this->response(['status' => FALSE, 'message' => "This should not have happened, please contact the site administrator."], REST_Controller::HTTP_BAD_REQUEST);
				}
				
				if (!empty($data))
				{
					$this->response($data, REST_Controller::HTTP_OK);
				}
				else
				{
					$this->response(['status' => FALSE, 'message' => "User has no " . $datatype . "."], REST_Controller::HTTP_NOT_FOUND);
				}
			}
			// This is silly and unnecessary.
			/*else
			{
				 Determine what data to get.
				if ($collectionid === NULL)
				{
					$commentid = (int) $commentid;
					$collectionid = 0; // Invalid ID
				}
				else
				{
					$collectionid = (int) $collectionid;
					$commentid = 0; // Invalid ID
				}

				// One of these is 0 the other must not be 0 or less.
				if ($collectionid <= 0 && $commentid <= 0)
				{
						$this->response(['status' => FALSE, 'message' => "This should not have happened, please contact the site administrator."], REST_Controller::HTTP_BAD_REQUEST);
				}
				else if ($collectionid > $commentid) // One of these values is greater than 0.
				{
					$data = $this->r2pdb_model->get_collection_by_id_display($collectionid);
					// Error message to return if the comment does not exist.
					$errorMessage = "User ID " . $userid . " does not have a collection with the ID " . $collectionid . ".";
				}
				else
				{
					$data = $this->r2pdb_model->get_comment_by_id_display($commentid);
					// Error message to return if the comment does not exist.
					$errorMessage = "User ID " . $userid . " does not have a comment with the ID " . $commentid . ".";
				}

				if (!empty($data))
				{
					$this->set_response($data, REST_Controller::HTTP_OK);
				}
				else
				{
					$this->set_response(['status' => FALSE, 'message' => $errorMessage], REST_Controller::HTTP_NOT_FOUND);
				}
			}*/
		}
		
		/* CodeIgniter will route the query to users_get() if $userid is NULL, so no NULL check is needed.
		the validator function handles other possible values so no else is needed. */
	}
	
	/*
	 * HTTP GET: PRODUCTS
	 */
	public function products_get()
	{
		// Get productid parameter from the query.
		// CodeIgniter routing rules read anything less than 0 or non-numbers as NULL.
		$id = $this->get('productid');

		// If the ID is NULL, return all products.
		if ($this->check_for_valid_id("Product", $id) === NULL)
		{
			$this->respond_with_all("products");
		}
		
		// Get specific product from database.
		$data = $this->r2pdb_model->get_product_by_id_display($id);
		
		// Because of the validity check above it is certain that the product id is present in the table.
		$this->set_response($data, REST_Controller::HTTP_OK);
	}
	
	/*
	 * HTTP GET: PRODUCT DATA
	 */
	public function productdata_get()
	{
		// Get productid parameter from the query.
		$productid = $this->get('productid');
	
		// Get reviewid parameter from the query.
		$reviewid = $this->get('reviewid');
		
		// Get commentid parameter from the query.
		$commentid = $this->get('commentid');
		
		// Get datatype parameter from the query.
		$datatype = $this->get('datatype');
		
		if ($this->check_for_valid_id("Product", $productid) === TRUE)
		{
			$productid = (int) $productid;

			if ($datatype !== NULL)
			{
				// Valid cases:
				// - Both reviewid and commentid are null -> get all data of specified type
				// - reviewid is not null and commentid is null (handled further down)
				if ($reviewid === NULL && $commentid === NULL)
				{
					switch ($datatype)
					{
						case "reviews":
							$data = $this->r2pdb_model->get_product_reviews_by_id_display($productid);
							break;
						case "comments":
							$data = $this->r2pdb_model->get_product_comments_by_id_display($userid);
							break;
						default:
							// Theoretically this is not possible.
							$this->response(['status' => FALSE, 'message' => "This should not have happened, please contact the site administrator."], REST_Controller::HTTP_BAD_REQUEST);
					}
				
					if (!empty($data))
					{
						$this->response($data, REST_Controller::HTTP_OK);
					}
					else
					{
						$this->response(['status' => FALSE, 'message' => "Product has no " . $datatype . "."], REST_Controller::HTTP_NOT_FOUND);
					}
				}
			}
			
			// FIXME: This is dumb. Do reviewdata_get.
			$both = FALSE;
			/*
			// Determine what data to get.
			if ($reviewid === NULL)
			{
				$commentid = (int) $commentid;
				$reviewid = 0; // Invalid ID
			}
			else if ($commentid === NULL)
			{
				$reviewid = (int) $reviewid;
				$commentid = 0; // Invalid ID
				
				// Get all review comments
				if ($datatype === "comments")
				{
					$comments = ['dummydata' => "dummy get all product review comments"];
				
					if ($comments)
					{
						$this->response($comments, REST_Controller::HTTP_OK);
					}
					else
					{
						$this->response(['status' => FALSE, 'message' => "Product ID " . $productid . " review ID " . $reviewid. " has no comments."], REST_Controller::HTTP_NOT_FOUND);
					}
				}
			}
			else
			{
				// Neither are NULL, get specific comment from specific review.
				$commentid = (int) $commentid;
				$reviewid = (int) $reviewid;
				$both = TRUE;
			}
			
			if ($reviewid <= 0 && $commentid <= 0)
			{
					$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
			}
			else if (!$both && ($reviewid > $commentid)) // One of these ID values is greater than 0.
			{
				// TODO: Get specific review from database.
				$data = NULL;
				// Error message to return if the comment does not exist.
				$errorMessage = "Product ID " . $productid . " does not have a review with the ID " . $reviewid . ".";
			}
			else if (!$both)
			{
				// TODO: Get specific comment from database.
				$data = NULL;
				// Error message to return if the comment does not exist.
				$errorMessage = "Product ID " . $productid . " does not have a comment with the ID " . $commentid . ".";
			}
			else // both is TRUE.
			{
				// TODO: Get specific comment from specific review.
				// TODO: Validate review id.
				$data = NULL;
				// Error message to return if the comment does not exist.
				$errorMessage = "Product ID " . $productid . " review ID " . $reviewid . " does not have a comment with the ID " . $commentid . ".";
			}
			
			if (!empty($data))
			{
				$this->set_response($data, REST_Controller::HTTP_OK);
			}
			else
			{
				$this->set_response(['status' => FALSE, 'message' => $errorMessage], REST_Controller::HTTP_NOT_FOUND);
			}
			*/
		}
	}

	
	/*
	 * HTTP GET: REVIEWS
	 */
	public function reviews_get()
	{
		// Get reviewid parameter from the query.
		// CodeIgniter routing rules read anything less than 0 or non-numbers as NULL.
		$id = $this->get('reviewid');
		
		// If the review is NULL, return all reviews.
		if ($this->check_for_valid_id("Review", $id) === NULL)
		{
			$this->respond_with_all("reviews");
		}
		
		// Get specific review from database.
		$data = $this->r2pdb_model->get_review_by_id_display($id);
		
		// Because of the validity check above it is certain that the product id is present in the table.
		$this->set_response($data, REST_Controller::HTTP_OK);
	}
	
	/*
	 * HTTP POST: COMMENTS
	 * TODO: Implement login functionality.
	 */
	public function comments_post()
	{
		// Get productid parameter from the query.
		$productid = $this->get('productid');
	
		// Get reviewid parameter from the query.
		$reviewid = $this->get('reviewid');
		
		// Get userid parameter from the query.
		$userid = $this->get('userid');
		
		// Get comment text.
		$text = $this->post('text');
		
		if ($productid === NULL)
		{
			// User comment.
			if ($userid !== NULL && $this->r2pdb_model->is_valid_user_id((int) $userid) === TRUE)
			{
				// DUMMY DATA!
				$this->set_response(['status' => TRUE, 'message' => "Dummy data: Comment posted to user ID " . $userid . ": " . $text], REST_Controller::HTTP_OK);
			}
			else
			{
				$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
			}
		}
		else
		{
			// Review comment.
			if ($reviewid !== NULL && $this->r2pdb_model->is_valid_review_id((int) $reviewid) === TRUE)
			{
				$this->set_response(['status' => TRUE, 'message' => "Dummy data: Comment posted to review ID " . $reviewid . " on product ID " . $productid . "."], REST_Controller::HTTP_OK);
			}
			else
			{
				$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
			}
		}
	}
	
	/*
	 * HTTP PUT: COLLECTIONS
	 * TODO: Needs login
	 */
	public function userdata_put()
	{
		// Get userid parameter from the query.
		$userid = $this->get('userid');
		
		// Get collectionid parameter from the query.
		$collectionid = $this->get('collectionid');
		
		// Get productid parameter from the query.
		$productid = $this->get('productid');
		
		// TODO: Userid is required at the moment.
		if ($userid === NULL)
		{
			// FIXME: Dev code
			$this->response($userid . " " . $collectionid . " " . $productid, REST_Controller::HTTP_BAD_REQUEST);
		}
		else
		{
			$userid = (int) $userid;
		}

		/* Validate the ID.
		   UserID field in the database must be >= 1.
		   TODO: Move to separate function later.
		 */
		if ($userid <= 0)
		{
			// Invalid id.
			// FIXME: Dev code
			$this->response($userid . " " . $collectionid . " " . $productid, REST_Controller::HTTP_BAD_REQUEST);
		}

		// TODO: Get specific user from database.
		$user = NULL;

		if ($collectionid === NULL)
		{
			// FIXME: Dev code
			$this->response($userid . " " . $collectionid . " " . $productid, REST_Controller::HTTP_BAD_REQUEST);
		}
		else
		{
			$collectionid = (int) $collectionid;
		}

		if ($collectionid <= 0)
		{
			// Invalid id.
			$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
		}

		// TODO: Get specific product from database.
		$collection = NULL;
		
		if ($productid === NULL)
		{
			$this->response($userid . " " . $collectionid . " " . $productid, REST_Controller::HTTP_BAD_REQUEST);
		}
		else
		{
			$productid = (int) $productid;
		}

		/* Validate the ID.
		   ProductID field in the database must be >= 1.
		   TODO: Move to separate function later.
		 */
		if ($productid <= 0)
		{
			// Invalid id.
			$this->response($userid . " " . $collectionid . " " . $productid, REST_Controller::HTTP_BAD_REQUEST);
		}

		// TODO: Get specific product from database.
		$product = NULL;
		
		$message = ['dummydata' => "Product ID " . $productid . " successfully added to collection ID " . $collectionid . " of user ID " . $userid . "."];
			
		$this->response($message, REST_Controller::HTTP_OK);
	}
}