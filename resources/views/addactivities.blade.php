@extends('layouts.app')
@section('content')
    
@if(Session::has('msg'))
   <p class="alert alert-warning text-center">{{ Session::get('msg') }}</p>
@endif

<form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="/saveactivies">
 {{ csrf_field() }}
<table class="table table-dponsive table-hover table-bordered table-striped" >
<tr>
<td colspan="4" class="text-center bg-navy">ADD ACTIVITY</td>
<tr>
      	 <td><strong>SELECT A EMPLOYEE *</strong></td>
      	 <td>
      	 	<select class="form-control select2" id="employeeid" name="employeeid">

      	 	<option value="">select a employee</option>

      	 	@foreach($users as $user)

             <option value="{{$user->id}}" title="{{$user->name}}">{{$user->name}}</option>

                 
      	 	@endforeach 
      	 	</select>
      	 </td>
      </tr>
</tr>


    <table class="table table-striped table-bordered display">
		<tr>
		 <td colspan="4" class="text-center bg-primary">ACTIVITY DETAILS</td>
		</tr>
		

	</table>


    <table class="table table-striped table-bordered display" >
		<thead class="bg-navy">
		  <tr style="border:1px,solid,#000;">
			<td>ACTIVITY</td>
			<td>START DATE</td>
			<td>END DATE</td>
			<td>DURATION</td>
			<td>ADD</td>
		  </tr>
		</thead>
		<tbody class="authorslist">

			<tr>
			
			 <td>
			    <select type="text" name="activityid" id="activityid" class="form-control select2"> 
					<option value="">SELECT ACTIVITY</option>
					 @foreach($activities as $key => $activity) 
					 <option value="{{$activity->id}}">{{$activity->activityname}}</option>
					 @endforeach
				</select>
			 </td>
			 <td> <input  id="startdate" class="form-control datepicker chng" readonly></td> 
			 <td> <input  id="enddate" class="form-control datepicker chng"  readonly></td> 
			 <td> <input  id="duration" class="form-control chngdate"></td> 
			 <td><button type="button" id="addnew" class="addauthor btn btn-primary">ADD</button></td>
 
			 
			</tr>
									 
	    </tbody>				
	</table>

    <table class="table table-striped table-bordered display">
		<tr>
		 <td colspan="4" class="text-center bg-primary">ADDED ACTIVITY</td>
		</tr>
		

	</table>
<table class="table table-striped table-bordered display" id="sum_table">
	
		<thead class="bg-navy">
		  <tr class="titlerow">
		    <td>ACTIVITY</td>
			<td>START DATE</td>
			<td>END DATE</td>
			<td>DURATION</td>
			<td>REMOVE</td>
		  </tr>
		</thead>
		<tbody class="addnewrow sortable">
            
			
									 
	    </tbody>	

	    <tfoot>
	    	<tr></tr>
	    	<tr>
	    		
	    		<td></td>
	    		<td></td>
	    		<td>TOTAL DAYS</td>
	    		<td><input type="text" id="totdays" readonly></td>
	    	</tr>
	    </tfoot>			  
</table>
	


	

<tr>
<td colspan="4"><button class="btn btn-success" style="float: right;" onclick="return confirm('Do You Want to proceed?')" type="submit">ADD ACTIVITY</button><a href="/"><button class="btn btn-danger" style="float: left;" type="button" >Cancel</button></a></td>
</tr>

</table>
</form>



<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">CHANGE START DATE</h4>
      </div>
      <div class="modal-body">
        <table class="table table-responsive table-hover table-bordered table-striped">
        	<tr>
        		<input type="hidden" id="stchngid">
        		<td>ENTER START DATE</td>
        		<td><input type="text" class="form-control datepicker" id="modifiedstdate"></td>
        	</tr>
        	<tr>
        		<td><button type="button" onclick="confirmchangestdate();" class="btn btn-success">CHANGE</button></td>
        		
        	</tr>


        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div id="myModal1" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">CHANGE END DATE</h4>
      </div>
      <div class="modal-body">
        <table class="table table-responsive table-hover table-bordered table-striped">
        	<tr>
        		<input type="hidden" id="enchngid">
        		<td>ENTER END DATE</td>
        		<td><input type="text" class="form-control datepicker" id="modifiedendate"></td>
        	</tr>
        	<tr>
        		<td><button type="button" onclick="confirmchangeendate();" class="btn btn-success">CHANGE</button></td>
        		
        	</tr>


        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


  

<script type="text/javascript">

	$("#cost").on("keypress",function(e){
  console.log("Entered Key is " + e.key);
  switch (e.key)
     {
         case "1":
         case "2":
         case "3":
         case "4":
         case "5":
         case "6":
         case "7":
         case "8":
         case "9":
         case "0":
         case "Backspace":
             return true;
             break;

         case ".":
             if ($(this).val().indexOf(".") == -1) //Checking if it already contains decimal. You can Remove this condition if you do not want to include decimals in your input box.
             {
                 return true;
             }
             else
             {
                 return false;
             }
             break;

         default:
             return false;
     }
});
	
	function changeclientname()
	{
	var cn=$( "#clientid option:selected" ).attr("title");
	$("#clientname").val(cn);

	}

$( ".chng" ).change(function() {

var start = $("#startdate").val();
var end = $("#enddate").val();

if(start!='' && end!='')
{
	var startDate = Date.parse(start);
var endDate = Date.parse(end);


var diff = new Date(endDate - startDate);

var days = diff/1000/60/60/24;
$("#duration").val(days);
}


	});

	$( ".getdays" ).change(function() {

var start = $("#sdate").val();
var end = $("#edate").val();

if(start!='' && end!='')
{
	var startDate = Date.parse(start);
var endDate = Date.parse(end);


var diff = new Date(endDate - startDate);

var days = diff/1000/60/60/24;
$("#totprojectdays").val(days);
}


	});




