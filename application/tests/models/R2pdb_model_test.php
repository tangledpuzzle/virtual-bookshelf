<?php
/**
 * PHPUnit tests for the database model.
 */

/**
 * Testing class for the MySQL database model used in the project.
 * The tests assume that the most recent version of the DEFAULT database is used.
 * To reset the local database to default, run dev/init.sql in MySQL.
 * @author Jose
 */
class R2pdbmodel_model_test extends TestCase
{
	
	/**
	 * A valid and used MySQL ID column integer value that is present in all tables in the default database. The value is 1.
	 */
	public $valid_id_int;
	
	/**
	 * An invalid MySQL ID column integer value. The value is 0.
	 */
	public $invalid_id_int;
	
	/**
	 * A valid MySQL ID column integer value that is not used in any tables in the default database. The value is 999999.
	 */
	public $unused_id_int;
	
	/**
	 * An invalid MySQL ID column value. The value is a number followed with letters.
	 */
	public $malformed_id_int;
	
	/**
	 * A random example string.
	 */
	public $string;
	
	/**
	 * An unassigned variable.
	 */
	public $unassigned;
	
	
	/**
	 * The default database row data for: product ID 1
	 */
	public $database_row_product_1;
	
	/**
	 * The default database row data for: no row found
	 */
	public $database_row_no_result;
	
	/**
	 * The default database row data for: products where language name is swedish
	 */
	public $database_products_language_swedish;
	
	/**
	 * The default database row data for: collection ID 2
	 */
	public $database_row_empty_collection_id_2;
	
	/**
	 * The default database row data for: comment ID 1
	 */
	public $database_row_comment_id_1;
	
	/**
	 * The default database row data for: product ID 1 reviews (short information for a list)
	 */
	public $database_row_review_infos_product_1;
	
	/**
	 * The default database row data for: user ID 1 collections (short information for a list)
	 */
	public $database_row_short_collection_info_user_1;
	
	/**
	 * The default database row data for: user ID 1 collections (minimal information for a list)
	 */
	public $database_row_minimal_collection_info_user_1;
	
	/**
	 * A valid and used default database table name.
	 */
	public $valid_table_name;
	
	/**
	 * An invalid database table name.
	 */
	public $invalid_table_name;
	
	/**
	 * A valid but unused default database table name.
	 */
	public $unused_table_name;
	
	
	/**
	 * Number of collections in the default database.
	 */
	public $number_of_collections;
	
	/**
	 * Number of products in the default database.
	 */
	public $number_of_products;
	
