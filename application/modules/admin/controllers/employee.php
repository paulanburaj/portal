<?php
class employee extends CI_Controller
{
	function __construct()
	{
		parent:: __construct();
		$this->load->helper('genfunction');
		admin_login();
		$this->load->helper(array('form', 'html', 'file' ,'url'));
		$this->load->model('admin/admin_login_model');
	}
	function index()
	{	
		$this->load->view('includes/header');
		$this->load->view('includes/left_nav');
		$this->load->view('admin/add_user');
		$this->load->view('includes/footer');
	}


	function add()
	{

$this->load->library('form_validation');
		// field name, error message, validation rules
		$this->form_validation->set_rules('title', 'Title', 'trim');
		$this->form_validation->set_rules('fname', 'First Name', 'trim|required' );
		$this->form_validation->set_rules('lname', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('display_name', 'Display Name', 'trim|required' );
		$this->form_validation->set_rules('user_type', 'User Role', 'trim|required|select_validate');
		$this->form_validation->set_rules('email1', 'Email', 'trim|valid_email');
		$this->form_validation->set_rules('email2', 'Other Email', 'trim|valid_email');
		$this->form_validation->set_rules('user_name', 'User Name', 'trim|required|is_unique[employees.user_name]' );
		$this->form_validation->set_rules('status', 'Status', 'trim|required' );
		$this->form_validation->set_rules('joined_date', 'Join date', 'trim|required' );
		$this->form_validation->set_rules('relieve_date', 'Releive date', 'trim' );
		$this->form_validation->set_rules('mobile1', 'Mobile', 'trim' );
		$this->form_validation->set_rules('mobile2', 'Other Mobile', 'trim' );
		$this->form_validation->set_rules('dob', 'Date of birth', 'trim' );
		$this->form_validation->set_rules('intime','In Time', 'trim|required' );
		$this->form_validation->set_rules('temp_address', 'Temporary Address', 'trim' );
		$this->form_validation->set_rules('perm_address', 'Permanent Address', 'trim' );
		$this->form_validation->set_rules('remarks', 'Remarks', 'trim' );
		$this->form_validation->set_rules('edu_details', 'Education Details', 'trim' );
		$this->form_validation->set_rules('experience', 'Experience', 'trim' );
		$this->form_validation->set_rules('skill_set', 'Skill Set', 'trim' );
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required|matches[password]');
		$this->form_validation->set_error_delimiters('<p class="error" style="color:red;">','</p>')  ;
	

		if($this->form_validation->run($this) == FALSE)
		{

		$this->load->view('includes/header');
		$this->load->view('includes/left_nav');
		$this->load->view('admin/add_user');
		$this->load->view('includes/footer');

		}
		
		else
		{	
$current_date=date('Y-m-d',time());	

if($this->input->post('joined_date') == '' || $this->input->post('joined_date') == '0000-00-00'){
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
$image='default.jpg';
}

$res_time=date('H:i:s',strtotime($this->input->post('intime')));


	$emp_data= array(

'title'=>$this->input->post('title'),
'fname'=>$this->input->post('fname'),
'lname'=>$this->input->post('lname'),	
'display_name'=>$this->input->post('display_name'),
'user_type'=>$this->input->post('user_type'),
'email1'=>$this->input->post('email1'),
'email2'=>$this->input->post('email2'),
'mobile1'=>$this->input->post('mobile1'),
'mobile2'=>$this->input->post('mobile2'),
'image'=>$image,
'temp_address'=>$this->input->post('temp_address'),
'perm_address'=>$this->input->post('perm_address'),
'joined_date'=>$joined_date,
'relieve_date'=>$relieve_date,
'dob'=>$this->input->post('dob'),
'in_time'=>$res_time,
'edu_details'=>$this->input->post('edu_details'),
'experience'=>$this->input->post('experience'),
'skill_set'=>$this->input->post('skill_set'),
'remarks'=>$this->input->post('remarks'),
'status'=>$this->input->post('status'),
'user_name'=>$this->input->post('user_name'),
'password'=>md5($this->input->post('password')),
'createddate'=>$current_date
);


$this->admin_login_model->add_employee($emp_data);
$this->session->set_flashdata('msg', 'You need to activate your account please check your email');
redirect('admin/employee/view_employee');

	
		}


	}

function edit_employee($user_id)
	{	

		$data['data']=$this->admin_login_model->get_employee_details($user_id);

		$this->load->view('includes/header');
		$this->load->view('includes/left_nav');
		$this->load->view('admin/edit_employee',$data);
		$this->load->view('includes/footer');
	}

function update()
	{

$this->load->library('form_validation');
		// field name, error message, validation rules
		$this->form_validation->set_rules('title', 'Title', 'trim');
		$this->form_validation->set_rules('fname', 'First Name', 'trim|required' );
		$this->form_validation->set_rules('lname', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('display_name', 'Display Name', 'trim' );
		$this->form_validation->set_rules('user_type', 'User Role', 'trim|required|select_validate');
		$this->form_validation->set_rules('email1', 'Email', 'trim|valid_email');
		$this->form_validation->set_rules('email2', 'Other Email', 'trim|valid_email');
		$this->form_validation->set_rules('status', 'Status', 'trim|required' );
		$this->form_validation->set_rules('joined_date', 'Join date', 'trim|required' );
		$this->form_validation->set_rules('relieve_date', 'Releive date', 'trim' );
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
		$data['data']=$this->admin_login_model->get_employee_details($user_id);

		$this->load->view('includes/header');
		$this->load->view('includes/left_nav');
		$this->load->view('admin/edit_employee',$data);
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
'user_type'=>$this->input->post('user_type'),
'email1'=>$this->input->post('email1'),
'email2'=>$this->input->post('email2'),
'mobile1'=>$this->input->post('mobile1'),
'mobile2'=>$this->input->post('mobile2'),
'image'=>$image,
'temp_address'=>$this->input->post('temp_address'),
'perm_address'=>$this->input->post('perm_address'),
'joined_date'=>$joined_date,
'relieve_date'=>$relieve_date,
'dob'=>$this->input->post('dob'),
'in_time'=>$res_time,
'edu_details'=>$this->input->post('edu_details'),
'experience'=>$this->input->post('experience'),
'skill_set'=>$this->input->post('skill_set'),
'remarks'=>$this->input->post('remarks'),
'status'=>$this->input->post('status'),
'modifieddate'=>$current_date
);


$user_id=$this->input->post('id');
$this->admin_login_model->update_employee_details($emp_data,$user_id);
$this->session->set_flashdata('msg', 'You need to activate your account please check your email');
redirect('admin/employee/view_employee');
		
		

	
		}

	}

function view_employee()

