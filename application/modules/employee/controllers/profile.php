<?php
class Profile extends CI_Controller
{
	function __construct()
	{
		parent:: __construct();
		$this->load->model('employee/profile_model');
	}
	function index()
	{	
		$this->load->view('includes/header');
		$this->load->view('includes/left_nav');
		$data['user']=$this->profile_model->get_profile_details();
		$this->load->view('profile_view',$data);
		$this->load->view('includes/footer');
		

	}




}


?>
