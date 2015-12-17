<?php
/**
 * PHPUnit tests for the REST API.
 */

/**
 * Test for the REST API.
 */
class Requests_test extends TestCase
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
	 * REST API request result as JSON for: database product ID 1
	 */
	public $json_result_product_1;
	
	/**
	 * REST API request result as JSON for: no result
	 */
	public $json_result_no_result;
	
	/**
	 * REST API request result as JSON for: database collection ID 2
	 */
	public $json_result_empty_collection_id_2;
	
	/**
	 * REST API request result as JSON for: database user ID 1 collections
	 */
	public $json_user_1_collections;
	
	/**
	 * REST API request result as JSON for: database user ID 1 comments
	 */
	public $json_result_user_1_comments;
	
	/**
	 * REST API request result as JSON for: database user ID 1 reviews
	 */
	public $json_result_user_1_reviews;
	
	/**
	 * REST API request result as JSON for: database user ID 1
	 */
	public $json_result_user_1;
	
	/**
	 * REST API request result as JSON for: database review ID 1
	 */
	public $json_result_review_1;
	
	/**
	 * REST API request result as JSON for: database product ID 1 comments
	 */
	public $json_result_product_1_comment;
	
	/**
	 * REST API request result as JSON for: database collection ID 1
	 */
	public $json_result_collection_1;
	
	/**
	 * REST API request result as JSON for: database review ID 1 comments
	 */
	public $json_result_review_1_comments;

	/**
	 * A valid and used resource name.
	 */
	public $valid_resource_name;
	
	/**
	 * An invalid resource name.
	 */
	public $invalid_resource_name;
	
	/**
	 * A valid but unused resource name.
	 */
	public $unused_resource_name;
	
	/**
	 * Number of collections in the default database.
	 */
	public $number_of_collections;
	
	/**
	 * Number of products in the default database.
	 */
	public $number_of_products;
	
	/**
	 * JSON data returned by the REST API on an unsuccessful request.
	 */
	public $json_rest_status_false;
	
	/**
	 * JSON data returned by the REST API on a successful request. (When applicable ie. posting a comment.)
	 */
	public $json_rest_status_true;

	/**
	 * A random unique string for comment posting test.
	 */
	public $comment_request_body;
	
	
	/**
	 * A random unique string for comment posting test.
	 */
	public $comment_request_body_invalid;
	
	/**
	 * Correct basic authorization values. User name is 'admin', password is '1234'.
	 */
	public $api_auth_ok;
	
	/**
	 * Incorrect basic authorization values. User name is 'admin', password is '1233'.
	 */
	public $api_auth_wrong;
	
	/**
	 * Set up the common variables before tests.
	 * @author Jose
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
		
		$this->json_result_review_1 = '[{"ReviewID":1,"ReviewDate":"2001-09-23 00:00:00","ProductID":1,"Name":"Sample Book 1","ScreenName":"A User","user_id":1,"Text":"Review text goes here.","Pros":"It had some good things.","Cons":"Can\'t think of any.","Rating":5},{"ReviewID":6,"ReviewDate":"2012-09-01 00:00:00","ProductID":1,"Name":"Sample Book 1","ScreenName":"Test Account 7","user_id":7,"Text":"Sed nisi.","Pros":null,"Cons":null,"Rating":2},{"ReviewID":23,"ReviewDate":"2006-05-25 00:00:00","ProductID":1,"Name":"Sample Book 1","ScreenName":"A Moderator","user_id":2,"Text":"Morbi lectus risus, iaculis vel, suscipit quis, luctus non, massa.","Pros":null,"Cons":"Sed dignissim lacinia nunc.","Rating":3},{"ReviewID":27,"ReviewDate":"2011-03-22 00:00:00","ProductID":1,"Name":"Sample Book 1","ScreenName":"Test Account 6","user_id":6,"Text":"Quisque volutpat condimentum velit.","Pros":null,"Cons":null,"Rating":4},{"ReviewID":28,"ReviewDate":"2011-03-27 00:00:00","ProductID":1,"Name":"Sample Book 1","ScreenName":"Test Account 8","user_id":8,"Text":"Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.","Pros":"Curabitur sodales ligula in libero.","Cons":"Suspendisse in justo eu magna luctus suscipit.","Rating":5}]';
		
		$this->json_result_product_1_comment = '[{"CommentID":2,"PostDate":"1901-11-11 00:00:00","user_id":2,"ScreenName":"A Moderator","Text":"Test Product Comment"},{"CommentID":3,"PostDate":"2021-09-19 00:00:00","user_id":3,"ScreenName":"An Admin","Text":"Test Product Comment 2"}]';
		
		$this->json_result_collection_1 = '{"CollectionID":1,"CollectionName":"Test Collection","Products":[{"ProductID":1,"Name":"Sample Book 1","ReleaseDate":"2008-11-11"},{"ProductID":2,"Name":"Sample Book 2","ReleaseDate":null},{"ProductID":3,"Name":"Sample Book 3","ReleaseDate":"2018-12-11"},{"ProductID":5,"Name":"Sample Book 5","ReleaseDate":"2007-11-11"},{"ProductID":10,"Name":"Sample Book 10","ReleaseDate":"2015-11-11"}]}';
		
		$this->json_result_review_1 = '{"ReviewID":1,"ReviewDate":"2001-09-23 00:00:00","ProductID":1,"Name":"Sample Book 1","ScreenName":"A User","user_id":1,"Text":"Review text goes here.","Pros":"It had some good things.","Cons":"Can\'t think of any.","Rating":5}';
		
		$this->json_result_review_1_comments = '[{"CommentID":4,"PostDate":"2014-10-12 00:00:00","user_id":1,"ScreenName":"A User","Text":"Test Review Comment"}]';
		
		$this->json_rest_status_false = '"status":false';
		$this->json_rest_status_true = '"status":true';
		
		$this->comment_request_body = 'PHPUNIT COMMENT nFfG4Y9tiLrlH6YYR6NA';
		$this->comment_request_body_invalid = 'PHPUNIT COMMENT INVALID DATA thw0qRiSP0hmePUKDfkR';
		$this->api_auth_ok 	  = 'Basic YWRtaW46MTIzNA==';
		$this->api_auth_wrong = 'Basic YWRtaW46MTIzMw==';
		
        $this->resetInstance();
        $this->CI->load->model('r2pdb_model');
        $this->obj = $this->CI->r2pdb_model;
    }
	
	
	/**
	 * REST api test: http POST product comment without authorization
	 * @author Jose
	 */
	public function test_post_comment_product_no_auth()
    {
        try {
        	$output = $this->request('POST', 'api/requests/products/'.$this->valid_id_int.'/comments', ['text' => $this->comment_request_body]);
        } catch (CIPHPUnitTestExitException $e) {
            $output = ob_get_clean();
        }
        $this->assertContains($this->json_rest_status_false,$output);
        $this->assertResponseCode(401); // HTTP unauthorized
    }
	
	/**
	 * REST api test: http POST review comment without authorization
	 * @author Jose
	 */
	public function test_post_comment_review_no_auth()
    {
        try {
        	$output = $this->request('POST', 'api/requests/reviews/'.$this->valid_id_int.'/comments', ['text' => $this->comment_request_body]);
        } catch (CIPHPUnitTestExitException $e) {
            $output = ob_get_clean();
        }
        $this->assertContains($this->json_rest_status_false,$output);
        $this->assertResponseCode(401); // HTTP unauthorized
    }
	
	/**
	 * REST api test: http POST user comment without authorization
	 * @author Jose
	 */
	public function test_post_comment_user_no_auth()
    {
        try {
        	$output = $this->request('POST', 'api/requests/users/'.$this->valid_id_int.'/comments', ['text' => $this->comment_request_body]);
        } catch (CIPHPUnitTestExitException $e) {
            $output = ob_get_clean();
        }
        $this->assertContains($this->json_rest_status_false,$output);
        $this->assertResponseCode(401); // HTTP unauthorized
    }
	
	/**
	 * REST api test: http POST product comment with wrong authorization
	 * @author Jose
	 */
	public function test_post_comment_product_wrong_auth()
    {
		$this->request->setHeader('Authorization', $this->api_auth_wrong);
		
        try {
        	$output = $this->request('POST', 'api/requests/products/'.$this->valid_id_int.'/comments', ['text' => $this->comment_request_body]);
        } catch (CIPHPUnitTestExitException $e) {
            $output = ob_get_clean();
        }
        $this->assertContains($this->json_rest_status_false,$output);
        $this->assertResponseCode(401); // HTTP unauthorized
    }
	
	/**
	 * REST api test: http POST review comment with wrong authorization
	 * @author Jose
	 */
	public function test_post_comment_review_wrong_auth()
    {
		$this->request->setHeader('Authorization', $this->api_auth_wrong);
		
        try {
        	$output = $this->request('POST', 'api/requests/reviews/'.$this->valid_id_int.'/comments', ['text' => $this->comment_request_body]);
        } catch (CIPHPUnitTestExitException $e) {
            $output = ob_get_clean();
        }
        $this->assertContains($this->json_rest_status_false,$output);
        $this->assertResponseCode(401); // HTTP unauthorized
    }
	
	/**
	 * REST api test: http POST user comment with wrong authorization
	 * @author Jose
	 */
	public function test_post_comment_user_wrong_auth()
    {
		$this->request->setHeader('Authorization', $this->api_auth_wrong);
		
        try {
        	$output = $this->request('POST', 'api/requests/users/'.$this->valid_id_int.'/comments', ['text' => $this->comment_request_body]);
        } catch (CIPHPUnitTestExitException $e) {
            $output = ob_get_clean();
        }
        $this->assertContains($this->json_rest_status_false,$output);
        $this->assertResponseCode(401); // HTTP unauthorized
    }
	
	/**
	 * REST api test: http POST product comment with ok authorization.
	 * @author Jose
	 */
	public function test_post_comment_product_ok_auth()
    {
		// Set authorization.
		$this->request->setHeader('Authorization', $this->api_auth_ok);
		
		// Do the request.
        try {
        	$output = $this->request('POST', 'api/requests/products/'.$this->valid_id_int.'/comments', ['text' => $this->comment_request_body]);
        } catch (CIPHPUnitTestExitException $e) {
            $output = ob_get_clean();
        }
		
		// Commenting successful.
        $this->assertContains($this->json_rest_status_true,$output);
        $this->assertResponseCode(200); // HTTP ok
		
		// Get comments posted to user ID valid_id_int.
        try {
            $output = $this->request('GET', 'api/requests/products/'.$this->valid_id_int.'/comments');
        } catch (CIPHPUnitTestExitException $e) {
            $output = ob_get_clean();
        }

		// Verify that comment was posted by checking if the unique string is in the comments.
        $this->assertContains($this->comment_request_body,$output);
        $this->assertResponseCode(200); //http OK.
		
		// Remove the posted comment which is id 8 as there are 7 default comments.
		// Assert that removal succeeded.
        $this->assertEquals(TRUE, $this->obj->remove_product_comment($this->valid_id_int, 8));
    }
	
	/**
	 * REST api test: http POST review comment with ok authorization.
	 * @author Jose
	 */
	public function test_post_comment_review_ok_auth()
    {
		$this->request->setHeader('Authorization', $this->api_auth_ok);
		
		// Do the request.
        try {
        	$output = $this->request('POST', 'api/requests/reviews/'.$this->valid_id_int.'/comments', ['text' => $this->comment_request_body]);
        } catch (CIPHPUnitTestExitException $e) {
            $output = ob_get_clean();
        }
		
		// Commenting successful.
        $this->assertContains($this->json_rest_status_true,$output);
        $this->assertResponseCode(200); // HTTP ok
		
		// Get comments posted to user ID valid_id_int.
        try {
            $output = $this->request('GET', 'api/requests/reviews/'.$this->valid_id_int.'/comments');
        } catch (CIPHPUnitTestExitException $e) {
            $output = ob_get_clean();
        }

		// Verify that comment was posted by checking if the unique string is in the comments.
        $this->assertContains($this->comment_request_body,$output);
        $this->assertResponseCode(200); //http OK.
		
		// Remove the posted comment which is id 9 as there are 7 default comments + 1 posted above.
		// Assert that removal succeeded.
        $this->assertEquals(TRUE, $this->obj->remove_review_comment($this->valid_id_int, 9));
    }
	
	/**
	 * REST api test: http POST user comment with ok authorization.
	 * @author Jose
	 */
	public function test_post_comment_user_ok_auth()
    {
		$this->request->setHeader('Authorization', $this->api_auth_ok);
		
		// Do the request.
        try {
        	$output = $this->request('POST', 'api/requests/users/'.$this->valid_id_int.'/comments', ['text' => $this->comment_request_body]);
        } catch (CIPHPUnitTestExitException $e) {
            $output = ob_get_clean();
        }
        
		// Commenting successful.
        $this->assertContains($this->json_rest_status_true,$output);
        $this->assertResponseCode(200); // HTTP ok
		
		// Get comments posted to user ID valid_id_int.
        try {
            $output = $this->request('GET', 'api/requests/users/'.$this->valid_id_int.'/comments');
        } catch (CIPHPUnitTestExitException $e) {
            $output = ob_get_clean();
        }

		// Verify that comment was posted by checking if the unique string is in the comments.
        $this->assertContains($this->comment_request_body,$output);
        $this->assertResponseCode(200); //http OK.
		
		// Remove the posted comment which is id 10 as there are 7 default comments + 2 posted above.
		// Assert that removal succeeded.
        $this->assertEquals(TRUE, $this->obj->remove_user_comment($this->valid_id_int, 10));
		
		/*
		 * PHPUnit runs these tests in order from top to bottom.
		 * We need to alter the AUTO_INCREMENT value in the comments table back to 8 or some tests further down will fail if these tests are run more than once without resetting the database in between.
		 */
		// This doesn't work. You need to reset the database manually after reach run.
		//$this->assertEquals(TRUE, $this->obj->db->query("ALTER TABLE comments AUTO_INCREMENT 7"));
		
		// Database is now in the same state as before doing the three tests above.
    }
	
	/**
	 * REST api test: http POST user comment with ok authorization but invalid target user.
	 * @author Jose
	 */
	public function test_post_comment_user_ok_auth_invalid_id()
    {
		$this->request->setHeader('Authorization', $this->api_auth_ok);
		
        try {
        	$output = $this->request('POST', 'api/requests/users/'.$this->invalid_id_int.'/comments', ['text' => $this->comment_request_body_invalid]);
        } catch (CIPHPUnitTestExitException $e) {
            $output = ob_get_clean();
        }
        
		// Commenting failed.
        $this->assertContains($this->json_rest_status_false,$output);
        $this->assertResponseCode(400); // HTTP bad request (404 would be valid but unused)
		
		// Get comments posted to user ID valid_id_int.
        try {
            $output = $this->request('GET', 'api/requests/users/'.$this->valid_id_int.'/comments');
        } catch (CIPHPUnitTestExitException $e) {
            $output = ob_get_clean();
        }
		
		// Verify that comment was NOT posted by checking if the unique string is NOT in the comments.
        $this->assertNotContains($this->comment_request_body_invalid,$output);
        $this->assertResponseCode(200); //http OK.
    }
	
	/**
	 * REST api test: http POST product comment with ok authorization but invalid target product.
	 * @author Jose
	 */
	public function test_post_comment_product_ok_auth_invalid_id()
    {
		$this->request->setHeader('Authorization', $this->api_auth_ok);
		
        try {
        	$output = $this->request('POST', 'api/requests/products/'.$this->invalid_id_int.'/comments', ['text' => $this->comment_request_body_invalid]);
        } catch (CIPHPUnitTestExitException $e) {
            $output = ob_get_clean();
        }
        
		// Commenting failed.
        $this->assertContains($this->json_rest_status_false,$output);
        $this->assertResponseCode(400); // HTTP bad request (404 would be valid but unused)
		
		// Get comments posted to user ID valid_id_int.
        try {
            $output = $this->request('GET', 'api/requests/products/'.$this->valid_id_int.'/comments');
        } catch (CIPHPUnitTestExitException $e) {
            $output = ob_get_clean();
        }
		
		// Verify that comment was NOT posted by checking if the unique string is NOT in the comments.
        $this->assertNotContains($this->comment_request_body_invalid,$output);
        $this->assertResponseCode(200); //http OK.
    }
	
	/**
	 * REST api test: http POST review comment with ok authorization but invalid target review.
	 * @author Jose
	 */
	public function test_post_comment_review_ok_auth_invalid_id()
    {
		$this->request->setHeader('Authorization', $this->api_auth_ok);
		
        try {
        	$output = $this->request('POST', 'api/requests/reviews/'.$this->invalid_id_int.'/comments', ['text' => $this->comment_request_body_invalid]);
        } catch (CIPHPUnitTestExitException $e) {
            $output = ob_get_clean();
        }
        
		// Commenting failed.
        $this->assertContains($this->json_rest_status_false,$output);
        $this->assertResponseCode(400); // HTTP bad request (404 would be valid but unused)
		
		// Get comments posted to user ID valid_id_int.
        try {
            $output = $this->request('GET', 'api/requests/reviews/'.$this->valid_id_int.'/comments');
        } catch (CIPHPUnitTestExitException $e) {
            $output = ob_get_clean();
        }
		
		// Verify that comment was NOT posted by checking if the unique string is NOT in the comments.
        $this->assertNotContains($this->comment_request_body_invalid,$output);
        $this->assertResponseCode(200); //http OK.
    }
	
	/**
	 * REST api test: http GET products
	 * @author Jose
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
	 * @author Jose
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
	 * @author Ilkka
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
	 * @author Ilkka
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
	 * @author Ilkka
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
	 * @author Ilkka
	 */
	public function test_get_products_1_reviews()
    {
        try {
            $output = $this->request('GET', 'api/requests/products/'.$this->valid_id_int.'/reviews/');
        } catch (CIPHPUnitTestExitException $e) {
            $output = ob_get_clean();
        }

        $this->assertEquals($this->json_result_review_1,$output);
        $this->assertResponseCode(200); //http OK.
    }
	
	/**
	 * REST api test: http GET product 1 comments
	 * @author Ilkka
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
	 * @author Ilkka
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
	 * @author Ilkka
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
	 * @author Ilkka
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
	
	/**
	 * REST api test: http GET products unused
	 * @author Jose
	 */
    public function test_get_products_unused()
    {
        try {
            $output = $this->request('GET', 'api/requests/products/'.$this->unused_id_int);
        } catch (CIPHPUnitTestExitException $e) {
            $output = ob_get_clean();
        }

        $this->assertContains(
            $this->json_rest_status_false,
            $output
        );
        $this->assertResponseCode(404); // http not found
    }
	
	
	/**
	 * REST api test: http GET unused user id collections
	 * @author Jose
	 */
	public function test_get_user_unused_collections()
    {
        try {
            $output = $this->request('GET', 'api/requests/users/'.$this->unused_id_int.'/collections');
        } catch (CIPHPUnitTestExitException $e) {
            $output = ob_get_clean();
        }

        $this->assertContains($this->json_rest_status_false,$output);
        $this->assertResponseCode(404); //http not found
    }
	
	/**
	 * REST api test: http GET unused user id comments
	 * @author Jose
	 */
	public function test_get_user_unused_comments()
    {
        try {
            $output = $this->request('GET', 'api/requests/users/'.$this->unused_id_int.'/comments');
        } catch (CIPHPUnitTestExitException $e) {
            $output = ob_get_clean();
        }

        $this->assertContains($this->json_rest_status_false,$output);
        $this->assertResponseCode(404); //http not found
    }
	
	/**
	 * REST api test: http GET unused user id reviews
	 * @author Jose
	 */
	public function test_get_user_unused_reviews()
    {
        try {
            $output = $this->request('GET', 'api/requests/users/'.$this->unused_id_int.'/reviews');
        } catch (CIPHPUnitTestExitException $e) {
            $output = ob_get_clean();
        }

        $this->assertContains($this->json_rest_status_false,$output);
        $this->assertResponseCode(404); //http not found
    }
	
	/**
	 * REST api test: http GET unused user id
	 * @author Jose
	 */
	public function test_get_user_unused()
    {
        try {
            $output = $this->request('GET', 'api/requests/users/'.$this->unused_id_int.'/');
        } catch (CIPHPUnitTestExitException $e) {
            $output = ob_get_clean();
        }

        $this->assertContains($this->json_rest_status_false,$output);
        $this->assertResponseCode(404); //http not found
    }
	
	/**
	 * REST api test: http GET product unused reviews
	 * @author Jose
	 */
	public function test_get_products_unused_reviews()
    {
        try {
            $output = $this->request('GET', 'api/requests/products/'.$this->unused_id_int.'/reviews/');
        } catch (CIPHPUnitTestExitException $e) {
            $output = ob_get_clean();
        }

        $this->assertContains($this->json_rest_status_false,$output);
        $this->assertResponseCode(404); //http not found
    }
	
	/**
	 * REST api test: http GET product unused comments
	 * @author Jose
	 */
	public function test_get_products_unused_comments()
    {
        try {
            $output = $this->request('GET', 'api/requests/products/'.$this->unused_id_int.'/comments/');
        } catch (CIPHPUnitTestExitException $e) {
            $output = ob_get_clean();
        }

        $this->assertContains($this->json_rest_status_false,$output);
        $this->assertResponseCode(404); //http not found
    }
	
	
	/**
	 * REST api test: http GET collection unused
	 * @author Jose
	 */
	public function test_get_collection_unused()
    {
        try {
            $output = $this->request('GET', 'api/requests/collections/'.$this->unused_id_int.'/');
        } catch (CIPHPUnitTestExitException $e) {
            $output = ob_get_clean();
        }

        $this->assertContains($this->json_rest_status_false,$output);
        $this->assertResponseCode(404); //http not found
    }
		
	/**
	 * REST api test: http GET review unused
	 * @author Jose
	 */
	public function test_get_review_unused()
    {
        try {
            $output = $this->request('GET', 'api/requests/reviews/'.$this->unused_id_int.'/');
        } catch (CIPHPUnitTestExitException $e) {
            $output = ob_get_clean();
        }

        $this->assertContains($this->json_rest_status_false,$output);
        $this->assertResponseCode(404); //http not found
    }
	
	/**
	 * REST api test: http GET unused review comments
	 * @author Jose
	 */
	public function test_get_review_unused_comments()
    {
        try {
            $output = $this->request('GET', 'api/requests/reviews/'.$this->unused_id_int.'/comments/');
        } catch (CIPHPUnitTestExitException $e) {
            $output = ob_get_clean();
        }

        $this->assertContains($this->json_rest_status_false,$output);
        $this->assertResponseCode(404); //http not found
    }
}