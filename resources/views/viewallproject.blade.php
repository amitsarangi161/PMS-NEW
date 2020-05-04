@extends('layouts.app')
@section('content')
@inject('provider', 'App\Http\Controllers\AccountController')
<style type="text/css">
    .b {
    white-space: nowrap; 
    width: 120px; 
    overflow: hidden;
    text-overflow: ellipsis; 
   
}
</style>
@if(Session::has('message'))
<p class="alert alert-success">{{ Session::get('message') }}</p>
@endif
@if(Session::has('msg'))
<p class="alert alert-success">{{ Session::get('msg') }}</p>
@endif
@if(Session::has('error'))
<p class="alert alert-danger">{{ Session::get('error') }}</p>
@endif
@if(count($errors) > 0)
    <div class="alert alert-danger">
     Upload Validation Error<br><br>
     <ul>
      @foreach($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
     </ul>
    </div>
@endif
<h4 class="text-center"><strong>VIEW ALL PROJECTS</strong></h4>

          </a>

  <table class="table">
    <tr>
      <td><a href="/projects/addproject" class="btn btn-success"><i class="fa fa-plus"></i> Add New Project</td>
    <form action="/projects/viewallproject" method="get">
    <td>
      <select class="form-control select2" name="client" required="">
            
            <option value="ALL" {{(Request::get('client')=='ALL')?'selected':''}}>ALL</option>
            @foreach($clients as $client)
            <option value="{{$client->id}}" {{($client->id==Request::get('client'))?'selected':''}}>{{$client->clientname}}</option>
            @endforeach
      </select>
    </td>
    <td>
      <select class="form-control select2" name="status" required="">
             
              <option value="ALL" {{(Request::get('status')=='ALL')?'selected':''}}>ALL</option>
              <option value="COMPLETED" {{(Request::get('status')=='COMPLETED')?'selected':''}}>COMPLETED</option>
              <option value="ASSIGNED" {{(Request::get('status')=='ASSIGNED')?'selected':''}}>ASSIGNED</option>
              <option value="STARTED" {{(Request::get('status')=='STARTED')?'selected':''}}>STARTED</option>
              <option value="ON PROGRESS" {{(Request::get('status')=='ON PROGRESS')?'selected':''}}>ON PROGRESS</option>
              <option value="HALTED" {{(Request::get('status')=='HALTED')?'selected':''}}>HALTED</option>
              
      </select>
  </td>
  <td><button type="submit" class="btn btn-primary">Filter</button></td>
  @if(Request::has('status') ||Request::has('client') )
   <td><a href="/projects/viewallproject" class="btn btn-danger">Clear</a></td>
  @endif
</form>
    </tr>

    
  </table>



    <div style="overflow-x:auto;">
<table class="table table-responsive table-hover table-bordered table-striped datatablescrollexport">
    <thead>
        <tr class="bg-navy" style="font-size: 10px;">
            <th>ID</th>
            <th>CLIENT</th>
            <th>AGREEMENT NO</th>
            <th>PROJECT NAME</th>
            <th>STATUS</th>
            <th>WORKORDER VALUE</th>
            <th>DISTRICT</th>
            <th>DIVISION</th> 
            <th>DATE OF COMMENCEMENT</th> 
             <th>END DATE</th>
            <th>EMD DATE</th>
            <th>EMD AMOUNT</th>
            <th>ISD DATE</th>
             <th>ISD AMOUNT</th>
            <th>PAPER COST</th>
          
        
            <th>PRIORITY</th>
            <th>PO DATE</th>
            <th>PO NUMBER</th>
            
            <th>ISD VALID UPTO</th>
           
           
            <th>EMD VALID UPTO</th>
            
            <th>APS DATE</th>
            <th>APS VALID UPTO</th>
            <th>APS AMOUNT</th>
            <th>BG DATE</th>
            <th>BG VALID UPTO</th>
            <th>BG AMOUNT</th>
            <th>DD DATE</th>
            <th>DD VALID UPTO</th>
            <th>DD AMOUNT</th>
            
            <th>VIEW</th>
            <th>EDIT</th>
            <!-- <th>DELETE</th> -->
        </tr>
    </thead>
    <tbody>
        @foreach($projects as $project)
        @php
            if($project->status=='COMPLETED')
            {
               $color='#1cff1c';
            }
            else
            {
                $color='#ffb1b1;';
            }
        @endphp

           

         
        <tr style="background-color: {{$color}};">
            <td><a href="/projects/adminprojectdetails/{{$project->id}}" class="btn btn-primary" target="_blank">{{$project->id}}</a></td>
            <td><strong>{{$project->clientname}}</strong></td>
            <td><strong>{{$project->agreementno}}</strong></td>
            <td>
              <strong><p class="b" title="{{$project->projectname}}">{{$project->projectname}}</p></strong></td>
            @if($project->status!='COMPLETED')
            <td><span class="label label-danger" ondblclick="changestatus('{{$project->id}}','{{$project->projectname}}');" title="Double click to change the status">{{$project->status}}</span></td>
            @else
            <td><span class="label label-success" ondblclick="changestatus('{{$project->id}}','{{$project->projectname}}');" title="Double click to change the status">{{$project->status}}</span></td>
            @endif
            <td><strong>{{$provider::moneyFormatIndia($project->cost)}}</strong></td>
            <td>{{$project->districtname}}</td>
            <td>{{$project->divisionname}}</td>
            <td>{{$project->startdate}}</td>
            <td>{{$project->enddate}}</td>
            <td>{{$project->emddate}}</td>
            <td>{{$project->emdamount}}</td>
            <td>{{$project->isddate}}</td>
            <td>{{$project->isdamount}}</td>
            <td>{{$project->papercost}}</td>
            
            <td>{{$project->priority}}</td>
            <td>{{$project->poddate}}</td>
            <td>{{$project->ponumber}}</td>
         
            <td>{{$project->isdvalidupto}}</td>
            
          
            <td>{{$project->emdvalidupto}}</td>
           
            <td>{{$project->apsdate}}</td>
            <td>{{$project->apsvalidupto}}</td>
            <td>{{$project->apsamount}}</td>
            <td>{{$project->bgdate}}</td>
            <td>{{$project->bgvalidupto}}</td>
            <td>{{$project->bgamount}}</td>
            <td>{{$project->dddate}}</td>
            <td>{{$project->ddvalidupto}}</td>
            <td>{{$project->ddamount}}</td>
            
            <td>
            <a href="/projects/adminprojectdetails/{{$project->id}}" class="btn btn-primary" target="_blank">VIEW DETAILS</a>
           </td>
            <td><a href="/projects/editproject/{{$project->id}}" class="btn btn-primary">EDIT</a></td>
        </tr>

        @endforeach
    </tbody>
    <tfoot>
      <tr style="background-color: gray;">
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><strong>Total</strong></td>
            <td><strong>Rs.{{$provider::moneyFormatIndia($projects->sum('cost'))}}</strong></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </tfoot>
</table>
</div>




<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">CHANGE STATUS</h4>
      </div>
      <div class="modal-body">
        <form action="/changestatus" method="post">
          {{csrf_field()}}
       <table class="table table-responsive table-hover table-bordered table-striped">
        <input type="hidden" name="pid" id="pid">
        <tr>
          <td>PROJECT NAME</td>
          <td><input type="text" readonly="" id='pname' class="form-control"></td>
        </tr>
        <tr>
          <td>STATUS</td>
          <td>
            <select name="status" class="form-control">
              <option value="ASSIGNED">ASSIGNED</option>
              <option value="STARTED">STARTED</option>
              <option value="ON PROGRESS">ON PROGRESS</option>
              <option value="HALTED">HALTED</option>
              <option value="COMPLETED">COMPLETED</option>
              
            </select>
          </td>
        </tr>
        <tr>
          <td><button type="submit" class="btn btn-primary">CHANGE</button></td>
        </tr>
        
       </table>   

        </form>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<div class="modal fade in" id="importproject">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <form method="post" enctype="multipart/form-data" action="/importproject">
      <div class="modal-header bg-navy">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" style="color: #fff;">×</span>
      </button>
        <h4 class="modal-title text-center">Upload Project Excel</h4>
      </div>
      <div class="modal-body">
        
              
                {{ csrf_field() }}
                <div class="form-group">
                <label>Select File for Upload Project</label>
                    <input type="file" name="select_file" />
                    <span class="text-muted">.xls, .xslx</span>
                </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success btn-flat">Upload</button>
      </div>
        </form>
    </div>
  </div>
</div>
<script type="text/javascript">
	function changestatus(id,pname)
	{
		$("#pname").val(pname);
		$("#pid").val(id);
        $("#myModal").modal('show');
	}

    function importproject(){
        alert("Do You Want To Upload Project Excel");
    }
  $(".alert-success").delay(5000).fadeOut(800); 
    $(".alert-danger").delay(5000).fadeOut(800);
</script>
@endsection
