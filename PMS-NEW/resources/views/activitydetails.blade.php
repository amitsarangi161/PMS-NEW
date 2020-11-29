@extends('layouts.app')

@section('content')

<table class="table table-responsive table-hover table-bordered table-striped" >
        <tr>
            <td colspan="4" class="text-center bg-navy">ACTIVITY DETAILS</td>
        </tr>
        <tr>
            <td><strong>SELECT A ACTIVITY</strong><span style="color: red"> *</span></td>
            <td>
            	<select id="activity" class="form-control select2" onchange="getdetails();">
                        <option value="">Select a Activity</option>
            		@foreach($activities as $activity)

                       <option value="{{$activity->id}}">{{$activity->activityname}}</option>

                       
            		@endforeach
            		
            	</select>

            </td>
            <td><button type="button" onclick="addanew();" class="btn btn-primary">ADD NEW ACTIVITY</button></td>
        </tr>
   
</table>


<table id="table" class="table table-responsive table-hover table-bordered table-striped" style="display: none;">
	<thead>
		<tr class="bg-primary">
			<td colspan="5" class="text-center"><button onclick="addnewmembertoactivity();" class="btn btn-warning">ADD A NEW MEMBER</button></td>
		</tr>
	</thead>
	<thead>
		<tr class="bg-navy">
			<td>ID</td>
			<td>ACTIVITY NAME</td>
      <td>EMPLOYEE NAME</td>
			<td>USER TYPE</td>
			<td>REMOVE</td>

		</tr>
	</thead>
	<tbody id="tbody">
		
	</tbody>
	
</table>


<!-- modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><b>ADD A ACTIVITY</b></h4>
      </div>
      <div class="modal-body">
        
            <table class="table table-responsive table-hover table-bordered table-striped" >
           <input type="hidden" name="activityid" id="activityid">
        <tr>
            <td colspan="4" class="text-center bg-navy">ADD ACTIVITY</td>
        </tr>
        <tr>
            <td>ACIVITY NAME<span style="color: red"> *</span></td>
            <td><input type="text" class="form-control" autocomplete="off" name="activityname" placeholder="ENTER ACTIVITY NAME" id="activityname" required></td>
        </tr>
        <tr>
            <td>DESCRIPTION <span style="color: red"> *</span></td>
            <td><textarea name="description" id="description" class="form-control" autocomplete="off" placeholder="ENTER DESCRIPTION"></textarea></td>
            
        </tr>
        
        <tr>
            <td></td>
<td colspan="3"><input type="button" onclick="saveactivity();" value="ADD" class="btn btn-success" style="float: right ;"></td>
</tr>
</table>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- Modal -->


<div id="myModal1" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><b>ADD MEMBER</b></h4>
      </div>
      <div class="modal-body">
        
            <table class="table table-responsive table-hover table-bordered table-striped" >
           <input type="hidden" name="activityid" id="activityid">
        <tr>
            <td colspan="4" class="text-center bg-navy">ADD MEMBER</td>
        </tr>
    
        <tr>
            <td>MEMBER<span style="color: red"> *</span></td>
            <td>
            	<select id="members" class="form-control select2">
            	 
                </select>
            </td>
          </tr>
          <tr>
               <td>USER TYPE<span style="color: red"> *</span></td>
             <td>
              <select id="usertype" class="form-control">
               <option value="USER">USER</option>
               <option value="ADMIN">ADMIN</option>
             </select>
           </td>
          </tr>
          
        
        
        <tr>
            <td></td>
<td colspan="3"><input type="button" onclick="assignactivity();" value="ADD" class="btn btn-success" style="float: right ;"></td>
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
	function addanew()
	{
		$("#myModal").modal('show');
	}

	function saveactivity()
	{
		var activityname=$("#activityname").val();
		var description=$("#description").val();

		 $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });

   //var u="business.draquaro.com/api.php?id=9658438020";

           $.ajax({
               type:'POST',
              
               url:'{{url("/ajaxaddactivity")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                      activityname: activityname,
                      description:description

                     },

               success:function(data) { 
                        
                            
                            $('#activity').append('<option value="'+data.id+'">'+data.activityname+'</option>')
                        	alert("Activity added successfully");
                        	$("#myModal").modal('hide');
                        	$("#activityname").val('');
                        	$("#description").val('');

                        
                     
                 
                }
              });


	}

 function getdetails()
	{
            var activityid=$("#activity").val();

    if(activityid!='')
    {
    	  $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });
              

              $.ajax({
               type:'POST',
              
               url:'{{url("/ajaxgetdetails")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                      activityid: activityid
                      

                     },

               success:function(data) { 
                        
                            $("#table").show();
                            $('#tbody').empty();
                           if(data.length>0)
                           {
                                $.each(data,function(key,value){

                                	$('#tbody').append('<tr><td>'+value.id+'</td><td>'+value.activityname+'</td><td>'+value.name+'</td><td>'+value.usertype+'</td><td class="text-center"><button type="button" class="btn btn-danger" onclick="removemember('+value.id+');">X</button></td></tr>');

                                });
                           }
                           else
                           {
                                 $('#tbody').append('<tr><td colspan="4" class="text-center">NO RECORD FOUND</td></tr>');
                           }

                        
                     
                 
                }
              });

    }
    else
    {
    	  $("#table").hide();
    }
           
	}

	function removemember(id)
	{
		//alert(id);
		var x=confirm("Do You Want to Remove this Member?");
		if(x)
		{

             $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });
              

              $.ajax({
               type:'POST',
              
               url:'{{url("/ajaxremovemeberfromactivity")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                      id: id
                      

                     },

               success:function(data) { 
                        
                           
                      getdetails();
                        
                     
                 
                }
              });

		}
	}


	 function getallusers(activityid)
	{


           $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });
              

              $.ajax({
               type:'POST',
              
               url:'{{url("/ajaxallusers")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                      
                      activityid:activityid
                      

                     },

               success:function(data) { 
                $("#members").empty();
               	          $.each(data,function(key,value){
                             $("#members").append('<option value="'+value.id+'">'+value.name+'</option>')
               	          });
                        
                           
                      $('.select2').select2();
                        
                     
                 
                }
              });
	}



	function addnewmembertoactivity()
	{
		var activityid=$("#activity").val();

        getallusers(activityid);
		$("#myModal1").modal('show');



	}

	function assignactivity()
	{
		var activityid=$("#activity").val();
		var member=$("#members").val();
    var usertype=$("#usertype").val();
          $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });
              

              $.ajax({
               type:'POST',
              
               url:'{{url("/ajaxmemberaddtoactivity")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                      
                      activityid:activityid,
                      usertype:usertype,
                      member:member

                     },

               success:function(data) { 
               	         
                        
                          $("#myModal1").modal('hide');

                            getdetails();
                      
                        
                     
                 
                }
              });


	}
</script>

@endsection