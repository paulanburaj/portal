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
	<div class="box span12" style="margin-left:70px;" >
<?php } ?>

<div class="box-header well" data-original-title>
	<h2><i class="icon-calendar"></i> Attendance </h2>
</div>
<div class="box-content">
	<div class="box span6"  data-sticky_column="" id="fixed_1">
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
	if($emp['sign_out_time']==NULL || $emp['sign_out_time']!='0000-00-00 00:00:00') {
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

<div class="box span6" data-sticky_column="" id="fixed_2" style="">
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

	

	if($emp['sign_out_time']=='0000-00-00 00:00:00'){
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
$("#fixed_2").stick_in_parent();
var base_url="<?php echo base_url();?>";
var start_with='';
var end_with='';
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
}  // function time_update

function check_in(ui)
{
var li='<li class="'+ui.item.attr("class")+'" username="'+ui.item.attr("username")+'" >'+ui.item.html()+'</li>';
var username=ui.item.attr("username");


if($('#is_login').val()!=1){
$('#login').modal({
backdrop: 'static',
    keyboard: false,
    show: 'true'
});
//$('#login').modal('show');

$('.login-me').off("click");

$('.close-me,.close').off("click");

$('.login-me').on( "click", function(e) {

var password=$('#password').val();
if(password!=''){
$.ajax({

url:base_url+'index.php/home/check_in_with_login',
type:'POST',
data:{
username:username,password:password}
,
success:function(result){
$('#password').val('');
if(result=='success'){
$('#login').modal('hide');
//$('#paul').modal('show');

$.ajax({

	url:base_url+'index.php/home/getdelay_time',
	type:'POST',
	data:{
	username:username}
	,
	success:function(result){
		if(result!='' && result!='00:00'){
				$('#reason').modal({
					backdrop: 'static',
					    keyboard: false,
					    show: 'true'
					});
			//$('#reason').modal('show');
			$('.reason').click(function(){
				var reason_data=$('#reason_data').val();
				$.ajax({

					url:base_url+'index.php/home/update_reason',
					type:'POST',
					data:{
					username:username,reason_data:reason_data
}
					,
					success:function(result){
						$('#reason').modal('hide');
						location.reload(true);
					}

				});
			});

		}
		else{

$('#message_for_before').modal({
backdrop: 'static',
    keyboard: false,
    show: 'true'
});
			//location.reload(true);
			}
	}

});

//location.reload(true);
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
var user_name_session="<?php echo $this->session->userdata('user_name');?> ";

if(user_name_session.trim()==username.trim()){



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
			$.ajax({

url:base_url+'index.php/home/getdelay_time',
type:'POST',
data:{
username:username}
,
success:function(result){
if(result!='' && result!='00:00'){
$('#reason').modal({
backdrop: 'static',
    keyboard: false,
    show: 'true'
});
//$('#reason').modal('show');
$('.reason').click(function(){
				var reason_data=$('#reason_data').val();
				$.ajax({

					url:base_url+'index.php/home/update_reason',
					type:'POST',
					data:{
					username:username,reason_data:reason_data}
					,
					success:function(result){
						$('#reason').modal('hide');
						location.reload(true);
					}

				});
			});
}
else{
$('#message_for_before').modal({
backdrop: 'static',
    keyboard: false,
    show: 'true'
});
			//location.reload(true);
			}
}

});
//location.reload(true);
}
else{
$('#password').val('');
alert(result);

}

}

});


}
else{
location.reload(true);
}

}


}


function check_out(ui){
var li='<li class="'+ui.item.attr("class")+'" username="'+ui.item.attr("username")+'" >'+ui.item.html()+'</li>';
var username=ui.item.attr("username");
if($('#is_login').val()!=1 ){
$('#login').modal({
backdrop: 'static',
    keyboard: false,
    show: 'true'
});
//$('#login').modal('show');

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
		if(result=='success'){
			$('#login').modal('hide');
			$.ajax({

			url:base_url+'index.php/home/get_total_intime',
			type:'POST',
			data:{
			username:username}
			,
			success:function(result){
//alert(result);
				if(result=='1'){
					$('#reason_quickout').modal({
					backdrop: 'static',
					    keyboard: false,
					    show: 'true'
					});
//$('#reason_quickout').modal('show');
	$('.reason_quickout').click(function(){
					var reason_quickout_data=$('#reason_quickout_data').val();
					$.ajax({

						url:base_url+'index.php/home/update_reason_quickout',
						type:'POST',
						data:{
						username:username,reason_quickout_data:reason_quickout_data}
						,
						success:function(result){
							location.reload(true);
						}

					});
				});
}
else{
$('#message_for_after').modal({
backdrop: 'static',
    keyboard: false,
    show: 'true'
});
			//location.reload(true);
			}
}

});


//location.reload(true);
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
var user_name_session="<?php echo $this->session->userdata('user_name');?> ";

if(user_name_session.trim()==username.trim()){
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

$.ajax({

url:base_url+'index.php/home/get_total_intime',
type:'POST',
data:{
username:username}
,
success:function(result){
//alert(result);
if(result=='1'){
$('#reason_quickout').modal({
backdrop: 'static',
    keyboard: false,
    show: 'true'
});
//$('#reason_quickout').modal('show');
$('.reason_quickout').click(function(){
				var reason_quickout_data=$('#reason_quickout_data').val();
				$.ajax({

					url:base_url+'index.php/home/update_reason_quickout',
					type:'POST',
					data:{
					username:username,reason_quickout_data:reason_quickout_data}
					,
					success:function(result){
						location.reload(true);
					}

				});
			});
}
else{
$('#message_for_after').modal({
backdrop: 'static',
    keyboard: false,
    show: 'true'
});
			//location.reload(true);
			}
}

});

//location.reload(true);
}
else{
$('#password').val('');
alert(result);

}

}

});
}
else{
location.reload(true);
}
}

}

if($('#is_login').val()==1){
var user_name_session="<?php echo $this->session->userdata('user_name');?> ";
//alert(user_name_session);

			$.ajax({

					url:base_url+'index.php/home/check_checkin',
					type:'POST',
					data:{
					user_name_session:user_name_session,}
					,
					success:function(result){
						//location.reload(true);
						if(result!=''){
						var username="<?php echo $this->session->userdata('user_name');?> ";
						$.ajax({

								url:base_url+'index.php/home/getdelay_time',
								type:'POST',
								data:{
								username:username,}
								,
								success:function(result){
									//location.reload(true);
									if(result!='' && result!='00:00'){
										$.ajax({

											url:base_url+'index.php/home/get_reason',
											type:'POST',
											data:{
											username:username,}
											,
											success:function(result){
											var trim=$.trim(result);
												if(trim==''){
												$.ajax({

											url:base_url+'index.php/home/delete_login',
											type:'POST',
											data:{
											username:username,}
											,
											success:function(result){
												//location.reload(true);
$('#message').modal({
backdrop: 'static',
    keyboard: false,
    show: 'true'
});

												
											}

										});


												}
												
											}

										});


									}
								}

							});
						}
					}

				});




}

$('.msg_before').click(function(){
$('#login').modal('hide');
});
});

