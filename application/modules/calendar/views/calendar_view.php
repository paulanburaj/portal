<title>Calendar</title>
<link href="<?php echo base_url(); ?>assets/css/fullcalendar.css" rel='stylesheet'>
<link href="<?php echo base_url(); ?>assets/css/fullcalendar.print.css" rel='stylesheet'  media='print'>
<script src="<?php echo base_url(); ?>assets/js/fullcalendar.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/moment.min.js"></script>
<script>
$(document).ready(function(){
//initialize the external events for calender
var base_url="<?php echo base_url();?>";
var is_admin=$('#is_admin').val();
 	var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();

	$('#external-events div.external-event').each(function() {

		// it doesn't need to have a start or end
		var eventObject = {
			title: $.trim($(this).text()) // use the element's text as the event title
		};
		
		// store the Event Object in the DOM element so we can get to it later
		$(this).data('eventObject', eventObject);
		
		// make the event draggable using jQuery UI
		$(this).draggable({
			zIndex: 999,
			revert: true,      // will cause the event to go back to its
			revertDuration: 0  //  original position after the drag
		});
		
	});

if(is_admin=='1'){

//initialize the calendar
 var calendar =	$('#calendar').fullCalendar({
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,agendaWeek,agendaDay',
			
		},
defaultView: 'agendaWeek',
events: base_url+"index.php/calendar/fetch_event",
   
   // Convert the allDay from string to boolean
   eventRender: function(event, element, view,title) {
    
   },
 eventClick:  function(event, jsEvent, view) {
 if(event.editable!='true'){
var event_start=moment(event.start).format('YYYY-MM-DD HH:mm:ss');
var event_end=moment(event.end).format('YYYY-MM-DD HH:mm:ss');
	$('#myModal_view').modal('show');
	$("#myModal_view .event_id").val(event.id);
$('#myModal_view #reason_text1').val(event.title);
$("#myModal_view .start_time").val(event_start);
$("#myModal_view .end_time").val(event_end);
$("#myModal_view .event_type").val(event.type);
return false;
	}
        //set the values and open the modal
        $("#eventInfo").html(event.description);
        $("#eventLink").attr('href', event.url);
        $("#eventContent").dialog({ modal: true, title: event.title });


var event_title=event.title;
var event_id=event.id;
var event_start=moment(event.start).format('YYYY-MM-DD HH:mm:ss');
var event_end=moment(event.end).format('YYYY-MM-DD HH:mm:ss');
var event_type=event.type;


$("#myModal1").modal('show');
$("#myModal1 .event_id").val(event_id);
$('#reason_text1').val(event_title);
$("#myModal1 .start_time").val(event_start);
$("#myModal1 .end_time").val(event_end);
$("#myModal1 .event_type").val(event_type);
if(event_type=='Holiday'){
$("#myModal1 .start_time").hide();
$("#myModal1 .start_time").prev().hide();
$("#myModal1 .end_time").hide();
$("#myModal1 .end_time").prev().hide();
$("#myModal1 .show_to_all").hide();
$('.show').hide();
$('.show').next().hide();
}
else{
$("#myModal1 .show_to_all").show();
$("#myModal1 .start_time").show();
$("#myModal1 .start_time").prev().show();
$("#myModal1 .end_time").show();
$("#myModal1 .end_time").prev().show();
$('.show').show();
$('.show').next().show();
}
			
var show_to_all=event.show_to_all;
if(show_to_all==1){

$(".show").prop('checked',true);
}
else{
$(".show").prop('checked',false);
}
},

eventDrop: function(event, delta) {
console.log(event.allDay);
if(event.editable!='true'|| event.type=='Holiday'){
	return false;
	}
    //set the values and open the modal
        $("#eventInfo").html(event.description);
        $("#eventLink").attr('href', event.url);
        $("#eventContent").dialog({ modal: true, title: event.title });


var event_title=event.title;
var event_id=event.id;
var event_start=moment(event.start).format('YYYY-MM-DD HH:mm:ss');
var event_end=moment(event.end).format('YYYY-MM-DD HH:mm:ss');
var event_type=event.type;


$("#myModal1").modal('show');
$("#myModal1 .event_id").val(event_id);
$('#reason_text1').val(event_title);
$("#myModal1 .start_time").val(event_start);
$("#myModal1 .end_time").val(event_end);
$("#myModal1 .event_type").val(event_type);
if(event_type=='Holiday'){
$("#myModal1 .show_to_all").hide();
$("#myModal1 .start_time").hide();
$("#myModal1 .start_time").prev().hide();
$("#myModal1 .end_time").hide();
$("#myModal1 .end_time").prev().hide();
}
else{
$("#myModal1 .show_to_all").show();
$("#myModal1 .start_time").show();
$("#myModal1 .start_time").prev().show();
$("#myModal1 .end_time").show();
$("#myModal1 .end_time").prev().show();
}
var show_to_all=event.show_to_all;
if(show_to_all==1){

$(".show").prop('checked',true);
}
else{
$(".show").prop('checked',false);
}		
},

 eventResize: function(event, delta, revertFunc) {

if(event.editable!='true' || event.allDay=='true'){
	return false;
	}
         //set the values and open the modal
        $("#eventInfo").html(event.description);
        $("#eventLink").attr('href', event.url);
        $("#eventContent").dialog({ modal: true, title: event.title });


var event_title=event.title;
var event_id=event.id;
var event_start=moment(event.start).format('YYYY-MM-DD HH:mm:ss');
var event_end=moment(event.end).format('YYYY-MM-DD HH:mm:ss');
var event_type=event.type;
var show_to_all=event.show_to_all;
if(show_to_all==1){

$(".show").prop('checked',true);
}
else{
$(".show").prop('checked',false);
}

$('#reason_text1').val(event_title);
$("#myModal1 .start_time").val(event_start);
$("#myModal1 .end_time").val(event_end);
$("#myModal1 .event_type").val(event_type);
$("#myModal1 .event_id").val(event_id);
if(event_type=='Holiday'){
$("#myModal1 .show_to_all").hide();
$("#myModal1 .start_time").hide();
$("#myModal1 .start_time").prev().hide();
$("#myModal1 .end_time").hide();
$("#myModal1 .end_time").prev().hide();
}
else{

$("#myModal1").modal('show');
$("#myModal1 .show_to_all").show();
$("#myModal1 .start_time").show();
$("#myModal1 .start_time").prev().show();
$("#myModal1 .end_time").show();
$("#myModal1 .end_time").prev().show();
}

    },

		editable: true,
		droppable: true, // this allows things to be dropped onto the calendar !!!
 		selectable: true,
           	 selectHelper: true,
          
	select: function (start, end,event) {
		
		$("#myModal_other #reason_text").val('');
		$("#myModal_other .show_to_all").prop('selected',false);
		var start=moment(start).format('YYYY-MM-DD HH:mm:ss');
		var end=moment(end).format('YYYY-MM-DD HH:mm:ss');
		var start_day=moment(start).format('YYYY-MM-DD');
		var end_day=moment(end).format('YYYY-MM-DD');
		var start_time=moment(start).format('HH:mm:ss');
		var end_time=moment(end).format('HH:mm:ss');
		if(start_day==end_day && start_time!=end_time)
		{
        $("#myModal_other").modal('show');
		$("#myModal_other .start_time").val(start);
		$("#myModal_other .end_time").val(end);
		}
		else{
		$("#myModal").modal('show');
		$("#myModal .start_time").val(start);
		$("#myModal .end_time").val(end);
		}

$("#myModal1 .show_to_all").prop('checked',false);


            },

		drop: function(date, allDay,title,event) { // this function is called when something is dropped
	

			// retrieve the dropped element's stored Event Object
			var originalEventObject = $(this).data('eventObject');
			
			// we need to copy it, so that multiple events don't have a reference to the same object
			var copiedEventObject = $.extend({}, originalEventObject);
			
			// assign it the date that was reported
			copiedEventObject.start = date;
			copiedEventObject.allDay = allDay;
			var start_time=copiedEventObject.start;
			var end_time=copiedEventObject.end;
			// render the event on the calendar
			// the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
			var start=moment(start_time).format('YYYY-MM-DD HH:mm:ss');
			var end=moment(end_time).format('YYYY-MM-DD HH:mm:ss');
			$("#myModal .start_time").val(start);
			$("#myModal .end_time").val('');  
		

			
			$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
			
				$("#myModal").modal('show');
				$('#reason_text').val("");                	
					
			if ($('#drop-remove').is(':checked')) {
				// if so, remove the element from the "Draggable Events" list
				$(this).remove();
			}
			
		}

	});

	}
	
else{



//initialize the calendar
 var calendar =	$('#calendar').fullCalendar({
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,agendaWeek,agendaDay',
			
		},
defaultView: 'agendaWeek',
events: base_url+"index.php/calendar/fetch_event",
   
   // Convert the allDay from string to boolean
   eventRender: function(event, element, view,title) {
    
   },
 eventClick:  function(event, jsEvent, view) {
 if(event.editable!='true'){
var event_start=moment(event.start).format('YYYY-MM-DD HH:mm:ss');
var event_end=moment(event.end).format('YYYY-MM-DD HH:mm:ss');
	$('#myModal_view').modal('show');
	$("#myModal_view .event_id").val(event.id);
$('#myModal_view #reason_text1').val(event.title);
$("#myModal_view .start_time").val(event_start);
$("#myModal_view .end_time").val(event_end);
$("#myModal_view .event_type").val(event.type);
return false;
	}
        //set the values and open the modal
        $("#eventInfo").html(event.description);
        $("#eventLink").attr('href', event.url);
        $("#eventContent").dialog({ modal: true, title: event.title });


var event_title=event.title;
var event_id=event.id;
var event_start=moment(event.start).format('YYYY-MM-DD HH:mm:ss');
var event_end=moment(event.end).format('YYYY-MM-DD HH:mm:ss');
var event_type=event.type;

$("#myModal1").modal('show');
$("#myModal1 .event_id").val(event_id);
$('#reason_text1').val(event_title);
$("#myModal1 .start_time").val(event_start);
$("#myModal1 .end_time").val(event_end);
$("#myModal1 .event_type").val(event_type);
if(event_type=='Holiday'){
$("#myModal1 .start_time").hide();
$("#myModal1 .start_time").prev().hide();
$("#myModal1 .end_time").hide();
$("#myModal1 .end_time").prev().hide();
$("#myModal1 .show_to_all").hide();
}
else{
$("#myModal1 .show_to_all").show();
$("#myModal1 .start_time").show();
$("#myModal1 .start_time").prev().show();
$("#myModal1 .end_time").show();
$("#myModal1 .end_time").prev().show();
}
			
var show_to_all=event.show_to_all;
if(show_to_all==1){

$(".show").prop('checked',true);
}
else{
$(".show").prop('checked',false);
}
},

eventDrop: function(event, delta) {
if(event.editable!='true'){
	return false;
	}
    //set the values and open the modal
        $("#eventInfo").html(event.description);
        $("#eventLink").attr('href', event.url);
        $("#eventContent").dialog({ modal: true, title: event.title });


var event_title=event.title;
var event_id=event.id;
var event_start=moment(event.start).format('YYYY-MM-DD HH:mm:ss');
var event_end=moment(event.end).format('YYYY-MM-DD HH:mm:ss');
var event_type=event.type;


$("#myModal1").modal('show');
$("#myModal1 .event_id").val(event_id);
$('#reason_text1').val(event_title);
$("#myModal1 .start_time").val(event_start);
$("#myModal1 .end_time").val(event_end);
$("#myModal1 .event_type").val(event_type);
if(event_type=='Holiday'){
$("#myModal1 .show_to_all").hide();
$("#myModal1 .start_time").hide();
$("#myModal1 .start_time").prev().hide();
$("#myModal1 .end_time").hide();
$("#myModal1 .end_time").prev().hide();
}
else{
$("#myModal1 .show_to_all").show();
$("#myModal1 .start_time").show();
$("#myModal1 .start_time").prev().show();
$("#myModal1 .end_time").show();
$("#myModal1 .end_time").prev().show();
}
var show_to_all=event.show_to_all;
if(show_to_all==1){

$(".show").prop('checked',true);
}
else{
$(".show").prop('checked',false);
}		
},

 eventResize: function(event, delta, revertFunc) {
if(event.editable!='true'){
	return false;
	}
         //set the values and open the modal
        $("#eventInfo").html(event.description);
        $("#eventLink").attr('href', event.url);
        $("#eventContent").dialog({ modal: true, title: event.title });


var event_title=event.title;
var event_id=event.id;
var event_start=moment(event.start).format('YYYY-MM-DD HH:mm:ss');
var event_end=moment(event.end).format('YYYY-MM-DD HH:mm:ss');
var event_type=event.type;
var show_to_all=event.show_to_all;
if(show_to_all==1){
$(".show").prop('checked',true);
}
else{
$(".show").prop('checked',false);
}
$("#myModal1").modal('show');

$('#reason_text1').val(event_title);
$("#myModal1 .start_time").val(event_start);
$("#myModal1 .end_time").val(event_end);
$("#myModal1 .event_type").val(event_type);
$("#myModal1 .event_id").val(event_id);
if(event_type=='Holiday'){
$("#myModal1 .show_to_all").hide();
$("#myModal1 .start_time").hide();
$("#myModal1 .start_time").prev().hide();
$("#myModal1 .end_time").hide();
$("#myModal1 .end_time").prev().hide();
}
else{
$("#myModal1 .show_to_all").show();
$("#myModal1 .start_time").show();
$("#myModal1 .start_time").prev().show();
$("#myModal1 .end_time").show();
$("#myModal1 .end_time").prev().show();
}

    },

		editable: true,
		droppable: true, // this allows things to be dropped onto the calendar !!!
 		selectable: true,
           	 selectHelper: true,
          
	select: function (start, end,event) {
		
		$("#myModal_other #reason_text").val('');
		$("#myModal_other .show_to_all").prop('checked',false);
		var start=moment(start).format('YYYY-MM-DD HH:mm:ss');
		var end=moment(end).format('YYYY-MM-DD HH:mm:ss');
		var start_day=moment(start).format('YYYY-MM-DD');
		var end_day=moment(end).format('YYYY-MM-DD');
		var start_time=moment(start).format('HH:mm:ss');
		var end_time=moment(end).format('HH:mm:ss');
		if(start_day==end_day && start_time!=end_time)
		{
        $("#myModal_other").modal('show');
		$("#myModal_other .start_time").val(start);
		$("#myModal_other .end_time").val(end);
		}
		else{
		return false;
		}

$(".show").prop('checked',false);


            },

		drop: function(date, allDay,title,event) { // this function is called when something is dropped
	

			// retrieve the dropped element's stored Event Object
			var originalEventObject = $(this).data('eventObject');
			
			// we need to copy it, so that multiple events don't have a reference to the same object
			var copiedEventObject = $.extend({}, originalEventObject);
			
			// assign it the date that was reported
			copiedEventObject.start = date;
			copiedEventObject.allDay = allDay;
			var start_time=copiedEventObject.start;
			var end_time=copiedEventObject.end;
			// render the event on the calendar
			// the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
			var start=moment(start_time).format('YYYY-MM-DD HH:mm:ss');
			var end=moment(end_time).format('YYYY-MM-DD HH:mm:ss');
			$("#myModal .start_time").val(start);
			$("#myModal .end_time").val('');  
		

			
			$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
			
				$("#myModal").modal('show');
				$('#reason_text').val("");                	
					
			if ($('#drop-remove').is(':checked')) {
				// if so, remove the element from the "Draggable Events" list
				$(this).remove();
			}
			
		}

	});



}


	
$('.close_event,.close').click(function(){

$('#calendar').fullCalendar('removeEvents');
$('#calendar').fullCalendar( 'refetchEvents' );

});


