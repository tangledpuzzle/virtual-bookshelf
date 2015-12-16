<?php
/**
* MySQL database model.
* @package r2pdb_model
* @author Jose Uusitalo
*/
class R2pdb_model extends CI_Model
{
	/**
	* Returns a string containg the names of the table columns that contain publicly viewable information.
	* @param string $table_name name of the table
	* @return string|null|boolean public data columns names as a string, FALSE for unknown table name, NULL if $table_name was null 
	*/
	private function get_public_data_columns($table_name)
	{
		if ($table_name !== NULL)
		{
			switch ($table_name)
			{
				case "collections":
				case "comments":
				case "countries":
				case "genders":
				case "genres":
				case "products":
				case "publishers":
				case "reviews":
					return "*";
				case "users":
					return "user_id, user_date, FirstName, LastName, Age, GenderID, CountryID, ScreenName, AvatarPath, Bio";
				default:
					// WARNING: Will throw a PHP error.
					return NULL;
			}
			
			return FALSE;
		}
	}
	
	/**
	* Returns a string containg the names of the table columns that contain publicly viewable information. For use with the display data getter.
	* @param string $table_name name of the table
	* @return string|null|boolean public data columns names as a string, FALSE for unknown table name, NULL if $table_name was null 
	*/
	private function get_public_data_columns_display($table_name)
	{
		if ($table_name !== NULL)
		{
			switch ($table_name)
			{
				case "reviewComments":
				case "userComments":
				case "productComments":
				case "comments":
					return "comments.CommentID, PostDate, comments.user_id, ScreenName, comments.Text";
				case "countries":
					return "CountrySymbol, CountryName, FlagPath";
				case "genders":
					return "GenderName";
				case "genres":
					return "GenreName";
				case "products":
					return "ProductID, Name, ReleaseDate, ImagePath, LanguageName, Brief, Description, EAN13, PublisherName";
				case "publishers":
					return "PublisherName";
				case "reviews":
					return "ReviewID, ReviewDate, reviews.ProductID, Name, ScreenName, reviews.user_id, Text, Pros, Cons, Rating";
				case "users":
					return "user_id, ScreenName, FirstName, LastName, Age, GenderName, CountryName, user_date, AvatarPath, Bio";
				case "userCollections":
					return "userCollections.user_id, userCollections.CollectionID, CollectionName, products.ProductID, Name, ReleaseDate, ImagePath, LanguageName, Brief, Description, EAN13, PublisherName";
				case "collections":
					return "*";
				default:
					// WARNING: Will throw a PHP error.
					return NULL;
			}
			
			return FALSE;
		}
	}
	
	/**
	* Returns the name of the ID column of the given table name.
	* @param string $table_name name of the table
	* @return string|null|boolean name of ID column as string, FALSE for unknown table name, NULL if $table_name was null 
	*/
	private function get_id_column_from_table($table_name)
	{
		if ($table_name !== NULL)
		{
			switch ($table_name)
			{
				case "userCollections":
					return "user_id, CollectionID";
				case "collections":
					return "CollectionID";
				case "comments":
					return "CommentID";
				case "countries":
					return "CountryID";
				case "genders":
					return "GenderID";
				case "genres":
					return "GenreID";
				case "products":
					return "ProductID";
				case "publishers":
					return "PublisherID";
				case "reviews":
					return "ReviewID";
				case "users":
					return "user_id";
				default:
					return NULL;
			}
			
			return FALSE;
		}
	}
	
	/**
	* Makes the appropriate fields have the correct data type as specified in the database table, instead of everything being a string.
	* @param object $query raw database query object
	* @return object|null array an array of arrays containing the rows of the table or NULL if given query was null
	*/
	private function correct_result_data_types($query)
	{
		if ($query !== NULL)
		{
			/* Array of key-value pairs, example:
			{"name":"user_id","type":3,"max_length":1,"primary_key":0,"default":""},
			{"name":"ScreenName","type":253,"max_length":17,"primary_key":0,"default":""}
			*/
			$fields = $query->field_data();
			$results = $query->result_array();
			
			// Rows
			foreach ($results as $id => $result)
			{
				$col = 0;
				// Columns
				foreach ($result as $column => $value)
				{
					// Check the data type of this column.
					switch($fields[$col]->type)
					{
						case 1: // Tiny int
						case 2: // Small int
						case 3: // Int
							$result[$column] = (int) $value;
							break;
						case 12: // Datetime
						default: // Some other type.
							// Keep as string.
							break;
					}
					$col++;
					// Put the changed values back into the results.
					$results[$id] = $result;
				}
			}
			return $results;
		}
		
		return NULL;
	}
	
	/**
	* Validates given row ID value.
	* @param int $id row ID
	* @param string $table_name name of the table
	* @return boolean|null TRUE if the ID is valid and present in the table,
							FALSE if ID is not present or is invalid,
							NULL if $table_name or $id was null or table name is unknown
	*/
	public function validate_row_id($table_name, $id)
	{
		// FIXME: FAILS ON "123GSDSR"
		if ($id !== NULL && $table_name !== NULL)
		{
			if ((int) $id > 0)
			{
				$id_column_name = $this->get_id_column_from_table($table_name);		
				
				// Null check was performed earlier.
				if ($id_column_name !== NULL)
				{
					$query = $this->db->get_where($table_name, array($id_column_name => $id));
					$this->db->reset_query();
					
					/* Not all database drivers have a native way of getting the total number of rows for a result set.
					When this is the case, all of the data is prefetched and count() is manually called on the resulting array in order to achieve the same result. */

					if ($query->num_rows() > 0)
					{
						return TRUE;
					}
					else
					{
						return FALSE;
					}
				}
				return NULL;
			}
			return FALSE;
		}
		return NULL;
	}
	
