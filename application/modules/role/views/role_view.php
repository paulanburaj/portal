<title>Add Roles</title>
<link href="<?php echo base_url(); ?>assets/css/ui.jqgrid.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.jqGrid.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/i18n/grid.locale-en.js"></script>

<!--<style>
@font-face{font-family:"Ubuntu",Helvetica,Arial,sans-serif;}
body{width:100%;padding:0px;margin:0px;}

.cvteste{color:#000;font-size:12px;font-family:"Ubuntu",Helvetica,Arial,sans-serif}
h1{text-align:center;font-family: "Ubuntu",Helvetica,Arial,sans-serif;}

.ui-widget{font-family:"Ubuntu",Helvetica,Arial,sans-serif; color:#fff;}

.ui-jqgrid .ui-jqgrid-hdiv {height:25px;}
.ui-jqgrid-titlebar{height:30px;padding-top:10px !important;}
.ui-jqgrid tr.jqgrow td{height:30px;}
.ui-jqgrid .ui-jqgrid-pager {height:30px;}
.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default {
  background: #fff;font-size:13px;border:1px solid #369bd7;}
.ui-widget-content{border: 1px solid #369bd7;}
.txt{width:250px;height:30px;border-radius:5px;border:1px solid #369bd7;}
.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default { font-size:12px  !important;font-weight:none  !important; text-align:left  !important;}
.ui-widget-header{background:none;background-color:#50a8dc !important; color:white; }
</style>-->



<style>
.ui-jqgrid{
    -moz-box-sizing: content-box;
}
.ui-jqgrid-btable{
	border-collapse: separate;
}
.ui-jqgrid-htable{
	border-collapse: separate;
}
.ui-jqgrid-titlebar{
    height: 40px;
    line-height: 15px;
    color: #999999;
    background-color: #F9F9F9;
    text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
}
.ui-jqgrid .ui-jqgrid-title {
    float: left;
    margin: 1.1em 1em 0.2em;
}
.ui-jqgrid .ui-jqgrid-titlebar { 
	position: relative; 
	border-left: 1 solid;
	border-right: 1 solid; 
	border-top: 1 solid;
}
.ui-widget-header{
    background: none;
    background-image: none;
    background-color: #F9F9F9;
    text-transform: uppercase;
    border-top-left-radius:  6px;
    border-top-right-radius: 6px;
}
.ui-jqgrid tr.ui-row-ltr td {
    border-right-color: inherit;
    border-right-style: solid;
    border-right-width: 1px;
    text-align: left;
    border-color: #DDDDDD;
    background-color: inherit;
}
.ui-search-toolbar input[type="text"]{
    font-size: 12px;
    height: 15px;
    border: 1px solid #CCCCCC;
    border-radius: 0px;                
}                

.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default {    
    background: #F9F9F9;
    border: 1px solid #D3D3D3;               
    line-height: 15px;
    font-weight: bold;
    color: #777777;
    text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
}
.ui-widget-content {
	box-sizing: content-box;
}
.ui-icon-triangle-1-n {
    background-position: 1px -16px;
}
.ui-jqgrid tr.ui-search-toolbar th { 
    border-top-width: 0px !important; 
    border-top-color: inherit !important; 
    border-top-style: ridge !important 
}
.ui-state-hover, .ui-widget-content .ui-state-hover, .ui-state-focus, .ui-widget-content .ui-state-focus, .ui-widget-header .ui-state-focus {  
    background: #dadada;
    border-collapse: separate;
}
.ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active { 
    border: 1px solid #aaaaaa; 
    background: #ffffff; 
    font-weight: normal; color: #212121; 
}
.ui-jqgrid .ui-pg-input {
    font-size: inherit;
    width: 50px;
    border: 1px solid #CCCCCC;
    height: 15px;
}
.ui-jqgrid .ui-pg-selbox {
    display: block;
    font-size: 1em;
    height: 25px;
    line-height: 18px;
    margin: 0;
    width: auto;
}
.ui-jqgrid .ui-pager-control {
    position: relative;
}
.ui-jqgrid .ui-jqgrid-pager {
    height: 32px;
    position: relative;
}
.ui-pg-table .navtable .ui-corner-all{
    border-radius: 0px;
}
.ui-jqgrid .ui-pg-button:hover {
    padding: 1px;
    border: 0px;
}
.ui-jqgrid .loading {
    position: absolute; 
    top: 45%;
    left: 45%;
    width: auto;
    height: auto;
    z-index:101;
    padding: 6px; 
    margin: 5px;
    text-align: center;
    font-weight: bold;
    display: none;
    border-width: 2px !important; 
    font-size:11px;
}
.ui-jqgrid .form-control {
	height: 10px;
	width: auto;
	display: inline;	
	padding: 10px 12px;
}
.ui-jqgrid-pager {
	height: 32px;	
}

table.ui-jqgrid-htable , #gview_list
{
height:40px;
} 
table tr
{
height:30px;
}
table
{
width:100%;
}
.box {
    border: none;
    border-radius: none;
    box-shadow:  none;
}
</style>

<div id="content" class="span10">


  <div class='wrapper'>
	<table id="rowed2"></table> 
	<div id="prowed2"></div>

  </div>
</div>

<script>
$(document).ready(function(){
var page_url="<?php echo base_url(); ?>";

			var mySearchOptions = {
			// it's just some options which you use
			multipleSearch: true,
			multipleGroup: true,
			recreateFilter: true,
			closeOnEscape: true,
			closeAfterSearch: true,
			showQuery: true,
			overlay: 0,
			stringResult: true, 
			searchOnEnter: false, 
			defaultSearch: 'cn',
			afterRedraw: function () {
			    $('input.add-rule',this).val('Add new rule').button();
			    $('input.add-group',this).val('Add new group or rules').button();
			    $('input.delete-rule',this).val('Delete rule').button();
			    $('input.delete-group',this).val('Delete group').button();
			},
			onClose:function()
		        {
		       
		          return true; 
		        },
			
			//"tmplNames" : ["Template One", "Template Two"],
			//"tmplFilters": [template1, template2],

		    };
					

//{ '1': 'US', '2': 'UK' };
	jQuery("#rowed2").jqGrid({
	
   	url:page_url+"index.php/role/get_role_details",
	datatype: "json",
   	  colNames:['Role Name','Parent', 'Description',], 
	   colModel:[ 

	   {name:'role_name',index:'a.role_name',editable:true,search:true, stype:'text'}, 
	  
	   {name:'parent',index:'a.parent',classes: 'cvteste',editable:true,edittype:'select',search:true, stype:'text',editoptions: {
    dataUrl: page_url+"index.php/role/get_role_names" ,
		
		buildSelect:function(resp){
				        var sel= '<select><option value="">Select parent</option>';
				        var obj = $.parseJSON(resp);
				        $.each(obj, function(key, value) {
					  sel += '<option value="'+key + '">'+ value + "</option>"; 
				        });
				     sel+='</select>';

				     return sel;
					}
}}, 
	   {name:'decription',index:'a.decription',editable:true,search:true, stype:'text'},
	    
	   	
	   ],

	rowNum:10,
	rowList:[10,20,30],
	pager: '#prowed2',
	sortname: 'id',
	search:false,
	viewrecords: true,
	height:'100%',
	autowidth: true,
	shrinkToFit: true,
	width:1000,
	sortorder: "asc",
	caption:"Role",
	multiselect: true,
}).navGrid('#prowed2', { edit: true, add: true, del: true },
        // Edit options
            {
         
            url:page_url+"index.php/role/edit_role_details",
         
        },
        // Add options
             {url: page_url+"index.php/role/add_role_details" },
        // Delete options
               {url: page_url+"index.php/role/delete_role_details" },
               { multipleSearch: true,
                  
               }
               );

jQuery("#rowed2").filterToolbar(mySearchOptions);

    });

   
	</script>
  	   


