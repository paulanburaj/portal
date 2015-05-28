<?php
 
    class calendar_model extends CI_Model { 

		function __construct() {
		parent::__construct();
		}


		function add_event($data)
		{	
$start=$data['start'];
if($this->input->post('event_type')=='Holiday'){
$query=$this->db->query("select * from events where DATE(start) ='$start'  and event_type='Holiday'");
$query=$query->num_rows();
if($query>0)
{

return FALSE;		

}
else{

$this->db->insert('events', $data);
return TRUE;

}

}

else{
$this->db->insert('events', $data);
return TRUE;

}


		}
		function fetch_event($start,$end)
		{
		$start=date('Y-m-d',$start);
	
		$end=date('Y-m-d',$end);

		$user_name=$this->session->userdata('user_name');
		
		$query=$this->db->query("select * from events where DATE(start) >='$start' and DATE(start) <='$end' and (createdby='$user_name' or show_to_all='1') ");

		return $query;
		}

		function edit_event($data)
		{	
		$event_id=$this->input->post('event_id');
		$this->db->where('id', $event_id);
		$this->db->update('events', $data); 
}

	
		
		

}


?>