	{

		$this->load->view('includes/header');
		$this->load->view('includes/left_nav');
		$this->load->view('admin/view_employee');
		$this->load->view('includes/footer');


	}

function get_employee_details()
{



$page = $_GET['page']; 
$limit = $_GET['rows']; 
$sidx = $_GET['sidx']; 
$sord = $_GET['sord']; 

if(!$sidx) $sidx =1; 

$count=$this->admin_login_model->get_all_employee_count();


if( $count > 0 && $limit > 0) { 
$total_pages = ceil($count/$limit); 
} else { 
$total_pages = 0; 
} 
$responce=new stdClass();
$responce->records=$count;
$responce->page=$page;
$responce->total=$total_pages;


if ($page > $total_pages) $page=$total_pages;
$start = $limit*$page - $limit;
if($start <0) $start = 0; 

$SQL=$this->db->query("SELECT e.user_name,e.id,e.fname,e.lname,e.display_name,e.email1,e.mobile1,e.joined_date,e.relieve_date,r.role_name as user_type,e.status FROM employees e left join roles r on e.user_type=r.id where e.user_type!=0 ORDER BY $sidx $sord LIMIT $start , $limit"); 
$result =$SQL->result_array();

$i=0;
foreach($result as $row) {

if($row['status']=='1')
{
$status='Active';
}
else
{
$status='Inactive';
}

$responce->rows[$i]['id']=$row['id'];
$edit_url="<a href='".base_url()."index.php/admin/employee/edit_employee/".$row['id']."'><i class='icon-edit' value='Edit' title='edit'  </i></a>";
$responce->rows[$i]['cell']=array($edit_url,$row['user_name'],$row['fname'],$row['lname'],$row['display_name'],$row['email1'],$row['mobile1'],$row['joined_date'],$row['relieve_date'],$row['user_type'],$status);
$i++;
}
echo json_encode($responce);


}


function get_full_employee_details($id){


$SQL=$this->db->query("SELECT * FROM employees where id=$id"); 
$result =$SQL->result_array();

$i=0;
foreach($result as $row) {
$responce->rows[$i]['id']=$row['id'];
$name_details='<div class="box span12">';
$name_details.='<div class="box-content"><div class="span4"> User Name :</div><div class="span8">'.$row['user_name'].'</div></div>';
$name_details.='<div class="box-content"><div class="span4"> First Name :</div><div class="span8">'.$row['fname'].'</div></div>';
$name_details.='<div class="box-content"><div class="span4"> Last Name :</div><div class="span8">'.$row['lname'].'</div></div>';
$name_details.='<div class="box-content"><div class="span4"> Display Name :</div><div class="span8">'.$row['display_name'].'</div></div>';

$name_details.='</div>';


$address_details='<div class="box span12">';
$address_details.='<div class="box-content"><div class="span4"> Email :</div><div class="span8">'.$row['email1'].'</div></div>';
$address_details.='<div class="box-content"><div class="span4"> Email2 :</div><div class="span8">'.$row['email2'].'</div></div>';
$address_details.='<div class="box-content"><div class="span4">Mobile :</div><div class="span8">'.$row['mobile1'].'</div></div>';
$address_details.='<div class="box-content"><div class="span4">Mobile2 :</div><div class="span8">'.$row['mobile2'].'</div></div>';
$address_details.='<div class="box-content"><div class="span4"> Temporary Address  :</div><div class="span4">'.$row['temp_address'].'</div></div>';
$address_details.='<div class="box-content"><div class="span8"> Permanant Address :</div><div class="span4">'.$row['perm_address'].'</div></div>';
$address_details.='</div>';

$skill_details='<div class="box span12">';
$skill_details.='<div class="box-content"><div class="span4"> Education Detail :</div><div class="span8">'.$row['edu_details'].'</div></div>';
$skill_details.='<div class="box-content"><div class="span4"> Skill set :</div><div class="span8">'.$row['skill_set'].'</div></div>';
$skill_details.='<div class="box-content"><div class="span4">Experience :</div><div class="span8">'.$row['experience'].'</div></div>';
$skill_details.='<div class="box-content"><div class="span4">Remarks :</div><div class="span8">'.$row['remarks'].'</div></div>';
$skill_details.='</div>';


$responce->rows[$i]['cell']=array($name_details,$address_details,$skill_details);
$i++;
}
echo json_encode($responce);


}

	
}
?>
