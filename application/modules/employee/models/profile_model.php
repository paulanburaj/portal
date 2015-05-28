<?php
 
    class profile_model extends CI_Model 
{ 

		function __construct() {
		parent::__construct();
		}

function get_profile_details(){
	$user=$this->session->userdata('user_name');
	$query=$this->db->query("SELECT * FROM employees where user_name='$user'"); 
	return $query->result_array();
}


function usertype_formation($id)
{
$query=$this->db->query("select role_name from roles where id='$id'");
foreach ($query->result() as $row)
{
   $role_name=$row->role_name;
	
}

return $role_name;
}

}
?>
