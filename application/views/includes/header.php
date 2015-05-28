<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
<!-- jQuery -->
	<script src="<?php echo base_url(); ?>assets/js/jquery-1.7.2.min.js"></script>
<link id="bs-css" href="<?php echo base_url(); ?>assets/css/bootstrap-cerulean.css" rel="stylesheet">
	<style type="text/css">
	  body {
		padding-bottom: 40px;
	  }
	  .sidebar-nav {
		padding: 9px 0;
	  }
	</style>
	<link href="<?php echo base_url(); ?>assets/css/bootstrap-responsive.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/css/charisma-app.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/css/jquery-ui-1.8.21.custom.css" rel="stylesheet">
	

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- The fav icon -->
	<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/gr_icon.ico">
<style>
.brand {
    font-family: 'Shojumaru',cursive,Arial,serif;
    letter-spacing: 2px;
    text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.5);
    width: 176px;
}
</style>

  </head>

  <body>

    <!-- Fixed navbar -->
   <div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="<?php echo base_url();?>"><img src="<?php echo base_url();?>assets/img/grfinal.png" style="width:77%;height:100%;"></a>
<?php if(!$this->session->userdata('is_logged_in')){?>				 
				<!-- theme selector starts -->
				<div class="btn-group pull-right theme-container" >
					 <form role="search" action="<?php echo base_url();?>index.php/home/login" method="POST">
					 <input type="text"  name="username" required placeholder="Username">

					 <input type="password" name="password" required placeholder="Password">

					 <button type="submit"  class="btn" style="margin-top: -8px;">Sign In</button>
<?php if($this->session->flashdata('error')){?>
<p style="color:red;"> Invalid username or password</p>
<?php } ?>
				</form>
				</div>
<?php } ?>				<!-- theme selector ends -->
				
				<!-- user dropdown starts -->
<?php if($this->session->userdata('is_logged_in')){?>
				<div class="btn-group pull-right" >
			
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="icon-user"></i><span class="hidden-phone"><?php echo $this->session->userdata('displayname'); ?> </span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo base_url(); ?>index.php/employee/profile">Profile</a></li>
						<li class="divider"></li>
						<li><?php echo anchor('home/logout', '<span class="glyphicon glyphicon-off"></span>&nbsp; Logout', array('title' => 'logout!')); ?></li>
					</ul>
				</div>
				<!-- user dropdown ends -->
<?php } ?>				
				
			</div>
		</div>
	</div>
      
   
<style>

#spinner {
position:fixed;
left: 0px;
top: 0px;
display:none;
width: 100%;
height: 100%;
z-index: 9999;
opacity:.9;
background: url('<?php echo base_url();?>/assets/img/ajax-loaders/ajax-loader-6.gif') 50% 50% no-repeat #ede9df;
}

</style>
<div id='spinner'>
</div>
<script type="text/javascript">
    jQuery(function ($){
        $("#spinner").ajaxStop(function(){
            $(this).hide();
         });
         $("#spinner").ajaxStart(function(){
             $(this).show();
         });    
    });    
</script>