$('#save_reason1').click(function(){
						var ev_title=$('#reason_text1').val();
						var event_id=$('.event_id').val();
						var event_type=$('.event_type').val();
						var event_start=$('#myModal1 .start_time').val();
						var event_end=$('#myModal1 .end_time').val();
if(event_type=='Holiday'){
							var data = {
							type:'edit_data',
							event_type:event_type,
							ev_title:ev_title,
							event_id:event_id,
							start:event_start,
							end:event_end,
							show_to_all:'1'
							}
}
else{
if($(".show").is(":checked")){
var show=1;
}
else{
var show=0;
}
					var data = {
							type:'edit_data',
							event_type:event_type,
							ev_title:ev_title,
							event_id:event_id,
							start:event_start,
							end:event_end,
							show_to_all:show
							}

}
						$.ajax({
                                                                                                                                 
					    		type: "POST",
					    		url: base_url+"index.php/calendar/edit_event",
							data: data,
					    		success: function(output) {
									//alert(output);
									
							$('#calendar').fullCalendar('removeEvents');
							$('#calendar').fullCalendar( 'refetchEvents' );
									$('#reason_text1').text(""); 
									$("#myModal1").modal('hide');
									$("#alert").modal('show');

						
							},

						
						});
			});

			$('#delete_reason').click(function(){
						var event_id=$('.event_id').val();
							var data = {
							type:'delete_data',
							event_id:event_id,
							}
						$.ajax({
                                                                                                                                 
					    		type: "POST",
					    		url: base_url+"index.php/calendar/delete_event",
							data: data,
					    		success: function(output) {
									//alert(output);
									
							$('#calendar').fullCalendar('removeEvents');
							$('#calendar').fullCalendar( 'refetchEvents' );
									$('#reason_text1').text(""); 
									$("#myModal1").modal('hide');
									$("#alert").modal('show');

						
							},

						
						});
			});




