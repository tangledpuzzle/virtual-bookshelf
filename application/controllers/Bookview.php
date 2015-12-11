<?php
class Bookview extends CI_Controller {

	public function index($bookid = NULL)
	{
		require_once('Projekti.php');
		$main = new Projekti();
		$data=NULL;
		
		
		$main->view('bookview', $data);
	}
}
