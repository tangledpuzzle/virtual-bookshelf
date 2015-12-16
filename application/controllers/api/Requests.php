<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';

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
	 * 						 FALSE if ID is invalid the function will set a proper HTTP response and stop the execution of this function and all subsequent code
	 */
	private function check_for_valid_id($id_type_name, $id)
	{
		if ($id === NULL)
		{
			return NULL;
		}
		else
		{
			if (!is_numeric($id))
			{
				$this->response(['status' => FALSE, 'message' => "Non-numeric " . $id_type_name . " ID."], REST_Controller::HTTP_BAD_REQUEST);
			}
			else if ((int) $id <= 0)
			{
				$this->response(['status' => FALSE, 'message' => "Invalid " . $id_type_name . " ID."], REST_Controller::HTTP_BAD_REQUEST);
			}
			else
			{
				$present_in_table = FALSE;
				
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
					$this->set_response(['status' => FALSE, 'message' => $id_type_name . " with the ID " . $id . " not found."], REST_Controller::HTTP_NOT_FOUND);
					return FALSE;
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
	 * HTTP POST: get_rows_by_field_display
	 * 
	 * FIXME: WARNING: REMOVE BEFORE PRODUCTION! DEVELOPMENT ONLY!
	 * 
	 
	public function db_post()
	{
		//$key = $this->post('key');
		//$value = $this->post('value');
		$array = $this->post('args');
		$data = $this->r2pdb_model->get_rows_by_field_display($array);
		$this->response($data, REST_Controller::HTTP_OK);
	}*/
	
	/*
	 * HTTP GET: USERS
	 */
	public function users_get()
	{
		// Get userid parameter from the query.
		// CodeIgniter routing rules read anything less than 0 or non-numbers as NULL.
		$id = $this->get('userid');

		$check = $this->check_for_valid_id("User", $id);
		
		// If the ID is NULL, return all users.
		if ($check === NULL)
		{
			$this->respond_with_all("users");
		}
		else if ($check === TRUE)
		{
			// Get specific user from database.
			$data = $this->r2pdb_model->get_user_by_id_display($id);

			// Because of the validity check above it is certain that the user id is present in the table.
			$this->set_response($data, REST_Controller::HTTP_OK);
		}
		// If false, check_for_valid_id already set a response.
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
		
		$check = $this->check_for_valid_id("User", $userid);
		if ($check === TRUE)
		{
			$userid = (int) $userid;

			if ($datatype !== NULL)
			{
				switch ($datatype)
				{
					case "collections":
						$data = $this->r2pdb_model->get_user_collections_short_display($userid);
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
		}
		// If false, check_for_valid_id already set a response.
		 
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

		$check = $this->check_for_valid_id("Product", $id);
			
		// If the ID is NULL, return all products.
		if ($check === NULL)
		{
			$this->respond_with_all("products");
		}
		else if ($check === TRUE)
		{
			// Get specific product from database.
			$data = $this->r2pdb_model->get_product_by_id_display($id);

			// Because of the validity check above it is certain that the product id is present in the table.
			$this->set_response($data, REST_Controller::HTTP_OK);
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
		
		$check = $this->check_for_valid_id("Product", $productid);
		
		if ($check === TRUE)
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
							$data = $this->r2pdb_model->get_product_comments_display($productid);
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
		}
		// If false, check_for_valid_id already set a response.
	}

	/*
	 * HTTP GET: COLLECTIONS
	 */
	public function collections_get()
	{
		// Get productid parameter from the query.
		// CodeIgniter routing rules read anything less than 0 or non-numbers as NULL.
		$id = $this->get('collectionid');

		$check = $this->check_for_valid_id("Collection", $id);
		
		// If the ID is NULL, return all collections.
		if ($check === NULL)
		{
			$this->respond_with_all("collections");
		}
		else if ($check === TRUE)
		{
			// Get specific collection from database.
			$data = $this->r2pdb_model->get_collections_by_id_display($id);

			// Because of the validity check above it is certain that the collection id is present in the table.
			$this->set_response($data, REST_Controller::HTTP_OK);
		}
		// If false, check_for_valid_id already set a response.
	}
	
	/*
	 * HTTP GET: REVIEWS
	 */
	public function reviews_get()
	{
		// Get reviewid parameter from the query.
		// CodeIgniter routing rules read anything less than 0 or non-numbers as NULL.
		$id = $this->get('reviewid');

		$check = $this->check_for_valid_id("Review", $id);
		// If the review is NULL, return all reviews.
		if ($check === NULL)
		{
			$this->respond_with_all("reviews");
		}
		else if ($check === TRUE)
		{
			// Get specific review from database.
			$data = $this->r2pdb_model->get_review_by_id_display($id);

			// Because of the validity check above it is certain that the product id is present in the table.
			$this->set_response($data, REST_Controller::HTTP_OK);
		}
		// If false, check_for_valid_id already set a response.
	}
	
	/*
	 * HTTP GET: PRODUCT DATA
	 */
	public function reviewdata_get()
	{
		// Get reviewid parameter from the query.
		$reviewid = $this->get('reviewid');
		
		// Get datatype parameter from the query.
		$datatype = $this->get('datatype');
		
		if ($this->check_for_valid_id("Review", $reviewid) === TRUE)
		{
			$reviewid = (int) $reviewid;

			if ($datatype !== NULL)
			{
					switch ($datatype)
					{
						case "comments":
							$data = $this->r2pdb_model->get_review_comments_display($reviewid);
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
						$this->response(['status' => FALSE, 'message' => "Review has no " . $datatype . "."], REST_Controller::HTTP_NOT_FOUND);
					}
			}
		}
	}
	/*
	 * HTTP POST: COMMENTS
	 * TODO: Implement proper login functionality.
	 */
	public function comments_post()
	{
		$auth = FALSE;
		$user_name = NULL;
		$password = NULL;
		
		// Authorization through Postman.
		if (!empty($this->input->server('PHP_AUTH_USER')))
		{
			$auth = TRUE;
			$user_name = $this->input->server('PHP_AUTH_USER');
			$password = $this->input->server('PHP_AUTH_PW');
		}
		else if (!empty($this->input->server('HTTP_AUTHORIZATION'))) // Authorization through PHPUnit.
		{
			$auth = TRUE;
			$data = explode(':' , base64_decode(substr($this->input->server('HTTP_AUTHORIZATION'), 6)));
			$user_name = $data[0];
			$password = $data[1];
		}
		
		if($auth === TRUE)
		{
			// No proper API login is implemented.
			if ($user_name === "admin" && $password === '1234')
			{
				// Get productid parameter from the query.
				$productid = $this->get('productid');

				// Get reviewid parameter from the query.
				$reviewid = $this->get('reviewid');

				// Get userid parameter from the query.
				$userid = $this->get('userid');

				// Get comment text.
				$text = $this->post('text');


				// Hard coded for now because there is no real support for API logins.
				$logged_in_user_id = 3; // Admin user.

				if ($userid !== NULL)
				{
					// User comment.
					$check = $this->check_for_valid_id("User", $userid);
					
					if ($check === TRUE)
					{
						$userid = (int) $userid;
						
						if ($this->r2pdb_model->add_user_comment($logged_in_user_id, $text, $userid) === TRUE)
						{
							$this->set_response(['status' => TRUE, 'message' => "Comment posted."], REST_Controller::HTTP_OK);
						}
						else
						{
							$this->set_response(['status' => FALSE, 'message' => "Comment posting failed."], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
						}
					}
					// If false, check_for_valid_id already set a response.
				}
				else if ($reviewid !== NULL)
				{
					// Review comment.
					$check = $this->check_for_valid_id("Review", $reviewid);
					
					if ($check === TRUE)
					{
						$reviewid = (int) $reviewid;
						if ($this->r2pdb_model->add_review_comment($logged_in_user_id, $text, $reviewid) === TRUE)
						{
							$this->set_response(['status' => TRUE, 'message' => "Comment posted."], REST_Controller::HTTP_OK);
						}
						else
						{
							$this->set_response(['status' => FALSE, 'message' => "Comment posting failed."], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
						}
					}
					// If false, check_for_valid_id already set a response.
				}
				else if ($productid !== NULL)
				{
					// Product comment.
					$check = $this->check_for_valid_id("Product", $productid);
					
					if ($check === TRUE)
					{
						$productid = (int) $productid;
						if ($this->r2pdb_model->add_product_comment($logged_in_user_id, $text, $productid) === TRUE)
						{
							$this->set_response(['status' => TRUE, 'message' => "Comment posted."], REST_Controller::HTTP_OK);
						}
						else
						{
							$this->set_response(['status' => FALSE, 'message' => "Comment posting failed."], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
						}
					}
					// If false, check_for_valid_id already set a response.
				}
				// Fall through on invalid ID.
			}
			else
			{
				$this->set_response(['status' => FALSE, 'message' => "Invalid credentials."], REST_Controller::HTTP_UNAUTHORIZED);
			}
		}
		else
		{
			$this->set_response(['status' => FALSE, 'message' => "Please provide authentication."], REST_Controller::HTTP_UNAUTHORIZED);
		}
		// Still falling through on invalid ID.
	}
	
	/*
	 * HTTP PUT: COLLECTIONS
	 
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
		 *
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
		 *
		if ($productid <= 0)
		{
			// Invalid id.
			$this->response($userid . " " . $collectionid . " " . $productid, REST_Controller::HTTP_BAD_REQUEST);
		}

		// TODO: Get specific product from database.
		$product = NULL;
		
		$message = ['dummydata' => "Product ID " . $productid . " successfully added to collection ID " . $collectionid . " of user ID " . $userid . "."];
			
		$this->response($message, REST_Controller::HTTP_OK);
	}*/
}