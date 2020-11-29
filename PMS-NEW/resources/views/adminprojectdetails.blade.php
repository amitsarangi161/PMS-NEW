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
.text-sm{letter-spacing: .5px;}

mark { 
  background-color: yellow;
  color: black;
  padding-left: 5px;
  padding-right: 5px;
}
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
                  
                    <div class="col-md-5">
                        <p class="text-muted text-sm"><b>WORK ORDER NO: </b> <mark>{{$project->workorderno}}</mark></p>
                    </div>
                    <div class="col-md-5">
                        <p class="text-muted text-sm"><b>ESTIMATE NO: </b> {{$project->estimateno}}</p>
                    </div>
                    <div class="col-md-5">
                        <p class="text-muted text-sm"><b>CLIENT NAME: </b> {{$project->clientname}}</p>
                    </div>
                    <div class="col-md-5">
                       <p class="text-muted text-sm"><b>DISTRICT NAME: </b> {{$project->districtname}}</p>
                    </div>
                  
                    <div class="col-md-5">
                      <p class="text-muted text-sm"><b>DIVISION NAME: </b> {{$project->divisionname}}</p>
                    </div>
                    <div class="col-md-5">
                      <p class="text-muted text-sm"><b>SCHEME NAME: </b> {{$project->schemename}}</p>
                    </div>
                    <div class="col-md-5">
                         <p class="text-muted text-sm"><b>PROJECT NAME: </b> {{$project->projectname}}</p>
                    </div>
                    <div class="col-md-5">
                      <p class="text-muted text-sm"><b>PROJECT COST: </b> {{$project->cost}}</p>
                    </div>
                    <div class="col-md-5">
                      <p class="text-muted text-sm"><b>PRIORITY: </b> {{$project->priority}}</p>
                    </div>
                    <div class="col-md-5">
                       <p class="text-muted text-sm"><b>PAPER COST: </b> {{$project->papercost}}</p>
                    </div>
                    <div class="col-md-5">
                       <p class="text-muted text-sm"><b>LOA NUMBER: </b> {{$project->loano}}</p>
                    </div>
                    <div class="col-md-5">
                      <p class="text-muted text-sm"><b>AGREEMENT NUMBER: </b> {{$project->agreementno}}</p>
                    </div>
                    <div class="col-md-5">
                      <p class="text-muted text-sm"><b>DATE OF COMMENCEMENT: </b> {{$project->startdate}}</p>
                    </div>
                    <div class="col-md-5">
                       <p class="text-muted text-sm"><b>DATE OF COMPLETION: </b> {{$project->enddate}}</p>
                    </div>
                    <div class="col-md-5">
                       <p class="text-muted text-sm"><b>ISD DATE: </b> {{$project->isddate}}</p>
                    </div>
                    <div class="col-md-5">
                       <p class="text-muted text-sm"><b>ISD VALID UPTO: </b> {{$project->isdvalidupto}}</p>
                    </div>
                    <div class="col-md-5">
                      <p class="text-muted text-sm"><b>ISD AMOUNT: </b> {{$project->isdamount}}</p>
                    </div>
                    <div class="col-md-5">
                      <p class="text-muted text-sm"><b>EMD DATE: </b> {{$project->emddate}}</p>
                    </div>
                    <div class="col-md-5">
                      <p class="text-muted text-sm"><b>EMD VALID UPTO: </b> {{$project->emdvalidupto}}</p>
                    </div>
                    <div class="col-md-5">
                      <p class="text-muted text-sm"><b>EMD AMOUNT: </b> {{$project->emdamount}}</p>
                    </div>
                    <div class="col-md-5">
                      <p class="text-muted text-sm"><b>APS DATE: </b> {{$project->apsdate}}</p>
                    </div>
                    <div class="col-md-5">
                      <p class="text-muted text-sm"><b>APS VALID UPTO: </b> {{$project->apsvalidupto}}</p>
                    </div>
                    <div class="col-md-5">
                      <p class="text-muted text-sm"><b>APS AMOUNT: </b> {{$project->apsamount}}</p>
                    </div>
                    <div class="col-md-5">
                      <p class="text-muted text-sm"><b>BG DATE: </b> {{$project->bgdate}}</p>
                    </div>
                    <div class="col-md-5">
                      <p class="text-muted text-sm"><b>BG VALID UPTO: </b> {{$project->bgvalidupto}}</p>
                    </div>
                    <div class="col-md-5">
                      <p class="text-muted text-sm"><b>BG AMOUNT: </b> {{$project->bgamount}}</p>
                    </div>
                    <div class="col-md-5">
                      <p class="text-muted text-sm"><b>DD DATE: </b> {{$project->dddate}}</p>
                    </div>
                    <div class="col-md-5">
                      <p class="text-muted text-sm"><b>DD VALID UPTO: </b> {{$project->ddvalidupto}}</p>
                    </div>
                    <div class="col-md-5">
                      <p class="text-muted text-sm"><b>DD AMOUNT: </b> {{$project->ddamount}}</p>
                    </div>
                  </div>
               </div>  
                <div class="panel panel-primary">
               <div class="panel-heading">
                    PROJECT DOCUMENTS
                  </div>
                  <div class="panel-body prdetails">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="row">
                        <div class="col-md-4">
                          <p class="text-muted text-sm"><b>Order Form: </b> </p>
                        </div>
                        <div class="col-md-8">
                          <a href="{{asset('/img/orderform/'.$project->orderform)}}" target="_blank">
                            <img style="height: 40px;width: 40px;" src="{{asset('/img/orderform/'.$project->orderform)}}" alt="click to view">
                          </a>
                          <a href="{{asset('/img/orderform/'.$project->orderform)}}" class="btn btn-primary btn-sm" download>
                           <span class="glyphicon glyphicon-download-alt"></span> Download
                           </a>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="row">
                        <div class="col-md-4">
                          <p class="text-muted text-sm"><b>Paper Cost: </b> </p>
                        </div>
                        <div class="col-md-8">
                          <a href="{{asset('/img/papercost/'.$project->papercostattachment)}}" target="_blank">
                            <img style="height: 40px;width: 40px;" src="{{asset('/img/papercost/'.$project->papercostattachment)}}" alt="click to view">
                          </a>
                          <a href="{{asset('/img/papercost/'.$project->papercostattachment)}}" class="btn btn-primary btn-sm" download>
                           <span class="glyphicon glyphicon-download-alt"></span> Download
                           </a>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="row">
                        <div class="col-md-4">
                          <p class="text-muted text-sm"><b>MOM: </b> </p>
                        </div>
                        <div class="col-md-8">
                          <a href="{{asset('/img/momattach/'.$project->momattach)}}" target="_blank">
                            <img style="height: 40px;width: 40px;" src="{{asset('/img/momattach/'.$project->momattach)}}" alt="click to view">
                          </a>
                          <a href="{{asset('/img/momattach/'.$project->momattach)}}" class="btn btn-primary btn-sm" download>
                           <span class="glyphicon glyphicon-download-alt"></span> Download
                           </a>
                        </div>
                      </div>
                    </div>          
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="row">
                        <div class="col-md-4">
                          <p class="text-muted text-sm"><b>PO Order: </b> </p>
                        </div>
                        <div class="col-md-8">
                          <a href="{{asset('/img/podattach/'.$project->podattach)}}" target="_blank">
                            <img style="height: 40px;width: 40px;" src="{{asset('/img/podattach/'.$project->podattach)}}" alt="click to view">
                          </a>
                          <a href="{{asset('/img/podattach/'.$project->podattach)}}" class="btn btn-primary btn-sm" download>
                           <span class="glyphicon glyphicon-download-alt"></span> Download
                           </a>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="row">
                        <div class="col-md-4">
                          <p class="text-muted text-sm"><b>ISD: </b> </p>
                        </div>
                        <div class="col-md-8">
                          <a href="{{asset('/img/isdattach/'.$project->isdattachment)}}" target="_blank">
                            <img style="height: 40px;width: 40px;" src="{{asset('/img/isdattach/'.$project->isdattachment)}}" alt="click to view">
                          </a>
                          <a href="{{asset('/img/isdattach/'.$project->isdattachment)}}" class="btn btn-primary btn-sm" download>
                           <span class="glyphicon glyphicon-download-alt"></span> Download
                           </a>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="row">
                        <div class="col-md-4">
                          <p class="text-muted text-sm"><b>EMD Form: </b> </p>
                        </div>
                        <div class="col-md-8">
                          <a href="{{asset('/img/emdattach/'.$project->emdattachment)}}" target="_blank">
                            <img style="height: 40px;width: 40px;" src="{{asset('/img/emdattach/'.$project->emdattachment)}}" alt="click to view">
                          </a>
                          <a href="{{asset('/img/emdattach/'.$project->emdattachment)}}" class="btn btn-primary btn-sm" download>
                           <span class="glyphicon glyphicon-download-alt"></span> Download
                           </a>
                        </div>
                      </div>
                    </div>          
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="row">
                        <div class="col-md-4">
                          <p class="text-muted text-sm"><b>APS: </b> </p>
                        </div>
                        <div class="col-md-8">
                          <a href="{{asset('/img/apsattach/'.$project->apsattachment)}}" target="_blank">
                            <img style="height: 40px;width: 40px;" src="{{asset('/img/apsattach/'.$project->apsattachment)}}" alt="click to view">
                          </a>
                          <a href="{{asset('/img/apsattach/'.$project->apsattachment)}}" class="btn btn-primary btn-sm" download>
                           <span class="glyphicon glyphicon-download-alt"></span> Download
                           </a>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="row">
                        <div class="col-md-4">
                          <p class="text-muted text-sm"><b>BG DETAILS: </b> </p>
                        </div>
                        <div class="col-md-8">
                          <a href="{{asset('/img/bgattach/'.$project->bgattachment)}}" target="_blank">
                            <img style="height: 40px;width: 40px;" src="{{asset('/img/bgattach/'.$project->bgattachment)}}" alt="click to view">
                          </a>
                          <a href="{{asset('/img/bgattach/'.$project->bgattachment)}}" class="btn btn-primary btn-sm" download>
                           <span class="glyphicon glyphicon-download-alt"></span> Download
                           </a>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="row">
                        <div class="col-md-4">
                          <p class="text-muted text-sm"><b>Demand Draft: </b> </p>
                        </div>
                        <div class="col-md-8">
                          <a href="{{asset('/img/ddattach/'.$project->ddattachment)}}" target="_blank">
                            <img style="height: 40px;width: 40px;" src="{{asset('/img/ddattach/'.$project->ddattachment)}}" alt="click to view">
                          </a>
                          <a href="{{asset('/img/ddattach/'.$project->ddattachment)}}" class="btn btn-primary btn-sm" download>
                           <span class="glyphicon glyphicon-download-alt"></span> Download
                           </a>
                        </div>
                      </div>
                    </div>          
                  </div>
                  
                  <div class="row">
                    @foreach($projectotherdocuments as $projectotherdocument)
                    <div class="col-md-4">
                      <div class="row">
                        <div class="col-md-4">
                          <p class="text-muted text-sm"><b>{{$projectotherdocument->documentname}}: </b> </p>
                        </div>
                        <div class="col-md-8">
                          <a href="{{asset('/image/projectotherdocument/'.$projectotherdocument->documentname)}}" target="_blank">
                            <img style="height: 40px;width: 40px;" src="{{asset('/image/projectotherdocument/'.$projectotherdocument->document)}}" alt="click to view">
                          </a>
                          <a href="{{asset('/image/projectotherdocument/'.$projectotherdocument->document)}}" class="btn btn-primary btn-sm" download>
                           <span class="glyphicon glyphicon-download-alt"></span> Download
                           </a>
                        </div>
                      </div>
                    </div>
                    @endforeach
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