	// Copied from Community Auth examples.
	/**
    * Get an unused ID for user creation.
    *
    * @return  int between 1200 and 4294967295
    */
    public function get_unused_user_id()
    {
        // Create a random user id
        $random_unique_int = 2147483648 + mt_rand( -2147482447, 2147483647 );

        // Make sure the random user_id isn't already in use
        $query = $this->db->where('user_id', $random_unique_int)->get_where(config_item('user_table'));

        if ($query->num_rows() > 0)
		{
            $query->free_result();

            // If the random user_id is already in use, get a new number by recursively calling this function until a free ID is found.
            return $this->get_unused_user_id();
        }

        return $random_unique_int;
    }
	
	/* 
	 * GENERIC PRIVATE DATA GETTERS
	 */
	
	/**
	* A generic get data function for a variable number of fields. Warning: Fewer integrity checks are performed with this function, use with caution.
	* @param various $arg_array a key-value array of database field names to sort by, use "table_name" key for table name
	* @return array|null an array of arrays containing found rows,
							NULL if no arguments were given 
	*/
	public function get_rows_by_field_display()
	{
		$arg_list = func_get_args()[0];
		
        if ($arg_list !== NULL && count($arg_list))
        {
			$table_name = $arg_list["table_name"];
			unset($arg_list["table_name"]); // Remove table_name element from array as it is not a field.
			$this->db->where($arg_list); // Add all fields to WHERE statement.
			
			$this->db->select($this->get_public_data_columns_display($table_name));
	
			// Left join the correct tables.
			switch ($table_name)
			{
				case "reviewComments":
					$this->db->join("comments", 'comments.CommentID = reviewComments.CommentID', 'left');
					$this->db->join("users", 'users.user_id = comments.user_id', 'left');
					$this->db->join("reviews", 'reviews.ReviewID = reviewComments.ReviewID', 'left');
					break;
				case "userComments":
					$this->db->join("comments", 'comments.CommentID = userComments.CommentID', 'left');
					$this->db->join("users", 'users.user_id = comments.user_id', 'left');
					break;
				case "productComments":
					$this->db->join("comments", 'comments.CommentID = productComments.CommentID', 'left');
					$this->db->join("users", 'users.user_id = comments.user_id', 'left');
					$this->db->join("products", 'products.ProductID = productComments.ProductID', 'left');
					break;
				case "reviews":
					$this->db->join("products", 'products.ProductID = reviews.ProductID', 'left');
					$this->db->join("users", 'users.user_id = reviews.user_id', 'left');
					break;
				case "comments":
					$this->db->join("users", 'users.user_id = comments.user_id', 'left');
					break;
				case "products":
					$this->db->join("languages", 'languages.LanguageID = products.LanguageID', 'left');
					$this->db->join("publishers", 'publishers.PublisherID = products.PublisherID', 'left');
					break;
				case "users":
					$this->db->join("countries", 'countries.CountryID = users.CountryID', 'left');
					$this->db->join("genders", 'genders.GenderID = users.GenderID', 'left');
					break;
				case "collections":
				case "countries":
				case "genders":
				case "genres":
				case "publishers":
				default:
					// No foreign keys to join.
					break;
			}

			$this->db->order_by($this->get_id_column_from_table($table_name), 'ASC');
			
			$query = $this->db->get($table_name);
			$this->db->reset_query();
			return $this->correct_result_data_types($query);
	
			return $query->result_array();
        }
		return NULL;
	}
	
	/*
	* A generic get data function for a variable number of fields. Warning: Fewer integrity checks are performed with this function, use with caution.
	* @param various $arg_array a key-value array of database field names to sort by, use "!table_name" key for table name
	* @return array|null an array of arrays containing found rows, NULL if no arguments were given 
	
	public function get_rows_by_field()
	{
		$arg_list = func_get_args()[0];
		
        if ($arg_list !== NULL && count($arg_list))
        {
			$table_name = $arg_list["table_name"];
			unset($arg_list["table_name"]); // Remove table_name element from array as it is not a field.
			$this->db->where($arg_list); // Add all fields to WHERE statement.
			
			$query = $this->db->get($table_name);
			$this->db->reset_query();
			return $query->result_array();
        }
		return NULL;
	}*/
	
	/*
	* A generic get data by id function for a single row.
	* @param int $id row ID
	* @param string $table_name name of the table
	* @return array|boolean|null an array of arrays containing found rows, FALSE for invalid ID or unknown table name, NULL if $table_name or $id was null 
	
	private function get_row_by_id($table_name, $id)
	{
		$valid = $this->validate_row_id($table_name, $id);
		
        if ($valid !== NULL)
        {
			if ($valid)
			{
				$query = $this->db->get_where($table_name, array($this->get_id_column_from_table($table_name) => (int) $id));
				$this->db->reset_query();
				return $query->result_array();
			}
			return FALSE;
        }
		return NULL;
	}*/
	
