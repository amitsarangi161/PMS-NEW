@extends('layouts.app')
@section('content')
<form action="/updateuserreport/{{$projectreport->id}}" method="post">
  {{csrf_field()}}
<table class="table table-responsive table-hover table-bordered table-striped">
  <thead>
  <tr class="bg-primary">
    <td class="text-center">UPDATE PROJECT REPORT</td>
  </tr>
  </thead>
</table>
<table class="table table-responsive table-hover table-bordered table-striped">

  <thead>
    <tr>
      <td>Report For Date</td>
      <td>
        <input type="text" name="reportfordate" value="{{$projectreport->reportfordate}}" class="form-control datepicker" placeholder="select a date" required="">
      </td>
    </tr>
    <tr>
      <td>SELECT CLIENT</td>
      <td>
        
        <select class="form-control" name="clientid" id="clientid" required onchange="getprojects();">
          <option value="">Select a Client</option>
          @foreach($clients as $client)
        <option value="{{$client->id}}" {{ ( $client->id == $projectreport->clientid) ? 'selected' : '' }}>{{$client->orgname}}</option>


          @endforeach
          
        </select>
      </td>
    </tr>

    <tr>
      <td>SELECT PROJECT NAME</td>
      <td>
        
        <select class="form-control"  name="projectid" id="projectid" required onchange="getactivities();">
         
          
        </select>
      </td>
    </tr>

        <tr>
      <td>SELECT ACTIVITY NAME</td>
      <td>
        
        <select class="form-control" name="activityid" id="activitiyid" required>
         
          
        </select>
      </td>
    </tr>

      <tr>
      <td>REPORT SUBJECT</td>
      <td>
       <input type="text" value="{{$projectreport->subject}}" class="form-control" name="subject" placeholder="Enter Report Subject" required>
      </td>
      </tr>
      <tr>
        <td>DESCRIPTION</td>
        <td>
                <div class="box">
            <div class="box-body pad">
             
                <textarea class="textarea" type="text" name="description" required placeholder="Place some text here"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{!! $projectreport->description !!}</textarea>
             
            </div>
          </div>
          </td>
      </tr>
      <tr>
         <td colspan="2" style="text-align: right;"><button type="submit" class="btn btn-success">UPDATE</button></td>
      </tr>
     

  </thead>

</table>

</form>
<script type="text/javascript">
  $(document).ready(function(){
     getprojects();
  });

  function getprojects() {
  var clientid=$("#clientid").val();

  if(clientid!='')
  {

      $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });
              

              $.ajax({
               type:'POST',
              
               url:'{{url("/ajaxgetprojects")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                      clientid: clientid
                      

                     },

               success:function(data) { 
                     $("#projectid").empty();
                   $.each(data,function(key,value){

                       $("#projectid").append('<option value="'+value.id+'">'+value.projectname+'</option>');
                   });
                   
                    getactivities();
               }
             });
  }
  }

  function getactivities()
  {
    
     var projectid=$("#projectid").val();

    
      $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });

        $.ajax({
               type:'POST',
              
               url:'{{url("/ajaxgetactivitiesall")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                      projectid: projectid
                      

                     },

               success:function(data) { 
                   $("#activitiyid").empty();
                   $.each(data,function(key,value){
                       $("#activitiyid").append('<option value="'+value.activityid+'">'+value.activityname+'</option>');
                   });
                   
                   
               }
             });
    
      


  }
</script>
@endsection