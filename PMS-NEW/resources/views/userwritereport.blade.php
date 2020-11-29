@extends('layouts.app')
@section('content')
<form action="/saveuserreport" method="post">
  {{csrf_field()}}
<table class="table table-responsive table-hover table-bordered table-striped">
  <thead>
  <tr class="bg-primary">
    <td class="text-center">WRITE PROJECT REPORT</td>
  </tr>
  </thead>
</table>
<table class="table table-responsive table-hover table-bordered table-striped">

  <thead>
    <tr>
      <td>Report For Date</td>
      <td>
        <input type="text" name="reportfordate" class="form-control datepicker4 readonly" placeholder="select a date" required="">
      </td>
    </tr>
    

    <tr>
      <td>SELECT PROJECT NAME</td>
      <td>
        
        <select class="form-control select2" name="projectid" id="projectid" required onchange="getactivities();">
         <option value="">select a project</option>
          @foreach($projects as $project)
             <option value="{{$project->id}}" mytag="{{$project->clientid}}" title="{{$project->orgname}}">{{$project->projectname}}</option>
           @endforeach
        </select>
      </td>
    </tr>


    <tr>
      <td>SELECT CLIENT</td>
      <td>
        
        <select class="form-control select2" name="clientid" id="clientid"  readonly required>
        
          
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
       <input type="text" class="form-control" name="subject" placeholder="Enter Report Subject" required>
      </td>
      </tr>
      <tr>
        <td>DESCRIPTION</td>
        <td>
                <div class="box">
            <div class="box-body pad">
             
                <textarea class="textarea" type="text" name="description" required placeholder="Place some text here"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
             
            </div>
          </div>
          </td>
      </tr>
      <tr>
         <td colspan="2" style="text-align: right;"><button type="submit" class="btn btn-success">SUBMIT</button></td>
      </tr>
     

  </thead>

</table>

</form>
<script type="text/javascript">
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
     $("#clientid").empty();
     var projectid=$("#projectid").val();

     if(projectid!='')
     {
         var cn=$("#projectid option:selected" ).attr("title");
         var ci=$("#projectid option:selected" ).attr("mytag");
            $("#clientid").append('<option value="'+ci+'" selected>'+cn+'</option>');
     }
     else
     {
        

         $("#clientid").empty();
     }
    
   

    
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
                   var x='<option value="">Select a Activity</option>'
                   $.each(data,function(key,value){
                   var y= '<option value="'+value.activityid+'">'+value.activityname+'</option>'
                   x=x+y;
                      
                   });
                   
                    $("#activitiyid").html(x);
               }
             });
    
      


  }
</script>
@endsection