	/**
	* A generic get data function for all rows in a table.
	* @param string $table_name name of the table
	* @return array an array of arrays containing the rows of the table 
	*/
	private function get_row_by_id_display($table_name, $id)
	{
		$valid = $this->validate_row_id($table_name, $id);
		
        if ($valid !== NULL)
        {
			if ($valid)
			{
				$this->db->select($this->get_public_data_columns_display($table_name));
				
				// Left join the correct tables.
				switch ($table_name)
				{
					case "reviews":
						$this->db->join("products", 'products.ProductID = reviews.ProductID', 'left');
						$this->db->join("users", 'users.user_id = reviews.user_id', 'left');
						break;
					case "comments":
						$this->db->join("users", 'users.user_id = comments.user_id', 'left');
						break;
					case "products":
						$this->db->join("languages", 'languages.LanguageID = products.LanguageID', 'left');
						$this->db->join("publishers", 'publishers.PublisherID = products.PublisherID', 'left');
						break;
					case "users":
						$this->db->join("countries", 'countries.CountryID = users.CountryID', 'left');
						$this->db->join("genders", 'genders.GenderID = users.GenderID', 'left');
						break;
					case "collections":
					case "countries":
					case "genders":
					case "genres":
					case "publishers":
					default:
						// No foreign keys to join.
						break;
				}

				$this->db->where($this->get_id_column_from_table($table_name), (int) $id);
				
				$query = $this->db->get($table_name);

				$this->db->reset_query();

				// Correcting the array data types (i.e. numerical data into ints because the database driver returns everything as a string) and returning the first row because IDs are unique.
				return $this->correct_result_data_types($query)[0];
			}
			return FALSE;
        }
		return NULL;
	}
	
	/**
	* A generic get data function for all rows in a table.
	* @param string $table_name name of the table
	* @return array an array of arrays containing the rows of the table 
	*/
	private function get_table_rows($table_name)
	{
		$this->db->select($this->get_public_data_columns($table_name))->get_compiled_select($table_name, FALSE);
		$query = $this->db->get();
		$this->db->reset_query();
		return $query->result_array();
	}
	
	/**
	* A generic get data function for all rows in a table.
	* @param string $table_name name of the table
	* @return array an array of arrays containing the rows of the table 
	*/
	private function get_table_rows_display($table_name)
	{
		$this->db->select($this->get_public_data_columns_display($table_name));
		
			// Left join the correct tables.
			switch ($table_name)
			{
				case "reviews":
					$this->db->join("products", 'products.ProductID = reviews.ProductID', 'left');
					$this->db->join("users", 'users.user_id = reviews.user_id', 'left');
					break;
				case "comments":
					$this->db->join("users", 'users.user_id = comments.user_id', 'left');
					break;
				case "products":
					$this->db->join("languages", 'languages.LanguageID = products.LanguageID', 'left');
					$this->db->join("publishers", 'publishers.PublisherID = products.PublisherID', 'left');
					break;
				case "users":
					$this->db->join("countries", 'countries.CountryID = users.CountryID', 'left');
					$this->db->join("genders", 'genders.GenderID = users.GenderID', 'left');
					break;
				case "collections":
				case "countries":
				case "genders":
				case "genres":
				case "publishers":
				default:
					// No foreign keys to join.
					break;
			}
		
		$this->db->order_by($this->get_id_column_from_table($table_name), 'ASC');
		
		$query = $this->db->get($table_name);
		$this->db->reset_query();
		
		return $this->correct_result_data_types($query);
	}
	
	/* 
	 * PUBLIC DATA SETTERS
	 */
	
	/**
	* Insert data into the reviews table.
	* Warning: Does not perform data integrity checks.
	* @param int $user_id user id who wrote the review
	* @param int $product_id product id the review is about
	* @param int $rating rating number in the range [1,5]
	* @param string $review review text
	* @param string $pros positive things
	* @param string $cons negative things
	* @return boolean|null TRUE if review was added,
							FALSE if database query failed,
	*/
	public function add_review($user_id, $product_id, $rating, $review, $pros, $cons)
	{
		date_default_timezone_set('Europe/Helsinki');
		$data = array(
			'ReviewDate' => date('Y-m-d H:m:s'),
			'ProductID' => $product_id,
			'user_id' => $user_id,
			'Text' => $review,
			'Pros' => $pros,
			'Cons' => $cons,
			'Rating' => $rating
		);
		// Return TRUE on success, FALSE on failure
		return $this->db->insert('reviews', $data);
	}
	
