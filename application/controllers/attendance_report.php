<?php

class Attendance_report extends CI_Controller {

    function __construct()
    {
        parent::__construct();
	$this->load->model('attendance_model');
	$this->load->helper('genfunction');
	}


 function index(){
$current_month=date('m',time());
$current_year=date('Y',time());
$data['sel_month']=$current_month.'/'.$current_year;
$data['days_count']=days_in_month($current_month,$current_year);

$data['all_leave_report']=$this->attendance_model->get_leave_report($current_month,$current_year);
$data['all_report']=$this->attendance_model->get_monthly_report($current_month,$current_year);
$data['all_user_list']=$this->attendance_model->get_users_list();

$this->load->view('includes/header');
$this->load->view('includes/left_nav');
$this->load->view('attendance_report_view',$data);
$this->load->view('includes/footer');


	}

function selected_month(){
$sel_month=$this->input->post('sel_month');

$sel_month=explode('/',$sel_month);
$current_month=$sel_month[0];
$current_year=$sel_month[1];
$data['sel_month']=$current_month.'/'.$current_year;
$data['days_count']=days_in_month($current_month,$current_year);
$data['all_leave_report']=$this->attendance_model->get_leave_report($current_month,$current_year);
$data['all_report']=$this->attendance_model->get_monthly_report($current_month,$current_year);
$data['all_user_list']=$this->attendance_model->get_users_list();

$this->load->view('includes/header');
$this->load->view('includes/left_nav');
$this->load->view('attendance_report_view',$data);
$this->load->view('includes/footer');


}


}

?>