	/**
	 * Set up the database model before the tests and assign the common variables.
	 */
    public function setUp()
    {
		$this->valid_id_int = 1;
		$this->invalid_id_int = 0;
		$this->unused_id_int = 99999;
		$this->malformed_id_int = "1sdfui";
		$this->string = "Test string.";
		
		// $this->unassigned is unassigned for a reason.
		// NULL is also tested but it does not need a variable.

		$this->database_products_language_swedish = array(
													 array (
														"ProductID" => 3,
														"Name" => "Sample Book 3",
														"ReleaseDate" => "2018-12-11",
														"ImagePath" => "ipsum",
														"LanguageName" => "Swedish",
														"Brief" => "Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Sed posuere interdum sem. Quisque ligula eros ullamcorper quis, lacinia quis facilisis sed sapien. Mauris varius diam vitae arcu.",
														"Description" => "minim",
														"EAN13" => "0000000000002",
														"PublisherName" => "Publisher #2"
													  ),
													  array (
														"ProductID" => 9,
														"Name" => "Sample Book 9",
														"ReleaseDate" => null,
														"ImagePath" => "elit",
														"LanguageName" => "Swedish",
														"Brief" => "ea",
														"Description" => "commodo",
														"EAN13" => "0000000000008",
														"PublisherName" => "Publisher #4"
													  ),
													  array (
														"ProductID" => 17,
														"Name" => "Sample Book 17",
														"ReleaseDate" => "2010-11-11",
														"ImagePath" => "et",
														"LanguageName" => "Swedish",
														"Brief" => "fugiat",
														"Description" => null,
														"EAN13" => "7000000000000",
														"PublisherName" => "Publisher #6"
													  ));
		
		$this->database_row_product_1 = array(array("ProductID"=> 1,
													  "Name"=> "Sample Book 1",
													  "ReleaseDate"=> "2008-11-11",
													  "ImagePath"=> "img-path",
													  "LanguageName"=> "Finnish",
													  "Brief"=> "Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Sed posuere interdum sem. Quisque ligula eros ullamcorper quis, lacinia quis facilisis sed sapien. Mauris varius diam vitae arcu.",
													  "Description"=> "Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Sed posuere interdum sem. Quisque ligula eros ullamcorper quis, lacinia quis facilisis sed sapien. Mauris varius diam vitae arcu. Sed arcu lectus auctor vitae, consectetuer et venenatis eget velit. Sed augue orci, lacinia eu tincidunt et eleifend nec lacus. Donec ultricies nisl ut felis, suspendisse potenti. Lorem ipsum ligula ut hendrerit mollis, ipsum erat vehicula risus, eu suscipit sem libero nec erat. Aliquam erat volutpat. Sed congue augue vitae neque. Nulla consectetuer porttitor pede. Fusce purus morbi tortor magna condimentum vel, placerat id blandit sit amet tortor.\n\nMauris sed libero. Suspendisse facilisis nulla in lacinia laoreet, lorem velit accumsan velit vel mattis libero nisl et sem. Proin interdum maecenas massa turpis sagittis in, interdum non lobortis vitae massa. Quisque purus lectus, posuere eget imperdiet nec sodales id arcu. Vestibulum elit pede dictum eu, viverra non tincidunt eu ligula.\n\nNam molestie nec tortor. Donec placerat leo sit amet velit. Vestibulum id justo ut vitae massa. Proin in dolor mauris consequat aliquam. Donec ipsum, vestibulum ullamcorper venenatis augue. Aliquam tempus nisi in auctor vulputate, erat felis pellentesque augue nec, pellentesque lectus justo nec erat. Aliquam et nisl. Quisque sit amet dolor in justo pretium condimentum.\n\nVivamus placerat lacus vel vehicula scelerisque, dui enim adipiscing lacus sit amet sagittis, libero enim vitae mi. In neque magna posuere, euismod ac tincidunt tempor est. Ut suscipit nisi eu purus. Proin ut pede mauris eget ipsum. Integer vel quam nunc commodo consequat. Integer ac eros eu tellus dignissim viverra. Maecenas erat aliquam erat volutpat. Ut venenatis ipsum quis turpis. Integer cursus scelerisque lorem. Sed nec mauris id quam blandit consequat. Cras nibh mi hendrerit vitae, dapibus et aliquam et magna. Nulla vitae elit. Mauris consectetuer odio vitae augue.",
													  "EAN13"=> "0000000000000",
													  "PublisherName"=> "Publisher #3"));
		
		$this->database_row_comment_id_1 = array("CommentID" => 1,
												"PostDate" => "2001-01-11 00:00:00",
												"user_id" => 1,
												"ScreenName" => "A User",
												"Text" => "Test User Comment");
		
		$this->database_row_no_result = array();
		
		$this->database_row_empty_collection_id_2 = array("CollectionID" => 2,
														  "CollectionName" => "Empty Collection",
														  "Products" => array());

		$this->database_row_review_infos_product_1 = array(array("ReviewID"=>1,"ReviewDate"=>"2001-09-23 00:00:00","user_id"=>1,"ScreenName"=>"A User","Rating"=>5),array("ReviewID"=>6,"ReviewDate"=>"2012-09-01 00:00:00","user_id"=>7,"ScreenName"=>"Test Account 7","Rating"=>2),array("ReviewID"=>23,"ReviewDate"=>"2006-05-25 00:00:00","user_id"=>2,"ScreenName"=>"A Moderator","Rating"=>3),array("ReviewID"=>27,"ReviewDate"=>"2011-03-22 00:00:00","user_id"=>6,"ScreenName"=>"Test Account 6","Rating"=>4),array("ReviewID"=>28,"ReviewDate"=>"2011-03-27 00:00:00","user_id"=>8,"ScreenName"=>"Test Account 8","Rating"=>5));
		$this->database_row_short_collection_info_user_1 = array(array("CollectionID"=>1,"CollectionName"=>"Test Collection","ProductCount"=>5),array("CollectionID"=>2,"CollectionName"=>"Empty Collection","ProductCount"=>0));
		$this->database_row_minimal_collection_info_user_1 = array(1=> "Test Collection", 2=> "Empty Collection"); 
		
		$this->valid_table_name = "products";
		$this->invalid_table_name = '!#¤%&/()=?;:_@£$€[\\]}';
		$this->unused_table_name = "this_table_name_is_not_used";
		$this->number_of_collections = 4;
		$this->number_of_products = 29;
		
        $this->resetInstance();
        $this->CI->load->model('r2pdb_model');
        $this->obj = $this->CI->r2pdb_model;
    }