$('#myModal_other #save_reason').click(function(){
					var start=$("#myModal_other .start_time").val();
					var end=$("#myModal_other .end_time").val();
					var reason_text=$("#myModal_other #reason_text").val() ;
					if(reason_text==''){
					$("#alert").modal('show');
					$('.modal-body .info').html('please fill the description');
					return false;
					}
					if($(".show1").is(":checked")){
						var show=1;
						}
						else{
						var show=0;
						}
								var data = {
								type:'save_data',
								event_type:'others',
								reason:reason_text,
								start:start,
								end:end,
								show_to_all:show
								}
						$.ajax({
                                                                                                                                 
					    		type: "POST",
					    		url: base_url+"index.php/calendar/add_event",
							data: data,
					    		success: function(output) {
									if(output=='success'){
									$('#calendar').fullCalendar('removeEvents');
							                $('#calendar').fullCalendar( 'refetchEvents' );
									$('#reason_text').val(""); 
									$("#myModal_other").modal('hide');
									$("#alert").modal('show');
									$('.modal-body .info').html('Successfully added');
									}

									else{
									$('#calendar').fullCalendar('removeEvents');
									$('#calendar').fullCalendar( 'refetchEvents' );
									$('#reason_text').val(""); 
									$("#myModal_other").modal('hide');
									$("#alert").modal('show');
									$('.modal-body .info').html(output);
									}
									
							},

						
						});
					

					});


