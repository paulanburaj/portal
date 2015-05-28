<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mail_report_model extends CI_Model {


function users_report(){


$date=date('Y/m/d');
$query="SELECT * From employees a LEFT JOIN (select * from attendance_log where logged_in_date='$date' group by user_name) b on a.user_name=b.user_name where user_type!=0 and status!=0 group by a.user_name";
$result=$this->db->query($query)->result_array();

$query2="select e.display_name,e.user_name,a.sign_in_time,a.logged_in_date from attendance_log a left join employees e on a.user_name=e.user_name where a.sign_out_time='0000-00-00 00:00:00' and a.logged_in_date!='$date'";
$result2=$this->db->query($query2)->result_array();

$a=array();

$signed_in_users_arr = array();
$late_users_arr = array();
$not_signed_in_users_arr = array();
$email_id=array();


$uncheck_out_users_arr = array();

$late='';
$signed_in='';
$uncheck='';
$mail_content='';

$mail_content.='Hi<div style="line-height:20px;margin-left:100px;"><h3>Not signed In:</h3></br>';
foreach($result as $a){
	
	if ($a['logged_in_date'] == '') {
		
			
			$not_signed_in_users_arr[] =$a;
			$not_signed=$a['display_name'];
		
			$mail_content .=$not_signed.'<br>';
		
	

	}
	
	//send_mail_with_smtp($email, $subject, $msg);
}

$mail_content.='<h3>Signed In:</h3>';
foreach($result as $a){
        if($a['logged_in_date'] && !$a['delay_time']){
			$sign_in_time=date('h:ia',strtotime($a['sign_in_time']));
			$in_time=date('h:ia',strtotime($a['in_time']));
			$signed_in_users_arr[] =$a;
			$signed_in=$a['display_name'].' -- '.$a['user_name'].' ('.$in_time.') '.' -- '.$sign_in_time;
			$mail_content .='<br>'.$signed_in;
	}
}

 $mail_content.='<h3>Late Attenance:</h3>';

foreach($result as $a){
	if ($a['delay_time'] && $a['delay_time']!=''){
			$sign_in_time=date('h:ia',strtotime($a['sign_in_time']));
			$in_time=date('h:ia',strtotime($a['in_time']));
			$late_users_arr[]=$a;
			$late=$a['display_name'].' -- '.$a['user_name'].' ('.$in_time.') '.' -- '.$sign_in_time.' -- '.$a['delay_time'].'hrs';
			$mail_content .='<br>'.$late;
		
	}
}

$mail_content.='<h3>Not checked out Users:</h3>';

foreach($result2 as $a){
	
		
			$uncheck_out_users_arr[]=$a;
			$uncheck=$a['display_name'].' -- '.$a['user_name'];
			$mail_content .='<br>'.$uncheck;
		
	
}

$email='';
foreach($result as $a){
	
	if (($a['logged_in_date'] == '') || ($a['delay_time'])) {
		$email_id[] =$a;
		$emails[]=$a['email1'];
		
	
		

	}


	
}
array_push($emails,"anand@grinfotech.com");
$email = implode(",", $emails);

//$email=substr($comma_separated,1);
//echo $email;
$subject="Portal Report";

$msg=$mail_content;

//echo $msg;
send_mail_with_smtp($email, $subject, $msg);
}






   }
function send_mail_with_smtp($email, $subject, $msg)
{

	require 'assets/phpmailer/class.phpmailer.php';
	require 'assets/phpmailer/class.smtp.php';

	$mail = new PHPMailer(); 
	$mail->IsSMTP(); 

	try{
		
	    $mail->SMTPDebug  = 1;                     
	    $mail->SMTPAuth   = true;                  
	    $mail->SMTPSecure = "ssl" ;
	    $mail->From	      ="projects@grinfotech.com";
	    $mail->Timeout    = 60;          
	    $mail->Host       = "smtp.gmail.com";      
	    $mail->Port       = 465;                  
	    $mail->Username   = 'projects@grinfotech.com';
	    $mail->Password   = 'Bgt56yhN@';   
	          
	    $mail->AddAddress('hr@grinfotech.com');//RECIPIENT
	     $addresses = explode(',', $email);
			foreach ($addresses as $address) {
    			$mail->AddCC($address);
		} 
	    $mail->SetFrom('projects@grinfotech.com', 'Portal Team');//IDK WHAT 'THIS' IS FOR
	    $mail->AddReplyTo("projects@grinfotech.com", "Portal Email");//FOR THE 'REPLY-TO' FIELD
	   
	    $mail->Subject = $subject;
	    $mail->MsgHTML($msg);

	   $mail->Send();

  	    echo "Mail Send Successfully!";

	} catch (phpmailerException $e) {

	    echo $e->errorMessage(); //Pretty error messages from PHPMailer
	    echo $mail->Host;

	} catch (Exception $e) {
	    echo $e->getMessage(); //Boring error messages from anything else!
	}


}


?>