	/**
	 * Reflection magic copypasted from: http://stackoverflow.com/a/2798203
	 * @param string $name Name of the function to get as public.
	 */
	protected static function getFunctionAsPublic($name)
	{
	  $class = new ReflectionClass('R2pdbmodel_model');
	  $method = $class->getMethod($name);
	  $method->setAccessible(true);
	  return $method;
	}
	
	/*
	 * ----------- validate_row_id -----------
	 */
	
	/**
	 * Test of generic row id validation function with: valid id
	 */
    public function test_validate_row_id_valid()
    {
		// Genders is a small table so it's fast to test.
       	$actual = $this->obj->validate_row_id("genders", $this->valid_id_int);
		$expected = TRUE;
        $this->assertEquals($expected, $actual);
    }

	/**
	 * Test of generic row id validation function with: unused id
	 */
    public function test_validate_row_id_unused()
    {
		// Genders is a small table so it's fast to test.
       	$actual = $this->obj->validate_row_id("genders", $this->unused_id_int);
		$expected = FALSE;
        $this->assertEquals($expected, $actual);
    }
	
	/**
	 * Test of generic row id validation function with: invalid id
	 */
    public function test_validate_row_id_invalid()
    {
		// Genders is a small table so it's fast to test.
       	$actual = $this->obj->validate_row_id("genders", $this->invalid_id_int);
		$expected = FALSE;
        $this->assertEquals($expected, $actual);
    }
	
	/**
	 * Test of generic row id validation function with: malformed
	 */
    public function test_validate_row_id_malformed()
    {
		// Genders is a small table so it's fast to test.
       	$actual = $this->obj->validate_row_id("genders", $this->malformed_id_int);
		$expected = FALSE;
        $this->assertEquals($expected, $actual);
    }
	
	/**
	 * Test of generic row id validation function with: string
	 */
    public function test_validate_row_id_string()
    {
		// Genders is a small table so it's fast to test.
       	$actual = $this->obj->validate_row_id("genders", $this->string);
		$expected = FALSE;
        $this->assertEquals($expected, $actual);
    }
	
	/**
	 * Test of generic row id validation function with: unassigned id
	 */
    public function test_validate_row_id_unassigned()
    {
		// Genders is a small table so it's fast to test.
       	$actual = $this->obj->validate_row_id("genders", $this->unassigned);
		$expected = FALSE;
        $this->assertEquals($expected, $actual);
    }
		
	/**
	 * Test of generic row id validation function with: NULL id
	 */
    public function test_validate_row_id_NULL()
    {
		// Genders is a small table so it's fast to test.
       	$actual = $this->obj->validate_row_id("genders", NULL);
		$expected = NULL;
        $this->assertEquals($expected, $actual);
    }
	
