<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class unchecked_out_users extends CI_Controller {


public function __Construct()
	{
		parent::__Construct();
		$this->load->helper('genfunction');
		admin_login();
		$this->load->model('admin/unchecked_out_users_model');

	}

	public function index()
	{

		
		$data['users']=$this->unchecked_out_users_model->get_unchecked_users();
		$this->load->view('includes/header');
		$this->load->view('includes/left_nav');
		$this->load->view('admin/unchecked_out_users_view',$data);
		$this->load->view('includes/footer');
	}


	public function update_time()
	{
	
	$user_name=$this->input->post('user_name');
	$check_in_time=$this->input->post('check_in_time');
	$check_out_time=$this->input->post('check_out_time');
	$this->unchecked_out_users_model->update_checkedout_time($user_name,$check_in_time,$check_out_time);


	}

}


?>
