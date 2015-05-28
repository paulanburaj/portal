<?php

class home_model extends CI_Model {



function __construct(){


	// $this->output->enable_profiler(TRUE);  

	}
	
function get_users_list()
	{
	
	$current_date=date('Y-m-d', time());

	$query = $this->db->query("select e.id,e.image,e.mobile1,e.user_name,e.display_name,e.in_time,e.email1,e.fname,e.lname,a.sign_in_time,a.sign_out_time,l.total_in_hours_today,l.sign_in_time_today,l.login_count,
l.first_login_id
from employees e  left join (SELECT * from (select id,user_name,sign_in_time,sign_out_time FROM attendance_log ORDER BY id desc ) as i GROUP by i.user_name  ) AS a  on e.user_name=a.user_name 
	left join (select id as first_login_id, sum(TIME_TO_SEC(in_hours)) as total_in_hours_today,user_name,TIME_TO_SEC(sign_in_time) as sign_in_time_today,COUNT(*) as login_count from attendance_log 

where logged_in_date='$current_date' group by user_name )l on e.user_name=l.user_name where e.status='1' and e.user_type!='0'  ORDER BY l.first_login_id");
	return $query->result_array();


	}


function get_login_user_details(){
$current_date=date('Y-m-d', time());
	$query = $this->db->query("select
    id,user_name,
    GROUP_CONCAT(sign_in_time ORDER BY id SEPARATOR ', ') all_sign_in_time, GROUP_CONCAT(sign_out_time ORDER BY id SEPARATOR ', ') all_sign_out_time
from
    attendance_log where logged_in_date='$current_date' group by user_name");
	$query=$query->result_array();
 if(empty($query))
        return array();

    $res = array();
    $i   = 0; 
    while($i < count($query))
    {
        $res[$query[$i]['user_name']] = $query[$i];
        ++$i;
    }

	return array($res);


}

function login_check(){
 $username=$this->input->post('username');
 $password=md5($this->input->post('password'));
 $query = $this->db->query("select * from employees where user_name='$username' and password='$password' and status='1' and user_type!='0'");
 return $query;

}

function check_checkin(){
 $user_name=$this->input->post('user_name_session');
 $cur_date=date("Y-m-d");
 $query = $this->db->query("select logged_in_date from attendance_log where user_name='$user_name' and  logged_in_date='$cur_date'");
 return $query;

}
function get_reason(){
 $user_name=$this->input->post('username');
 $cur_date=date("Y-m-d");
 $query = $this->db->query("select reason from attendance_log where user_name='$user_name' and  logged_in_date='$cur_date'");
 return $query;

}
function delete_login(){
 $user_name=$this->input->post('username');
 $cur_date=date("Y-m-d");
 $query = $this->db->query("delete from attendance_log where user_name='$user_name' and logged_in_date='$cur_date'");
 return $query;

}
function delay_time(){
$username=$this->input->post('username');
$cur_date=date("Y-m-d");
$query = $this->db->query("select delay_time from attendance_log where user_name='$username' and logged_in_date='$cur_date' ");
 return $query;
}

function update_reason(){
$username=$this->input->post('username');
$reason=$this->input->post('reason_data');
$cur_date=date("Y-m-d");
$query = $this->db->query("UPDATE attendance_log SET reason='$reason' WHERE user_name='$username' and logged_in_date='$cur_date' ");
return $query;
} 

function update_reason_quickout(){
$username=$this->input->post('username');
$reason_quickout=$this->input->post('reason_quickout_data');
$cur_date=date("Y-m-d");
$query = $this->db->query("UPDATE attendance_log SET reason_quickout='$reason_quickout' WHERE user_name='$username' and logged_in_date='$cur_date' ");

} 


function total_intime(){
$username=$this->input->post('username');
$cur_date=date("Y-m-d");
$query = $this->db->query("SELECT a.in_time, sum(TIME_TO_SEC(b.in_hours)) as total_in_hours_today FROM employees a LEFT JOIN attendance_log b ON a.user_name = b.user_name where b.user_name='$username' and b.logged_in_date='$cur_date' ");
 return $query;

}
function check_in()
{
$username=$this->input->post('username');
$qry= $this->db->query("select in_time from employees where user_name='$username'");
$qry=$qry->result_array();

$actual_time=$qry[0]['in_time'];

$enter_time=date('Y:m:d H:i:s',time());


if(strtotime($actual_time)>strtotime($enter_time))
{
$delay='';
}
else if(strtotime($actual_time)==strtotime($enter_time))
{
$delay='';
}
else
{
$time_diff=strtotime($enter_time)-strtotime($actual_time);

$delay=gmdate("H:i", $time_diff);
}
$current_date=date('Y-m-d', time());

$data = array('user_name' => $username,
		'sign_in_time' => $enter_time,
		'delay_time' => $delay,
		'logged_in_date'=> $current_date,
		);

$query = $this->db->insert('attendance_log', $data);
return TRUE;

}


	function check_out()
{
$username=$this->input->post('username');
$current_time=date('Y-m-d H:i:s', time());
$query = $this->db->query("update attendance_log set sign_out_time='$current_time' , in_hours=TIMEDIFF(sign_out_time,sign_in_time) where user_name='$username' order by id desc limit 1");

return FALSE;

}





}
?>