	/*
	 * ----------- get_rows_by_field_display -----------
	 */
	
	/**
	 * Test of generic get rows by field function: LanguageName is Swedish
	 * Also tests table joining.
	 */
    public function test_get_rows_by_field_display_swedish_products()
    {
		$fields = array("table_name" => "products", "languages.LanguageName" => "Swedish");
		$actual = $this->obj->get_rows_by_field_display($fields);
		$expected = $this->database_products_language_swedish;
        $this->assertEquals($expected, $actual);
    }
	
	/**
	 * Test of generic get rows by field function: valid
	 */
    public function test_get_rows_by_field_display_valid()
    {
		$fields = array("table_name" => "products", "products.ProductID" => $this->valid_id_int);
		$actual = $this->obj->get_rows_by_field_display($fields);
		$expected = $this->database_row_product_1;
        $this->assertEquals($expected, $actual);
    }
	
	/**
	 * Test of generic get rows by field function: unused
	 */
    public function test_get_rows_by_field_display_unused()
    {
		$fields = array("table_name" => "products", "products.ProductID" => $this->unused_id_int);
		$actual = $this->obj->get_rows_by_field_display($fields);
		$expected = $this->database_row_no_result;
        $this->assertEquals($expected, $actual);
    }
	
	/**
	 * Test of generic get rows by field function: invalid
	 */
    public function test_get_rows_by_field_display_invalid()
    {
		$fields = array("table_name" => "products", "products.ProductID" => $this->invalid_id_int);
		$actual = $this->obj->get_rows_by_field_display($fields);
		$expected = FALSE;
        $this->assertEquals($expected, $actual);
    }
	
	/**
	 * Test of generic get rows by field function: malformed
	 */
    public function test_get_rows_by_field_display_malformed()
    {
		$fields = array("table_name" => "products", "products.ProductID" => $this->malformed_id_int);
		$actual = $this->obj->get_rows_by_field_display($fields);
		$expected = FALSE;
        $this->assertEquals($expected, $actual);
    }
	
	/**
	 * Test of generic get rows by field function: string
	 */
    public function test_get_rows_by_field_display_string()
    {
		$fields = array("table_name" => "products", "products.ProductID" => $this->string);
		$actual = $this->obj->get_rows_by_field_display($fields);
		$expected = FALSE;
        $this->assertEquals($expected, $actual);
    }
	
	/**
	 * Test of generic get rows by field function: unassigned
	 */
    public function test_get_rows_by_field_display_unassigned()
    {
		$fields = array("table_name" => "products", "products.ProductID" => $this->unassigned);
		$actual = $this->obj->get_rows_by_field_display($fields);
		$expected = NULL;
        $this->assertEquals($expected, $actual);
    }
	
	/**
	 * Test of generic get rows by field function: null
	 */
    public function test_get_rows_by_field_display_null()
    {
		$fields = array("table_name" => "products", "products.ProductID" => NULL);
		$actual = $this->obj->get_rows_by_field_display($fields);
		$expected = NULL;
        $this->assertEquals($expected, $actual);
    }
	
	/*
	 * ----------- get_table_rows -----------
	 * Commented out because I'm not sure how this works.
	
	/**
	 * Test get rows: valid
	 
    public function test_get_table_rows_valid()
    {
		$pubfunc = self::getFunctionAsPublic($this->obj->get_table_rows);
		
		$actual = count($pubfunc($this->valid_table_name));
		
		$expected = $this->number_of_products;
        $this->assertEquals($expected, $actual);
    }*/
	
	
	/*
	 * ----------- collections -----------
	 */
	
	/**
	 * Test get table rows: collections
	 */
    public function test_get_collections()
    {
		$actual = count($this->obj->get_collections_display());
		$expected = $this->number_of_collections;
        $this->assertEquals($expected, $actual);
    }
	
