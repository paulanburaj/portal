<style>
.table-wrapper
{
    
    width: 100%;
    height: 100%;
    overflow: auto;
}
</style>

<title>Attendance Report</title>
<div id="content" class="span10">
			<!-- content starts -->
			<div class="row-fluid sortable">
				<div class="box span12">
				  <div class="box-header well" data-original-title>
					  <h2><i class="icon-calendar"></i>Monthly  Attendance Report</h2>
				
				  </div>
				  <div class="box-content">
<form method="POST" action="<?php echo base_url();?>index.php/attendance_report/selected_month"> 
<input class="monthpicker" data-start-year="2009" name="sel_month" required value="<?php echo $sel_month;?>">&nbsp;&nbsp;<button type="submit" class="btn btn-primary" value="Generate Report" > Generate Report </button>
</form>
<br>
<?php

$current_month=date('m',time());
$current_year=date('Y',time());
$current_day=date('Y-m-d',time());
?>
<div  class="table-wrapper">
<table class="gridtable">
<tr>
<th></th>
<?php 

$sel_month=explode('/',$sel_month);
$month=$sel_month[0];
$year=$sel_month[1];

for($i=1;$i<=$days_count;$i++){


echo "<th>".$i."</th>";

}

?>
<th>Work Days</th>
<th>Present Days</th>
</tr>
<tbody>
<?php 

foreach($all_user_list as $user){
$total_absent=0;
$total_work=$days_count;
echo "<tr><td>".$user['display_name']."</td>";

for($i=1;$i<=$days_count;$i++){

$day=str_pad($i, 2, "0", STR_PAD_LEFT);
$date=$year.'-'.$month.'-'.$day;
if(in_array($date,$all_leave_report['L'])|| in_array($date,$all_leave_report['H']))
{
$total_work=$total_work-1;
	if(in_array($date,$all_leave_report['L']))
	{
	echo "<td style='color:blue;'>L</td>";
	}
	else
	{
	echo "<td style='color:blue;'>W.H</td>";
	}

}
else if($current_day<$date){

echo "<td>-</td>";
}
else if((($date>=$user['joined_date'] && $date<=$user['relieve_date']) || ($date>=$user['joined_date'] && $user['relieve_date']=='0000-00-00')) && (empty($all_report)) ){
$total_absent=$total_absent+1;
echo "<td style='color:red;'>A</td>";
}
else{
if(empty($all_report)){
echo "<td>-</td>";
}
else{
foreach($all_report as $user_report){

if(isset($user_report[$user['id']][$date])){

$work_hours=$user_report[$user['id']][$date]['in_hours'];
$sign_in_time=$user_report[$user['id']][$date]['sign_out_time'];
$sign_in_time=date('h:ia',strtotime($sign_in_time));
$sign_out_time=$user_report[$user['id']][$date]['sign_in_time'];
$sign_out_time=date('h:ia',strtotime($sign_out_time));
$delay_time=$user_report[$user['id']][$date]['delay_time'];
$display_name=$user_report[$user['id']][$date]['user_name'];
$logged_date=$user_report[$user['id']][$date]['logged_in_date'];
$work_hours=gmdate('H:i:s',$work_hours);
if($delay_time!='' && $delay_time!='00:00'){

echo '<td class="present" logged_date="'.$logged_date.'" display_name="'.$display_name.'" in_time="'.$work_hours.'" sign_in_time="'.$sign_in_time.'" sign_out_time="'.$sign_out_time.'" delay_time="'.$delay_time.'" data-popbox="pop1" style="background-color:#369bd7;color:white;"> P </td><div id="pop1" class="popbox">
     <h2>Details</h2>
<p>
     <h5 style="display:inline;"> <span  class="display_name_span" style="display:inline;"><span></h5></p>

    <h5><p>Date :
        <span class="logged_date"></span>
    </p></h5>
  
    
    <h5> <p>Delay Time:
         <span class="delay_time"></span>
    </p></h5>
<br>
    <h2 class="in_time"></h2></div>
';
}
else{
echo '<td class="present" logged_date="'.$logged_date.'" display_name="'.$display_name.'" in_time="'.$work_hours.'" sign_in_time="'.$sign_in_time.'" sign_out_time="'.$sign_out_time.'" delay_time="'.$delay_time.'" data-popbox="pop1"> P </td><div id="pop1" class="popbox">
     <h2>Details</h2>
<p>
     <h5 style="display:inline;"> <span  class="display_name_span" style="display:inline;"><span></h5></p>

    <h5><p>Date :
        <span class="logged_date"></span>
    </p></h5>
  
    
    <h5> <p>Delay Time:
         <span class="delay_time"></span>
    </p></h5>
<br>
    <h2 class="in_time"></h2></div>
';
}

}
else if($current_day<$date){

echo "<td>-</td>";
}

else{
if(($date>=$user['joined_date'] && $date<=$user['relieve_date']) || ($date>=$user['joined_date'] && $user['relieve_date']=='0000-00-00') ){
$total_absent=$total_absent+1;
echo "<td style='color:red;'>A</td>";
}
else{
echo "<td>-</td>";
}


}
}
}

}

}
$total_present=$total_work-$total_absent;
echo "<td>".$total_work."</td><td>".$total_present."</td>";

echo "</tr>";
}

