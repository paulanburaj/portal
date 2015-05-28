<div class="container-fluid">
		<div class="row-fluid">
				
			<!-- left menu starts -->
			<div class="span2 main-menu-span">
				<div class="well nav-collapse sidebar-nav">
					<ul class="nav nav-tabs nav-stacked main-menu">
<?php if($this->session->userdata('is_admin')){?>
						<li class="nav-header hidden-tablet">Main</li>

						<li><?php echo anchor('home/dashboard', '<i class="icon-home"></i><span class="hidden-tablet"> Dashboard</span>', array('title' => 'dashboard!','class'=>'ajax-link')); ?></li>
<li class="nav-header hidden-tablet">Employee Section</li>

<li><?php echo anchor('admin/employee/view_employee', '<i class="icon-eye-open"></i><span class="hidden-tablet">&nbsp;&nbsp;View employee </span>', array('title' => 'view employee!','class'=>'ajax-link')); ?></li>


<li class="nav-header hidden-tablet">Role Section</li>
<li><?php echo anchor('role', '<i class="icon-globe"></i><span class="hidden-tablet">&nbsp;&nbsp;Role</span>', array('title' => 'role','class'=>'ajax-link')); ?></li>

						<li><?php echo anchor('admin/employee', '<i class="icon-edit"></i><span class="hidden-tablet">&nbsp;&nbsp;Add employee </span>', array('title' => 'add employee!','class'=>'ajax-link')); ?></li>
			<?php } ?>			
						<li class="nav-header hidden-tablet">Event Section</li>
							<li><?php echo anchor('home', '<i class="icon-th"></i><span class="hidden-tablet">&nbsp;&nbsp;View Attendance</span>', array('title' => 'view Attendance!','class'=>'ajax-link')); ?>
						<li><?php echo anchor('calendar', '<i class="icon-calendar"></i><span class="hidden-tablet">&nbsp;&nbsp;View Calendar</span>', array('title' => 'view Calendar!','class'=>'ajax-link')); ?></li>
							<li class="nav-header hidden-tablet">Report Section</li>
						<li><?php echo anchor('attendance_report', '<i class="icon-globe"></i><span class="hidden-tablet">&nbsp;&nbsp;Attendance Report</span>', array('title' => 'view Attendance Report!','class'=>'ajax-link')); ?></li>
<?php if($this->session->userdata('is_admin')){?>
<li><?php echo anchor('import', '<i class="icon-globe"></i><span class="hidden-tablet">&nbsp;&nbsp;Import Report</span>', array('title' => 'Import Report!','class'=>'ajax-link')); ?></li>
<li><?php echo anchor('admin/unchecked_out_users', '<i class="icon-globe"></i><span class="hidden-tablet">&nbsp;&nbsp;Unchecked users</span>', array('title' => 'Unchecked users','class'=>'ajax-link')); ?></li>
<li><?php echo anchor('admin/mail_report/mail_report_full', '<i class="icon-globe"></i><span class="hidden-tablet">&nbsp;&nbsp;Mail Report</span>', array('title' => 'Mail Report','class'=>'ajax-link')); ?></li>


<?php } ?>
<li class="nav-header hidden-tablet">Coding Standards</li>
<li><a class="ajax-link" href="<?php echo base_url();?>assets/coding/coding_standard.doc"><i class="icon-globe"></i><span class="hidden-tablet">&nbsp;&nbsp; Coding Standards</a></span></li>

						
					</ul>
		
				</div><!--/.well -->
			</div><!--/span-->
			<!-- left menu ends -->
