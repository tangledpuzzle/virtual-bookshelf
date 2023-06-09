<?php
/**
 * Controller for the login page.
 * @author Community Auth
 */
defined('BASEPATH') or exit('No direct script access allowed');

include_once (dirname(__FILE__) . "/My_projekti.php");

/**
 * Handle user logging in/out.
 */
class Login extends My_projekti
{
	/**
	 * Contruct the parent controller.
	 */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Modified Community Auth code.
     * 
     * This login method only serves to redirect a user to a 
     * location once they have successfully logged in. It does
     * not attempt to confirm that the user has permission to 
     * be on the page they are being redirected to.
     */
    public function login()
    {
			// Load Community Auth variables.
			$this->is_logged_in();

			// Is the user logged in?
			if($this->auth_level !== NULL)
			{
				$this->view('myprofile', NULL);
			}
			else
			{
				if( strtolower( $_SERVER['REQUEST_METHOD'] ) == 'post' )
				{
					$this->require_min_level(1);
				}

				$this->setup_login_form();

				$this->view('login_form', null);
			}
    }

    /**
     * Copied from Community Auth: Log out.
     */
    public function logout()
    {
        $this->authentication->logout();

        redirect( secure_site_url( LOGIN_PAGE . '?logout=1') );
    }
}