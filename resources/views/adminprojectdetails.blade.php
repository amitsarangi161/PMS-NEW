@extends('layouts.app')
@section('content')
<style type="text/css">
  .select2-selection__choice {

    background-color: #134b86!important;
    border: 1px solid #134b86!important;
    border-radius: 2px!important;
}
.fa-times{
  cursor: pointer;
  color: red;
}
.prdetails label{font-size: 12px;letter-spacing: .7px;}
.prdetails .form-control{font-size: 12px;height: 30px;letter-spacing: .7px;}
</style>

<div class="row">
          <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs text-center">
              <li class="active"><a href="#projectdetails" data-toggle="tab"><i class="fa fa-th"></i> Project Details</a></li>
              <li><a href="#assignproject" data-toggle="tab">
                <i class="fa fa-users" ></i> Assign Project</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="projectdetails">
                <div class="panel panel-primary">
                  <div class="panel-heading">
                    PROJECT DETAILS
                  </div>
                  <div class="panel-body prdetails">                    
                  
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>CLIENT NAME</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" value="{{$project->clientname}}" placeholder="Enter email">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">DISTRICT NAME</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" value="{{$project->districtname}}" placeholder="Enter email">
                      </div>
                    </div>
                  
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">DIVISION NAME</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" value="{{$project->divisionname}}" placeholder="Enter email">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">PROJECT NAME</label>
                        <input type="email" class="form-control" id="exampleInputEmail1"value="{{$project->projectname}}" placeholder="Enter email">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">PROJECT COST</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" value="{{$project->cost}}" placeholder="Enter email">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">PRIORITY</label>
                        <input type="email" class="form-control" id="exampleInputEmail1"value="{{$project->priority}}" placeholder="Enter email">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">PAPER COST</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" value="{{$project->papercost}}" placeholder="Enter email">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">LOA NUMBER</label>
                        <input type="email" class="form-control" id="exampleInputEmail1"value="{{$project->loano}}" placeholder="Enter email">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">AGREEMENT NUMBER</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" value="{{$project->agreementno}}" placeholder="Enter email">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">DATE OF COMMENCEMENT </label>
                        <input type="email" class="form-control" id="exampleInputEmail1"value="{{$project->startdate}}" placeholder="Enter email">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">DATE OF COMPLETION</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" value="{{$project->enddate}}" placeholder="Enter email">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">ISD DATE </label>
                        <input type="email" class="form-control" id="exampleInputEmail1"value="{{$project->isddate}}" placeholder="Enter email">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">ISD VALID UPTO</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" value="{{$project->isdvalidupto}}" placeholder="Enter email">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">ISD AMOUNT</label>
                        <input type="email" class="form-control" id="exampleInputEmail1"value="{{$project->isdamount}}" placeholder="Enter email">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">EMD DATE</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" value="{{$project->emddate}}" placeholder="Enter email">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">EMD VALID UPTO </label>
                        <input type="email" class="form-control" id="exampleInputEmail1"value="{{$project->emdvalidupto}}" placeholder="Enter email">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">EMD AMOUNT</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" value="{{$project->emdamount}}" placeholder="Enter email">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">APS DATE</label>
                        <input type="email" class="form-control" id="exampleInputEmail1"value="{{$project->apsdate}}" placeholder="Enter email">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">APS VALID UPTO</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" value="{{$project->apsvalidupto}}" placeholder="Enter email">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">APS AMOUNT</label>
                        <input type="email" class="form-control" id="exampleInputEmail1"value="{{$project->apsamount}}" placeholder="Enter email">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">BG DATE</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" value="{{$project->bgdate}}" placeholder="Enter email">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">BG VALID UPTO</label>
                        <input type="email" class="form-control" id="exampleInputEmail1"value="{{$project->bgvalidupto}}" placeholder="Enter email">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">BG AMOUNT</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" value="{{$project->bgamount}}" placeholder="Enter email">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">DD DATE</label>
                        <input type="email" class="form-control" id="exampleInputEmail1"value="{{$project->dddate}}" placeholder="Enter email">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">DD VALID UPTO</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" value="{{$project->ddvalidupto}}" placeholder="Enter email">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">DD AMOUNT</label>
                        <input type="email" class="form-control" id="exampleInputEmail1"value="{{$project->ddamount}}" placeholder="Enter email">
                      </div>
                    </div>
                  </div>
               </div>            
            </div>
              <div class="tab-pane" id="assignproject">
                <div class="panel panel-primary">
                  <div class="panel-heading">
                    ASSIGN PROJECT TO USER
                  </div>
                  <div class="panel-body">
                    
                      <div class="box-body">
                        <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                <label  class="col-sm-4 control-label">Project Name</label>

                              <div class="col-sm-8">
                                <input type="hidden"  class="form-control" value="{{$project->id}}" name="project_id" id="projectid">
                                <input type="text"  class="form-control" value="{{$project->projectname}}" disabled="">
                              </div>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                <label  class="col-sm-4 control-label">Select  User</label>

                              <div class="col-sm-8">
                                <select name="employee_id" required="" class="form-control select2" style="width: 100%;"  multiple="multiple" data-placeholder="Select User" id="empid">
                                @foreach($users as $user)
                                  <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                                </select>
                              </div>
                              </div>
                          <div class="col-md-12" style="margin-top: 10px;">
                              <button type="button" class="btn btn-success btn-flat pull-right" onclick="confirm('Are you want to assign this employee to this project');assignprojecttouser();">Assign Usre</button>                              
                          </div>
                          </div>
                        </div>
                      </div>
                  </div>
               </div>
               <div class="panel panel-primary">
                 <div class="panel-heading">
                    ALL ASSIGN USERS 
                  </div>
                  <div class="panel-body">
                    <div class="box-body table-responsive">
                      <table class="table table-bordered  datatable">
                        <thead class="bg-navy">
                          <tr>
                            <th class="col-md-3">Sl. No</th>
                            <th class="col-md-3">Employee Name</th>
                            <th class="col-md-1">Action</th>
                          </tr>
                        </thead>
                        <tbody id="fetch_userlist">
                          
                        </tbody>
                      </table>
                    </div>
                  </div>

               </div>
              </div>
              </div>
              </div>
            </div>
          </div>
        
