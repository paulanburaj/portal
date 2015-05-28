<?php
 
    class role_model extends CI_Model { 

		function __construct() {
		parent::__construct();
		}



function get_all_role_count()
{
$query=$this->db->query("select id from roles"); 
$query=$query->num_rows();

	return $query;


}

function update_role_details($role_data,$role_id){

	$data=$role_data;
	$this->db->where('id',$role_id);
	$this->db->update('roles',$data);

}


function delete_role_details($id){
$sql="delete from roles where FIND_IN_SET(id,?)";

$this->db->query($sql,array($id));


}

function add_role_details($role_data){

$this->db->insert('roles',$role_data);

}
}


?>