	/**
	 * Test get empty collection (ID 2)
	 */
    public function test_get_empty_collection()
    {
		$actual = $this->obj->get_collections_by_id_display(2);
		$expected = $this->database_row_empty_collection_id_2;
        $this->assertEquals($expected, $actual);
    }
	
	/*
	 * iVarious is_valid_*_id() use is_valid_row_id() which has been extensively tested.
	 */
	 
	/*
	 * ----------- comments -----------
	 */
	 
	/**
	 * Test get comment by id
	 */
    public function test_get_comment_by_id_display_valid()
    {
		$actual = $this->obj->get_comment_by_id_display($this->valid_id_int);
		$expected = $this->database_row_comment_id_1;
        $this->assertEquals($expected, $actual);
    }
	
	/*
	 * The various get_*_by_id_display all use get_rows_by_field_display which has been extensively tested.
	 */
	
	/*
	 * ----------- reviews -----------
	 */
	 
	/**
	 * Test get review information with product id: valid
	 */
    public function test_get_review_infos_by_product_id_display_valid()
    {
		$actual = $this->obj->get_review_infos_by_product_id_display($this->valid_id_int);
		$expected = $this->database_row_review_infos_product_1;
        $this->assertEquals($expected, $actual);
    }
	
	/**
	 * Test get review information with product id: invalid
	 */
    public function test_get_review_infos_by_product_id_display_invalid()
    {
		$actual = $this->obj->get_review_infos_by_product_id_display($this->invalid_id_int);
		$expected = FALSE;
        $this->assertEquals($expected, $actual);
    }
	
	/**
	 * Test get review information with product id: unused
	 */
    public function test_get_review_infos_by_product_id_display_unused()
    {
		$actual = $this->obj->get_review_infos_by_product_id_display($this->unused_id_int);
		$expected = $this->database_row_no_result;
        $this->assertEquals($expected, $actual);
    }
	
	/**
	 * Test get review information with product id: malformed
	 */
    public function test_get_review_infos_by_product_id_display_malformed()
    {
		$actual = $this->obj->get_review_infos_by_product_id_display($this->malformed_id_int);
		$expected = FALSE;
        $this->assertEquals($expected, $actual);
    }
	
	/**
	 * Test get review information with product id: string
	 */
    public function test_get_review_infos_by_product_id_display_string()
    {
		$actual = $this->obj->get_review_infos_by_product_id_display($this->string);
		$expected = FALSE;
        $this->assertEquals($expected, $actual);
    }
	
	/**
	 * Test get review information with product id: unassigned
	 */
    public function test_get_review_infos_by_product_id_display_unassigned()
    {
		$actual = $this->obj->get_review_infos_by_product_id_display($this->unassigned);
		$expected = FALSE;
        $this->assertEquals($expected, $actual);
    }
	
	/**
	 * Test get review information with product id: NULL
	 */
    public function test_get_review_infos_by_product_id_display_null()
    {
		$actual = $this->obj->get_review_infos_by_product_id_display(NULL);
		$expected = NULL;
        $this->assertEquals($expected, $actual);
    }
	
	/*
	 * ----------- user collections -----------
	 */
	
	/**
	 * Test get short user collection info with user id: valid
	 */
    public function test_get_user_collections_short_display_valid()
    {
		$actual = $this->obj->get_user_collections_short_display($this->valid_id_int);
		$expected = $this->database_row_short_collection_info_user_1;
        $this->assertEquals($expected, $actual);
    }
	
	/**
	 * Test get short user collection info with user id: invalid
	 */
    public function test_get_user_collections_short_display_invalid()
    {
		$actual = $this->obj->get_user_collections_short_display($this->invalid_id_int);
		$expected = FALSE;
        $this->assertEquals($expected, $actual);
    }
	
