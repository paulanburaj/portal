<title>
	<?php echo SITE_NAME; ?>
</title>
<?php if($this->session->userdata('is_logged_in')) { ?>
	<div id="content" class="span10">
<?php } else { ?>
	<div id="content" class="span12">
<?php } ?>

<!-- content starts -->
<div class="row-fluid sortable">
<?php if($this->session->userdata('is_logged_in')){ ?>
	<div class="box span12" >
<?php } else { ?>
	<div class="box span12" style="margin-left:70px;">
<?php } ?>

<div class="box-header well" data-original-title>
	<h2><i class="icon-calendar"></i> Attendance </h2>
</div>
<div class="box-content">
	<div class="box span6">
		<div class="box-header well" data-original-title>
		<h2><i class="icon-th"></i>   Checked Out Users  </h2>
		</div>
	<div class="box-content">
	<div class="row-fluid" id="user_out">
		<ul id="sortable1" class="connectedSortable">
<?php
foreach($employees as $emp){

	$initial_signin_time='';
	$final_sign_out_time='';
	if($emp['total_in_hours_today']==0){
		$in_hours='00:00:00';
	}
	else{
		$in_hours=gmdate('H:i',$emp['total_in_hours_today']);
	}

	if($this->session->userdata('is_logged_in')){
		if($emp['user_name']==$this->session->userdata('user_name')){
			$class='';
		}
		else {
			$class='ui-state-disabled';
		}
	}
	else {
		$class='';
	}
	if(($emp['sign_out_time']==NULL || $emp['sign_out_time']!='0000-00-00 00:00:00') && $emp['logged_point']==0){
		$title='';
		foreach($attendance as $att) {
			if(isset($att[$emp['user_name']])) {
				$all_sign_in_time=explode(',',$att[$emp['user_name']]['all_sign_in_time']);
				$all_sign_out_time=explode(',',$att[$emp['user_name']]['all_sign_out_time']);

				for($i=0;$i<count($all_sign_in_time);$i++){
					$title.='sign in time : '.$all_sign_in_time[$i].'     sign out time : '.$all_sign_out_time[$i].'&#13;';
					$initial_signin_time=$all_sign_in_time[0];
					$final_sign_out_time=$all_sign_out_time[$i];
				}
			}
		}
	if(($initial_signin_time!='' && $final_sign_out_time!='')){
		$initial_signin_time=date('h:ia',strtotime($initial_signin_time));
		$final_sign_out_time=date('h:ia',strtotime($final_sign_out_time));
		$in_hours_details=$initial_signin_time.'-'.$final_sign_out_time;
		}
		else
		{
		$in_hours_details='';
		}
		//$total_hrs=$final_sign_out_time_time-$initial_signin_time_time;
		//$a123=abs(strtotime($final_sign_out_time) - strtotime($initial_signin_time))/(60*60);
		echo '
		<li class="ui-state-default '.$class.'"  username='.$emp['user_name'].' title="'.$title.'">
		<img class="photoimg" src="'.base_url().'assets/uploads/thumb/'.$emp['image'].'" style="float:left;">
		<div class="user-info">
		<span>
		'.$emp['display_name'].'
		</span>
		<br>
		<span>
		'.$emp['mobile1'].'
		</span>
		<br>
		<span>
		In Time : '.$in_hours_details.'
		</span>
		<br>
		<span>
		In hours:  '.$in_hours.'
		</span>
		</div>
		</li>
		';
	}

} /* foreach($employees as $emp) */
?>
			</ul>
		</div>           
	</div>
</div><!--/span-->

<div class="box span6" id="stickynav">
	<div class="box-header well" data-original-title>
		<h2><i class="icon-th"></i>   Checked In Users  </h2>
	</div>
<div class="box-content">
	<div class="row-fluid" id="user_in">
	<ul id="sortable2" class="connectedSortable">
