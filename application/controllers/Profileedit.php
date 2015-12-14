<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once (dirname(__FILE__) . "/My_projekti.php");

class Profileedit extends My_projekti
{
	public function update_user()
	{
			$data = NULL;
		if($this->input->post('submit'))
		{
			$data["message"] = $this->input->post("ScreenName");
			$this->view('message', $data);
		}
		else{
			$this->view('profileedit', $data);
		}
		
	}
}