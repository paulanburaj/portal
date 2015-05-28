<title>Profile</title>
<style>
	.thumbnail img, .thumbnail > a {
    display: block;
    height: 150px;
  
    position: relative;
    width: 150px;
    z-index: 2;
}

.show-grid {
    background-color:white;
    border-radius: 3px;
    line-height: 30px;
    min-height: 30px;
    text-align: center;
}

.edit_profile{

    position: relative;
width: 150px;
}

.change_password{

    position: relative;
width: 150px;
}


</style>


<div id="content" class="span10">
	<div class="row-fluid sortable ui-sortable">
		<div class="box span12">
			<div class="box-header well" data-original-title="">
				<h2>
					<i class="icon-picture"></i>
						Profile
				</h2>
					<div class="box-icon">
						<a class="btn btn-setting btn-round" href="#">
							<i class="icon-cog"></i>
						</a>
						<a class="btn btn-minimize btn-round" href="#">
							<i class="icon-chevron-up"></i>
						</a>
						<a class="btn btn-close btn-round" href="#">
							<i class="icon-remove"></i>
						</a>
					</div>
			</div>
						<div class="box-content">
							
							<div class="row-fluid">
<form class="form-horizontal" method="POST" action="<?php echo base_url(); ?>index.php/employee/edit_employee/<?php echo $user[0]['id'];?>" enctype="multipart/form-data">
						  <fieldset>	
								<div class="span4"><center>	<br>						<div class="thumbnails gallery">	
										<div id="image-2" class="thumbnail">
									
											<img class="grayscale" alt="Profile Image" src="<?php echo base_url(); ?>assets/uploads/<?php echo $user[0]['image']; ?>" style="display: block;">
									
										</div>
 								<button type="submit" class="btn btn-primary edit_profile">Edit Profile</button><br><br>
								<a href="<?php echo base_url(); ?>index.php/employee/change_password/<?php echo $user[0]['id'];?>"><button type="button" class="btn btn-warning change_password">Change Password</button></a>
							  
								
									</div>
							
								</div>
								
	</center>
							


			<!-- content starts -->
						<div class="span8"><br>
						
							
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>Name</td>
                        <td><?php echo $user[0]['title'].' '.$user[0]['fname'].' '.$user[0]['lname']; ?></td>
                      </tr>
                      <tr>
                        <td>Display Name</td>
                        <td><?php echo $user[0]['display_name']; ?></td>
                      </tr>
                      <tr>
                        <td>Role</td>
                        <td><?php 	
$options=$this->profile_model->usertype_formation($user[0]['user_type']);	

echo $options;


?></td>
                      </tr>
                   <?php $in_time=date('h:iA',strtotime($user[0]['in_time'])); ?>
                         <tr>
                             <tr>
                        <td>In Time</td>
                        <td><?php echo $in_time; ?></td>
                      </tr>
                        <tr>
                        <td>Email</td>
                        <td><?php if($user[0]['email1']==''){
											echo 'Not Assigned';
										}
										else{
											echo $user[0]['email1'];
										}?><br><br><?php if($user[0]['email2']==''){
											echo 'Not Assigned';
										}
										else{
											echo $user[0]['email2'].'(Other email)';
										}?></td>
                      </tr>
			<tr>
                      <td>Mobile Number</td>
                        <td><?php if($user[0]['mobile1']==''){
											echo 'Not Assigned';
										}
										else{
											echo $user[0]['mobile1'];
										}?><br><br><?php if($user[0]['mobile2']==''){
											echo 'Not Assigned';
										}
										else{
											echo $user[0]['mobile2'].'(Other Mobile)';
										}?>
                        </td>
                           
                      </tr>
			<tr>
                      <td>Address</td>
                        <td>Temporary:<br><?php if($user[0]['temp_address']==''){
											echo 'Not Assigned';
										}
										else{
											echo $user[0]['temp_address'];
										}?><br><br>Permanant:<br><?php if($user[0]['perm_address']==''){
											echo 'Not Assigned';
										}
										else{
											echo $user[0]['perm_address'];
										}?>
                        </td>
                           
                      </tr>
			 <tr>
                        <td>Joined Date</td>
                        <td><?php if($user[0]['joined_date']==''){
											echo 'Not Assigned';
										}
										else{
											echo $user[0]['joined_date'];
										}?></td>
                      </tr>
			 <tr>
                        <td>Relieve Date</td>
                        <td><?php if($user[0]['relieve_date']==''){
											echo 'Not Assigned';
										}
										else{
											echo $user[0]['relieve_date'];
										}?></td>
                      </tr>
			 <tr>
                        <td>Date Of Birth</td>
                        <td><?php if($user[0]['dob']==''){
											echo 'Not Assigned';
										}
										else{
											echo $user[0]['dob'];
										}?></td>
                      </tr>
			<tr>
                        <td>Educational Details</td>
                        <td><?php if($user[0]['edu_details']==''){
											echo 'Not Assigned';
										}
										else{
											echo $user[0]['edu_details'];
										}?></td>
                      </tr>
			<tr>
                        <td>Experience</td>
                        <td><?php if($user[0]['experience']==''){
											echo 'Not Assigned';
										}
										else{
											echo $user[0]['experience'];
										}?></td>
                      </tr>
			<tr>
                        <td>Skill set</td>
                        <td><?php if($user[0]['skill_set']==''){
											echo 'Not Assigned';
										}
										else{
											echo $user[0]['skill_set'];
										}?></td>
                      </tr>
			<tr>
                        <td>Remarks</td>
                        <td><?php if($user[0]['remarks']==''){
											echo 'Not Assigned';
										}
										else{
											echo $user[0]['remarks'];
										}?></td>
                      </tr>
			
                     
                    </tbody>
                  </table>
                  
                
               
						  </fieldset>
						</form>
</div>
</div>
