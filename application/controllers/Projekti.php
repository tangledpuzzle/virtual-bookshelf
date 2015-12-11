<?php

class Projekti extends CI_Controller
{
	function __construct()
	{
        parent::__construct();
    }
	
	public function view($page = 'front', $data = NULL)
	{
		if ( ! file_exists(APPPATH.'/views/pages/'.$page.'.php'))
		{
			show_404();
		}
		
		$this->load->view('templates/header');
		$this->load->view('pages/'.$page, $data);
		$this->load->view('templates/footer');
	}
	
	
	public function view_comment($page = 'front', $data = NULL, $comment_type = NULL)
	{
		echo "jeeeeeeeeeeeeeeeeeeeeeee";
		if ( ! file_exists(APPPATH.'/views/pages/'.$page.'.php'))
		{
			show_404();
		}
		
		$this->load->view('templates/header');
		$this->load->view('pages/'.$page, $data);
		$data["comment_type"]=$comment_type;
		$this->load->view('pages/comment', $data);
		$this->load->view('templates/footer');
	}
}

