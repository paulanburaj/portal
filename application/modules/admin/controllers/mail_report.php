<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mail_report extends CI_Controller {


public function __Construct()
	{
		parent::__Construct();
		$this->load->helper('genfunction');
		$this->load->model('admin/mail_report_model');

	}

	

public function mail_report_full(){

$this->mail_report_model->users_report();
}
	

}


?>
