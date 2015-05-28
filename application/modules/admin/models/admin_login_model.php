<?php
 
    class admin_login_model extends CI_Model { 

		function __construct() {
		parent::__construct();
		}

	function login_check(){
 $username=$this->input->post('username');
 $password=md5($this->input->post('password'));
 $query = $this->db->query("select * from employees where user_name='$username' and password='$password' and status='1' and user_type='0' ");
 return $query;

}


	function add_employee($data)	
	{

$this->db->insert('employees',$data);

	}


	function get_employee_details($user_id)
	{
	$query=$this->db->query("select * from employees where id='$user_id'");
	$query=$query->result_array();
	return $query;

	}

function update_employee_details($user_data,$user_id)
	{

	$data=$user_data;
	$this->db->where('id',$user_id);
	$this->db->update('employees',$data);

	}


function get_all_employee_details()
{

$query=$this->db->query("select id,user_name,fname,lname,display_name,email1,mobile1,joined_date,relieve_date,user_type,status from employees where user_type!='0'"); 
$query=$query->result_array();

	return $query;
}

function get_all_employee_count()
{
$query=$this->db->query("select id from employees where user_type!='0'"); 
$query=$query->num_rows();

	return $query;


}

/*function update_all_employee_details($data,$user_id)


{

	$this->db->where('id',$user_id);
	$this->db->update('employees',$data);

}*/
function usertype_formation()
{
$query=$this->db->query("select id,role_name from roles");
$query=$query->result_array();
$options=array();
foreach($query as $a)
{
$options[$a['id']]=$a['role_name'];
}
return $options;
}
	

}


?>
