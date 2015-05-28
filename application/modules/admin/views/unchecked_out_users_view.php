
<title>Admin | Uncheckedout Users</title>
<div id="content" class="span10">
			<!-- content starts -->
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> &nbsp;&nbsp;Uncheckedout users list</h2>
						<div class="box-icon">
							
						</div>
					</div>
					<div class="box-content">
<table class="table table-bordered table-striped table-condensed">
<thead>
<tr>
<th style="display:none;">Username</th>
<th>Name</th>
<th>Last Checked In Date</th>
<th>Last Checked In Time</th>
<th>Last Checked Out Time</th>
</tr>
</thead>
<tbody>
<?php 
foreach($users as $user){

echo '<tr>
<td style="display:none;">'.$user['user_name'].'</td>
<td>'.$user['display_name'].'</td>
<td class="center">'.$user['logged_in_date'].'</td>
<td class="center">'.date("H:i:s",strtotime($user['sign_in_time'])).'</td>
<td class="out_time" >00:00:00 <i class="icon-edit"></i></td>


</td>
</tr>';

			}
?>

</tbody>
</table>

<span class="time" style="display:none;" >
Hours : 
<select style="width:50px;" class="hours">
<option value="00" > 00 </option>
<?php for($i = 0; $i < 24; $i++): 
$j=$i+1;
if($j>=0 && $j<=9){
$val='0'.$j;
}
else
{
$val=$j;
}
  ?>  <option value="<?php echo $val; ?>"><?php echo $val; ?></option>
<?php endfor ?>
</select>
Minitues : 
<select style="width:50px;" class="minitues">
<option value="00" > 00 </option>
<?php for($i =5; $i <= 55; ): 
$j=$i;
if($j>=0 && $j<=9){
$val='0'.$j;
}
else
{
$val=$j;
}
  ?>  <option value="<?php echo $val; ?>"><?php echo $val; ?></option>
<?php 
$i=$i+5;
endfor ?>
</select>
</span>

					</div>
				</div>

			</div>
</div>
<script>
$(document).ready(function(){
var base_url="<?php echo base_url();?>";
var dropdown=$('.time').html();

var dropdown=dropdown + '<span class="label label-success save" >Save this</span>';


$('span.save').live('click', function (ev) {

var hours=$(this).parent().find('.hours option:selected').val();
var minitues=$(this).parent().find('.minitues option:selected').val();
var user_name=$(this).parent().parent().find('td:first').html();
var display_name=$(this).parent().parent().find('td:eq(1)').html();
var logged_in_date=$(this).parent().parent().find('td:eq(2)').html();
var logged_in_time=$(this).parent().parent().find('td:eq(3)').html();
var tr_element=$(this).parent().parent();
if(hours=='00'){
alert('Invalid time selection');
}
else
{
var check_in_time=logged_in_date+' '+logged_in_time;
var check_out_time=logged_in_date+' '+hours+':'+minitues+':'+'00';

$.ajax({

url:base_url+'index.php/admin/unchecked_out_users/update_time',
type:'POST',
data:{
user_name:user_name,check_out_time:check_out_time,logged_in_date:logged_in_date}
,
success:function(result){
tr_element.remove();
alert(display_name+"'s checkedout time has been updated successfully"); 

},
error:function(jqXHR,status,err){

alert(err);

}

});

}

exit;
});


$('.out_time').click(function(){

if($(this).html()=='00:00:00 <i class="icon-edit"></i>'){
$(this).html(dropdown);
var in_time=$(this).prev().html().split(':');
var hours=in_time[0];
var minitues=in_time[1];
$(this).find('.hours option').each(function(){
if(hours>this.value)
{
$(this).hide();
}

});



}



});



});

</script>
