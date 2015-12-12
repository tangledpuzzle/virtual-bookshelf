<?php

class My_projekti extends MY_Controller
{
	function __construct()
	{
        parent::__construct();
    }
	
	public function view($page = 'front', $data = NULL)
	{
		if ( ! file_exists(APPPATH . 'views/pages/' . $page . '.php'))
		{
			echo "Can't find " . APPPATH . 'views/pages/' . $page . '.php';
			show_404();
		}
		
		$this->load->view('templates/header');
		$this->load->view('pages/'.$page, $data);
		$this->load->view('templates/footer');
	}
}