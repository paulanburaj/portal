<title>Change Password</title>
<div id="content" class="span10">
			<!-- content starts -->
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> &nbsp;&nbsp;Change Password</h2>
						<div class="box-icon">
							
						</div>
					</div>
					<div class="box-content">
						
						  <fieldset>
							
							<form class="form-horizontal" method="POST" action="<?php echo base_url(); ?>index.php/employee/update_password/<?php echo $data[0]['id'];?>" enctype="multipart/form-data" name="password_check">
<?php if($this->session->flashdata('old')){?>
<p style="color:red;"> old password invalid!</p>
<?php } ?>
							
							<div class="control-group">
								<label class="control-label" for="focusedInput">Old Password *</label>
									<div class="controls">
											<input id="old_password" class="input-xlarge focused pass" name="old_password" type="password" required><?php echo form_error('password'); ?>	
									</div>
							</div>
<div id="old_error"></div>

							<div class="control-group">
								<label class="control-label" for="focusedInput">Password *</label>
									<div class="controls">
											<input id="pass" class="input-xlarge focused pass" name="password" type="password" required><?php echo form_error('password'); ?>	
									</div>
							</div>
							<div class="control-group">
							<label class="control-label" for="focusedInput">Confirm Password *</label>
									<div class="controls">
											<input id="c_pass" class="input-xlarge focused c_pass" name="password2" type="password" required><?php echo form_error('password2'); ?>	
									</div>
							</div>
							


							<div class="form-actions">
							  <button type="button" id="submit" class="btn btn-primary">Save</button>
							  <button type="reset" class="btn" onclick="history.back(1);">Cancel</button>
							</div>
						  </fieldset>
						</form>

					</div>
				</div><!--/span-->

			</div><!--/row-->
</div>

<script>
$(document).ready(function(){
var base_url="<?php echo base_url(); ?>"; 
var id="<?php echo $data[0]['id'];?>";
$("#submit").click(function(){
var old=$('#old_password').val();

var pass=$('#pass').val();

var c_pass=$('#c_pass').val();

if(old=='' || pass=='' || c_pass==''){
	$("#pass").css("border-color", "red");
	$("#c_pass").css("border-color", "red");
	$("#old_password").css("border-color", "red");
	$('#pass').attr("placeholder", "Where is your New password!");
	$('#c_pass').attr("placeholder", "Where is your Confirm password!");
	$('#old_password').attr("placeholder", "Where is your old password!");
	return false;
}
else if(pass!=c_pass){

	$('#c_pass').val('');
 	$('#c_pass').attr("placeholder", "Password does not match!");
	return false;

}



var data={
	type:'save',
	old:old,
	pass:pass,
	}
 $.ajax({
	type: "POST",
	url: base_url+"index.php/employee/update_password/"+id,
	data: data,
	success: function(output){
				if(output=='0' || output==''){
					$('#old_password').val('');
					$("#old_password").css("border-color", "red");
					$('#old_password').attr("placeholder", "Wrong password!!");
					$('#c_pass').val('');	
				}			
					
				else{
				
				window.location.href = base_url+'index.php/employee/profile';
				}			
		},			

	 });


if(old=='' ){

$("#old_error").append("<div>hello world</div>")


}
});
});

</script>

