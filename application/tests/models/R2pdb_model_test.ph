<?php

/**
 * Testing class for the MySQL database model used in the project.
 * The tests assume that the most recent version of the DEFAULT database is used.
 * To reset the local database to default, run dev/init.sql in MySQL.
 * @author Jose
 */
class R2pdbmodel_model_test extends TestCase
{
	public $valid_id_int;
	public $invalid_id_int;
	public $unused_id_int;
	public $malformed_id_int;
	public $string;
	public $unassigned;
	
	public $database_row_product_1;
	public $database_row_no_result;
	public $database_products_language_swedish;
	public $database_row_empty_collection_id_2;
	
	public $valid_table_name;
	public $invalid_table_name;
	public $unused_table_name;
	
	public $number_of_collections;
	public $number_of_products;
	/**
	 * Set up the database model before each test and assign the common variables.
	 */
    public function setUp()
    {
		$this->valid_id_int = 1;
		$this->invalid_id_int = 0;
		$this->unused_id_int = 999999;
		$this->malformed_id_int = "1sdfui";
		$this->string = "Test string.";
		
		// $this->unassigned is unassigned for a reason.
		// NULL is also tested but it does not need a variable.
		// 
		$this->database_row_product_1 = array(
array("ProductID"=> 1,
  "Name"=> "Sample Book 1",
  "ReleaseDate"=> "2008-11-11",
  "ImagePath"=> "img-path",
  "LanguageName"=> "Finnish",
  "Brief"=> "Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Sed posuere interdum sem. Quisque ligula eros ullamcorper quis, lacinia quis facilisis sed sapien. Mauris varius diam vitae arcu.",
  "Description"=> "Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Sed posuere interdum sem. Quisque ligula eros ullamcorper quis, lacinia quis facilisis sed sapien. Mauris varius diam vitae arcu. Sed arcu lectus auctor vitae, consectetuer et venenatis eget velit. Sed augue orci, lacinia eu tincidunt et eleifend nec lacus. Donec ultricies nisl ut felis, suspendisse potenti. Lorem ipsum ligula ut hendrerit mollis, ipsum erat vehicula risus, eu suscipit sem libero nec erat. Aliquam erat volutpat. Sed congue augue vitae neque. Nulla consectetuer porttitor pede. Fusce purus morbi tortor magna condimentum vel, placerat id blandit sit amet tortor.\n\nMauris sed libero. Suspendisse facilisis nulla in lacinia laoreet, lorem velit accumsan velit vel mattis libero nisl et sem. Proin interdum maecenas massa turpis sagittis in, interdum non lobortis vitae massa. Quisque purus lectus, posuere eget imperdiet nec sodales id arcu. Vestibulum elit pede dictum eu, viverra non tincidunt eu ligula.\n\nNam molestie nec tortor. Donec placerat leo sit amet velit. Vestibulum id justo ut vitae massa. Proin in dolor mauris consequat aliquam. Donec ipsum, vestibulum ullamcorper venenatis augue. Aliquam tempus nisi in auctor vulputate, erat felis pellentesque augue nec, pellentesque lectus justo nec erat. Aliquam et nisl. Quisque sit amet dolor in justo pretium condimentum.\n\nVivamus placerat lacus vel vehicula scelerisque, dui enim adipiscing lacus sit amet sagittis, libero enim vitae mi. In neque magna posuere, euismod ac tincidunt tempor est. Ut suscipit nisi eu purus. Proin ut pede mauris eget ipsum. Integer vel quam nunc commodo consequat. Integer ac eros eu tellus dignissim viverra. Maecenas erat aliquam erat volutpat. Ut venenatis ipsum quis turpis. Integer cursus scelerisque lorem. Sed nec mauris id quam blandit consequat. Cras nibh mi hendrerit vitae, dapibus et aliquam et magna. Nulla vitae elit. Mauris consectetuer odio vitae augue.",
  "EAN13"=> "0000000000000",
  "PublisherName"=> "Publisher #3")
		);
		
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
  )
		);
		
		$this->database_row_no_result = array();
		
		$this->valid_table_name = "products";
		$this->invalid_table_name = '!#¤%&/()=?;:_@£$€[\\]}';
		$this->unused_table_name = "this_table_name_is_not_used";
		
		$this->database_row_empty_collection_id_2 = 
		array("CollectionID" => 2,
  "CollectionName" => "Empty Collection",
  "Products" => array());
  
		$this->number_of_collections = 4;
		$this->number_of_products = 29;
		
        $this->resetInstance();
        $this->CI->load->model('r2pdb_model');
        $this->obj = $this->CI->r2pdb_model;
    }

	/**
	 * Reflection magic copypasted from: http://stackoverflow.com/a/2798203
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
	 * Test row id validation with: valid id
	 */
    public function test_validate_row_id_valid()
    {
		// Genders is a small table so it's fast to test.
       	$actual = $this->obj->validate_row_id("genders", $this->valid_id_int);
		$expected = TRUE;
        $this->assertEquals($expected, $actual);
    }

	/**
	 * Test row id validation with: unused id
	 */
    public function test_validate_row_id_unused()
    {
		// Genders is a small table so it's fast to test.
       	$actual = $this->obj->validate_row_id("genders", $this->unused_id_int);
		$expected = FALSE;
        $this->assertEquals($expected, $actual);
    }
	
	/**
	 * Test row id validation with: invalid id
	 */
    public function test_validate_row_id_invalid()
    {
		// Genders is a small table so it's fast to test.
       	$actual = $this->obj->validate_row_id("genders", $this->invalid_id_int);
		$expected = FALSE;
        $this->assertEquals($expected, $actual);
    }
	
	/**
	 * Test row id validation with: malformed
	 */
    public function test_validate_row_id_malformed()
    {
		// Genders is a small table so it's fast to test.
       	$actual = $this->obj->validate_row_id("genders", $this->malformed_id_int);
		$expected = FALSE;
        $this->assertEquals($expected, $actual);
    }
	
	/**
	 * Test row id validation with: string
	 */
    public function test_validate_row_id_string()
    {
		// Genders is a small table so it's fast to test.
       	$actual = $this->obj->validate_row_id("genders", $this->string);
		$expected = FALSE;
        $this->assertEquals($expected, $actual);
    }
	
	/**
	 * Test row id validation with: unassigned id
	 */
    public function test_validate_row_id_unassigned()
    {
		// Genders is a small table so it's fast to test.
       	$actual = $this->obj->validate_row_id("genders", $this->unassigned);
		$expected = FALSE;
        $this->assertEquals($expected, $actual);
    }
		
	/**
	 * Test row id validation with: NULL id
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
	 * Test get rows by field: LanguageName is Swedish
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
	 * Test get rows by field: valid
	 */
    public function test_get_rows_by_field_display_valid()
    {
		$fields = array("table_name" => "products", "products.ProductID" => $this->valid_id_int);
		$actual = $this->obj->get_rows_by_field_display($fields);
		$expected = $this->database_row_product_1;
        $this->assertEquals($expected, $actual);
    }
	
	/**
	 * Test get rows by field: unused
	 */
    public function test_get_rows_by_field_display_unused()
    {
		$fields = array("table_name" => "products", "products.ProductID" => $this->unused_id_int);
		$actual = $this->obj->get_rows_by_field_display($fields);
		$expected = $this->database_row_no_result;
        $this->assertEquals($expected, $actual);
    }
	
	/**
	 * Test get rows by field: invalid
	 */
    public function test_get_rows_by_field_display_invalid()
    {
		$fields = array("table_name" => "products", "products.ProductID" => $this->invalid_id_int);
		$actual = $this->obj->get_rows_by_field_display($fields);
		$expected = $this->database_row_no_result;
        $this->assertEquals($expected, $actual);
    }
	
	/**
	 * Test get rows by field: malformed
	 */
    public function test_get_rows_by_field_display_malformed()
    {
		$fields = array("table_name" => "products", "products.ProductID" => $this->malformed_id_int);
		$actual = $this->obj->get_rows_by_field_display($fields);
		$expected = NULL;
        $this->assertEquals($expected, $actual);
    }
	
	/**
	 * Test get rows by field: string
	 */
    public function test_get_rows_by_field_display_string()
    {
		$fields = array("table_name" => "products", "products.ProductID" => $this->string);
		$actual = $this->obj->get_rows_by_field_display($fields);
		$expected = NULL;
        $this->assertEquals($expected, $actual);
    }
	
	/**
	 * Test get rows by field: unassigned
	 */
    public function test_get_rows_by_field_display_unassigned()
    {
		$fields = array("table_name" => "products", "products.ProductID" => $this->unassigned);
		$actual = $this->obj->get_rows_by_field_display($fields);
		$expected = $this->database_row_no_result;
        $this->assertEquals($expected, $actual);
    }
	
	/**
	 * Test get rows by field: null
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
    }
	
	/**
	 * Test get rows: unused
	 
    public function test_get_table_rows_unused()
    {
		$actual = self::getFunctionAsPublic($this->obj->get_table_rows($this->unused_table_name));
		$expected = $this->database_row_no_result;
        $this->assertEquals($expected, $actual);
    }
	
	/**
	 * Test get rows: invalid
	 
    public function test_get_table_rows_invalid()
    {
		$actual = self::getFunctionAsPublic($this->obj->get_table_rows($this->invalid_table_name));
		$expected = NULL;
        $this->assertEquals($expected, $actual);
    }
	
	/**
	 * Test get rows: malformed
	 
    public function test_get_table_rows_malformed()
    {
		$actual = ($this->malformed_table_name));
		$expected = NULL;
        $this->assertEquals($expected, $actual);
    }
	
	/**
	 * Test get rows: unassigned
	 
    public function test_get_table_rows_unassigned()
    {
		$actual = self::getFunctionAsPublic($this->obj->get_table_rows($this->unassigned));
		$expected = NULL;
        $this->assertEquals($expected, $actual);
    }
	
	/**
	 * Test get rows: null
	 
    public function test_get_table_rows_null()
    {
		$actual = self::getFunctionAsPublic($this->obj->get_table_rows(NULL));
		$expected = NULL;
        $this->assertEquals($expected, $actual);
    }*/
	
	
	/*
	 * ----------- get_collections_display -----------
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
	
	
}