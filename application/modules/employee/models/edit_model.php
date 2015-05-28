<?php
 
    class edit_model extends CI_Model { 

		function __construct() {
		parent::__construct();
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

function update_password_details($user_data,$user_id)
	{

	$data=$user_data;
	$this->db->where('id',$user_id);
	$this->db->update('employees',$data);


	}

function select_old_password($old_password,$user_id){


$query=$this->db->query("select * from employees where id='$user_id' and password='$old_password'");

if ($query->num_rows() == '1') {
        return true;
     }
     return false;
}


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