$('#myModal #save_reason').click(function(){
					var start=$("#myModal .start_time").val();
					var end=$("#myModal .end_time").val();
					var reason_text=$("#reason_text").val() ;
					if(reason_text==''){
					$("#alert").modal('show');
					$('.modal-body .info').html('please fill the description');
					return false;
					}
								var data = {
								type:'save_data',
								event_type:'Holiday',
								reason:reason_text,
								start:start,
								end:end,
								show_to_all:'1'
								}
						$.ajax({
                                                                                                                                 
					    		type: "POST",
					    		url: base_url+"index.php/calendar/add_event",
							data: data,
					    		success: function(output) {
									if(output=='success'){
									$('#calendar').fullCalendar('removeEvents');
							                $('#calendar').fullCalendar( 'refetchEvents' );
									$('#reason_text').val(""); 
									$("#myModal").modal('hide');
									$("#alert").modal('show');
									$('.modal-body .info').html('Successfully added');
									}

									else{
									$('#calendar').fullCalendar('removeEvents');
									$('#calendar').fullCalendar( 'refetchEvents' );
									$('#reason_text').val(""); 
									$("#myModal").modal('hide');
									$("#alert").modal('show');
									$('.modal-body .info').html(output);
									}
									
							},

						
						});
					

					});


});
</script>
			<div id="content" class="span10">
			<!-- content starts -->
			<div class="row-fluid sortable">
				<div class="box span12">
				  <div class="box-header well" data-original-title>
					  <h2><i class="icon-calendar"></i>Calendar</h2>
				
				  </div>
				  <div class="box-content">
