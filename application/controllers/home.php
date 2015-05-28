<?php

class Home extends CI_Controller {

    function __construct()
    {
        parent::__construct();
	$this->load->model('home_model');
	}
	
	
	function index()
	{
	$data['employees']=$this->home_model->get_users_list();	
	$this->load->view('includes/header');	
	if($this->session->userdata('is_logged_in')){
	$this->load->view('includes/left_nav');
	}
$data['attendance']=$this->home_model->get_login_user_details();
	$this->load->view('home',$data);	
	$this->load->view('includes/footer');	

	}

	function login()
	{

	$query=$this->home_model->login_check();	
	if($query->num_rows>0)
	{

	$emp=$query->result_array();

	$data = array(
				'displayname' => $emp[0]['display_name'],
				'image' => $emp[0]['image'],
				'user_name' => $emp[0]['user_name'],
				'is_logged_in' => true
			);
			$this->session->set_userdata($data);
			redirect('home/dashboard');

	}
	else{

	$this->session->set_flashdata('error','Invalid Username or password');
	redirect('home');
	}

	}

	function check_in_with_login(){

	$query=$this->home_model->login_check();	

	if($query->num_rows>0 )
	{
	$emp=$query->result_array();

	$data = array(
				'displayname' => $emp[0]['display_name'],
				'image' => $emp[0]['image'],
				'user_name' => $emp[0]['user_name'],
				'in_time' => $emp[0]['in_time'],
				'is_logged_in' => true
			);
			$this->session->set_userdata($data);
	$this->home_model->check_in();
	
	echo "success";
	}
	else
	{
	echo "You are not authorized user";
	}



	}
function getdelay_time(){

$query=$this->home_model->delay_time();
$emp_1=$query->result_array();
echo $emp_1[0]['delay_time'];
}

function update_reason(){

$query_1=$this->home_model->update_reason();

}
function update_reason_quickout(){

$query_2=$this->home_model->update_reason_quickout();

}
//last 
function get_total_intime(){

$query=$this->home_model->total_intime();
$emp_2=$query->result_array();
$total_in_time_in_sec=$emp_2[0]['total_in_hours_today'];
$total_in_time=gmdate("H:i:s", $total_in_time_in_sec);

$nine_hrs=strtotime("09:00:00");
$total_in_hrs=strtotime($total_in_time);
if($total_in_hrs<$nine_hrs){
echo "1";

}
}

function check_checkin(){

	//echo 'hai';
$query=$this->home_model->check_checkin();
$emp_2=$query->result_array();
echo $emp_2[0]['logged_in_date'];

}

function get_reason(){

	//echo 'hai';
$query=$this->home_model->get_reason();
$emp_2=$query->result_array();
echo $emp_2[0]['reason'];

}

function delete_login(){

$query=$this->home_model->delete_login();

}
	function check_out_with_login(){

	$query=$this->home_model->login_check();	
	if($query->num_rows>0)
	{
	$emp=$query->result_array();

	$data = array(
				'displayname' => $emp[0]['display_name'],
				'image' => $emp[0]['image'],
				'user_name' => $emp[0]['user_name'],
				'is_logged_in' => true
			);
			$this->session->set_userdata($data);
	$this->home_model->check_out();
	echo "success";
	}
	else
	{
	echo "You are not authorized user";
	}



	}

	function check_in()
	{


	$this->home_model->check_in();
	
	echo "success"; 

	}

	function check_out()
	{


	$this->home_model->check_out();
	
	echo "success"; 

	}

	

function dashboard()
	{

	$this->load->helper('genfunction');
	validate_login();
	$this->load->view('includes/header');
	$this->load->view('includes/left_nav');
	$this->load->view('dashboard');
	$this->load->view('includes/footer');

	}


	function logout()
	{
	$this->session->userdata = array();
	$this->session->sess_destroy();
	redirect('home');
	}

}


/* End of file home.php */
/* Location: ./system/application/controllers/home.php */
