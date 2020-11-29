@extends('layouts.tender')
@section('content')
@inject('provider', 'App\Http\Controllers\TenderController')
@inject('tend', 'App\Http\Controllers\AccountController')
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
		<td class="text-center">TENDER ASSIGNED TO APPLY</td>
		
	</tr>
</table>
<div class="table-responsive">
<table class="table table-responsive table-hover table-bordered table-striped yajratable">
	<thead>
		<tr class="bg-blue">
			<td>ID</td>
			<td>NAME OF WORK</td>
			<td>CLIENT</td>
      <td>LOCATION</td>
			<td>SOURCE</td>
			<td>WORK VALUE</td>
			<td>NIT PUBLICATION DATE</td>
			<td>LAST DATE OF SUB.</td>
			<td>RFP AVAILABLE DATE</td>
      <td>EMD AMT</td>
			<td>CREATED AT</td>
			<td>STATUS</td>
      <td>AUTHOR</td>
			<td>VIEW</td>
			
		</tr>
	</thead>
	<tbody>
		
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
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
  var table = $('.yajratable').DataTable({
        order: [[ 7, "asc" ]],
        processing: true, 
        serverSide: true,
        "scrollY": 450,
        "scrollX": true,
        "iDisplayLength": 25,
          ajax: {
            url: '{{ url("getassignedtendersofficelist")  }}',
        },
        columns: [

            {data: 'idbtn', name: 'id'},
            {data: 'now',name: 'nameofthework'},
            {data: 'clientname', name: 'clientname'},
            {data: 'location', name: 'location'},
            {data: 'source', name: 'source'},
            {data: 'workvalue', name: 'workvalue'},
            {data: 'nitpublicationdate', name: 'nitpublicationdate'},
            {data: 'ldos', name: 'lastdateofsubmisssion'},
            {data: 'rfpavailabledate', name:'rfpavailabledate'},    
            {data: 'emdamount', name:'emdamount'},    
            {name: 'created_at',data: 'created_at'},
            {data: 'status', name: 'status'},
            {data: 'name', name: 'users.name'},
            {data: 'view', name: 'view'},
                      

          

        ]

    });
</script>
@endsection