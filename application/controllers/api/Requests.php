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
		$this->load->model('r2pdb_model');

		// Configure limits on our controller methods
		// Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
		$this->methods['user_get']['limit'] = 500; // 500 requests per hour per user/key
		$this->methods['user_post']['limit'] = 100; // 100 requests per hour per user/key
		$this->methods['user_delete']['limit'] = 50; // 50 requests per hour per user/key
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
		$userid = $this->get('userid');
		
		// If the userid is NULL, return all users.
		if ($userid === NULL)
		{
			// Get all users from the database.
			$users = $this->r2pdb_model->get_users_display();
			
			// Check if the users data store contains users
			if (!empty($users))
			{
				$this->response($users, REST_Controller::HTTP_OK);
			}
			else
			{
				$this->response(['status' => FALSE, 'message' => 'No users were found'], REST_Controller::HTTP_NOT_FOUND);
			}
		}

		// Get specific user from database.
		$user = $this->r2pdb_model->get_user_by_id_display($userid);
		
		// Validate userid. NOTE: NULL equals FALSE with loose comparison.
		if ($user == FALSE)
		{
			$this->response(['status' => FALSE, 'message' => 'Invalid or null user ID.'], REST_Controller::HTTP_BAD_REQUEST);
		}
		else if (!empty($user))
		{
			$this->set_response($user, REST_Controller::HTTP_OK);
		}
		else
		{
			$this->set_response(['status' => FALSE, 'message' => "User with the ID " . $userid . " not found."], REST_Controller::HTTP_NOT_FOUND);
		}
	}
	
	/*
	 * HTTP GET: USER DATA
	 */
	public function userdata_get()
	{
		// Get userid parameter from the query.
		$userid = $this->get('userid');
	
		// Get collectionid parameter from the query.
		$collectionid = $this->get('collectionid');
		
		// Get commentid parameter from the query.
		$commentid = $this->get('commentid');
		
		// Get datatype parameter from the query.
		$datatype = $this->get('datatype');
		
		// TODO: Validate userid in a separate function.
		if ($userid === NULL || (int) $userid <= 0)
		{
			$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
		}

		$userid = (int) $userid;

		// TODO: Get specific user from database.
		$user = NULL;

		if (empty($user))
		{
			$this->set_response(['status' => FALSE, 'message' => "User with the ID " . $userid . " not found."], REST_Controller::HTTP_NOT_FOUND);
		}
		else
		{
			if ($datatype !== NULL)
			{
				// Error checking, this should always be true when datatype is not NULL.
				if ($collectionid === NULL && $commentid === NULL)
				{
					switch ($datatype)
					{
						case "collections":
							$collections = ['dummydata' => "dummy get all user collections"];
				
							if ($collections)
							{
								$this->response($collections, REST_Controller::HTTP_OK);
							}
							else
							{
								$this->response(['status' => FALSE, 'message' => "User has no collections."], REST_Controller::HTTP_NOT_FOUND);
							}
							break;
						case "comments":
							$comments = ['dummydata' => "dummy get all user comments"];
				
							if ($comments)
							{
								$this->response($comments, REST_Controller::HTTP_OK);
							}
							else
							{
								$this->response(['status' => FALSE, 'message' => "User has no comments."], REST_Controller::HTTP_NOT_FOUND);
							}
							break;
						default:
							// Theoretically this is not possible.
							$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
					}
					
					$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
				}
			}

			// Determine what data to get.
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
					$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
			}
			else if ($collectionid > $commentid) // One of these values is greater than 0.
			{
				// TODO: Get specific collection from database.
				$data = NULL;
				// Error message to return if the comment does not exist.
				$errorMessage = "User ID " . $userid . " does not have a collection with the ID " . $collectionid . ".";
			}
			else
			{
				// TODO: Get specific comment from database.
				$data = NULL;
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
		}
	}
	
	/*
	 * HTTP GET: PRODUCTS
	 */
	public function products_get()
	{
		// Get productid parameter from the query.
		$productid = $this->get('productid');
		
		// If the productid is NULL, return all products.
		if ($productid === NULL)
		{
			// TODO: Get all products from the database.
			$products = ['dummydata' => 'dummy get all products'];
			
			// TODO: Check if the products data store contains products (in case the database result returns NULL)
			if ($products)
			{
				$this->response($products, REST_Controller::HTTP_OK);
			}
			else
			{
				$this->response(['status' => FALSE, 'message' => 'No products were found'], REST_Controller::HTTP_NOT_FOUND);
			}
		}

		// TODO: Find and return a single record for a particular product.
		$productid = (int) $productid;

		/* Validate the ID.
		   ProductID field in the database must be >= 1.
		   TODO: Move to separate function later.
		 */
		if ($productid <= 0)
		{
			// Invalid id.
			$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
		}

		// TODO: Get specific product from database.
		$product = NULL;

		if (!empty($product))
		{
			$this->set_response($product, REST_Controller::HTTP_OK);
		}
		else
		{
			$this->set_response(['status' => FALSE, 'message' => "Product with the ID " . $productid . " not found."], REST_Controller::HTTP_NOT_FOUND);
		}
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
		
		// TODO: Validate productid in a separate function.
		if ($productid === NULL || (int) $productid <= 0)
		{
			$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
		}

		$productid = (int) $productid;

		// TODO: ID validation function
		$product = NULL;

		if (empty($product))
		{
			$this->set_response(['status' => FALSE, 'message' => "Product with the ID " . $productid . " not found."], REST_Controller::HTTP_NOT_FOUND);
		}
		else
		{
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
							$reviews = ['dummydata' => "dummy get all product reviews"];
				
							if ($reviews)
							{
								$this->response($reviews, REST_Controller::HTTP_OK);
							}
							else
							{
								$this->response(['status' => FALSE, 'message' => "Product ID " . $productid . " has no reviews."], REST_Controller::HTTP_NOT_FOUND);
							}
							break;
						case "comments":
							$comments = ['dummydata' => "dummy get all product comments"];
				
							if ($comments)
							{
								$this->response($comments, REST_Controller::HTTP_OK);
							}
							else
							{
								$this->response(['status' => FALSE, 'message' => "Product ID " . $productid . " has no comments."], REST_Controller::HTTP_NOT_FOUND);
							}
							break;
						default:
							// Theoretically this is not possible.
							$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
					
						$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
					}
				}
			}
			
			$both = FALSE;
			
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
		}
	}

	/*
	 * HTTP POST: COMMENTS
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
			if ($userid !== NULL)
			{
				$userid = (int) $userid;

				// TODO: Validate userid.
				$this->set_response(['status' => TRUE, 'message' => "Comment posted to user ID " . $userid . ": " . $text], REST_Controller::HTTP_OK);
			}
			else
			{
				$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
			}
		}
		else
		{
			// Review comment.
			if ($reviewid !== NULL)
			{
				$reviewid = (int) $reviewid;

				// TODO: Validate reviewid.
				$this->set_response(['status' => TRUE, 'message' => "Comment posted to review ID " . $reviewid . " on product ID " . $productid . "."], REST_Controller::HTTP_OK);
			}
			else
			{
				$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
			}
		}
	}
	
	/*
	 * HTTP PUT: COLLECTIONS
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
			$this->response($userid . " " . $collectionid . " " . $productid, REST_Controller::HTTP_BAD_REQUEST);
		}

		// TODO: Get specific user from database.
		$user = NULL;

		if ($collectionid === NULL)
		{
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