<?php if($this->session->userdata('is_admin')==true) { ?>
					<div id="external-events" class="well">
						<h4>Draggable Events</h4>
						<div class="external-event badge badge-success">Add Holiday</div>
						</div>
						<div id="calendar" ></div>
<?php } 
else
{

?>
						<div id="calendar" style="width:100%"></div>
						
<?php } ?>						


					</div>
				</div>
			</div><!--/row-->
		
					<!-- content ends -->
			</div><!--/#content.span10-->
				</div><!--/fluid-row-->
				
		<hr>
<div class="modal hide fade" id="myModal">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Add Holiday</h3>
			</div>
			<div class="modal-body">
				<div class="control-group">
					
						<div class="controls">
							<div class="controls">
								
							</div>
							<label class="control-label" for="reason_text">Description</label>
							<textarea id="reason_text" class="input-xlarge focused" type="text"></textarea>
<input type="hidden" class="start_time"  disabled>
<input type="hidden" class="end_time" disabled>
						</div>
					</div>
			</div>
			<div class="modal-footer">
				<button id="close_reason" class="btn close_event" data-dismiss="modal">Close</button>
				<button id="save_reason" class="btn btn-primary">Save</button>
			</div>
		</div>

<div class="modal hide fade" id="myModal1">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Edit Events</h3>
			</div>
			<div class="modal-body">
				<div class="control-group">
					<label class="control-label" for="reason_text">Description</label>
						<div class="controls">
							<textarea id="reason_text1" class="input-xlarge focused" type="text"></textarea>
						</div>
