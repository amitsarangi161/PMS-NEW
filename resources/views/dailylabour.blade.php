@extends('layouts.app')
@section('content')

@if(Session::has('msg'))
   <p class="alert alert-info text-center"><b>{{ Session::get('msg') }}</b></p>
@endif
<table class="table table-responsive table-hover table-bordered table-striped">
 	<tr class="bg-navy">
       <td class="text-center">ENGAGE LABOUR</td>		
 	</tr>
	
</table>
<form action="/savedailylabour" method="POST" enctype="multipart/form-data">
	{{csrf_field()}}

 <table class="table table-responsive table-hover table-bordered table-striped">
 

 
 </table>
 <table class="table table-responsive table-hover table-bordered table-striped">
 	<thead>
  <tr>
    <td><strong>SELECT A PROJECT</strong></td>
    <td>
      <select class="form-control select2" name="projectid" required="">
        <option value="">select a project</option>
        @foreach($projects as $project)
        <option value="{{$project->id}}">{{$project->projectname}}</option>
        @endforeach
      </select>
    </td>
  </tr>
 	<tr>
 		<td><strong>DATE *</strong></td>
 		<td><input type="text" name="date" class="form-control datepicker5 readonly" required=""></td>
 	</tr>
 	<tr>
 		<td><strong>SELECT A LABOUR</strong></td>
 		<td>
 			<select class="form-control" id="labour">
 				<option value="">Select a Labour</option>
 				@foreach($labours as $labour)
                     <option id="selectedid{{$labour->id}}" value="{{$labour->id}}">{{$labour->labourname}}</option>
 				@endforeach
 			</select>
       <p style="color: red;">* Note: Add Multiple labour Then save</p>
 		</td>
 		<td>
 			<button type="button" id="addnew" class="addauthor btn btn-primary">ADD</button>

 		</td>

 	</tr>
 	</thead>

 	<tbody class="addnewrow">
 		
 	</thead>

 	 	<tfoot>
 		<tr>
 			<td><strong>ATTACHMENT *</strong></td>
			<td><input type="file" name="workingimage" required=""></td>
 		</tr>
 		<tr>
 			<td><strong>DESCRIPTION *</strong></td>
 			<td><textarea class="form-control" placeholder="Enter Work Description..." name="description" required=""></textarea></td>
 		</tr>
 		<tr>
 			<td><button class="btn btn-success" type="submit">SUBMIT</button></td>
 		</tr>
 	</tfoot>


 </table>
 </form>

 <script>

var counter = 0;
var gdtotal = 0;


var count=0;
jQuery('#addnew').click(function(event){
   
	var labourid = jQuery('#labour').val();
	var labourname=$("#labour option:selected" ).text();
	
	if(labourid!='')
	{
  
    event.preventDefault();
    counter++;
    var newRow = jQuery('<tr style="background-color: aqua;">'+
    	'<td>'+counter+'</td>'+
    	'<td>'+labourname+'<input type="hidden" name="labour[]" value="'+labourid+'"></td>'+

    	'<td><button type="button" onclick="removerow('+labourid+')" class="btn btn-danger remove_field">X</button></td></tr>');

   
    jQuery('.addnewrow').append(newRow);
    count++;
   var sel="#selectedid"+labourid;
   $(sel).attr('disabled','disabled');
   $(sel).attr('title','Already added');
   $(sel).css("color","red");
    
 
   
	}
	else
	{
		alert("please add all the Above Detail Correctly")
	}
	
	
}); 


jQuery(".addnewrow").on("click",".remove_field", function(e){ //user click on remove text
e.preventDefault();
jQuery(this).parent('td').parent('tr').remove();
});

function removerow(id)
{
    var sel="#selectedid"+id;
   $(sel).removeAttr('disabled','disabled');
   $(sel).removeAttr('title','Already added');
   $(sel).css("color","");

}
</script>
@endsection