</script>

<div class="container">
	<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					
					<h4 class="modal-title" id="exampleModalLabel">
					Login Please
					</h4>
				</div>
	<div class="modal-body">



		<div class="form-group">
			<label for="recipient-name" class="control-label">
			Password :
			</label>
			<input type="password" class="form-control" id="password">
		</div>


	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default close-me" data-dismiss="modal">
		Close
		</button>
		<button type="submit" class="btn btn-primary login-me">
		Login
		</button>
	</div>
			</div>
		</div>
</div>


<div class="modal fade" id="reason" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					
					<h4 class="modal-title" id="exampleModalLabel">
					You are Delay today! Reason??
					</h4>
				</div>
	<div class="modal-body">



		<div class="form-group">
			<textarea id="reason_data" name="reason_data"></textarea>
			
		</div>


	</div>
	<div class="modal-footer">
		
		<button type="submit" class="btn btn-primary reason">
		Send
		</button>
	</div>
			</div>
		</div>
</div>

<div class="modal fade" id="reason_quickout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					
					<h4 class="modal-title" id="exampleModalLabel">
					Reason for quickly checked out!!
					</h4>
				</div>
	<div class="modal-body">



		<div class="form-group">
			<textarea id="reason_quickout_data" name="reason_quickout_data"></textarea>
			
		</div>


	</div>
	<div class="modal-footer">
		
		<button type="submit" class="btn btn-primary reason_quickout">
		Send
		</button>
	</div>
			</div>
		</div>
</div>

<div class="modal fade" id="message" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		
	<div class="modal-body">



		<div class="form-group">
			
			Please update your reason for delay... You are checked Out!!
		</div>


	</div>
	<div class="modal-footer">
		
		<button type="submit" class="btn btn-primary" onclick="location.reload(true);">
		OK
		</button>
	</div>
			</div>
		</div>
</div>

<div class="modal fade" id="message_for_before" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		
	<div class="modal-body">



		<div class="form-group">
			
			<p><h2>Awesome! Keep it up :-)</h2><p>
		</div>


	</div>
	<div class="modal-footer">
		
		<button  class="btn btn-primary msg_before" >
		OK
		</button>
	</div>
			</div>
		</div>
</div>

<div class="modal fade" id="message_for_after" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		
	<div class="modal-body">



		<div class="form-group">
			
			<p><h3>You done a great job Today!! bye bye :-) </h3><p>
		</div>


	</div>
	<div class="modal-footer">
		
		<button type="button" class="btn btn-primary msg_after" >
		OK
		</button>
	</div>
			</div>
		</div>
</div>
