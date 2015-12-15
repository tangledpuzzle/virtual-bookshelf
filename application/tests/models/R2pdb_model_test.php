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
	public $malformed_id_string;
	public $test_string;
	public $unassigned;
	
	/**
	 * Set up the database model before each test and assign the common variables.
	 */
    public function setUp()
    {
		$this->valid_id_int = 1;
		$this->invalid_id_int = 0;
		$this->unused_id_int = 999999;
		$this->malformed_id_string = "1sdfui";
		$this->test_string = "Test string.";
		// $this->unassigned is unassigned for a reason.
		// NULL is also tested but it does not need a variable.
		
        $this->resetInstance();
        $this->CI->load->model('r2pdb_model');
        $this->obj = $this->CI->r2pdb_model;
    }

	/**
	 * Reflection magic copypasted from: http://stackoverflow.com/a/2798203
	 */
	protected static function getMethodAsPublic($name)
	{
	  $class = new ReflectionClass('R2pdbmodel_model');
	  $method = $class->getMethod($name);
	  $method->setAccessible(true);
	  return $method;
	}
	 
	/*
	 * ----------- row id validation -----------
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
	 * Test row id validation with: malformed id
	 */
    public function test_validate_row_id_malformed()
    {
		// Genders is a small table so it's fast to test.
       	$actual = $this->obj->validate_row_id("genders", $this->malformed_id_string);
		$expected = FALSE;
        $this->assertEquals($expected, $actual);
    }
	
	/**
	 * Test row id validation with: string
	 */
    public function test_validate_row_id_string()
    {
		// Genders is a small table so it's fast to test.
       	$actual = $this->obj->validate_row_id("genders", $this->test_string);
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
}