	/**
	* Insert given product to given collection.
	* Warning: Does not perform data integrity checks.
	* $productid int product ID
	* $collectionid int collection ID
	* @return boolean TRUE if product was added,
							 FALSE if database query failed
	*/
	public function add_product_id_to_collection($productid, $collectionid)
	{
		// INSERT: 'column name' => value
		$data = array(
			'CollectionID' => $collectionid,
			'ProductID' => $productid
		);
		// Return TRUE on success, FALSE on failure
		return $this->db->insert('collectionProducts', $data);
	}
	
	
	/**
	* Insert a new collection for a user.
	* Warning: Does not perform data integrity checks.
	* $name string collection name
	* $user_id int user ID who created the collection
	* @return boolean TRUE if collection was added,
							 FALSE if database query failed
	*/
	public function add_collection($name, $user_id)
	{
		// INSERT: 'column name' => value
		$data = array(
			'CollectionName' => $name
		);
		// Return TRUE on success, FALSE on failure
		$success = $this->db->insert('collections', $data);
		
		if ($success)
		{
			$collection_id = $this->db->insert_id();
			// INSERT: 'column name' => value
			// $this->db->insert_id() returns the ID of the last insert statement.
			$data = array(
				'CollectionID' => $collection_id,
				'user_id' => $user_id
			);
			
			// Link comment to user profile.
			// Return TRUE on success, FALSE on failure
			if ($this->db->insert('userCollections', $data) === TRUE)
			{
				return $collection_id;
			}
			else
			{
				return 0;
			}
		}
		return FALSE;
	}
	
	/**
	* Deletes given product from given collection.
	* Warning: Does not perform data integrity checks.
	* $productid int product ID
	* $collectionid int collection ID
	* @return boolean TRUE if product was removed,
							 FALSE if database query failed
	*/
	public function remove_product_id_from_collection($productid, $collectionid)
	{
		// WHERE: 'column name' => value
		$data = array(
			'CollectionID' => $collectionid,
			'ProductID' => $productid
		);
		
		// If FALSE query failed
		if ($this->db->delete('collectionProducts', $data) === FALSE)
		{
			return FALSE;
		}
		return TRUE;
	}
	
	/**
	* Insert data into the user comments table.
	* Warning: Does not perform data integrity checks.
	* @param int $user_id user id who wrote the comment
	* @param string $text comment text
	* @param int $target_user_id user id the comment is about
	* @return boolean TRUE if comment was added,
						FALSE if database query failed,
	*/
	public function add_user_comment($user_id, $text, $target_user_id)
	{
		date_default_timezone_set('Europe/Helsinki');
		
		// INSERT: 'column name' => value
		$data = array(
			'PostDate' => date('Y-m-d H:m:s'),
			'user_id' => $user_id,
			'Text' => $text
		);
		
		// Insert comment data.
		// Returns TRUE on success, FALSE on failure
		$success = $this->db->insert('comments', $data);
		
		if ($success)
		{
			// INSERT: 'column name' => value
			// $this->db->insert_id() returns the ID of the last insert statement.
			$data = array(
				'CommentID' => $this->db->insert_id(),
				'user_id' => $target_user_id
			);
			
			// Link comment to user profile.
			// Return TRUE on success, FALSE on failure
			return $this->db->insert('userComments', $data);
		}
		return FALSE;
	}
	
	/**
	* Delete comment data.
	* Warning: Does not perform data integrity checks.
	* @param int $target_user_id user id of the person whose profile the comment is on
	* @param int $commentid comment id to be deleted
	* @return boolean TRUE if comment was deleted,
						FALSE if database query failed,
	*/
	public function remove_user_comment($target_user_id, $commentid)
	{
		// WHERE: 'column name' => value
		$data = array(
			'user_id' => $target_user_id,
			'CommentID' => $commentid
		);
		
		// Delete from user profile first because of foreign keys.
		// If FALSE query failed
		if ($this->db->delete('userComments', $data) === FALSE)
		{
			return FALSE;
		}
		else
		{
			// WHERE: 'column name' => value
			$data = array(
				'CommentID' => $commentid,
			);
		
			// Delete comment data.
			// If FALSE query failed
			if ($this->db->delete('comments', $data) === FALSE)
			{
				return FALSE;
			}
			
			return TRUE;
		}
	}
	
	/**
	* Insert data into the product comments table.
	* Warning: Does not perform data integrity checks.
	* @param int $user_id user id who wrote the comment
	* @param string $text comment text
	* @param int $target_product_id product id the comment is about
	* @return boolean TRUE if comment was added,
						FALSE if database query failed,
	*/
	public function add_product_comment($user_id, $text, $target_product_id)
	{
		date_default_timezone_set('Europe/Helsinki');
		
		// INSERT: 'column name' => value
		$data = array(
			'PostDate' => date('Y-m-d H:m:s'),
			'user_id' => $user_id,
			'Text' => $text
		);
		// Insert into comments.
		// Returns TRUE on success, FALSE on failure
		$success = $this->db->insert('comments', $data);
		
		if ($success)
		{
			// INSERT: 'column name' => value
			// $this->db->insert_id() returns the ID of the last insert statement.
			$data = array(
				'CommentID' => $this->db->insert_id(),
				'ProductID' => $target_product_id
			);
			
			// Link comment to product.
			// Return TRUE on success, FALSE on failure
			return $this->db->insert('productComments', $data);
		}
		return FALSE;
	}
	
	/**
	* Delete comment data.
	* Warning: Does not perform data integrity checks.
	* @param int $target_product_id product id the comment is about
	* @param int $commentid comment id to be deleted
	* @return boolean TRUE if comment was deleted,
						FALSE if database query failed,
	*/
	public function remove_product_comment($target_product_id, $commentid)
	{
		// WHERE: 'column name' => value
		$data = array(
			'ProductID' => $target_product_id,
			'CommentID' => $commentid
		);
		
		// Delete from product page first because of foreign keys.
		// If FALSE query failed
		if ($this->db->delete('productComments', $data) === FALSE)
		{
			return FALSE;
		}
		else
		{
			// Delete comment data.
			// WHERE: 'column name' => value
			$data = array(
				'CommentID' => $commentid,
			);
		
			// If FALSE query failed
			if ($this->db->delete('comments', $data) === FALSE)
			{
				return FALSE;
			}
			
			return TRUE;
		}
	}
	
