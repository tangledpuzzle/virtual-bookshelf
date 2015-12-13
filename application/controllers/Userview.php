<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once (dirname(__FILE__) . "/My_projekti.php");

class Userview extends My_projekti
{
	public function show_user($userid = null)
	{
		$data['user_id'] = $userid;
		$this->view_comment('userview', $data, "user");
	}
}
