<?php
/**
 * PHPUnit tests for the registration controller.
 */

/**
 * Test for the register controller.
 * @author Jose
 */
class Register_test extends TestCase
{
	/**
	 * Page Test: register by function
	 * @author Jose
	 */
	public function test_register_by_function()
    {
        $output = $this->request('GET', ['Register', 'show_register']);
		// php header test
        $this->assertContains('<img id="logo"', $output);
		// php page test
		$this->assertContains('<h1 class="first-content-element">Register an Account</h1>', $output);
		// php footer php
		$this->assertContains('<footer class="navbar-inverse page-footer">', $output);
    }	
}