</div>
<script type="text/javascript">
   assignuserlist();
function assignuserlist(){
  var projectid=$('#projectid').val();
   $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });
        $.ajax({
               type:'POST',
              
               url:'{{url("/ajaxassignuserlist")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                      projectid: projectid,
                     },

               success:function(data) {
                $('#fetch_userlist').empty();
                 $.each(data,function(key,value){
                  var userlist='<tr>' +
                                '<td class="col-md-3">' + (++key) +'</td>'+
                                '<td class="col-md-3">' + value.name+'</td>'+
                                '<td class="col-md-1"><i class="fa fa-times" onclick="removeassignuser('+value.id+');"></i></td>'+
                                '</tr>';
                $('#fetch_userlist').append(userlist); 
            });
                }
    });
}
function assignprojecttouser(){
var projectid=$('#projectid').val();
var empid=$('#empid').val();
   $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });
        $.ajax({
               type:'POST',
              
               url:'{{url("/ajaxassignprojecttouser")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                      projectid: projectid,
                      empid: empid,
                     },

               success:function(data) { 
                assignuserlist();

                }
    });
}

function removeassignuser(id){
var x=confirm('Do you want to remove this employee?');
if(x){
     $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });
        $.ajax({
               type:'POST',
              
               url:'{{url("/ajaxremoveassignuser")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                      id: id,
                     },

               success:function(data) { 
                assignuserlist();

                }
    });
}

}


   function openverifymodal(id) {
       //alert(id);
       $("#reportid").val(id);
       $("#myModal").modal('show');
   }
</script>


@endsection