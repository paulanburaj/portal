<?php

class admin extends CI_Controller {

    function __construct()
    	{
	
        parent::__construct();
	
	$this->load->model('admin_login_model');

	
	}


    function index()

	{
	$this->load->view('includes/script_header');
	$this->load->view('admin_login');
	
	}

   function login()
	{

	$query=$this->admin_login_model->login_check();	
	if($query->num_rows>0)
	{

	$emp=$query->result_array();

	$data = array(
				'displayname' => $emp[0]['display_name'],
				'image' => $emp[0]['image'],
				'user_name' => $emp[0]['user_name'],
				'is_logged_in' => true,
				'is_admin' => true
				
			);
			$this->session->set_userdata($data);
			redirect('home/dashboard');

	}
	else{

	$this->session->set_flashdata('error','Invalid username or password !');
	redirect('admin');
	}
	
	
	}


	

}

?>
