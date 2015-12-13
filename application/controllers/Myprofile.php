<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once (dirname(__FILE__) . "/My_projekti.php");

class Myprofile extends My_projekti
{
	public function show_myprofile()
	{
		$this->is_logged_in();
		$data['user_id'] = $this->auth_user_id;
		$this->view_comment('userview', $data, "user");
	}
}
