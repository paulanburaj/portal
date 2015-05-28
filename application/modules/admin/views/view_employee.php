<title>View employee details</title>
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


<!--<style>
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
var page_url="<?php echo base_url(); ?>";
	jQuery("#rowed2").jqGrid({
   	url:page_url+"index.php/admin/employee/get_employee_details",
	datatype: "json",
   	  colNames:['Actions','Username','First Name', 'Last Name', 'Display Name','Email Address','Mobile Num','Date Join','Date Relieve','Role','Status',], 
	   colModel:[ 
	    {name:'act',index:'act', sortable:false,width:'60px'},
	   {name:'user_name',index:'user_name',classes: 'cvteste'}, 
	  
	   {name:'fname',index:'fname',classes: 'cvteste',editable:true}, 
	   {name:'lname',index:'lname', classes: 'cvteste',editable:true},
	   {name:'display_name',index:'display_name',classes: 'cvteste',editable:true},
       	   {name:'email1',index:'email1',  sortable:false,classes: 'cvteste',editable:true},
	   {name:'mobile1',index:'mobile1', sortable:false,classes: 'cvteste',editable:true},
	   {name:'joined_date',index:'joined_date', sortable:false,classes: 'cvteste',editable:true},
	   {name:'relieve_date',index:'relieve_date',  sortable:false,classes: 'cvteste',editable:true},
           {name:'user_type',index:'user_type', sortable:false},
	   {name:'status',index:'status',sortable:false},
	   	
	   ],
   	rowNum:10,
   	rowList:[10,20,30],
   	pager: '#prowed2',
   	sortname: 'id',
    viewrecords: true,
	height:'100%',
autowidth:true,
	shrinkToFit: false,
    sortorder: "asc",
   caption:"View Employee",
subGrid: true,
subGridRowExpanded: function(subgrid_id, row_id) {
    var subgrid_table_id, pager_id;
    subgrid_table_id = subgrid_id + "_t";
    pager_id = "p_" + subgrid_table_id;
    $("#" + subgrid_id).html("<table id='" + subgrid_table_id + "' class='scroll'></table><div id='" + pager_id + "' class='scroll'></div>");
    jQuery("#" + subgrid_table_id).jqGrid({
        url: page_url+"index.php/admin/employee/get_full_employee_details/"+row_id,
        datatype: "json",
	autowidth: true,
        colNames: ['User Details','Contact Details', 'Skill Details'],
        colModel: [{
            name: "name",
        }, {
            name: "address",
        }, {
            name: "skills",

        }],
       
        //width: '100%',
	height:'100%',
    });
    jQuery("#" + subgrid_table_id).jqGrid('navGrid', "#" + pager_id, {
        edit: false,
        add: false,
        del: false
    })
}, subGridRowColapsed: function(subgrid_id, row_id) {
    var subgrid_table_id;
    subgrid_table_id = subgrid_id + "_t";
    jQuery("#" + subgrid_table_id).remove();
},
	
	
});
//jQuery("#rowed2").jqGrid('navGrid',"#prowed2",{edit:false,add:false,del:false});   
	</script>
  	   


