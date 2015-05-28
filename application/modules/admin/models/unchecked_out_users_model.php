<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class unchecked_out_users_model extends CI_Model {


public function get_unchecked_users()
			{

			$date=date('Y-m-d');

			$query=$this->db->query("select e.display_name,e.user_name,a.sign_in_time,a.logged_in_date from attendance_log a left join employees e on a.user_name=e.user_name where a.sign_out_time='0000-00-00 00:00:00' and a.logged_in_date!='$date'");
			$query=$query->result_array();
			return $query;

			}

public function update_checkedout_time($user_name,$check_in_time,$check_out_time)
		{
$date=date('Y-m-d');
$query=$this->db->query("update attendance_log set sign_out_time='$check_out_time',in_hours=TIMEDIFF(sign_out_time,sign_in_time) where user_name='$user_name' and sign_out_time='0000-00-00 00:00:00' and logged_in_date!='$date'");

		return TRUE;

		}

					    }


?>
