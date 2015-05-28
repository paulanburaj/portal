
 <footer>
			<p class="pull-left">&copy; <a href="http://grinfotech.com" target="_blank">GR Infotech</a> <?php echo date('Y');?></p>
			<p class="pull-right">Powered by: <a href="http://grinfotech.com">GR Infotech</a></p>
		</footer>
		

</body>
<!-- external javascript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->

	
	<!-- jQuery UI -->
	<script src="<?php echo base_url(); ?>assets/js/jquery-ui-1.8.21.custom.min.js"></script>
	<!-- transition / effect library -->
	<script src="<?php echo base_url(); ?>assets/js/bootstrap-transition.js"></script>
	<!-- alert enhancer library -->
	<script src="<?php echo base_url(); ?>assets/js/bootstrap-alert.js"></script>
	<!-- modal / dialog library -->
	<script src="<?php echo base_url(); ?>assets/js/bootstrap-modal.js"></script>
	<!-- custom dropdown library -->
	<script src="<?php echo base_url(); ?>assets/js/bootstrap-dropdown.js"></script>
	<!-- library for creating tabs -->
	<script src="<?php echo base_url(); ?>assets/js/bootstrap-tab.js"></script>
<!-- library for advanced tooltip -->
	<script src="<?php echo base_url(); ?>assets/js/bootstrap-tooltip.js"></script>
	<!-- popover effect library -->
	<script src="<?php echo base_url(); ?>assets/js/bootstrap-popover.js"></script>
	<!-- button enhancer library -->
	<script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery.plugin.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery.timeentry.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.sticky-kit.min.js"></script>
	
	<script>
		$(document).ready(function(){
			$('.datepicker').datepicker();
			$('#intime').timeEntry().change(function() { 
   			 var log = $('#log'); 
    			log.val(log.val() + ($('#intime').val() || 'blank') + '\n'); 
		});
		});
</script>
</html>
