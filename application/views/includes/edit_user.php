<title>Edit Employee Details </title>
<div id="content" class="span10">
			<!-- content starts -->
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> &nbsp;&nbsp;Edit Employee details</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" method="POST" action="<?php echo base_url();?>index.php/admin/employee/edit" enctype="multipart/form-data">
						  <fieldset>
							<div class="control-group">
								<label class="control-label" for="selectError3">Title</label>
								<div class="controls">
<?php 	
$options = array(
		  '0' => '',
                  'Mr'  => 'Mr',
                  'Ms'    => 'Ms',
		  'Mrs'=>'Mrs'
                );


echo form_dropdown('title', $options,set_value('title'));


?>
								</div>
							</div>
							
							<div class="control-group">
								<label class="control-label" for="focusedInput">First Name *</label>
									<div class="controls">
											<input id="focusedInput" class="input-xlarge focused" name="fname" type="text" value="<?php echo set_value('fname'); ?>">
		<?php echo form_error('fname'); ?>							</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="focusedInput">Last  Name *</label>
									<div class="controls">
											<input id="focusedInput" class="input-xlarge focused" name="lname" type="text" value="<?php echo set_value('lname'); ?>"><?php echo form_error('lname'); ?>
									</div>
							</div>
							
							<div class="control-group">
								<label class="control-label" for="focusedInput">Display Name</label>
									<div class="controls">
											<input id="focusedInput" class="input-xlarge focused" name="display_name" type="text" value="<?php echo set_value('display_name'); ?>">
									</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="selectError3">User Role *</label>
							<div class="controls">
<?php 	
$options = array(
		  '0' => '',
                  '1'  => 'Web Developer',
                  '2'    => 'Web Designer'
                );


echo form_dropdown('user_type', $options,set_value('user_type'));


?>
<?php echo form_error('user_type'); ?>
								
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="focusedInput">Email </label>
									<div class="controls">
											<input id="focusedInput" class="input-xlarge focused" name="email1" type="text" value="<?php echo set_value('email1'); ?>"><?php echo form_error('email1'); ?>
									</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="focusedInput">Other Email</label>
									<div class="controls">
											<input id="focusedInput" class="input-xlarge focused" name="email2" type="text" value="<?php echo set_value('email2'); ?>"><?php echo form_error('email2'); ?>
									</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="focusedInput">Mobile Number </label>
									<div class="controls">
											<input id="focusedInput" class="input-xlarge focused" name="mobile1" value="<?php echo set_value('mobile1'); ?>" type="phone">
									</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="focusedInput">Other Mobile Number</label>
									<div class="controls">
											<input id="focusedInput" class="input-xlarge focused" name="mobile2" type="phone" value="<?php echo set_value('mobile2'); ?>">
									</div>
							</div>
							<div class="control-group">
							  	<label class="control-label" for="fileInput">Upload Image</label>
							  		<div class="controls">
										<input class="input-file uniform_on" id="fileInput" type="file" name='image' value="<?php echo set_value('image'); ?>"><?php echo form_error('image'); ?>
							  		</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="focusedInput">Temporary Address</label>
									<div class="controls">
											<textarea class="autogrow" name="temp_address"><?php echo set_value('temp_address'); ?></textarea>
									</div>
							</div> 
							<div class="control-group">
								<label class="control-label" for="focusedInput">Pemanant Address</label>
									<div class="controls">
											<textarea class="autogrow" name="perm_address" name="perm_address"><?php echo set_value('perm_address'); ?></textarea>
									</div>
							</div> 
							<div class="control-group">
							  <label class="control-label" for="date01">Joined Date *</label>
							  <div class="controls">
								<input type="text" class="input-xlarge datepicker" id="jdate"  name="joined_date" value="<?php echo set_value('joined_date'); ?>"><?php echo form_error('joined_date'); ?>
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="date01">Relieve Date</label>
							  <div class="controls">
								<input type="text" class="input-xlarge datepicker" id="rdate"  name="relieve_date" value="<?php echo set_value('relieve_date'); ?>">
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="date01">Date Of Birth</label>
							  <div class="controls">
								<input type="text" class="input-xlarge datepicker" id="dob"  name="dob" <?php echo set_value('dob'); ?> value="<?php echo set_value('dob'); ?>">
							  </div>
							</div>

							          
							<div class="control-group">
							  <label class="control-label" for="textarea2">Educational Details</label>
							  <div class="controls">
								<textarea class="cleditor" id="textarea2" rows="3" name="edu_details"><?php echo set_value('edu_details'); ?></textarea>
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="textarea2">Experience</label>
							  <div class="controls">
								<textarea class="cleditor" id="textarea2" rows="3" name="experience" name="experience"><?php echo set_value('experience'); ?></textarea>
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="textarea2">Skill Set</label>
							  <div class="controls">
								<textarea class="cleditor" id="textarea2" rows="3" name="skill_set" name="skill_set"><?php echo set_value('skill_set'); ?></textarea>
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="textarea2">Remarks</label>
							  <div class="controls">
								<textarea class="cleditor" id="textarea2" rows="3" name="remarks" name="remarks"><?php echo set_value('remarks'); ?></textarea>
							  </div>
							</div>
							<div class="control-group">
							<label class="control-label" for="focusedInput">Status *</label>
									<div class="controls">
										<label>
<?php

$radio_options = array(
        '1' => 'Active',
        '0' => 'In Active'
    );

    foreach( $radio_options as $key => $radio_option ) {
	echo '<label>';
        echo form_radio('status[]', $key, set_radio('status[]', $key), 'class="input-xlarge focused"');
	echo '&nbsp;&nbsp;'.$radio_option.'</label>';
    }

?>	<?php echo form_error('status[]'); ?>					</div>
							</div><hr>
   						<h2>Login Details</h2><hr>
							<div class="control-group">
								<label class="control-label" for="focusedInput">UserName *</label>
									<div class="controls">
											<input id="focusedInput" class="input-xlarge focused" name="user_name" type="text" value="<?php echo set_value('user_name');?>">
					<?php echo form_error('user_name'); ?>				</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="focusedInput">Password *</label>
									<div class="controls">
											<input id="focusedInput" class="input-xlarge focused" name="password" type="password"><?php echo form_error('password'); ?>	
									</div>
							</div>
							<div class="control-group">
							<label class="control-label" for="focusedInput">Confirm Password *</label>
									<div class="controls">
											<input id="focusedInput" class="input-xlarge focused" name="password2" type="password"><?php echo form_error('password2'); ?>	
									</div>
							</div>
							

							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Save</button>
							  <button type="reset" class="btn">Cancel</button>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->
</div>

