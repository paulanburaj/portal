<?php

class calendar extends CI_Controller {

    function __construct()
    	{
        parent::__construct();
	$this->load->model('calendar_model');
	$this->load->helper('genfunction');
	validate_login();
	}


   function index()
	{

	$this->load->view('includes/header');
	$this->load->view('includes/left_nav');
	$this->load->view('calendar_view');
	$this->load->view('includes/footer');

	}
function add_event()
	{
	
	$reason=$this->input->post('reason');
	$start=$this->input->post('start');
	$end=$this->input->post('end');
	$start=date('Y-m-d H:i:s',strtotime($start));
	$created_by=$this->session->userdata('user_name');
	$day[]=date('D',strtotime($start));


if($end!=''){
$end=date('Y-m-d H:i:s',strtotime($end));
$day[]=date('D',strtotime($end));
}


	$data = array(
   	'description' => $reason,
	'start' => $start,
	'end' => $end,
	'event_type' =>$this->input->post('event_type'),
	'createdby'=>$created_by,
	'show_to_all'=>$this->input->post('show_to_all')
	);

 	if($this->calendar_model->add_event($data))
		{

	echo "success";

		}
	else{


echo "Holiday has beeen already added on that day";


		}
	  
	
}


function fetch_event()
	{

	$start=$this->input->get('start');
	$end=$this->input->get('end');

$sundays=array();
$sunday = strtotime("sunday", $start);
while($sunday <= $end) {
    $sundays[]= date("Y-m-d H:i:s", $sunday);   
    $sunday = strtotime("+1 weeks", $sunday);
}


	$start=$this->input->get('start');
	$end=$this->input->get('end');
	$query=$this->calendar_model->fetch_event($start,$end);
	$event=$query->result_array();
foreach($event as $ev){

if($ev['event_type']=='Holiday'){

$allday=true;
$color='#378006';
}
else{
$allday=false;
$color='';
}
$editable='false';
$start=date('Y-m-d H:i:s',strtotime($ev['start']));
if($ev['end']!='0000-00-00 00:00:00'){
$end=date('Y-m-d H:i:s',strtotime($ev['end']));

}
else{
$end="0000-00-00 00:00:00";
}

if($this->session->userdata('user_name')==$ev['createdby']){
$editable='true';
}
else{
$editable='false';
$color='#ED1317';
}

if($ev['event_type']=='Holiday'){

$allday=true;
$color='#378006';
}

	$data[] = array(
				'id' => $ev['id'],
				'title' => $ev['description'],
				'type' =>$ev['event_type'],
				'start' => $start,
				'end' => $end,
				'allDay' => $allday,
				'color'=>$color,
				'createdby'=>$ev['createdby'],
				'show_to_all'=>$ev['show_to_all'],
				'editable'=>$editable
			);
}

foreach($sundays as $sun){

$data[] = array(
				'id' => '',
				'title' =>'Weekly Holiday',
				'type' =>'Holiday',
				'start' =>$sun,
				'end' => $sun,
				'allDay' => true,
				'color'=>'#378006',
				'createdby'=>'',
				'show_to_all'=>'',
				'editable'=>'false'
		);

}


	
	echo json_encode($data);

	}

function edit_event()
	{
	
	$ev_title=$this->input->post('ev_title');
	$event_type=$this->input->post('event_type');
	$event_id=$this->input->post('event_id');
	$event_show=$this->input->post('show_to_all');
	if($event_type=='Holiday'){
	$data = array(
		
	   	'description' => $ev_title,
		'start'=>$this->input->post('start'),
		'end'=>$this->input->post('end')
	);
	}
	else{
$data = array(
		
	   	'description' => $ev_title,
		'start'=>$this->input->post('start'),
		'end'=>$this->input->post('end'),
		'show_to_all'=>$event_show
	);
	}

	$this->calendar_model->edit_event($data);
	
}
function delete_event()
	{
	$event_id1=$this->input->post('event_id');
		$this->db->where('id', $event_id1);
		$this->db->delete('events'); 
	}
	
	
}

?>
