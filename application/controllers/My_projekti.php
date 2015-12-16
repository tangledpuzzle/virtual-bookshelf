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
		
		// Load Community Auth variables.
		$this->is_logged_in();
		
		// Is the user logged in?
		if($this->auth_level !== NULL)
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
		// Community Auth: Is the user logged in?
		if($this->auth_level !== NULL)
		{
			// Get logged in user id from Community Auth.
			$logged_in_user_id = (int) $this->auth_user_id;
		}
		else
		{
			// Else set id to -1. IDs <= 0 are invalid.
			$logged_in_user_id = -1;
		}
		
		switch ($page)
		{
			case "booklist":
				$data["books"] = json_encode($this->r2pdb_model->get_products_display());
				break;
				
			case "userlist":
				$data["users"] = json_encode($this->r2pdb_model->get_users_display());
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
					$data["collection"] = json_encode($this->r2pdb_model->get_collections_by_id_display($id));
					
				}
				else
				{
					$data["error_message"] = "Invalid collection ID '" . $id . "'.";
				}
				
				break;
				
			case "review":	// Read review.
				// Review ID comes from the URL routing.
				$review_id = $data["id"];
				
				// For some reason the previous data needs to be cleared before it can be initialized with an array.
				$data = NULL;
				
				// Validate ID.
				if ($this->r2pdb_model->is_valid_review_id($review_id) === TRUE)
				{
					// Was data submitted to this page with HTTP POST?
					if($this->input->post('submit'))
					{
						// Is the user logged in?
						if($logged_in_user_id > 0)
						{
							$this->r2pdb_model->add_review_comment($logged_in_user_id,
																   $this->input->post("comment-text"),
																   $review_id);
						}
						else
						{
							$data["error_message"] = "You need to be logged in to write reviews.";
						}
					}
					
					// Get data from database.
					$data["review"] = $this->r2pdb_model->get_review_by_id_display($review_id);
					$data["comment_type"] = "review";
					$data["comment_target_id"] = $review_id;
					$data["comments"] = json_encode($this->r2pdb_model->get_review_comments_display($review_id));
				}
				else
				{
					$data["error_message"] = "Invalid review ID '" . $review_id . "'.";
				}
				break;
			
			case "userview":
				// User ID comes from the URL routing.
				$user_id = $data["id"];
				
				// For some reason the previous data needs to be cleared before it can be initialized with an array.
				$data = NULL;
				
				// Validate ID.
				if ($this->r2pdb_model->is_valid_user_id($user_id) === TRUE)
				{
					// Was data submitted to this page with HTTP POST?
					if($this->input->post('submit'))
					{
						// Is the user logged in?
						if($logged_in_user_id > 0)
						{
							$this->r2pdb_model->add_user_comment($logged_in_user_id,
																 $this->input->post("comment-text"),
																 $user_id);
						}
						else
						{
							$data["error_message"] = "You need to be logged in to write comments.";
						}
					}
					
					// Get user data from database.
					$data["user"] = json_encode($this->r2pdb_model->get_user_by_id_display($user_id));
					
					// Get a short info list of this user's collections from database.
					$data["collections"] = json_encode($this->r2pdb_model->get_user_collections_short_display($user_id));
					
					// Comment type for writing comments.
					$data["comment_type"] = "user";
					
					// User ID to attach written comment to.
					$data["comment_target_id"] = $user_id;
					
					// Existing comments for this user.
					$data["comments"] = json_encode($this->r2pdb_model->get_user_comments_display($user_id));
					
					// Give the JavaScript script information (through the view PHP file) if the current user is logged in to selectively disable dynamically created site features.
					$data["logged_in_user_id"] = $logged_in_user_id;
				}
				else
				{
					$data["error_message"] = "Invalid user ID '" . $user_id . "'.";
				}
				break;
					
			case "myprofile":
				// Is the user logged in?
				if($logged_in_user_id > 0)
				{
					// ID comes from the cookie.
					$user_id = $logged_in_user_id;

					// My profile just routes to the standard user view page.
					$page = "userview";

					// For some reason the previous data needs to be cleared before it can be initialized with an array.
					$data = NULL;

					// Validate ID.
					if ($this->r2pdb_model->is_valid_user_id($user_id) === TRUE)
					{
						// Was data submitted to this page with HTTP POST?
						if($this->input->post('submit'))
						{
							// Is the user logged in?
							if($logged_in_user_id > 0)
							{
								$this->r2pdb_model->add_user_comment($logged_in_user_id,
																	 $this->input->post("comment-text"),
																	 $user_id);
							}
							else
							{
								$data["error_message"] = "You need to be logged in to write comments.";
							}
						}
						
						// Get user data from database.
						$data["user"] = json_encode($this->r2pdb_model->get_user_by_id_display($user_id));
						
						// Comment type for writing comments.
						$data["comment_type"] = "user";
						
						// Existing comments for this user.
						$data["comments"] = json_encode($this->r2pdb_model->get_user_comments_display($user_id));
	
						// Give the JavaScript script information (through the view PHP file) if the current user is logged in to selectively disable dynamically created site features.
						$data["logged_in_user_id"] = $logged_in_user_id;
					}
					else
					{
						$data["error_message"] = "Invalid user ID '" . $user_id . "'.";
					}
				}
				else
				{
					$data["error_message"] = "You need to be logged in to view your profile.";
				}
				break;
				
			case "profileedit":
				// Is the user logged in?
				if($logged_in_user_id > 0)
				{
					// ID comes from the cookie.
					$user_id = $logged_in_user_id;

					// For some reason the previous data needs to be cleared before it can be initialized with an array.
					$data = NULL;

					// Validate ID.
					if ($this->r2pdb_model->is_valid_user_id($user_id) === TRUE)
					{
						// Get user data from database.
						$data["user"] = $this->r2pdb_model->get_user_by_id_display($user_id);
					}
					else
					{
						$data["error_message"] = "Invalid user ID '" . $user_id . "'.";
					}
				}
				else
				{
					$data["error_message"] = "You need to be logged in to edit your profile.";
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
					// Was data submitted to this page with HTTP POST?
					if($this->input->post('submit'))
					{
						$collection_id = $this->input->post("collection-id");
						$collection_name = $this->input->post("collection-name");
						$user_id = $logged_in_user_id;
						$comment = $this->input->post("comment-text");
						$delete_comment_id = $this->input->post("delete_comment_id");
						
						// Is there comment text data?
						if ($comment !== NULL)
						{
							// Is the user logged in?
							if($logged_in_user_id > 0)
							{
								// Post comment.
								$this->r2pdb_model->add_product_comment($user_id, $comment, $book_id);
							}
							else
							{
								$data["error_message"] = "You need to be logged in to write comments.";
							}
						}
						else if ($collection_name !== NULL)	// Collection data?
						{
							// Is the user logged in?
							if($logged_in_user_id > 0)
							{
								// Add to existing collection?
								if ($collection_id > 0)
								{
									$this->r2pdb_model->add_product_id_to_collection($book_id, $collection_id);
									
									// FIXME: Handle success message.
									$data["success_message"] = "Book added to shelf " . $collection_name . "!";
								}
								else
								{
									$collection_id = $this->r2pdb_model->add_collection($collection_name, $logged_in_user_id);
									// Create a new collection.
									if ($collection_id > 0)
									{
										// On success, add product to the collection.
										$this->r2pdb_model->add_product_id_to_collection($book_id, $collection_id);
										$data["success_message"] = "New shelf " . $collection_name . " created and book added!";
									}
									else
									{
										$data["error_message"] = "Attempt to create a new shelf '" . $collection_name . "' failed.";
									}
								}
							}
							else
							{
								$data["error_message"] = "You need to be logged in to add books to shelves.";
							}
						}
						else if ($delete_comment_id !== NULL)	// Comment deletion data?
						{
							// Is the user an admin?
							if($this->auth_level >= 9)
							{
								$this->r2pdb_model->remove_product_comment($book_id, $delete_comment_id);
								
								// FIXME: Handle success message.
								$data["success_message"] = "Comment deleted.";
							}
							else
							{
								$data["error_message"] = "You must be an admin to delete comments.";
							}
						}
						// Otherwise do nothing.
					}

					// Get book data from database.
					$data["book"] = json_encode($this->r2pdb_model->get_product_by_id_display($book_id));
					
					// Get reviews written for this book.
					$data['reviews'] = json_encode($this->r2pdb_model->get_review_infos_by_product_id_display($book_id));

					// Comment type for writing comments.
					$data["comment_type"] = "product";
					
					// Book ID to attach written comment to.
					$data["comment_target_id"] = $book_id;
					
					// Existing comments for this book.
					$data["comments"] = json_encode($this->r2pdb_model->get_product_comments_display($book_id));
					
					// Give the JavaScript script information (through the view PHP file) if the current user is logged in to selectively disable dynamically created site features.
					$data["logged_in_user_id"] = $logged_in_user_id;
					
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
			// Does the wanted page exist?
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
			
			// Load collections after the page?
			if (isset($data["collections"]))
			{
				$this->load->view('pages/collectionlist', $data);
			}
			
			// Load comments after the page?
			if (isset($data["comment_type"]))
			{
				// Is the user an admin?
				if($this->auth_level >= 9)
				{
				// The value is an int because PHP echos booleans as int.
					$data["user_is_admin"] = 1;
				}
				else
				{
					$data["user_is_admin"] = 0;
				}
					
				// Load list of comments.
				$this->load->view('pages/commentlist', $data);
				
				// Is the user logged in?
				if($logged_in_user_id > 0)
				{
					// Load comment writing box.
					$this->load->view('pages/comment', $data);
				}
				// User not logged in, do not load comment writing.
			}
		}
	}
}