	/**
	* Insert data into the review comments table.
	* Warning: Does not perform data integrity checks.
	* @param int $user_id user id who wrote the comment
	* @param string $text comment text
	* @param int $target_review_id review id the comment is about
	* @return boolean TRUE if comment was added,
						FALSE if database query failed,
	*/
	public function add_review_comment($user_id, $text, $target_review_id)
	{
		date_default_timezone_set('Europe/Helsinki');
		
		// INSERT: 'column name' => value
		$data = array(
			'PostDate' => date('Y-m-d H:m:s'),
			'user_id' => $user_id,
			'Text' => $text
		);
		// Insert into comments.
		// Returns TRUE on success, FALSE on failure
		$success = $this->db->insert('comments', $data);
		
		if ($success)
		{
			// INSERT: 'column name' => value
			// $this->db->insert_id() returns the ID of the last insert statement.
			$data = array(
				'CommentID' => $this->db->insert_id(),
				'ReviewID' => $target_review_id
			);
			
			// Link review to product.
			// Return TRUE on success, FALSE on failure
			return $this->db->insert('reviewComments', $data);
		}
		return FALSE;
	}
	
	/**
	* Delete comment data.
	* Warning: Does not perform data integrity checks.
	* @param int $target_review_id review id the comment is about
	* @param int $commentid comment id to be deleted
	* @return boolean TRUE if comment was deleted,
						FALSE if database query failed,
	*/
	public function remove_review_comment($target_review_id, $commentid)
	{
		// WHERE: 'column name' => value
		$data = array(
			'ReviewID' => $target_review_id,
			'CommentID' => $commentid
		);
		
		// Delete from review page first because of foreign keys.
		// If FALSE query failed
		if ($this->db->delete('reviewComments', $data) === FALSE)
		{
			return FALSE;
		}
		else
		{
			// Delete comment data.
			// WHERE: 'column name' => value
			$data = array(
				'CommentID' => $commentid,
			);
		
			// If FALSE query failed
			if ($this->db->delete('comments', $data) === FALSE)
			{
				return FALSE;
			}
			
			return TRUE;
		}
	}
	
	/* 
	 * SPECIFIC PUBLIC DATA GETTERS
	 */
	
	// collections
	
	/**
	* Get all collections with data formatting for display purposes.
	* @return array an array of arrays containing all collections
	*/
	public function get_collections_display()
	{
		return $this->get_table_rows_display("collections");
	}
	
	/**
	* Get a specific collection and contents by their ID with data formatting for display purposes.
	* @param int $id collection ID
	* @return array|boolean|null an array containing found collection as an array,
								FALSE for invalid ID,
								NULL if $id was null 
	*/
	public function get_collections_by_id_display($id)
	{
		$table_name ="collections";
		$this->db->select($this->get_public_data_columns_display($table_name));
		$this->db->where("collections.CollectionID", (int) $id);

		// Get collection id and name.
		$query = $this->db->get($table_name);
		
		// Only one row is returned.
		$collection = $this->correct_result_data_types($query)[0];
		$this->db->reset_query();
		
		// Get collection product data.
		$table_name = "collectionProducts";
		$this->db->select("products.ProductID, Name, ReleaseDate");
		$this->db->where("collectionProducts.CollectionID", (int) $id);

		// Left join with products to get product data.
		$this->db->join("products", 'collectionProducts.ProductID = products.ProductID', 'left');

		$this->db->order_by("collectionProducts.ProductID", 'ASC');

		// Get collection product data.
		$query = $this->db->get($table_name);
		$this->db->reset_query();
	
		$collection["Products"] = $this->correct_result_data_types($query);
		
		return $collection;
	}
	
	/**
	* Checks if given collection ID is present in the table.
	* @param int $product_id collection id number
	* @return boolean TRUE if ID is valid
	*/
	public function is_valid_collection_id($id)
	{
		return $this->validate_row_id('collections', (int) $id);
	}
	
