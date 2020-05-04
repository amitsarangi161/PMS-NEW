@extends('layouts.tender')
@section('content')
@inject('provider', 'App\Http\Controllers\TenderController')
<style type="text/css">
    .b {
    white-space: nowrap; 
    width: 120px; 
    overflow: hidden;
    text-overflow: ellipsis; 
   
}

</style>
<table class="table">
	<tr class="bg-navy">
		<td class="text-center">ADMIN APPROVED TENDERS</td>
		
	</tr>
</table>
<div class="table-responsive">
<table class="table table-responsive table-hover table-bordered table-striped datatablescroll">
	<thead>
		<tr class="bg-blue">
			<td>ID</td>
			<td>NAME OF WORK</td>
			<td>CLIENT</td>
			<td>SOURCE</td>
			<td>WORK VALUE</td>
			<td>NIT PUBLICATION DATE</td>
			<td>LAST DATE OF SUB.</td>
			<td>RFP AVAILABLE DATE</td>
			<td>CREATED AT</td>
			<td>STATUS</td>
      <td>AUTHOR</td>
			<td>VIEW</td>
			
		</tr>
	</thead>
	<tbody>
		@foreach($tenders as $tender)
		   
           
		   <tr>
		   	<td><a href="/viewadminapprovedtender/{{$tender->id}}" class="btn btn-info">{{$tender->id}}</a></td>
		   	<td><p class="b" title="{{$tender->nameofthework}}">{{$tender->nameofthework}}</p></td>
		   	<td>{{$tender->clientname}}</td>
		   	<td>{{$tender->source}}</td>
		   	<td>{{$tender->workvalue}}</td>
		  <td data-sort="{{strtotime($tender->nitpublicationdate)}}">{{$provider::changedateformat($tender->nitpublicationdate)}}</td>
		   	<td data-sort="{{strtotime($tender->lastdateofsubmisssion)}}">{{$provider::changedateformat($tender->lastdateofsubmisssion)}}</td>
		   	<td data-sort="{{strtotime($tender->rfpavailabledate)}}">{{$provider::changedateformat($tender->rfpavailabledate)}}</td>
		   	<td data-sort="{{strtotime($tender->created_at)}}">{{$provider::changedatetimeformat($tender->created_at)}}</td>
		   	<td>
		   		<select id="status" onchange="changestatus(this.value,'{{$tender->id}}')">
		   			<option value="ADMIN APPROVED">Select a option</option>
		   			<option value="APPLIED">APPLIED</option>
		   			<option value="NOT APPLIED">NOT APPLIED</option>
		   		</select>
		   	</td>
        <td>{{$tender->name}}</td>
		   	<td><a href="/viewadminapprovedtender/{{$tender->id}}" class="btn btn-info">VIEW</a></td>
		   	
		   </tr>

		@endforeach
	</tbody>
</table>
</div>

  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align: center;font-weight: bold;color: gray;">Describe Why this Tender not Applied ?</h4>
        </div>
        <div class="modal-body">
            <table class="table">
            	<tr>
            		<input type="hidden" id="tid">
            		<td><strong>Description</strong></td>
            		<td>
            			<textarea id="description" class="form-control"></textarea>
            		</td>
            		<td>
            			<button type="button" onclick="savestatus();" class="btn btn-danger">Submit</button>
            		</td>
            	</tr>
            	
            </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">

	function savestatus()
	{
       var tid=$("#tid").val();
       var description=$("#description").val();
       var status="NOT APPLIED";

       if(tid!='' && description!='' && status!='')
          callajax(status,tid,description);
        else
         alert("Description can't be blank");

	}
	function changestatus(value,id)
    { 


         if (value=='APPLIED') {
         	var r = confirm("Do You Want to chnage status to "+ value +"?");
              if (r == true) {
              	callajax(value,id);
              }

         }

         else if(value=='NOT APPLIED')
         {

         	$("#myModal").modal('show');
         	$("#tid").val(id);
         }
         else
         {

         }
       
} 


function callajax(value,id,description='')
{
	$.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });

           $.ajax({
               type:'POST',
              
               url:'{{url("/ajaxchangetenderstatus")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                     status:value,
                     id:id,
                     description:description,
                     
                     },

               success:function(data) { 
                    window.location.reload();
               }
               
             });
}
</script>
@endsection