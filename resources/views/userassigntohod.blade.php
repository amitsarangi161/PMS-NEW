@extends('layouts.app')

@section('content')

<table class="table table-responsive table-hover table-bordered table-striped" >
        <tr>
            <td colspan="4" class="text-center bg-navy">ASSIGN USER TO HOD</td>
        </tr>
        <tr>
            <td><strong>SELECT A HOD</strong><span style="color: red"> *</span></td>
            <td>
            	<select id="hod" class="form-control select2" onchange="fetchusersunderhod();">
                        <option value="">Select a HOD</option>
            		@foreach($hods as $hod)

                       <option value="{{$hod->id}}">{{$hod->name}}</option>

                       
            		@endforeach
            		
            	</select>

            </td>
          
        </tr>
   
</table>


<table id="table" class="table table-responsive table-hover table-bordered table-striped" style="display: none;">
	<thead>
		<tr class="bg-primary">
			<td colspan="5" class="text-center"><button onclick="addnewmemberunderhod();" class="btn btn-warning">ADD A NEW MEMBER</button></td>
		</tr>
	</thead>
	<thead>
		<tr class="bg-navy">
			<td>ID</td>
      <td>EMPLOYEE NAME</td>
			<td>REMOVE</td>

		</tr>
	</thead>
	<tbody id="tbody">
		
	</tbody>
	
</table>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center">ADD NEW MEMBER UNDER HOD</h4>
      </div>
      <div class="modal-body">
       <table class="table">
        <tr>
          <td><strong>SELECT A USER</strong></td>
          <td>
            <select class="form-control select2" id="user">
              <option value="">Select a user</option>
              @foreach($users as $user)
               <option value="{{$user->id}}">{{$user->name}}</option>

              @endforeach
              
            </select>
          </td>
          <td>
            <button class="btn btn-success" onclick="newuseraddunderhod()" type="button">ADD</button>
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
<script type="text/javascript">
  function fetchusersunderhod()
  {
    
   var hodid=$("#hod").val();
    if(hodid!='')
    {

    
                $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });
              

              $.ajax({
               type:'POST',
              
               url:'{{url("/ajaxgetusersunderhod")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",

                      hodid:hodid

                     },

               success:function(data) { 
                         $("#tbody").empty();
                         //alert(data);
                        $("#table").show();
                     $.each(data,function(key,value){
                        $("#tbody").append('<tr><td>'+value.userid+'</td><td>'+value.name+'</td>'+'</td><td class="text-center"><button type="button" class="btn btn-danger" onclick="removemember('+value.id+');">X</button></td></tr>');
                     });
                 
                }
              });



    }
    else
    {
        $("#table").show();
    }

  }

function addnewmemberunderhod()
{

    $("#myModal").modal('show');
}


function newuseraddunderhod()
{
   var hodid=$("#hod").val();
   var userid=$("#user").val();
   
    if(hodid!='' && userid!=null)
    {

      
                $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });
              

              $.ajax({
               type:'POST',
              
               url:'{{url("/ajaxnewuseraddunderhod")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",

                      hodid:hodid,
                      userid:userid

                     },

               success:function(data) { 
                         
                        $("#myModal").modal('hide');
                      fetchusersunderhod();
                      refreshusers();
                }
              });



    }
    else
    {
          $("#myModal").modal('close');
    }
   

}
  
function removemember(id)
{
   if(id!='')
    {

    
                $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });
              

              $.ajax({
               type:'POST',
              
               url:'{{url("/ajaxremoveuserfromhod")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                      id:id

                     },

               success:function(data) { 
                         
                        $("#myModal").modal('hide');
                      fetchusersunderhod();
                      refreshusers();
                }
              });



    }
   
}

function refreshusers()
{
  var id=3;
                $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });
              

              $.ajax({
               type:'POST',
              
               url:'{{url("/ajaxrefreshusers")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                      id:id

                     },

               success:function(data) { 
                    $("#user").empty();
                     $.each(data,function(key,value){
                        $("#user").append('<option value="'+value.id+'">'+value.name+'</option>');
                     });
                }
              });
}
</script>




@endsection