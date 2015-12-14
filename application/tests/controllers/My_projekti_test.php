<?php

class My_projekti_test extends TestCase
{
	/**
	 * Test for: Valid APPPATH
	 */
	public function test_APPPATH()
	{
		$actual = realpath(APPPATH);
		$expected = realpath(__DIR__ . '/../..');
		$this->assertEquals(
			$expected,
			$actual,
			'Your APPPATH seems to be wrong. Check your $application_folder in tests/Bootstrap.php'
		);
	}
	
	/**
	 * Page Test: 404 part 1
	 */
	public function test_404()
	{
		$this->request('GET', ['My_projekti', 'this-is-not-a-function']);
		$this->assertResponseCode(404);
	}
	
	/**
	 * Page Test: 404 part 2
	 */
	public function test_404_2()
	{
		$this->request('GET', 'this-is-not-a-page');
		$this->assertResponseCode(404);
	}
	
	/**
	 * Page Test: front page by function
	 */
    public function test_index_by_function()
    {
        $output = $this->request('GET', ['My_projekti', 'view']);
        $this->assertContains('<title>Virtual Bookshelf</title>', $output);
        $this->assertContains('<h1 class="first-content-element">Welcome!</h1>', $output);
    }
	
	/**
	 * Page Test: front page by url
	 */
	public function test_index_by_url()
    {
        $output = $this->request('GET', '/');
        $this->assertContains('<title>Virtual Bookshelf</title>', $output);
        $this->assertContains('<h1 class="first-content-element">Welcome!</h1>', $output);
    }
	
}