<?php
$current_date=date('Y-m-d',time());
foreach($employees as $emp) {
	$checked_in_time='';
	$sign_in_time=date('Y-m-d H:i:s',strtotime($emp['sign_in_time']));
	if($emp['total_in_hours_today']==0 ) {
		$current_time =time()- strtotime($current_date);
		$current_time=$current_time -$emp['sign_in_time_today'];

		$in_hours=gmdate('H:i:s',$current_time);

	}
	else if($emp['login_count']>1) {
		$current_time =time()- strtotime($emp['sign_in_time']);
		$current_time=$current_time+$emp['total_in_hours_today'];
		$in_hours=gmdate('H:i:s',$current_time);
	}
	else {
		$in_hours=gmdate('H:i:s',$emp['total_in_hours_today']);
	}

	$last_check_in_date=date('Y-m-d',strtotime($emp['sign_in_time']));
	if($this->session->userdata('is_logged_in')) {
		if($emp['user_name']==$this->session->userdata('user_name') && $last_check_in_date==$current_date) {
			$class='';
			$text='';
		}
		else {
		$text="";
		$class='ui-state-disabled';
		
		}
	}
	else {
		$class='';
		$text='';
	}

	

	if($emp['sign_out_time']=='0000-00-00 00:00:00' || $emp['logged_point']==1){
		$title='';
		foreach($attendance as $att){
			if(isset($att[$emp['user_name']])){
				$all_sign_in_time=explode(',',$att[$emp['user_name']]['all_sign_in_time']);
				$all_sign_out_time=explode(',',$att[$emp['user_name']]['all_sign_out_time']);
				for($i=0;$i<count($all_sign_in_time);$i++){
					$title.='sign in time : '.$all_sign_in_time[$i].'     sign out time : '.$all_sign_out_time[$i].'&#13;';
					$checked_in_time=$all_sign_in_time[0];
					
				}
			}
		}

if($checked_in_time!=''){
		$checked_in_time_time=date('h:ia',strtotime($checked_in_time));
			}
		    else{
			
		$checked_in_time_time='';

			}
$in_time=$emp['in_time'];

$checked_in_time_time_time=date('H:i:s',strtotime($checked_in_time_time));

$a=strtotime($in_time);

$b=strtotime($checked_in_time_time_time);
$diff=$b-$a;
$diff_1=$a-$b;
if($b>$a){
	$delay_time=gmdate("H:i", $diff);
	$message='<span style="color:red;">Delay: '.gmdate("H:i", $diff).' hrs ';
}
else if($b<$a){
	$message='<span style="color:#50a8dc;">Before: '.gmdate("H:i", $diff_1).' hrs';
}
else{
	$message='<span style="color:green;">On Time: '.gmdate("H:i", $diff_1).' hrs';
	}

if($last_check_in_date!=$current_date){
		$class='ui-state-disabled';
		
		$text="<br><span style='color:red;'>contact your admin to unlock</span>";
		$in_hours="00:00:00";
		$checked_in_time_time="00:00";
		$message='';
	}
		echo '<li class="ui-state-default '.$class.'"  username='.$emp['user_name'].' title="'.$title.'">
		<img class="photoimg" src="'.base_url().'assets/uploads/thumb/'.$emp['image'].'" style="float:left;">
		<div class="user-info">
		<span>
		'.$emp['display_name'].'
		</span><br>
		<span>
		'.$emp['mobile1'].'
		</span>
		<br>
		<span>
		In hours :  '.$in_hours.'
		</span>
		<br>
		<span>
		In Time :   '.$checked_in_time_time.'
		</span>
		
		'.$text.'
		
		<br>
		
		'.$message.'
		</span>
		</div>

		</li>
		';
		$total_users[]=$emp['user_name'];
		$total_user_string=implode(',',$total_users);

	}
}
?>
			</ul>
		</div>                             
	</div>
</div><!--/span-->

</div>
</div>			</div><!--/row-->

</div>                             
</div>
</div><!--/span-->

<input type="hidden" value="<?php echo $this->session->userdata('is_logged_in');?>" id="is_login">
<style>
#sortable1, #sortable2 {
border: 1px solid #eee;
width: 100%;
min-height: 20px;
list-style-type: none;
margin: 0;
padding: 5px 0 0 0;
float: left;
margin-right: 10px;
}
#sortable1 li, #sortable2 li {
margin: 0 5px 5px 5px;
padding: 5px;
font-size: 1.2em;
width:95%;
}
#sticky{
position:fixed;
left:50%;
width:46%!important;
}
.fixed {
  position:fixed;
  top:0;
  left:56.5%;
  width:38%!important;
  z-index:99999;
}
.label-pink, .badge-pink {
background-color: #D6487E !important;
}
.cen{
padding-left:30%;
}
.photoimg{
border-radius: 100% 100% 100% 100%;
border: 1px solid rgb(204, 204, 204);
width: 50px;
height: 80%;

box-shadow: 1px 1px 1px rgba(0, 0, 0, 0.15);
}
.ui-state-default{
height:90px;
}
.user-info{
float:left;
margin-left:20px;
}

