<?php

class Requests_test extends TestCase
{
	public $valid_id_int;
	public $invalid_id_int;
	public $unused_id_int;
	public $malformed_id_int;
	public $string;
	public $unassigned;
	
	public $json_result_product_1;
	public $json_result_no_result;
	public $json_result_empty_collection_id_2;
	
	public $valid_resource_name;
	public $invalid_resource_name;
	public $unused_resource_name;
	
	public $number_of_collections;
	public $number_of_products;
	
	/**
	 * Set up the common variables.
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
		
		$this->json_result_product_1 = '{"ProductID":1,"Name":"Sample Book 1","ReleaseDate":"2008-11-11","ImagePath":"img-path","LanguageName":"Finnish","Brief":"Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Sed posuere interdum sem. Quisque ligula eros ullamcorper quis, lacinia quis facilisis sed sapien. Mauris varius diam vitae arcu.","Description":"Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Sed posuere interdum sem. Quisque ligula eros ullamcorper quis, lacinia quis facilisis sed sapien. Mauris varius diam vitae arcu. Sed arcu lectus auctor vitae, consectetuer et venenatis eget velit. Sed augue orci, lacinia eu tincidunt et eleifend nec lacus. Donec ultricies nisl ut felis, suspendisse potenti. Lorem ipsum ligula ut hendrerit mollis, ipsum erat vehicula risus, eu suscipit sem libero nec erat. Aliquam erat volutpat. Sed congue augue vitae neque. Nulla consectetuer porttitor pede. Fusce purus morbi tortor magna condimentum vel, placerat id blandit sit amet tortor.\n\nMauris sed libero. Suspendisse facilisis nulla in lacinia laoreet, lorem velit accumsan velit vel mattis libero nisl et sem. Proin interdum maecenas massa turpis sagittis in, interdum non lobortis vitae massa. Quisque purus lectus, posuere eget imperdiet nec sodales id arcu. Vestibulum elit pede dictum eu, viverra non tincidunt eu ligula.\n\nNam molestie nec tortor. Donec placerat leo sit amet velit. Vestibulum id justo ut vitae massa. Proin in dolor mauris consequat aliquam. Donec ipsum, vestibulum ullamcorper venenatis augue. Aliquam tempus nisi in auctor vulputate, erat felis pellentesque augue nec, pellentesque lectus justo nec erat. Aliquam et nisl. Quisque sit amet dolor in justo pretium condimentum.\n\nVivamus placerat lacus vel vehicula scelerisque, dui enim adipiscing lacus sit amet sagittis, libero enim vitae mi. In neque magna posuere, euismod ac tincidunt tempor est. Ut suscipit nisi eu purus. Proin ut pede mauris eget ipsum. Integer vel quam nunc commodo consequat. Integer ac eros eu tellus dignissim viverra. Maecenas erat aliquam erat volutpat. Ut venenatis ipsum quis turpis. Integer cursus scelerisque lorem. Sed nec mauris id quam blandit consequat. Cras nibh mi hendrerit vitae, dapibus et aliquam et magna. Nulla vitae elit. Mauris consectetuer odio vitae augue.","EAN13":"0000000000000","PublisherName":"Publisher #3"}';
		
		$this->json_result_no_result = json_encode(array());
		
		$this->valid_resource_name = "products";
		$this->invalid_resource_name = '!#¤%&/()=?;:_@£$€[\\]}';
		$this->unused_resource_name = "this_resource_name_is_not_used";
		
		$this->json_result_empty_collection_id_2 = 
		array("CollectionID" => 2,
  "CollectionName" => "Empty Collection",
  "Products" => array());
		
		$this->number_of_collections = 4;
		$this->number_of_products = 29;
		
        $this->resetInstance();
        $this->CI->load->model('r2pdb_model');
        $this->obj = $this->CI->r2pdb_model;
    }
	
    public function test_get_products_1()
    {
        try {
            $output = $this->request('GET', 'api/requests/products/1');
        } catch (CIPHPUnitTestExitException $e) {
            $output = ob_get_clean();
        }

        $this->assertEquals(
            $this->json_result_product_1,
            $output
        );
        $this->assertResponseCode(200);
    }
}