<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

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

	public function users_get()
	{
		// Get userid parameter from the query.
		$userid = $this->get('userid');
		
		// If the userid is NULL, return all users.
		if ($userid === NULL)
		{
			// TODO: Get all users from the database.
			$users = 'dummy get all users';
			
			// TODO: Check if the users data store contains users (in case the database result returns NULL)
			if ($users)
			{
				$this->response($users, REST_Controller::HTTP_OK);
			}
			else
			{
				$this->response("No users found.", REST_Controller::HTTP_NOT_FOUND);
			}
		}

		// TODO: Find and return a single record for a particular user.
		$userid = (int) $userid;

		/* Validate the ID.
		   UserID field in the database must be >= 1.
		   TODO: Move to separate function later.
		 */
		if ($userid <= 0)
		{
			// Invalid id.
			$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
		}

		// TODO: Get specific user from database.
		$user = NULL;

		if (!empty($user))
		{
			$this->set_response($user, REST_Controller::HTTP_OK);
		}
		else
		{
			$this->set_response("User with the ID " . $userid . " not found.", REST_Controller::HTTP_NOT_FOUND);
		}
	}
	
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
			$this->set_response("User with the ID " . $userid . " not found.", REST_Controller::HTTP_NOT_FOUND);
		}

		if ($datatype !== NULL)
		{
			// Error checking, this should always be true when datatype is not NULL.
			if ($collectionid === NULL && $commentid === NULL)
			{
				switch ($datatype)
				{
					case "collections":
						$collections = "dummy get all user collections";
			
						if ($collections)
						{
							$this->response($collections, REST_Controller::HTTP_OK);
						}
						else
						{
							$this->response("User has no collections.", REST_Controller::HTTP_NOT_FOUND);
						}
						break;
					case "comments":
						$comments = "dummy get all user comments";
			
						if ($comments)
						{
							$this->response($comments, REST_Controller::HTTP_OK);
						}
						else
						{
							$this->response("User has no comments.", REST_Controller::HTTP_NOT_FOUND);
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
			$this->set_response($errorMessage, REST_Controller::HTTP_NOT_FOUND);
		}
	}
}
