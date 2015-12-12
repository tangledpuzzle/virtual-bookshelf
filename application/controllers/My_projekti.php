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
		
		$this->is_logged_in();

		if( $http_user_cookie_contents = $this->input->cookie( config_item('http_user_cookie_name') ) )
            {
                $data["cookie"] = unserialize( $http_user_cookie_contents );
            }
		else
		{
			$data['cookie'] = "lols";
		}
        if( ! empty( $this->auth_role ) )
        {
            echo 'User ID is ' . $this->auth_user_id;
			
		$this->load->view('templates/header', $data);
		$this->load->view('pages/'.$page, $data);
		$this->load->view('templates/footer');
		}
		else
		{
				
		$this->load->view('templates/header');
		$this->load->view('pages/'.$page, $data);
		$this->load->view('templates/footer');
			}
	}
}