</style>
</script>
<script>
$(function() {


//disable and enable user part end

var base_url="<?php echo base_url();?>";
var start_with='';
var end_with='';
var username;
$( "#sortable1, #sortable2" ).sortable({

	connectWith: ".connectedSortable",
	opacity: 0.7,
	cursor: 'move' ,
	start: function (event, ui) {

		ui.item.toggleClass("highlight");
		start_with=ui.item.parent().parent().attr('id');
	}
	,
	stop: function (event, ui) {
	ui.item.toggleClass("highlight");
	end_with=ui.item.parent().parent().attr('id');
	time_update(ui);

	},


});




$( "#sortable1,#sortable2" ).sortable({
	cancel: ".ui-state-disabled"
});

// function time_update start
function time_update(ui)
{
	if(start_with==end_with){
		return false;
	}
	else if(start_with=='user_in')
	{
		check_out(ui);
	}
	else if(start_with=='user_out')
	{
		check_in(ui);

	}
}  // function time_update end


function check_in(ui)
{
	var li='<li class="'+ui.item.attr("class")+'" username="'+ui.item.attr("username")+'" >'+ui.item.html()+'</li>';
	 username=ui.item.attr("username");


	//checking login is true or not start

	if($('#is_login').val()!=1 ){


	//ajax befoer reason model box



		$.ajax({

		url:base_url+'index.php/home/reason_box/',
		type:'POST',
		data:{
		username:username}
		,
		success:function(result){
			$('#password').val('');
			if(result=='reason'){
				$('.modal-footer .reason_login').hide();
				$('.modal-footer .reason_send').show();
				$('.modal-footer .reason_close').hide();
				$('#reason_content').show();
				$('#password').hide();
				$('#login').modal('show');
				$('#exampleModalLabel').html('You are delay today!');
				$('#label_reason').html('Enter your reason please');

			}
			else if(result!='success' && result!='reason'){
				$('#password').val('');
				alert(result);

			}

		}

		});






	$('#login').modal('show');

	$('.login-me').off("click");

	$('.close-me,.close').off("click");

	$('.login-me').on( "click", function(e) {

		var password=$('#password').val();
		if(password!=''){
			$.ajax({

			url:base_url+'index.php/home/check_in_with_login',
			type:'POST',
			data:{
			username:username,password:password }
			,
			success:function(result){
				$('#password').val('');
				if(result=='success'){
					$('#login').modal('hide');
					location.reload(true);
				}
				else if(result=='reason'){
					location.reload(true);

				}
				else{
					$('#password').val('');
					alert(result);

				}

			}

			});
		}

	});






	$('.close-me,.close').on( "click", function(e) {


		$("#sortable2").find("li[username='" + username + "']").remove();
		$("#sortable2").sortable('refresh');
		$("#sortable1").append(li);
		$("#sortable1").sortable('refresh');

	});

	}
	else
	{

		$.ajax({

		url:base_url+'index.php/home/check_in',
		type:'POST',
		data:{
		username:username
		},
		success:function(result){
			$('#password').val('');
			if(result=='success'){
				$('#login').modal('hide');
				location.reload(true);
			}
			else if(result=='reason'){
				$('.modal-footer .reason_login').hide();
				$('.modal-footer .reason_send').show();
				$('.modal-footer .reason_close').hide();
				$('#reason_content').show();
				$('#password').hide();
				$('#login').modal('show');
				$('#exampleModalLabel').html('You are delay today!');
				$('#label_reason').html('Enter your reason please');

			}
			else{
				$('#password').val('');
				alert(result);

			}

		}

		});


	}
	//checking login is true or not end

}


 
function check_out(ui){
	var li='<li class="'+ui.item.attr("class")+'" username="'+ui.item.attr("username")+'" >'+ui.item.html()+'</li>';
 	username=ui.item.attr("username");
	
	//checking login is true or not start
	if($('#is_login').val()!=1 ){


			$.ajax({

				url:base_url+'index.php/home/before_logout_check/'+username,
				type:'POST',
				data:{
				username:username
				},
				success:function(result){
					$('#password').val('');
					if(result=='success'){
						$('#login').modal('hide');
						location.reload(true);
					}
					else if(result=='reason'){
						$.ajax({

						url:base_url+'index.php/home/check_out',
						type:'POST',
						data:{
						username:username
						},
							success:function(result){
								$('#password').val('');
								if(result=='success'){
									//$('#login').modal('hide');
									location.reload(true);
								}
								else if(result=='reason'){
									$('.modal-footer .reason_login').hide();
									$('.modal-footer .reason_send').hide();
									$('.modal-footer .reason_quickout').show();
									$('.modal-footer .reason_close').hide();
									$('#reason_content').show();
									$('#password').hide();
									$('#login').fadeIn('slow');
									$('#exampleModalLabel').html('You are delay today!');
									$('#label_reason').html('Enter your reason please');

								}
								else if(result=='contact'){
									alert('Please contact admin to unlock');

									location.reload(true);

								}


					   		 }

						});

					}
					else if(result=='contact'){
							alert('Please contact admin to unlock');
							location.reload(true);

					}
					else{
							$('#password').val('');
							alert(result);
					}

				}

			});





		$('#login').modal('show');

		$('.login-me').off("click");

		$('.close-me,.close').off("click");

		$('.login-me').on( "click", function(e) {


		var password=$('#password').val();
			if(password!=''){
				$.ajax({

				url:base_url+'index.php/home/check_out_with_login',
				type:'POST',
				data:{
				username:username,password:password}
				,
				success:function(result){
					$('#password').val('');
					if(result=='success' || result=='reason' ){
						$('#login').modal('hide');
						location.reload(true);
					}
					else{
						$('#password').val('');
						alert(result);

					}

				}

				});
			}

		});




		$('.close-me,.close').on( "click", function(e) {

			$("#sortable1").find("li[username='" + username + "']").remove();
			$("#sortable1").sortable('refresh');
			$("#sortable2").append(li);
			$("#sortable2").sortable('refresh');

		});


	}

	else
	{
		$.ajax({

		url:base_url+'index.php/home/check_out',
		type:'POST',
		data:{
		username:username
		},
		success:function(result){
			$('#password').val('');
			if(result=='success'){
				$('#login').modal('hide');
				location.reload(true);
			}
			else if(result=='reason'){
				$('.modal-footer .reason_login').hide();
				$('.modal-footer .reason_send').hide();
				$('.modal-footer .reason_quickout').show();
				$('.modal-footer .reason_close').hide();
				$('#reason_content').show();
				$('#password').hide();
				$('#login').modal('show');
				$('#exampleModalLabel').html('You are delay today!');
				$('#label_reason').html('Enter your reason please');

			}
			else if(result='contact'){
				alert('Please contact your admin to unlock.');
			}
			else{
				$('#password').val('');
				alert(result);

			}

		}

		});


	}
	//checking login is true or not end

}

//reason part
$('.reason_send').on( "click", function(e) {

var reason_content=$('#reason_content').val();
var data={
	type:'send_reason',
	reason_content:reason_content,
	}

	if(reason_content!=''){
	$.ajax({
		type:'POST',
		url:base_url+'index.php/home/send_reason/'+username,
		data:data,
		success:function(){
			$('#reason_content').val('');
			$('#login').modal('hide');
			if($('#is_login').val()!=1 ){
		
			$('#login').modal('show');

		

			$('.modal-footer .reason_login').show();
			$('.modal-footer .reason_send').hide();
			$('.modal-footer .reason_quickout').hide();
			$('.modal-footer .reason_close').hide();
			$('#exampleModalLabel').html('Login Please');
			$('#label_reason').html('password');
			$('#reason_content').hide();
			$('#password').show();

			}
		}
	});
	}
	else{

		alert('Your reason box is empty! Please fill reason box');
	}


});




//reason part end 



//quick_out

$('.reason_quickout').on( "click", function(e) {

var reason_content=$('#reason_content').val();
var data={
	type:'send_reason',
	reason_content:reason_content,
	}
	if(reason_content!=''){
		$.ajax({
			type:'POST',
			url:base_url+'index.php/home/quickout_reason/'+username,
			data:data,
			success:function(){
		
				},
			complete:function(){
				$('#reason_content').val('');
				$('#login').modal('hide');
				if($('#is_login').val()!=1 ){
		
				$('#login').modal('show');

				$('.modal-footer .reason_login').show();
				$('.modal-footer .reason_send').hide();
				$('.modal-footer .reason_quickout').hide();
				$('.modal-footer .reason_close').hide();
				$('#exampleModalLabel').html('Login Please');
				$('#label_reason').html('password');
				$('#reason_content').hide();
				$('#password').show();
		
			}
			}
		});
	}
	else{

		alert('Your reason box is empty! Please fill reason box');
	}

});
//quick_out end



});
</script>

<div class="container">
<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<!--<button type="button" class="close" data-dismiss="modal">
<span aria-hidden="true">
&times;
</span>-->

</button>
<h4 class="modal-title" id="exampleModalLabel" >
Login Please
</h4>
</div>
<div class="modal-body">



<div class="form-group">
<label for="recipient-name" class="control-label" id="label_reason">
Password :
</label>
<input type="password" class="form-control" id="password">
<textarea id="reason_content" style="display:none;width: 507px; height: 57px;" placeholder="type your reason here"required></textarea>
</div>


</div>
<div class="modal-footer">
<button type="button" class="btn btn-default close-me reason_close" data-dismiss="modal" >
Close
</button>
<button type="submit" class="btn btn-primary login-me reason_login">
Login
</button>
<button type="submit" class="btn btn-primary reason_send" style="display:none;">
Send
</button>
<button type="submit" class="btn btn-primary reason_quickout" style="display:none;">
Send
</button>
</div>
</div>
</div>
</div>


<script>

</script>
