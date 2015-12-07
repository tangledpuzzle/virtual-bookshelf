<?php
/**
* MySQL database model.
* @package r2pdb_model
* @author Jose Uusitalo
*/
class R2pdb_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}
	
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
				case "users":
					return "UserID, RegistrationDate, FirstName, LastName, Age, GenderID, CountryID, ScreenName, AvatarPath, Bio";
				default:
					return NULL;
			}
			
			return FALSE;
		}
	}
	
	/**
	* Returns a string containg the names of the table columns that contain publicly viewable information. For use with the formatted data getter.
	* @param string $table_name name of the table
	* @return string|null|boolean public data columns names as a string, FALSE for unknown table name, NULL if $table_name was null 
	*/
	private function get_public_data_columns_formatted($table_name)
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
					return NULL;
				case "users":
					return "UserID, ScreenName, FirstName, LastName, Age, GenderName, CountryName, RegistrationDate, AvatarPath, Bio";
				default:
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
					return "UserID";
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
			{"name":"UserID","type":3,"max_length":1,"primary_key":0,"default":""},
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
							// Do nothing.
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
	* @return boolean|null TRUE if the ID is valid and present in the table, FALSE for invalid ID or unknown table name, NULL if $table_name or $id was null 
	*/
	public function validate_row_id($table_name, $id)
	{
		if ($id !== NULL && $table_name !== NULL)
		{
			if ((int) $id > 0)
			{
				$id_column_name = $this->get_id_column_from_table($table_name);		
				
				// Null check was performed earlier.
				if ($id_column_name)
				{
					$query = $this->db->get_where($table_name, array($id_column_name => $id));
					$this->db->reset_query();
					
					/* Not all database drivers have a native way of getting the total number of rows for a result set.
					When this is the case, all of the data is prefetched and count() is manually called on the resulting array in order to achieve the same result. */

					return ($query->num_rows() > 0);
				}
				return FALSE;
			}
			return FALSE;
		}
		return NULL;
	}
	
	/* 
	 * GENERIC PRIVATE DATA GETTERS
	 */
	
	/**
	* A generic get data function for a variable number of fields. Warning: Fewer integrity checks are performed with this function, use with caution.
	* @param various $arg_array a key-value array of database field names to sort by, use "!table_name" key for table name
	* @return array|null an array of arrays containing found rows, NULL if no arguments were given 
	*/
	private function get_rows_by_field()
	{
		$arg_list = func_get_args();
		
        if ($arg_list !== NULL && count($arg_list))
        {
			$table_name = $arg_list["!table_name"];
			unset($arg_list["!table_name"]); // Remove table_name element from array as it is not a field.
			$this->db->where($arg_list); // Add all fields to WHERE statement.
			
			$query = $this->db->get($table_name);
			$this->db->reset_query();
			return $query->result_array();
        }
		return NULL;
	}
	
	/**
	* A generic get data by id function for a single row.
	* @param int $id row ID
	* @param string $table_name name of the table
	* @return array|boolean|null an array of arrays containing found rows, FALSE for invalid ID or unknown table name, NULL if $table_name or $id was null 
	*/
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
	}
	
	/**
	* A generic get data function for all rows in a table.
	* @param string $table_name name of the table
	* @return array an array of arrays containing the rows of the table 
	*/
	private function get_row_by_id_formatted($table_name, $id)
	{
		$valid = $this->validate_row_id($table_name, $id);
		
        if ($valid !== NULL)
        {
			print("one");
			if ($valid)
			{
			print("two");
				$this->db->select($this->get_public_data_columns_formatted($table_name));
				// Left join the correct tables.
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
						return NULL;
					case "users":
						$this->db->join("countries", 'countries.CountryID = users.CountryID', 'left');
						$this->db->join("genders", 'genders.GenderID = users.GenderID', 'left');
						break;
					default:
						return NULL;
				}
				$this->db->where($this->get_id_column_from_table($table_name), (int) $id));
				// FIXME: QUERY FAILS
				$query = $this->db->get($table_name);

				$this->db->reset_query();

			print_r($query->result_array());
				//return $this->correct_result_data_types($query);
				return $query->result_array();
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
	private function get_table_rows_formatted($table_name)
	{
		$this->db->select($this->get_public_data_columns_formatted($table_name));
		
		// Left join the correct tables.
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
				return NULL;
			case "users":
				$this->db->join("countries", 'countries.CountryID = users.CountryID', 'left');
				$this->db->join("genders", 'genders.GenderID = users.GenderID', 'left');
				break;
			default:
				return NULL;
		}
		
		$this->db->order_by($this->get_id_column_from_table($table_name), 'ASC');
		
		$query = $this->db->get($table_name);
		$this->db->reset_query();
		
		return $this->correct_result_data_types($query);
	}
	
	/* 
	 * SPECIFIC PUBLIC DATA GETTERS
	 */
	
	// collections
	
	/**
	* Get all collections with data formatting.
	* @return array an array of arrays containing all collections
	*/
	public function get_collections_formatted()
	{
		return $this->get_table_rows_formatted("collections");
	}
	
	/**
	* Get all collections without data formatting.
	* @return array an array of arrays containing all collections
	*/
	public function get_collections()
	{
		return $this->get_table_rows("collections");
	}
	
	/**
	* Get a specific collection by their ID with data formatting.
	* @param int $id collection ID
	* @return array|boolean|null an array containing found collection as an array, FALSE for invalid ID, NULL if $id was null 
	*/
	public function get_collection_by_id_formatted($id)
	{
		return $this->get_row_by_id_formatted("collections", $id);
	}
	
	/**
	* Get a specific collection by their ID without data formatting.
	* @param int $id collection ID
	* @return array|boolean|null an array containing found collection as an array, FALSE for invalid ID, NULL if $id was null 
	*/
	public function get_collection_by_id($id)
	{
		return $this->get_row_by_id("collections", $id);
	}
	
	// comments
	
	/**
	* Get all comments with data formatting.
	* @return array an array of arrays containing all comments
	*/
	public function get_comments_formatted()
	{
		return $this->get_table_rows_formatted("comments");
	}
	
	/**
	* Get all comments without data formatting.
	* @return array an array of arrays containing all comments
	*/
	public function get_comments()
	{
		return $this->get_table_rows("comments");
	}
	
	/**
	* Get a specific comment by their ID with data formatting.
	* @param int $id comment ID
	* @return array|boolean|null an array containing found comment as an array, FALSE for invalid ID, NULL if $id was null 
	*/
	public function get_comment_by_id_formatted($id)
	{
		return $this->get_row_by_id_formatted("comments", $id);
	}
	
	/**
	* Get a specific comment by their ID without data formatting.
	* @param int $id comment ID
	* @return array|boolean|null an array containing found comment as an array, FALSE for invalid ID, NULL if $id was null 
	*/
	public function get_comment_by_id($id)
	{
		return $this->get_row_by_id("comments", $id);
	}
	
	// countries
	
	/**
	* Get all countries with data formatting.
	* @return array an array of arrays containing all countries
	*/
	public function get_countries_formatted()
	{
		return $this->get_table_rows_formatted("countries");
	}
	
	/**
	* Get all countries without data formatting.
	* @return array an array of arrays containing all countries
	*/
	public function get_countries()
	{
		return $this->get_table_rows("countries");
	}
	
	/**
	* Get a specific country by their ID with data formatting.
	* @param int $id country ID
	* @return array|boolean|null an array containing found country as an array, FALSE for invalid ID, NULL if $id was null 
	*/
	public function get_country_by_id_formatted($id)
	{
		return $this->get_row_by_id_formatted("countries", $id);
	}
	
	/**
	* Get a specific country by their ID without data formatting.
	* @param int $id country ID
	* @return array|boolean|null an array containing found country as an array, FALSE for invalid ID, NULL if $id was null 
	*/
	public function get_country_by_id($id)
	{
		return $this->get_row_by_id("countries", $id);
	}
	
	// genders
	
	/**
	* Get all genders with data formatting.
	* @return array an array of arrays containing all genders
	*/
	public function get_genders_formatted()
	{
		return $this->get_table_rows_formatted("genders");
	}
	
	/**
	* Get all genders without data formatting.
	* @return array an array of arrays containing all genders
	*/
	public function get_genders()
	{
		return $this->get_table_rows("genders");
	}
	
	/**
	* Get a specific gender by their ID with data formatting.
	* @param int $id gender ID
	* @return array|boolean|null an array containing found gender as an array, FALSE for invalid ID, NULL if $id was null 
	*/
	public function get_gender_by_id_formatted($id)
	{
		return $this->get_row_by_id_formatted("genders", $id);
	}
	
	/**
	* Get a specific gender by their ID without data formatting.
	* @param int $id gender ID
	* @return array|boolean|null an array containing found gender as an array, FALSE for invalid ID, NULL if $id was null 
	*/
	public function get_gender_by_id($id)
	{
		return $this->get_row_by_id("genders", $id);
	}
	
	// genres
	
	/**
	* Get all genres with data formatting.
	* @return array an array of arrays containing all genres
	*/
	public function get_genres_formatted()
	{
		return $this->get_table_rows_formatted("genres");
	}
	
	/**
	* Get all genres without data formatting.
	* @return array an array of arrays containing all genres
	*/
	public function get_genres()
	{
		return $this->get_table_rows("genres");
	}
	
	/**
	* Get a specific genre by their ID with data formatting.
	* @param int $id genre ID
	* @return array|boolean|null an array containing found genre as an array, FALSE for invalid ID, NULL if $id was null 
	*/
	public function get_genre_by_id_formatted($id)
	{
		return $this->get_row_by_id_formatted("genres", $id);
	}
	
	/**
	* Get a specific genre by their ID without data formatting.
	* @param int $id genre ID
	* @return array|boolean|null an array containing found genre as an array, FALSE for invalid ID, NULL if $id was null 
	*/
	public function get_genre_by_id($id)
	{
		return $this->get_row_by_id("genres", $id);
	}
	
	// products
	
	/**
	* Get all products with data formatting.
	* @return array an array of arrays containing all products
	*/
	public function get_products_formatted()
	{
		return $this->get_table_rows_formatted("products");
	}
	
	/**
	* Get all products without data formatting.
	* @return array an array of arrays containing all products
	*/
	public function get_products()
	{
		return $this->get_table_rows("products");
	}
	
	/**
	* Get a specific product by their ID with data formatting.
	* @param int $id product ID
	* @return array|boolean|null an array containing found product as an array, FALSE for invalid ID, NULL if $id was null 
	*/
	public function get_product_by_id_formatted($id)
	{
		return $this->get_row_by_id_formatted("products", $id);
	}
	
	/**
	* Get a specific product by their ID without data formatting.
	* @param int $id product ID
	* @return array|boolean|null an array containing found product as an array, FALSE for invalid ID, NULL if $id was null 
	*/
	public function get_product_by_id($id)
	{
		return $this->get_row_by_id("products", $id);
	}
	
	// publishers
	
	/**
	* Get all publishers with data formatting.
	* @return array an array of arrays containing all publishers
	*/
	public function get_publishers_formatted()
	{
		return $this->get_table_rows_formatted("publishers");
	}
	
	/**
	* Get all publishers without data formatting.
	* @return array an array of arrays containing all publishers
	*/
	public function get_publishers()
	{
		return $this->get_table_rows("publishers");
	}
	
	/**
	* Get a specific publisher by their ID with data formatting.
	* @param int $id publisher ID
	* @return array|boolean|null an array containing found publisher as an array, FALSE for invalid ID, NULL if $id was null 
	*/
	public function get_publisher_by_id_formatted($id)
	{
		return $this->get_row_by_id_formatted("publishers", $id);
	}
	
	/**
	* Get a specific publisher by their ID without data formatting.
	* @param int $id publisher ID
	* @return array|boolean|null an array containing found publisher as an array, FALSE for invalid ID, NULL if $id was null 
	*/
	public function get_publisher_by_id($id)
	{
		return $this->get_row_by_id("publishers", $id);
	}
	
	// reviews
	
	/**
	* Get all reviews with data formatting.
	* @return array an array of arrays containing all reviews
	*/
	public function get_reviews_formatted()
	{
		return $this->get_table_rows_formatted("reviews");
	}
	
	/**
	* Get all reviews without data formatting.
	* @return array an array of arrays containing all reviews
	*/
	public function get_reviews()
	{
		return $this->get_table_rows("reviews");
	}
	
	/**
	* Get a specific review by their ID with data formatting.
	* @param int $id review ID
	* @return array|boolean|null an array containing found review as an array, FALSE for invalid ID, NULL if $id was null 
	*/
	public function get_review_by_id_formatted($id)
	{
		return $this->get_row_by_id_formatted("reviews", $id);
	}
	
	/**
	* Get a specific review by their ID without data formatting.
	* @param int $id review ID
	* @return array|boolean|null an array containing found review as an array, FALSE for invalid ID, NULL if $id was null 
	*/
	public function get_review_by_id($id)
	{
		return $this->get_row_by_id("reviews", $id);
	}
	
	// users
	
	/**
	* Get all users with data formatting.
	* @return array an array of arrays containing all users
	*/
	public function get_users_formatted()
	{
		return $this->get_table_rows_formatted("users");
	}
	
	/**
	* Get all users without data formatting.
	* @return array an array of arrays containing all users
	*/
	public function get_users()
	{
		return $this->get_table_rows("users");
	}
	
	/**
	* Get a specific user by their ID with data formatting.
	* @param int $id user ID
	* @return array|boolean|null an array containing found user as an array, FALSE for invalid ID, NULL if $id was null 
	*/
	public function get_user_by_id_formatted($id)
	{
		return $this->get_row_by_id_formatted("users", $id);
	}
	
	/**
	* Get a specific user by their ID without data formatting.
	* @param int $id user ID
	* @return array|boolean|null an array containing found user as an array, FALSE for invalid ID, NULL if $id was null 
	*/
	public function get_user_by_id($id)
	{
		return $this->get_row_by_id("users", $id);
	}
}