?>
</tbody>
</table>
</div>

<div class="row-fluid">
<div class="box span12">
<div class="box-header well">
<h2>
<i class="icon-info-sign"></i>
Yearly Summary Report
</h2>

</div>
<div class="box-content">

<select>
</select>
&nbsp;&nbsp;
<button type="submit" class="btn btn-primary" value="Generate Report" > Generate Report </button>



</div>
</div>
</div>


					</div>
				</div>
			</div><!--/row-->
		
					<!-- content ends -->
			</div><!--/#content.span10-->
				</div><!--/fluid-row-->
<script src="<?php echo base_url(); ?>assets/js/jquery.mtz.monthpicker.js"></script>
<script>
$(document).ready(function(){
var moveLeft = 0;
var moveDown = 0;
$('.present').hover(function (e) {
		var user_text='UserName:';
		var display_name=$(this).attr('display_name');
		$('.display_name_span').text(user_text+display_name);

		var delay_text='Total In Time:';
		var in_time=$(this).attr('in_time');
		$('.in_time').text(delay_text+in_time);


		var in_time=$(this).attr('title');
		$('.input_box').val(in_time);

		var logged_date=$(this).attr('logged_date');
		$('.logged_date').text(logged_date);

		var sign_in_time=$(this).attr('sign_in_time');
		$('.sign_in_time').text(sign_in_time);

		var sign_out_time=$(this).attr('sign_out_time');
		$('.sign_out_time').text(sign_out_time);

		var delay_time=$(this).attr('delay_time');
		$('.delay_time').text(delay_time);
    var target = '#' + ($(this).attr('data-popbox'));
    $(target).show();
    moveLeft = $(this).outerWidth();
    moveDown = ($(target).outerHeight() / 2);
}, function () {
    var target = '#' + ($(this).attr('data-popbox'));
    if (!($(".present").hasClass("show"))) {
        $(target).hide();
    }
});

$('.present').mousemove(function (e) {
    var target = '#' + ($(this).attr('data-popbox'));

    leftD = e.pageX + parseInt(moveLeft);
    maxRight = leftD + $(target).outerWidth();
    windowLeft = $(window).width() - 40;
    windowRight = 0;
    maxLeft = e.pageX - (parseInt(moveLeft) + $(target).outerWidth() + 20);

    if (maxRight > windowLeft && maxLeft > windowRight) {
        leftD = maxLeft;
    }

    topD = e.pageY - parseInt(moveDown);
    maxBottom = parseInt(e.pageY + parseInt(moveDown) + 20);
    windowBottom = parseInt(parseInt($(document).scrollTop()) + parseInt($(window).height()));
    maxTop = topD;
    windowTop = parseInt($(document).scrollTop());
    if (maxBottom > windowBottom) {
        topD = windowBottom - $(target).outerHeight() - 20;
    } else if (maxTop < windowTop) {
        topD = windowTop + 20;
    }

    $(target).css('top', topD).css('left', leftD);
});
$('.present').click(function (e) {
    var target = '#' + ($(this).attr('data-popbox'));
    if (!($(this).hasClass("show"))) {
        $(target).show();
    }
    $(this).toggleClass("show");
});
$('.monthpicker').monthpicker();



});
</script>
<!-- CSS goes in the document HEAD or added to your external stylesheet -->
<style type="text/css">
table.gridtable {
	font-family: verdana,arial,sans-serif;
	font-size:11px;
	color:#333333;
	border-width: 1px;
	border-color: #666666;
	border-collapse: collapse;
}
table.gridtable th {
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #666666;
	background-color: #dedede;
}
table.gridtable td {
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #666666;
	background-color: #ffffff;
}

.popbox {
    display: none;
    position: absolute;
    z-index: 99999;
    
    padding: 10px;
    background: #EEEFEB;
    color: #000000;
    border: 1px solid #4D4F53;
    margin: 0px;
    -webkit-box-shadow: 0px 0px 5px 0px rgba(164, 164, 164, 1);
    box-shadow: 0px 0px 5px 0px rgba(164, 164, 164, 1);
}
.popbox h2 {
    background-color: #4D4F53;
    color: #E3E5DD;
    font-size: 14px;
    display: block;
    width: 100%;
    margin: -10px 0px 8px -10px;
    padding: 5px 10px;
}
</style>

