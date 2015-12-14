<?php

class My_projekti extends MY_Controller
{
	function __construct()
	{
        parent::__construct();
    }
	
	public function view($page = 'front', $data = NULL)
	{
		// Page existence check is performed only just before the page is loaded to allow for "fake URLS" like /myprofile.
		
		// Is there ID data from URL routing?
		// I.e. $data is an int.
		if (!is_array($data))
		{
			// Assign ID data into array.
			$id = $data;
			$data = null;
			$data["id"] = $id;
		}
		
		// Is the user logged in?
		if($this->verify_min_level(1))
		{
			if( $http_user_cookie_contents = $this->input->cookie(config_item('http_user_cookie_name')))
			{
				$data["cookie"] = unserialize( $http_user_cookie_contents );
			}
		}
			
		$this->load->view('templates/header', $data);
		
		$this->load_page($page, $data);
		
		$this->load->view('templates/footer');
	}
	
	private function load_page($page, $data)
	{
		switch ($page)
		{
			case "booklist":
				$data["books"] = json_encode($this->r2pdb_model->get_products_display());
				break;
				
			case "collectionview":
				// ID comes from the URL routing.
				$id = $data["id"];
				
				// For some reason the previous data needs to be cleared before it can be initialized with an array.
				$data = NULL;
				
				// Validate ID.
				if ($this->r2pdb_model->is_valid_collection_id($id) === TRUE)
				{
					// Get data from database.
					$data["collection"] = json_encode($this->r2pdb_model->get_collection_by_id_display($id));
					
				}
				else
				{
					$data["error_message"] = "Invalid collection ID '" . $id . "'.";
				}
				
				
				break;
				
			case "userlist":
				
				$data["users"] = json_encode($this->r2pdb_model->get_users_display());
				break;
				
			case "review":
				// ID comes from the URL routing.
				$review_id = $data["id"];
				
				// For some reason the previous data needs to be cleared before it can be initialized with an array.
				$data = NULL;
				
				// Validate ID.
				if ($this->r2pdb_model->is_valid_review_id($review_id) === TRUE)
				{
					// Get data from database.
					$data["review"] = $this->r2pdb_model->get_review_by_id_display($review_id);
					$data["comment_type"] = "review";
				}
				else
				{
					$data["error_message"] = "Invalid review ID '" . $review_id . "'.";
				}
				break;
			
			case "userview":
				// ID comes from the URL routing.
				$user_id = $data["id"];
				
				// For some reason the previous data needs to be cleared before it can be initialized with an array.
				$data = NULL;
				
				// Validate ID.
				if ($this->r2pdb_model->is_valid_user_id($user_id) === TRUE)
				{
					// Get data from database.
					$data["user"] = json_encode($this->r2pdb_model->get_user_by_id_display($user_id));
					$data["comment_type"] = "user";
				}
				else
				{
					$data["error_message"] = "Invalid user ID '" . $user_id . "'.";
				}
				break;
					
			case "myprofile":
				// ID comes from the cookie.
				$user_id = $this->auth_user_id;

				// My profile just routes to the standard user view page.
				$page = "userview";
				
				// For some reason the previous data needs to be cleared before it can be initialized with an array.
				$data = NULL;
				
				// Validate ID.
				if ($this->r2pdb_model->is_valid_user_id($user_id) === TRUE)
				{
					// Get data from database.
					$data["user"] = json_encode($this->r2pdb_model->get_user_by_id_display($user_id));
					$data["comment_type"] = "user";
				}
				else
				{
					print_r($user_id);
					$data["error_message"] = "Invalid user ID '" . $user_id . "'.";
				}
				break;
				
			case "bookview":
				// ID comes from the URL routing.
				$book_id = $data["id"];
				
				// For some reason the previous data needs to be cleared before it can be initialized with an array.
				$data = NULL;
				
				// Validate ID.
				if ($this->r2pdb_model->is_valid_product_id($book_id) === TRUE)
				{
					// Get data from database.
					$data["book"] = json_encode($this->r2pdb_model->get_product_by_id_display($book_id));
					$data['reviews'] = json_encode($this->r2pdb_model->get_review_infos_by_product_id_display($book_id));
					$data["comment_type"] = "product";
				}
				else
				{
					$data["error_message"] = "Invalid book ID '" . $book_id . "'.";
				}
				break;
		}
		
		// If an error message was set, load an error page.
		if (isset($data["error_message"]))
		{
				$this->load->view('pages/error', $data);
		}
		else
		{
			if (!file_exists(APPPATH . 'views/pages/' . $page . '.php'))
			{
				echo "Unable to find " . APPPATH . 'views/pages/' . $page . '.php';
				show_404();
			}
			
			// Otherwise proceed with page load.
			$this->load->view('pages/'.$page, $data);
			
			// Load reviews after the page?
			if (isset($data["reviews"]))
			{
				$this->load->view('pages/reviewlist', $data);
			}
			
			// Load comments after the page?
			if (isset($data["comment_type"]))
			{
				$this->load->view('pages/comment', $data);
			}
		}
	}
}