$(".chngdate").bind("keyup change", function(e) {
    // do stuff!
          
           var myDate = $("#startdate").val();
          var days=parseInt($("#duration").val());

          if(myDate!='' && days!='' && days>=0)
          {
          	 date = new Date(myDate);
            next_date = new Date(date.setDate(date.getDate() + days));
            formatted = next_date.getUTCFullYear() + '-' + padNumber(next_date.getUTCMonth() + 1) + '-' + padNumber(next_date.getUTCDate())
            $("#enddate").val(formatted);
          }
          else
          {
          	 $("#enddate").val('');


          }
           
            
       
});
$(".caldate").bind("keyup change", function(e) {
    // do stuff!
          
           var myDate = $("#sdate").val();
          var days=parseInt($("#totprojectdays").val());

          if(myDate!='' && days!='' && days>=0)
          {
          	 date = new Date(myDate);
            next_date = new Date(date.setDate(date.getDate() + days));
            formatted = next_date.getUTCFullYear() + '-' + padNumber(next_date.getUTCMonth() + 1) + '-' + padNumber(next_date.getUTCDate())
            $("#edate").val(formatted);
          }
          else
          {
          	 $("#edate").val('');


          }
           
            
       
});
          

	        
              
           
 function padNumber(number) {
                var string  = '' + number;
                string      = string.length < 2 ? '0' + string : string;
                return string;
            }       

</script>


        <script>
           
            
            
        </script>



<script>
var counter = 0;
var gdtotal = 0;


var count=0;
jQuery('#addnew').click(function(event){
   
	var activityid = jQuery('#activityid').val();
	var activityname=$( "#activityid option:selected" ).text();
	var startdate=$("#startdate").val();
	var enddate=$("#enddate").val();
	var duration=$("#duration").val();
	if(activityid!='' && startdate!='' && enddate!='' && duration!='')
	{
		  
		  event.preventDefault();
    counter++;
    var newRow = jQuery('<tr>'+
    	  
    	'<td>'+activityname+'<input type="hidden" name="activityid[]" value="'+activityid+'"></td>'+
    	  '<td id="st'+(count+1)+'" ondblclick="startdatechange('+(count+1)+')">'+startdate+'<input type="hidden" name="activitystartdate[]" id="s'+(count+1)+'" value="'+startdate+'" class="calcin"/></td>'+
    	  '<td id="en'+(count+1)+'" ondblclick="enddatechange('+(count+1)+')">'+enddate+'<input type="hidden" name="activityenddate[]" id="e'+(count+1)+'" value="'+enddate+'"/></td>'+
    	  '<td id="du'+(count+1)+'">'+duration+'<input type="hidden" name="duration[]" class="countable" value="'+duration+'" class="calcin"/></td>'+
    	  '<td><button type="button" class="btn btn-danger remove_field" onclick="negatefunction('+duration+')" id="'+counter+'">X</button></td></tr>');
    jQuery('.addnewrow').append(newRow);
    count++;
    sumofduration();
   
   
	}
	else
	{
		alert("please add all the Above Detail Correctly")
	}
	
	
}); 
	
 function startdatechange(id)
 {
 	 
    $("#stchngid").val(id);
   
    $("#myModal").modal('show');

 }
 function enddatechange(id)
 {
      $("#enchngid").val(id);
   
    $("#myModal1").modal('show');
 }


jQuery(".addnewrow").on("click",".remove_field", function(e){ //user click on remove text
e.preventDefault();
jQuery(this).parent('td').parent('tr').remove(); counter--;
	
sumofduration();

});




function confirmchangestdate()
{  
    var stchngid=$("#stchngid").val();
	var modifiedstdate=$("#modifiedstdate").val();

	
	if(stchngid!='' && modifiedstdate!='')
	{
		  var x=modifiedstdate+'<input type="hidden" name="activitystartdate[]" value="'+modifiedstdate+'" id="s'+stchngid+'"class="calcin"/>';
     $("#st"+stchngid).html(x);
        calculateduration(stchngid);
	}
    
	
	$("#myModal").modal('hide');

	
}

function confirmchangeendate()
{
	var enchngid=$("#enchngid").val();
	var modifiedendate=$("#modifiedendate").val();
   
   if(enchngid!='' && modifiedendate!='')
	{
		  var x=modifiedendate+'<input type="hidden" name="activityenddate[]" value="'+modifiedendate+'" id="e'+enchngid+'"class="calcin"/>';
     $("#en"+enchngid).html(x);
        calculateduration(enchngid);
	}
    
	
	$("#myModal1").modal('hide');


}

function calculateduration(id)
 {
 	  
 	
var start = $("#s"+id).val();
var end = $("#e"+id).val();



if(start!='' && end!='')
{
	var startDate = Date.parse(start);
var endDate = Date.parse(end);


var diff = new Date(endDate - startDate);

var days = diff/1000/60/60/24;
$("#du"+id).html(days+'<input type="hidden" name="duration[]" class="countable" value="'+days+'" class="calcin"/>');
 }
 sumofduration();
}


function sumofduration()
{

     var totals = 0;
    $('.countable').each(function (index, element) {
        totals = totals + parseFloat($(element).val());
    });
   
    $("#totdays").val(totals);

   
}
</script>






@endsection


