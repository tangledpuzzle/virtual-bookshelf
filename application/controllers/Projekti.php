<?php
class Projekti extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->helper('url');
		$this->load->model('r2pdb_model');
	}

    public function view($page = 'front')
	{
        if ( ! file_exists(APPPATH.'/views/pages/'.$page.'.php'))
        {
                // Whoops, we don't have a page for that!
                show_404();
        }

       
        $this->load->view('templates/header');
        $this->load->view('pages/'.$page);
        $this->load->view('templates/footer');
	}
}