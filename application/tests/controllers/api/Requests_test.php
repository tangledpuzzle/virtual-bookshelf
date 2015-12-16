<?php


//FIXME !! testaa comment POST.
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
	public $json_user_1_collections;
	public $json_result_user_1_comments;
	public $json_result_user_1_reviews;
	public $json_result_user_1;
	public $json_result_product_1_review;
	public $json_result_product_1_comment;
	public $json_result_product_1_id;
	public $json_result_collection_1;
	public $json_result_review_1;
	public $json_result_review_1_comments;
	
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
		
		$this->json_result_user_1_collections = '[{"CollectionID":1,"CollectionName":"Test Collection","ProductCount":5},{"CollectionID":2,"CollectionName":"Empty Collection","ProductCount":0}]';
		
		$this->json_result_user_1_comments = '[{"CommentID":1,"PostDate":"2001-01-11 00:00:00","user_id":1,"ScreenName":"A User","Text":"Test User Comment"}]';
		
		$this->json_result_user_1_reviews = '[{"ReviewID":1,"ReviewDate":"2001-09-23 00:00:00","ProductID":1,"Name":"Sample Book 1","ScreenName":"A User","user_id":1,"Text":"Review text goes here.","Pros":"It had some good things.","Cons":"Can\'t think of any.","Rating":5},{"ReviewID":2,"ReviewDate":"2015-12-08 00:00:00","ProductID":10,"Name":"Sample Book 10","ScreenName":"A User","user_id":1,"Text":"Lorem ipsum dolor sit amet, consectetur adipiscing elit.","Pros":null,"Cons":"Sed nisi.","Rating":2},{"ReviewID":11,"ReviewDate":"2014-11-06 00:00:00","ProductID":4,"Name":"Sample Book 4","ScreenName":"A User","user_id":1,"Text":"Mauris massa.","Pros":null,"Cons":null,"Rating":3},{"ReviewID":14,"ReviewDate":"2008-03-29 00:00:00","ProductID":6,"Name":"Sample Book 6","ScreenName":"A User","user_id":1,"Text":"Curabitur sodales ligula in libero.","Pros":null,"Cons":"Aenean quam.","Rating":3},{"ReviewID":15,"ReviewDate":"2004-02-19 00:00:00","ProductID":10,"Name":"Sample Book 10","ScreenName":"A User","user_id":1,"Text":"Sed dignissim lacinia nunc.","Pros":"Ut ultrices ultrices enim.","Cons":"Nulla quis sem at nibh elementum imperdiet.","Rating":5},{"ReviewID":26,"ReviewDate":"2007-04-08 00:00:00","ProductID":8,"Name":"Sample Book 8","ScreenName":"A User","user_id":1,"Text":"Nulla metus metus, ullamcorper vel, tincidunt sed, euismod in, nibh.","Pros":"Vestibulum lacinia arcu eget nulla.","Cons":"Proin quam.","Rating":3}]';
		
		$this->json_result_user_1 = '{"user_id":1,"ScreenName":"A User","FirstName":null,"LastName":null,"Age":37,"GenderName":"Male","CountryName":"Japan","user_date":"2015-12-12 21:14:07","AvatarPath":null,"Bio":"test user please ignore"}';
		
		$this->json_result_product_1_review = '[{"ReviewID":1,"ReviewDate":"2001-09-23 00:00:00","ProductID":1,"Name":"Sample Book 1","ScreenName":"A User","user_id":1,"Text":"Review text goes here.","Pros":"It had some good things.","Cons":"Can\'t think of any.","Rating":5},{"ReviewID":6,"ReviewDate":"2012-09-01 00:00:00","ProductID":1,"Name":"Sample Book 1","ScreenName":"Test Account 7","user_id":7,"Text":"Sed nisi.","Pros":null,"Cons":null,"Rating":2},{"ReviewID":23,"ReviewDate":"2006-05-25 00:00:00","ProductID":1,"Name":"Sample Book 1","ScreenName":"A Moderator","user_id":2,"Text":"Morbi lectus risus, iaculis vel, suscipit quis, luctus non, massa.","Pros":null,"Cons":"Sed dignissim lacinia nunc.","Rating":3},{"ReviewID":27,"ReviewDate":"2011-03-22 00:00:00","ProductID":1,"Name":"Sample Book 1","ScreenName":"Test Account 6","user_id":6,"Text":"Quisque volutpat condimentum velit.","Pros":null,"Cons":null,"Rating":4},{"ReviewID":28,"ReviewDate":"2011-03-27 00:00:00","ProductID":1,"Name":"Sample Book 1","ScreenName":"Test Account 8","user_id":8,"Text":"Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.","Pros":"Curabitur sodales ligula in libero.","Cons":"Suspendisse in justo eu magna luctus suscipit.","Rating":5}]';
		
		$this->json_result_product_1_comment = '[{"CommentID":2,"PostDate":"1901-11-11 00:00:00","user_id":2,"ScreenName":"A Moderator","Text":"Test Product Comment"},{"CommentID":3,"PostDate":"2021-09-19 00:00:00","user_id":3,"ScreenName":"An Admin","Text":"Test Product Comment 2"}]';
		
		$this->json_result_product_1_id = '{"ProductID":1,"Name":"Sample Book 1","ReleaseDate":"2008-11-11","ImagePath":"img-path","LanguageName":"Finnish","Brief":"Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Sed posuere interdum sem. Quisque ligula eros ullamcorper quis, lacinia quis facilisis sed sapien. Mauris varius diam vitae arcu.","Description":"Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Sed posuere interdum sem. Quisque ligula eros ullamcorper quis, lacinia quis facilisis sed sapien. Mauris varius diam vitae arcu. Sed arcu lectus auctor vitae, consectetuer et venenatis eget velit. Sed augue orci, lacinia eu tincidunt et eleifend nec lacus. Donec ultricies nisl ut felis, suspendisse potenti. Lorem ipsum ligula ut hendrerit mollis, ipsum erat vehicula risus, eu suscipit sem libero nec erat. Aliquam erat volutpat. Sed congue augue vitae neque. Nulla consectetuer porttitor pede. Fusce purus morbi tortor magna condimentum vel, placerat id blandit sit amet tortor.\n\nMauris sed libero. Suspendisse facilisis nulla in lacinia laoreet, lorem velit accumsan velit vel mattis libero nisl et sem. Proin interdum maecenas massa turpis sagittis in, interdum non lobortis vitae massa. Quisque purus lectus, posuere eget imperdiet nec sodales id arcu. Vestibulum elit pede dictum eu, viverra non tincidunt eu ligula.\n\nNam molestie nec tortor. Donec placerat leo sit amet velit. Vestibulum id justo ut vitae massa. Proin in dolor mauris consequat aliquam. Donec ipsum, vestibulum ullamcorper venenatis augue. Aliquam tempus nisi in auctor vulputate, erat felis pellentesque augue nec, pellentesque lectus justo nec erat. Aliquam et nisl. Quisque sit amet dolor in justo pretium condimentum.\n\nVivamus placerat lacus vel vehicula scelerisque, dui enim adipiscing lacus sit amet sagittis, libero enim vitae mi. In neque magna posuere, euismod ac tincidunt tempor est. Ut suscipit nisi eu purus. Proin ut pede mauris eget ipsum. Integer vel quam nunc commodo consequat. Integer ac eros eu tellus dignissim viverra. Maecenas erat aliquam erat volutpat. Ut venenatis ipsum quis turpis. Integer cursus scelerisque lorem. Sed nec mauris id quam blandit consequat. Cras nibh mi hendrerit vitae, dapibus et aliquam et magna. Nulla vitae elit. Mauris consectetuer odio vitae augue.","EAN13":"0000000000000","PublisherName":"Publisher #3"}';
		
		$this->json_result_collection_1 = '{"CollectionID":1,"CollectionName":"Test Collection","Products":[{"ProductID":1,"Name":"Sample Book 1","ReleaseDate":"2008-11-11"},{"ProductID":2,"Name":"Sample Book 2","ReleaseDate":null},{"ProductID":3,"Name":"Sample Book 3","ReleaseDate":"2018-12-11"},{"ProductID":5,"Name":"Sample Book 5","ReleaseDate":"2007-11-11"},{"ProductID":10,"Name":"Sample Book 10","ReleaseDate":"2015-11-11"}]}';
		
		$this->json_result_review_1 = '{"ReviewID":1,"ReviewDate":"2001-09-23 00:00:00","ProductID":1,"Name":"Sample Book 1","ScreenName":"A User","user_id":1,"Text":"Review text goes here.","Pros":"It had some good things.","Cons":"Can\'t think of any.","Rating":5}';
		
		$this->json_result_review_1_comments = '[{"CommentID":4,"PostDate":"2014-10-12 00:00:00","user_id":1,"ScreenName":"A User","Text":"Test Review Comment"}]';
		
        $this->resetInstance();
        $this->CI->load->model('r2pdb_model');
        $this->obj = $this->CI->r2pdb_model;
    }
	
	
	/**
	 * REST api test: http GET products
	 */
    public function test_get_products_1()
    {
        try {
            $output = $this->request('GET', 'api/requests/products/'.$this->valid_id_int);
        } catch (CIPHPUnitTestExitException $e) {
            $output = ob_get_clean();
        }

        $this->assertEquals(
            $this->json_result_product_1,
            $output
        );
        $this->assertResponseCode(200);
    }
	
	/**
	 * REST api test: http GET user 1 collections
	 */
	public function test_get_user_1_collections()
    {
        try {
            $output = $this->request('GET', 'api/requests/users/'.$this->valid_id_int.'/collections');
        } catch (CIPHPUnitTestExitException $e) {
            $output = ob_get_clean();
        }

        $this->assertEquals($this->json_result_user_1_collections,$output);
        $this->assertResponseCode(200); //http OK.
    }
	
	/**
	 * REST api test: http GET user 1 comments
	 */
	public function test_get_user_1_comments()
    {
        try {
            $output = $this->request('GET', 'api/requests/users/'.$this->valid_id_int.'/comments');
        } catch (CIPHPUnitTestExitException $e) {
            $output = ob_get_clean();
        }

        $this->assertEquals($this->json_result_user_1_comments,$output);
        $this->assertResponseCode(200); //http OK.
    }
	
	/**
	 * REST api test: http GET user 1 reviews
	 */
	public function test_get_user_1_reviews()
    {
        try {
            $output = $this->request('GET', 'api/requests/users/'.$this->valid_id_int.'/reviews');
        } catch (CIPHPUnitTestExitException $e) {
            $output = ob_get_clean();
        }

        $this->assertEquals($this->json_result_user_1_reviews,$output);
        $this->assertResponseCode(200); //http OK.
    }
	
	/**
	 * REST api test: http GET user 1
	 */
	public function test_get_user_1()
    {
        try {
            $output = $this->request('GET', 'api/requests/users/'.$this->valid_id_int.'/');
        } catch (CIPHPUnitTestExitException $e) {
            $output = ob_get_clean();
        }

        $this->assertEquals($this->json_result_user_1,$output);
        $this->assertResponseCode(200); //http OK.
    }
	
	/**
	 * REST api test: http GET product 1 reviews
	 */
	public function test_get_products_1_reviews()
    {
        try {
            $output = $this->request('GET', 'api/requests/products/'.$this->valid_id_int.'/reviews/');
        } catch (CIPHPUnitTestExitException $e) {
            $output = ob_get_clean();
        }

        $this->assertEquals($this->json_result_product_1_review,$output);
        $this->assertResponseCode(200); //http OK.
    }
	
	/**
	 * REST api test: http GET product 1 comments
	 */
	public function test_get_products_1_comments()
    {
        try {
            $output = $this->request('GET', 'api/requests/products/'.$this->valid_id_int.'/comments/');
        } catch (CIPHPUnitTestExitException $e) {
            $output = ob_get_clean();
        }

        $this->assertEquals($this->json_result_product_1_comment,$output);
        $this->assertResponseCode(200); //http OK.
    }
	
	
	/**
	 * REST api test: http GET collection 1
	 */
	public function test_get_collection_1()
    {
        try {
            $output = $this->request('GET', 'api/requests/collections/'.$this->valid_id_int.'/');
        } catch (CIPHPUnitTestExitException $e) {
            $output = ob_get_clean();
        }

        $this->assertEquals($this->json_result_collection_1,$output);
        $this->assertResponseCode(200); //http OK.
    }
		
	/**
	 * REST api test: http GET review 1
	 */
	public function test_get_review_1()
    {
        try {
            $output = $this->request('GET', 'api/requests/reviews/'.$this->valid_id_int.'/');
        } catch (CIPHPUnitTestExitException $e) {
            $output = ob_get_clean();
        }

        $this->assertEquals($this->json_result_review_1,$output);
        $this->assertResponseCode(200); //http OK.
    }
	
	/**
	 * REST api test: http GET review 1 comments
	 */
	public function test_get_review_1_comments()
    {
        try {
            $output = $this->request('GET', 'api/requests/reviews/'.$this->valid_id_int.'/comments/');
        } catch (CIPHPUnitTestExitException $e) {
            $output = ob_get_clean();
        }

        $this->assertEquals($this->json_result_review_1_comments,$output);
        $this->assertResponseCode(200); //http OK.
    }
	
}