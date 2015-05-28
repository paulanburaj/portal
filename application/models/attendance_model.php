<?php

class attendance_model extends CI_Model {



function __construct(){


	// $this->output->enable_profiler(TRUE);  

	}

function get_monthly_report($current_month,$current_year)
	{


	$query=$this->db->query("SELECT sum(TIME_TO_SEC(a.in_hours)) as in_hours,e.display_name,e.user_name,e.id,a.logged_in_date,a.sign_in_time,a.sign_out_time,a.delay_time FROM attendance_log a left join employees e on a.user_name=e.user_name WHERE YEAR(a.logged_in_date) = '$current_year' AND MONTH(a.logged_in_date) ='$current_month' and e.user_type!='0' and e.status='1' group by a.user_name,a.logged_in_date order by e.id asc");


$query=$query->result_array();
 if(empty($query))
        return array();

    $res = array();
    $i   = 0; 
    while($i < count($query))
    {
        $res[$query[$i]['id']][$query[$i]['logged_in_date']] = $query[$i];
        ++$i;
    }

	return array($res);
	}


function get_users_list()
{

$query=$this->db->query("select user_name,id,fname,lname,display_name,joined_date,relieve_date from employees where user_type!='0' and status='1' order by id asc");

$query=$query->result_array();
return $query;
}




function get_leave_report($current_month,$current_year)
{

$query=$this->db->query("select DATE(start) as start,DATE(end) as end from events where YEAR(start) = '$current_year' AND MONTH(start) ='$current_month' and event_type!='others' ");

$query=$query->result_array();
$leave_date=array();
$leave_date['H']=array();
$leave_date['L']=array();
foreach($query as $bet_date){
$between_date=createDateRangeArray($bet_date['start'],$bet_date['end']);
if(empty($between_date)){
$leave_date['L'][]=$bet_date['start'];
}
else{
foreach($between_date as $date)
{
if(date('m',strtotime($date))==$current_month){
$leave_date['L'][]=$date;
}
}
}
}

$sundays= getsundays($current_month,$current_year);
foreach($sundays as $sunday)
{
$leave_date['H'][]=$sunday;
}
return $leave_date;

}

}


?>