	/**
	 * Test get short user collection info with user id: unused
	 */
    public function test_get_user_collections_short_display_unused()
    {
		$actual = $this->obj->get_user_collections_short_display($this->unused_id_int);
		$expected = $this->database_row_no_result;
        $this->assertEquals($expected, $actual);
    }
	
	/**
	 * Test get short user collection info with user id: malformed
	 */
    public function test_get_user_collections_short_display_malformed()
    {
		$actual = $this->obj->get_user_collections_short_display($this->malformed_id_int);
		$expected = FALSE;
        $this->assertEquals($expected, $actual);
    }
	
	/**
	 * Test get short user collection info with user id: string
	 */
    public function test_get_user_collections_short_display_string()
    {
		$actual = $this->obj->get_user_collections_short_display($this->string);
		$expected = FALSE;
        $this->assertEquals($expected, $actual);
    }
	
	/**
	 * Test get short user collection info with user id: unassigned
	 */
    public function test_get_user_collections_short_display_unassigned()
    {
		$actual = $this->obj->get_user_collections_short_display($this->unassigned);
		$expected = FALSE;
        $this->assertEquals($expected, $actual);
    }
	
	/**
	 * Test get short user collection info with user id: NULL
	 */
    public function test_get_user_collections_short_display_null()
    {
		$actual = $this->obj->get_user_collections_short_display(NULL);
		$expected = NULL;
        $this->assertEquals($expected, $actual);
    }
	
	
	/*
	 * ----------- private: correct_result_data_types -----------
	 */
	 
	/**
	 * Test getting data from database in the correct format, i.e. numbers are ints.
	 */
    public function test_correct_result_data_types()
    {
		$actual = $this->obj->get_user_collections_short_display($this->valid_id_int);
        $this->assertInternalType('int', $actual[0]["CollectionID"]);
    }
	
	
	/*
	 * ----------- user collections -----------
	 */
	
	/**
	 * Test get minimal user collection info with user id: valid
	 */
    public function test_get_user_collections_minimal_list_valid()
    {
		$actual = $this->obj->get_user_collections_minimal_list($this->valid_id_int);
		$expected = $this->database_row_minimal_collection_info_user_1;
        $this->assertEquals($expected, $actual);
    }
	
	/**
	 * Test get minimal user collection info with user id: invalid
	 */
    public function test_get_user_collections_minimal_list_invalid()
    {
		$actual = $this->obj->get_user_collections_minimal_list($this->invalid_id_int);
		$expected = FALSE;
        $this->assertEquals($expected, $actual);
    }
	
	/**
	 * Test get minimal user collection info with user id: unused
	 */
    public function test_get_user_collections_minimal_list_unused()
    {
		$actual = $this->obj->get_user_collections_minimal_list($this->unused_id_int);
		$expected = $this->database_row_no_result;
        $this->assertEquals($expected, $actual);
    }
	
	/**
	 * Test get minimal user collection info with user id: malformed
	 */
    public function test_get_user_collections_minimal_list_malformed()
    {
		$actual = $this->obj->get_user_collections_minimal_list($this->malformed_id_int);
		$expected = FALSE;
        $this->assertEquals($expected, $actual);
    }
	
	/**
	 * Test get minimal user collection info with user id: string
	 */
    public function test_get_user_collections_minimal_list_string()
    {
		$actual = $this->obj->get_user_collections_minimal_list($this->string);
		$expected = FALSE;
        $this->assertEquals($expected, $actual);
    }
	
	/**
	 * Test get minimal user collection info with user id: unassigned
	 */
    public function test_get_user_collections_minimal_list_unassigned()
    {
		$actual = $this->obj->get_user_collections_minimal_list($this->unassigned);
		$expected = FALSE;
        $this->assertEquals($expected, $actual);
    }
	
	/**
	 * Test get minimal user collection info with user id: NULL
	 */
    public function test_get_user_collections_minimal_list_null()
    {
		$actual = $this->obj->get_user_collections_minimal_list(NULL);
		$expected = NULL;
        $this->assertEquals($expected, $actual);
    }
}