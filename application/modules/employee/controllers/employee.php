<?php
class Employee extends CI_Controller
{
	function __construct()
	{
		parent:: __construct();
		$this->load->helper('genfunction');
		
		$this->load->helper(array('form', 'html', 'file' ,'url'));
		
	}
function index(){
$this->load->model('employee/edit_model');

}	

function edit_employee($user_id)
	{	

//$user_id=$this->input->post('id');
				$this->load->model('edit_model');
		$data['data']=$this->edit_model->get_employee_details($user_id);

		$this->load->view('includes/header');
		$this->load->view('includes/left_nav');
		$this->load->view('employee/edit_employee',$data);
		$this->load->view('includes/footer');
	}

function update()
	{
$this->load->model('edit_model');
$this->load->library('form_validation');
		// field name, error message, validation rules
		$this->form_validation->set_rules('title', 'Title', 'trim');
		$this->form_validation->set_rules('fname', 'First Name', 'trim|required' );
		$this->form_validation->set_rules('lname', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('display_name', 'Display Name', 'trim' );
		
		$this->form_validation->set_rules('email1', 'Email', 'trim|valid_email');
		$this->form_validation->set_rules('email2', 'Other Email', 'trim|valid_email');
		
		
		$this->form_validation->set_rules('mobile1', 'Mobile', 'trim' );
		$this->form_validation->set_rules('mobile2', 'Other Mobile', 'trim' );
		$this->form_validation->set_rules('dob', 'Date of birth', 'trim' );
		$this->form_validation->set_rules('temp_address', 'Temporary Address', 'trim' );
		$this->form_validation->set_rules('perm_address', 'Permanent Address', 'trim' );
		$this->form_validation->set_rules('remarks', 'Remarks', 'trim' );
		$this->form_validation->set_rules('edu_details', 'Education Details', 'trim' );
		$this->form_validation->set_rules('experience', 'Experience', 'trim' );
		$this->form_validation->set_rules('skill_set', 'Skill Set', 'trim' );
		$this->form_validation->set_error_delimiters('<p class="error" style="color:red;">','</p>')  ;
	

		if($this->form_validation->run($this) == FALSE)
		{


		$user_id=$this->input->post('id');
		$data['data']=$this->edit_model->get_employee_details($user_id);

		$this->load->view('includes/header');
		$this->load->view('includes/left_nav');
		$this->load->view('employee/edit_employee',$data);
		$this->load->view('includes/footer');
		}

		else{



$current_date=date('Y-m-d',time());	

if($_FILES['image']['tmp_name']!=''){

$config['upload_path'] = APPPATH.'../assets/uploads';
$config['allowed_types'] = 'jpg|jpeg|png';
$path_info = pathinfo($_FILES["image"]["name"]);
$fileExtension = $path_info['extension'];
$modifiedFileName = time().'.'.$fileExtension ;   
$config['file_name'] = $modifiedFileName;
  
$this->load->library('upload', $config);

$this->upload->do_upload('image');

$config['image_library'] = 'gd2';
$config['new_image'] = APPPATH.'../assets/uploads/thumb/'.$modifiedFileName;
$config['source_image'] =$_FILES['image']['tmp_name'];
$config['create_thumb'] = TRUE;
$config['thumb_marker']='';
$config['maintain_ratio'] = TRUE;
$config['width'] = 100;
$config['height'] = 100;

$this->load->library('image_lib', $config);

$this->image_lib->resize();
		
$image=$modifiedFileName;

}
else{
$image=$this->input->post('hide_image');


}
if($this->input->post('joined_date')=='' || $this->input->post('joined_date')=='0000-00-00'){
$joined_date='';
}
else{
$joined_date=date('Y-m-d',strtotime($this->input->post('joined_date')));
}
if($this->input->post('relieve_date')=='' || $this->input->post('relieve_date')=='0000-00-00'){
$relieve_date='';
}
else{
$relieve_date=date('Y-m-d',strtotime($this->input->post('relieve-date')));
}
$res_time=date('H:i:s',strtotime($this->input->post('intime')));
	$emp_data= array(

'title'=>$this->input->post('title'),
'fname'=>$this->input->post('fname'),
'lname'=>$this->input->post('lname'),	
'display_name'=>$this->input->post('display_name'),

'email1'=>$this->input->post('email1'),
'email2'=>$this->input->post('email2'),
'mobile1'=>$this->input->post('mobile1'),
'mobile2'=>$this->input->post('mobile2'),
'image'=>$image,
'temp_address'=>$this->input->post('temp_address'),
'perm_address'=>$this->input->post('perm_address'),

'dob'=>$this->input->post('dob'),

'edu_details'=>$this->input->post('edu_details'),
'experience'=>$this->input->post('experience'),
'skill_set'=>$this->input->post('skill_set'),
'remarks'=>$this->input->post('remarks'),

'modifieddate'=>$current_date
);


$user_id=$this->input->post('id');
$this->edit_model->update_employee_details($emp_data,$user_id);
$this->session->set_flashdata('msg', 'You need to activate your account please check your email');
redirect('employee/profile');
		
		

	
		}

	}


function change_password($user_id){

		$this->load->model('edit_model');
		$data['data']=$this->edit_model->get_employee_details($user_id);
		$this->load->view('includes/header');
		$this->load->view('includes/left_nav');
		$this->load->view('employee/change_password',$data);
		$this->load->view('includes/footer');
}



function update_password($user_id)
	{

$this->load->model('edit_model');

		$old_password=md5($this->input->post('old'));

		$da=$this->edit_model->select_old_password($old_password,$user_id);
		
		if($da=='1'){
		
	$emp_data= array(
		
		'password'=>md5($this->input->post('pass'))
	);

$this->edit_model->update_password_details($emp_data,$user_id);

redirect('employee/profile');
}
else{

echo '0';
}
		
		
	
		

	}

	
}
?>