<label>Event Start</label><input type="text" class="start_time"  disabled>
<label>Event End</label><input type="text" class="end_time" disabled>
<br>
<input type="checkbox" class="show" value="1" ><label>Show To All</label>
<input type="hidden" class="event_type" >
<input type="hidden" class="event_id" >
<label></label>
					<button id="delete_reason" class="btn btn-danger">Delete This Event</button>
					</div>
			</div>
			<div class="modal-footer">
				<button id="close_reason1" class="btn " data-dismiss="modal">Close</button>
				<button id="save_reason1" class="btn btn-primary">Save</button>
			</div>
		</div>

<div class="modal hide fade" id="myModal_other">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Add Events</h3>
			</div>
			<div class="modal-body">
				<div class="control-group">
					
						<div class="controls">
							<div class="controls">
								
							</div>
							<label class="control-label" for="reason_text">Description</label>
							<textarea id="reason_text" class="input-xlarge focused" type="text"></textarea>


						</div>

<label>Event Start</label><input type="text" class="start_time" disabled>
<label>Event End</label><input type="text" class="end_time"disabled >
<br>
<input type="checkbox" class="show1" value="1"><label>Show To All</label>
					</div>
			</div>
			<div class="modal-footer">
				<button id="close_reason" class="btn close_event" data-dismiss="modal">Close</button>
				<button id="save_reason" class="btn btn-primary">Save</button>
			</div>
		</div>

<div class="modal hide fade" id="alert">
			
			<div class="modal-body">
				<h3 class="info">Successfully saved</h3>
			</div>
			<div class="modal-footer">
				<button class="btn btn-primary" data-dismiss="modal">OK</button>
				 
			</div>
		</div>
		
		<div class="modal hide fade" id="myModal_view">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>View Events</h3>
			</div>
			<div class="modal-body">
				<div class="control-group">
					<label class="control-label" for="reason_text">Description</label>
						<div class="controls">
							<textarea id="reason_text1" class="input-xlarge focused" type="text" disabled></textarea>
						</div>
<label>Event Start</label><input type="text" class="start_time"  disabled>
<label>Event End</label><input type="text" class="end_time" disabled>

<input type="hidden" class="event_type" >
<input type="hidden" class="event_id" >
<label></label>
		
					</div>
			</div>
			<div class="modal-footer">
				<button  class="btn " data-dismiss="modal">Close</button>
			</div>
		</div>
		
<input type="hidden" id="is_admin" value="<?php echo $this->session->userdata('is_admin');?>">

