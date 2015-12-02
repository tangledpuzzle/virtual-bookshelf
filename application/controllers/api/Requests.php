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
			$users = 'dummy get users';
			
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
	
	public function usercollections_get()
	{
		// Get userid parameter from the query.
		$userid = $this->get('userid');
	
		// Get collectionid parameter from the query.
		$collectionid = $this->get('collectionid');
		
		// TODO: Validate userid and collectionid in a separate function.
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

		// If the collectionid is NULL, return all collections.
		if ($collectionid === NULL)
		{
			// TODO: Get all user collections from the database.
			$collections = "dummy get user collections";
			
			if ($collections)
			{
				$this->response($collections, REST_Controller::HTTP_OK);
			}
			else
			{
				$this->response("User has no collections.", REST_Controller::HTTP_NOT_FOUND);
			}
		}
		
		// TODO: Find and return a single record for a particular user.
		$collectionid = (int) $collectionid;

		//TODO: Validate
		if ($collectionid <= 0)
		{
			// Invalid collectionid.
			$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
		}

		// TODO: Get specific collection from database.
		$collection = NULL;

		if (!empty($collection))
		{
			$this->set_response($collection, REST_Controller::HTTP_OK);
		}
		else
		{
			$this->set_response("User ID " . $userid . " does not have a collection with the ID " . $collectionid . ".", REST_Controller::HTTP_NOT_FOUND);
		}
	}
	
	public function usercomments_get()
	{
		// Get userid parameter from the query.
		$userid = $this->get('userid');
	
		// Get commentid parameter from the query.
		$commentid = $this->get('commentid');
		
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

		// If the commentid is NULL, return all comments.
		if ($commentid === NULL)
		{
			// TODO: Get all user comments from the database.
			$comments = "dummy get user comments";
			
			if ($comments)
			{
				$this->response($comments, REST_Controller::HTTP_OK);
			}
			else
			{
				$this->response("User has no comments.", REST_Controller::HTTP_NOT_FOUND);
			}
		}
		
		$commentid = (int) $commentid;

		//TODO: Validate
		if ($commentid <= 0)
		{
			// Invalid commentid.
			$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
		}

		// TODO: Get specific comment from database.
		$comment = NULL;

		if (!empty($comment))
		{
			$this->set_response($comment, REST_Controller::HTTP_OK);
		}
		else
		{
			$this->set_response("User ID " . $userid . " does not have a comment with the ID " . $commentid . ".", REST_Controller::HTTP_NOT_FOUND);
		}
	}
}
