<title>
  <?php echo SITE_NAME; ?>
</title>
<div id="content" class="span10">
<div class="box span12" >

				  <div class="box-header well" data-original-title>
					  <h2><i class="icon-calendar"></i> Import attendance </h2>
				
				  </div>
				  <div class="box-content">


<form class="form-horizontal" method="POST"  action="<?php echo base_url();?>index.php/import/import_attendance" enctype="multipart/form-data">
<?php if($this->session->flashdata('msg')){

echo '<div class="alert alert-error">
<button class="close" data-dismiss="alert" type="button">×</button>
'.$this->session->flashdata('msg').'
</div>';

} ?>
<div class="control-group">
<label class="control-label" for="date01">Excel File to  import</label>
<div class="controls">
<input id="file" class="file" name="excel" required type="file">
</div>
</div>
<div class="control-group">
<label class="control-label" for="date01">Download our excel template from here</label>
<div class="controls">
<a href="<?php echo base_url();?>/assets/excel/template.xlsx" >Click here to download template</a>
</div>
</div>

<div class="form-actions">
<button class="btn btn-primary" type="submit">Import</button>
<button class="btn" type="reset">Cancel</button>
</div>

<p>Time format need to be HH:MM:SS</p>
<p>Day format need to be mm/dd/yyyy</p>
</form>
</div>                             
                  </div>
				</div><!--/span-->
</div>
</div>			</div><!--/row-->

  </div>                             
                  </div>
				</div><!--/span-->