	/**
	* Checks if given product ID is not present in the collection.
	* @param int $productid product id number
	* @param int $collection collection id number
	* @return boolean TRUE if ID is valid
	*/
	public function is_not_in_collection_id($productid, $collectionid)
	{
		$this->db->where(array("CollectionID" => (int) $collectionid, "ProductID" => (int) $productid));
		$this->db->select("CollectionID");
		$query = $this->db->get("collectionProducts");
		$this->db->reset_query();
		
		if ($query->num_rows() > 0)
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	// comments
	
	/*
	* Get all comments with data formatting for display purposes.
	* @return array an array of arrays containing all comments
	
	public function get_comments_display()
	{
		return $this->get_table_rows_display("comments");
	}*/
	
	/*
	* Get all comments without data formatting for display purposes.
	* @return array an array of arrays containing all comments
	
	public function get_comments()
	{
		return $this->get_table_rows("comments");
	}*/
	
	/**
	* Checks if given comment ID is present in the table.
	* @param int $id comment id number
	* @return boolean TRUE if ID is valid
	*/
	public function is_valid_comment_id($id)
	{
		return $this->validate_row_id('comments', (int) $id);
	}	
	
	/**
	* Get a specific comment by their ID with data formatting for display purposes.
	* @param int $id comment ID
	* @return array|boolean|null an array containing found comment as an array, FALSE for invalid ID, NULL if $id was null 
	*/
	public function get_comment_by_id_display($id)
	{
		return $this->get_row_by_id_display("comments", $id);
	}
	
	/*
	* Get a specific comment by their ID without data formatting for display purposes.
	* @param int $id comment ID
	* @return array|boolean|null an array containing found comment as an array, FALSE for invalid ID, NULL if $id was null 
	
	public function get_comment_by_id($id)
	{
		return $this->get_row_by_id("comments", $id);
	}*/
	
	// countries
	
	/**
	* Get all countries with data formatting for display purposes.
	* @return array an array of arrays containing all countries
	*/
	public function get_countries_display()
	{
		return $this->get_table_rows_display("countries");
	}
	
	/**
	* Get all countries without data formatting for display purposes.
	* @return array an array of arrays containing all countries
	
	public function get_countries()
	{
		return $this->get_table_rows("countries");
	}*/
	
	/**
	* Get a specific country by their ID with data formatting for display purposes.
	* @param int $id country ID
	* @return array|boolean|null an array containing found country as an array, FALSE for invalid ID, NULL if $id was null 
	*/
	public function get_country_by_id_display($id)
	{
		return $this->get_row_by_id_display("countries", $id);
	}
	
	/*
	* Get a specific country by their ID without data formatting for display purposes.
	* @param int $id country ID
	* @return array|boolean|null an array containing found country as an array, FALSE for invalid ID, NULL if $id was null 
	
	public function get_country_by_id($id)
	{
		return $this->get_row_by_id("countries", $id);
	}*/
	
	// genders
	
	/**
	* Get all genders with data formatting for display purposes.
	* @return array an array of arrays containing all genders
	*/
	public function get_genders_display()
	{
		return $this->get_table_rows_display("genders");
	}
	
	/**
	* Get all genders without data formatting for display purposes.
	* @return array an array of arrays containing all genders
	*/
	public function get_genders()
	{
		return $this->get_table_rows("genders");
	}
	
	/**
	* Get a specific gender by their ID with data formatting for display purposes.
	* @param int $id gender ID
	* @return array|boolean|null an array containing found gender as an array, FALSE for invalid ID, NULL if $id was null 
	*/
	public function get_gender_by_id_display($id)
	{
		return $this->get_row_by_id_display("genders", $id);
	}
	
	/*
	* Get a specific gender by their ID without data formatting for display purposes.
	* @param int $id gender ID
	* @return array|boolean|null an array containing found gender as an array, FALSE for invalid ID, NULL if $id was null 
	
	public function get_gender_by_id($id)
	{
		return $this->get_row_by_id("genders", $id);
	}*/
	
	// genres
	
	/**
	* Get all genres with data formatting for display purposes.
	* @return array an array of arrays containing all genres
	*/
	public function get_genres_display()
	{
		return $this->get_table_rows_display("genres");
	}
	
	/**
	* Get all genres without data formatting for display purposes.
	* @return array an array of arrays containing all genres
	*/
	public function get_genres()
	{
		return $this->get_table_rows("genres");
	}
	
	/**
	* Get a specific genre by their ID with data formatting for display purposes.
	* @param int $id genre ID
	* @return array|boolean|null an array containing found genre as an array, FALSE for invalid ID, NULL if $id was null 
	*/
	public function get_genre_by_id_display($id)
	{
		return $this->get_row_by_id_display("genres", $id);
	}
	
	/*
	* Get a specific genre by their ID without data formatting for display purposes.
	* @param int $id genre ID
	* @return array|boolean|null an array containing found genre as an array, FALSE for invalid ID, NULL if $id was null 
	
	public function get_genre_by_id($id)
	{
		return $this->get_row_by_id("genres", $id);
	}*/
	
	// products
	
	/**
	* Get all comments of a specific product with data formatting for display purposes.
	* @param int $productid id of the product
	* @return array an array of arrays containing all comments
	*/
	public function get_product_comments_display($productid)
	{
		$args = array("table_name" => "productComments", "products.ProductID" => (int) $productid);
		return $this->get_rows_by_field_display($args);
	}
	
	/**
	* Get all products with data formatting for display purposes.
	* @return array an array of arrays containing all products
	*/
	public function get_products_display()
	{
		return $this->get_table_rows_display("products");
	}
	
	/**
	* Get all products without data formatting for display purposes.
	* @return array an array of arrays containing all products
	*/
	public function get_products()
	{
		return $this->get_table_rows("products");
	}
	
	/**
	* Checks if given product ID is present in the table.
	* @param int $id product id number
	* @return boolean TRUE if ID is valid
	*/
	public function is_valid_product_id($id)
	{
		return $this->validate_row_id('products', (int) $id);
	}
	
	/**
	* Get a specific product by their ID with data formatting for display purposes.
	* @param int $id product ID
	* @return array|boolean|null an array containing found product as an array, FALSE for invalid ID, NULL if $id was null 
	*/
	public function get_product_by_id_display($id)
	{
		return $this->get_row_by_id_display("products", $id);
	}
	
	/*
	* Get a specific product by their ID without data formatting for display purposes.
	* @param int $id product ID
	* @return array|boolean|null an array containing found product as an array, FALSE for invalid ID, NULL if $id was null 
	
	public function get_product_by_id($id)
	{
		return $this->get_row_by_id("products", $id);
	}*/
	
	/**
	* Get all product reviews with data formatting for display purposes.
	* @param int $productid product ID
	* @return array|boolean|null an array containing found product reviews as an array, FALSE for invalid ID, NULL if $id was null 
	*/
	public function get_product_reviews_by_id_display($productid)
	{
		$args = array("table_name" => "reviews", "reviews.ProductID" => (int) $productid);
		return $this->get_rows_by_field_display($args);
	}
	
	// publishers
	
	/**
	* Get all publishers with data formatting for display purposes.
	* @return array an array of arrays containing all publishers
	*/
	public function get_publishers_display()
	{
		return $this->get_table_rows_display("publishers");
	}
	
	/**
	* Get all publishers without data formatting for display purposes.
	* @return array an array of arrays containing all publishers
	*/
	public function get_publishers()
	{
		return $this->get_table_rows("publishers");
	}
	
	/**
	* Checks if given publisher ID is present in the table.
	* @param int $id publisher id number
	* @return boolean TRUE if ID is valid
	*/
	public function is_valid_publisher_id($id)
	{
		return $this->validate_row_id('publishers', (int) $id);
	}
	
	/**
	* Get a specific publisher by their ID with data formatting for display purposes.
	* @param int $id publisher ID
	* @return array|boolean|null an array containing found publisher as an array, FALSE for invalid ID, NULL if $id was null 
	*/
	public function get_publisher_by_id_display($id)
	{
		return $this->get_row_by_id_display("publishers", $id);
	}
	
	/*
	* Get a specific publisher by their ID without data formatting for display purposes.
	* @param int $id publisher ID
	* @return array|boolean|null an array containing found publisher as an array, FALSE for invalid ID, NULL if $id was null 
	
	public function get_publisher_by_id($id)
	{
		return $this->get_row_by_id("publishers", $id);
	}*/
	
	// reviews
	
	/**
	* Get all comments of a specific review with data formatting for display purposes.
	* @param int $reviewid id of the review
	* @return array an array of arrays containing all comments
	*/
	public function get_review_comments_display($reviewid)
	{
		$args = array("table_name" => "reviewComments", "reviews.ReviewID" => (int) $reviewid);
		return $this->get_rows_by_field_display($args);
	}
	
	/**
	* Get all reviews with data formatting for display purposes.
	* @return array an array of arrays containing all reviews
	*/
	public function get_reviews_display()
	{
		return $this->get_table_rows_display("reviews");
	}
	
	/**
	* Get all reviews without data formatting for display purposes.
	* @return array an array of arrays containing all reviews
	*/
	public function get_reviews()
	{
		return $this->get_table_rows("reviews");
	}
	
	/**
	* Checks if given review ID is present in the table.
	* @param int $id review id number
	* @return boolean TRUE if ID is valid
	*/
	public function is_valid_review_id($id)
	{
		return $this->validate_row_id('reviews', (int) $id);
	}
	
	/**
	* Get a specific review by their ID with data formatting for display purposes.
	* @param int $id review ID
	* @return array|boolean|null an array containing found review as an array, FALSE for invalid ID, NULL if $id was null 
	*/
	public function get_review_by_id_display($id)
	{
		return $this->get_row_by_id_display("reviews", $id);
	}
	
	/**
	* Get a list of review information without the text by the ProductID with data formatting for display purposes.
	* @param int $id product ID
	* @return array|boolean|null an array containing found reviews as an array, FALSE for invalid ID, NULL if $id was null 
	*/
	public function get_review_infos_by_product_id_display($id)
	{
		$table_name ="reviews";
		$this->db->select("ReviewID, ReviewDate, reviews.user_id, ScreenName, Rating");
		$this->db->where("ProductID", (int) $id);

		// Left join to get user name.
		$this->db->join("users", 'reviews.user_id = users.user_id', 'left');

		$query = $this->db->get($table_name);
		$this->db->reset_query();
		
		return $this->correct_result_data_types($query);
	}
	
	/*
	* Get a specific review by their ID without data formatting for display purposes.
	* @param int $id review ID
	* @return array|boolean|null an array containing found review as an array, FALSE for invalid ID, NULL if $id was null 
	
	public function get_review_by_id($id)
	{
		return $this->get_row_by_id("reviews", $id);
	}*/
	
	// users
	
	/**
	* Get all users with data formatting for display purposes.
	* @return array an array of arrays containing all users
	*/
	public function get_users_display()
	{
		return $this->get_table_rows_display("users");
	}
	
	/**
	* Get all users without data formatting for display purposes.
	* @return array an array of arrays containing all users
	*/
	public function get_users()
	{
		return $this->get_table_rows("users");
	}
	
	/**
	* Checks if given user ID is present in the table.
	* @param int $id product id number
	* @return boolean TRUE if ID is valid
	*/
	public function is_valid_user_id($id)
	{
		return $this->validate_row_id('users', (int) $id);
	}	
	
	/**
	* Get a specific user by their ID with data formatting for display purposes.
	* @param int $id user ID
	* @return array|boolean|null an array containing found user as an array, FALSE for invalid ID, NULL if $id was null 
	*/
	public function get_user_by_id_display($id)
	{
		return $this->get_row_by_id_display("users", $id);
	}
	
	/*
	* Get a specific user by their ID without data formatting for display purposes.
	* @param int $id user ID
	* @return array|boolean|null an array containing found user as an array, FALSE for invalid ID, NULL if $id was null 
	
	public function get_user_by_id($id)
	{
		return $this->get_row_by_id("users", $id);
	}*/
	
	/**
	* Get all user reviews with data formatting for display purposes.
	* @param int $userid user ID
	* @return array an array of arrays containing all reviews
	*/
	public function get_user_reviews_display($userid)
	{
		$args = array("table_name" => "reviews", "reviews.user_id" => (int) $userid);
		return $this->get_rows_by_field_display($args);
	}
		
	/**
	* Get all user comments with data formatting for display purposes.
	* @param int $userid user ID
	* @return array an array of arrays containing all comments
	*/
	public function get_user_comments_display($userid)
	{
		$args = array("table_name" => "userComments", "userComments.user_id" => (int) $userid);
		return $this->get_rows_by_field_display($args);
	}
		
	/**
	* Get all user collections with full product data with data formatting for display purposes.
	* @param int $userid user ID
	* @return array an array of collections containing all products in an array
	*/
	public function get_user_collections_full_display($userid)
	{
		$table_name ="userCollections";
		$this->db->select("userCollections.CollectionID, CollectionName");
		$this->db->where("userCollections.user_id", (int) $userid);

		// Left join to get collection name.
		$this->db->join("collections", 'userCollections.CollectionID = collections.CollectionID', 'left');

		$query = $this->db->get($table_name);
		$this->db->reset_query();
		
		$collections = $query->result_array();
		
		$length = count($collections);
		
		// For every collection.
		for ($i = 0; $i < $length; $i++)
		{
			$table_name ="collectionProducts";
			$this->db->select("products.ProductID, Name, ReleaseDate, ImagePath, LanguageName, Brief, Description, EAN13, PublisherName");
			$this->db->where("collectionProducts.CollectionID", (int) $collections[$i]["CollectionID"]);

			// Left join with products to get product data.
			$this->db->join("products", 'collectionProducts.ProductID = products.ProductID', 'left');

			// Product joins.
			$this->db->join("languages", 'languages.LanguageID = products.LanguageID', 'left');
			$this->db->join("publishers", 'publishers.PublisherID = products.PublisherID', 'left');

			$this->db->order_by("collectionProducts.ProductID", 'ASC');

			// Get collection product data.
			$query = $this->db->get($table_name);
			$this->db->reset_query();
		
			$collections[$i]["Products"] = $this->correct_result_data_types($query);
		}
		
		return $collections;
	}
		
	/**
	* Get all user collections with product id, name, and release date with data formatting for display purposes.
	* @param int $userid user ID
	* @return array an array of arrays containing collection data
	*/
	public function get_user_collections_short_display($userid)
	{
		$table_name ="userCollections";
		$this->db->select("userCollections.CollectionID, CollectionName");
		$this->db->where("userCollections.user_id", (int) $userid);

		// Left join to get collection name.
		$this->db->join("collections", 'userCollections.CollectionID = collections.CollectionID', 'left');

		$query = $this->db->get($table_name);
		$this->db->reset_query();
		
		$collections = $this->correct_result_data_types($query);
		
		$length = count($collections);
		
		// For every collection.
		for ($i = 0; $i < $length; $i++)
		{
			$table_name ="collectionProducts";
			/*$this->db->select("products.ProductID");
			$this->db->where("collectionProducts.CollectionID", (int) $collections[$i]["CollectionID"]);

			/ Left join with products to get product data.
			$this->db->join("products", 'collectionProducts.ProductID = products.ProductID', 'left');

			// Product joins.
			$this->db->join("languages", 'languages.LanguageID = products.LanguageID', 'left');
			$this->db->join("publishers", 'publishers.PublisherID = products.PublisherID', 'left');

			$this->db->order_by("collectionProducts.ProductID", 'ASC');*/

			// Get collection product data.
			$this->db->like('collectionProducts.CollectionID', (int) $collections[$i]["CollectionID"]);
			$this->db->from($table_name);
		
			$collections[$i]["ProductCount"] = $this->db->count_all_results();
			$this->db->reset_query();
		}
		
		return $collections;
	}
	
	/**
	* Get all user collections with collection id as STRING key and name as value.
	* @param int $userid user ID
	* @return array an array of collections
	*/
	public function get_user_collections_minimal_list($userid)
	{
		$table_name ="userCollections";
		$this->db->select("userCollections.CollectionID, CollectionName");
		$this->db->where("userCollections.user_id", (int) $userid);

		// Left join to get collection name.
		$this->db->join("collections", 'userCollections.CollectionID = collections.CollectionID', 'left');

		$query = $this->db->get($table_name);
		$result = $query->result_array();
		$array = array();

		$length = count($result);
		
		// For every collection.
		for ($i = 0; $i < $length; $i++)
		{
			$array[$result[$i]["CollectionID"]] = $result[$i]["CollectionName"];
		}
		
		return $array;
	}
}