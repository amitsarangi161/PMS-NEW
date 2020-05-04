@extends('layouts.hr')

@section('content')
<style type="text/css">
  .b {
    white-space: nowrap; 
    width: 150px; 
    overflow: hidden;
    text-overflow: ellipsis; 
   
}
</style>
 @if(Session::has('message'))
   <p class="alert alert-info text-center">{{ Session::get('message') }}</p>
   @endif
<form action="/savecomplaint" method="post" enctype="multipart/form-data">
  {{csrf_field()}}
  <table class="table table-responsive table-hover table-bordered table-striped">
  <tr class="bg-navy">
    <td style="text-align: center;">Complaint Form</td>
  </tr>
</table>

<table class="table table-responsive table-hover table-bordered table-striped">
  <tr>
    <td><strong>SELECT A TYPE</strong></td>
    <td>
    <select class="form-control" name="type" required>
      <option value="">SELECT A TYPE</option>
      <option value="COMPLAINT">COMPLAINT</option>
      <option value="REQUEST">REQUEST</option>
      <option value="ADVICE">ADVICE</option>
      

    </select>
  </td>
  <td><strong>TO</strong></td>
  <td>
    <select class="form-control select2" name="touserid" required>
      <option value="">Select a User</option>
      @foreach($users as $user)
      @if($user->designation=='')
       <option value="{{$user->id}}">{{$user->name}}</option>
      @else
        <option value="{{$user->id}}">{{$user->name}} ({{$user->designation}})</option>
      @endif
      @endforeach
        
    </select>
  </td>
  </tr>
  <tr>
    <td><strong>CC</strong></td>
    <td>
      <select name="cc" class="form-control select2">
        <option value="">Select A User</option>
          @foreach($users as $user)
      @if($user->designation=='')
       <option value="{{$user->id}}">{{$user->name}}</option>
      @else
        <option value="{{$user->id}}">{{$user->name}} ({{$user->designation}})</option>
      @endif
      @endforeach
      </select>
    </td>
    <td><strong>DATE TO RESOLVE</strong></td>
    <td><input type="text" name="date" class="form-control datepicker2 readonly" autocomplete="off" required></td>
  </tr>
  <tr>
     <td><strong>DESCRIBE THE ISSUE</strong></td>
    <td>
      <textarea class="form-control" name="description" required></textarea>
    </td>
     <td><strong>ATTACHMENT</strong></td>
    <td><input type="file" name="attachment" ></td>
  </tr>
  <tr>
    <td colspan="4" style="text-align: right;"><button type="submit" class="btn btn-success btn-lg">Submit</button></td>
  </tr>
</table>
</form>

<table class="table">
      @if($filterreq)
    <tr>
      <td ><a href="/hrcom/complaint" class="btn btn-danger">Clear Search</a></td>
      <td  class="text-center"><strong style="font-size: 20px;color: blue;"><span class="label label-success">Showing Results For {{$filterreq}} (Found {{count($complaints)}} records)</span></strong></td>

    </tr>
    @endif
    <tr>
      <td><strong>FILTTER BY STATUS</strong></td>
      <td>
      <select class="form-control" id="filtter" onchange="filterbystatus(this.value);">
          <option value="">select a type</option>
          @foreach($statuses as $status)
          <option value="{{$status->status}}" {{ ( $filterreq == $status->status) ? 'selected' : '' }}>{{$status->status}}</option>
          @endforeach
      </select>
    </td>
      <td style="text-align: right;">
      <a href="/hrcom/complaint" class="btn btn-info btn-lg">CREATE A COMPALINT</a>
      </td>
    </tr>
    
  </table>
<div style="overflow-x:auto;">
<table class="table table-responsive table-hover table-bordered table-striped datatable1" style="width: 100%">
  <thead>
    <tr class="bg-navy" style="font-size: 10px;">
      <td>ID</td>
      <td>TYPE</td>
      <td>COMPLAINT FORM</td>
      <td>COMPLAINT TO</td>
      <td>CC</td>
      <td>DATE OF POST</td>
      <td>DESCRIPTION</td>
      <td>EXP.DATE TO SOLVE</td>
      <td>REMARK</td>
      <td>RESOLVED DATE</td>
      <td>STATUS</td>
      <td>VIEW</td>
      <td>EDIT</td>
      <td>RESOLVED</td>
     
    </tr>

  </thead>
  <tbody>
    @foreach($complaints as $compalint)
         @php
            if($compalint->status=="PENDING")
            {
              $col="#d78e8e";
            }
            elseif($compalint->status=="RESOLVED")
            {
              $col="green";
            }
            else
            {
              $col="#dadbda99";
            }

        @endphp
    <tr style="background-color: {{$col}};font-size: 12px;">
      <td>{{$compalint->id}}</td>
      <td>{{$compalint->type}}</td>
      <td>{{$compalint->from}}</td>
      <td>{{$compalint->to}}</td>
       <td>{{$compalint->ccname}}</td>
      <td>{{$compalint->created_at}}</td>
       <td ><p class="b" title="{{$compalint->description}}">{{$compalint->description}}</p></td>
      <td>{{$compalint->lastdate}}</td>
       <td ><p class="b" title="{{$compalint->remark}}">{{$compalint->remark}}</p></td>      
       <td>{{$compalint->resolveddate}}</td>
     
      @if($compalint->status=='PENDING')
      <td><span class="label label-danger">{{$compalint->status}}</span></td>
      @else
      <td><span class="label label-success">{{$compalint->status}}</span></td>
      @endif
       <td>
         <a href="/hrviewcomplaintdetails/{{$compalint->id}}" class="btn btn-success">VIEW</a>
       </td>
       @if($compalint->status!='RESOLVED')
      <td><button type="button" class="btn btn-primary" onclick="editcomplant('{{$compalint->id}}','{{$compalint->lastdate}}','{{$compalint->touserid}}','{{$compalint->fromuserid}}','{{$compalint->description}}','{{$compalint->type}}','{{$compalint->cc}}')">EDIT</button></td>
      <td>
        <button type="button" onclick="resolvedproblem('{{$compalint->id}}');" class="btn btn-danger">RESOLVED?</button>
      </td>
      @else
        <td><button class="btn btn-primary" type="button" disabled>EDIT</button></td>
        <td><button class="btn btn-danger" type="button" disabled>RESOLVED?</button></td>
      @endif
    </tr>
    @endforeach
  </tbody>

</table>
</div>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title">EDIT COMPLAINT</h4>
      </div>
      <div class="modal-body">
        <form action="/updatecompalint" method="post" enctype="multipart/form-data">
          {{csrf_field()}}
        <table class="table table-responsive table-hover table-bordered table-striped">
        <input type="hidden" name="cid" id="cid">
     <tr>
    <td><strong>SELECT A TYPE</strong></td>
    <td>
    <select class="form-control" name="type" id="type" required>
      <option value="">SELECT A TYPE</option>
      <option value="COMPLAINT">COMPLAINT</option>
      <option value="REQUEST">REQUEST</option>
      <option value="ADVICE">ADVICE</option>
      

    </select>
  </td>
  <td><strong>TO</strong></td>
  <td>
    <select class="form-control" name="touserid" id="touserid" required>
      <option value="">Select a User</option>
      @foreach($users as $user)
      @if($user->designation=='')
       <option value="{{$user->id}}">{{$user->name}}</option>
      @else
        <option value="{{$user->id}}">{{$user->name}} ({{$user->designation}})</option>
      @endif
      @endforeach
        
    </select>
  </td>
  </tr>
  <tr>
    <td><strong>CC</strong></td>
    <td>
      <select name="cc" id="cc" class="form-control">
        <option value="">Select A User</option>
          @foreach($users as $user)
      @if($user->designation=='')
       <option value="{{$user->id}}">{{$user->name}}</option>
      @else
        <option value="{{$user->id}}">{{$user->name}} ({{$user->designation}})</option>
      @endif
      @endforeach
      </select>
    </td>
    <td><strong>DATE</strong></td>
    <td><input type="text" name="date" class="form-control datepicker2 readonly" autocomplete="off" id="date" required></td>
  </tr>
  <tr>
    <td><strong>DESCRIBE THE ISSUE</strong></td>
    <td>
      <textarea class="form-control" name="description" id="description" required></textarea>
    </td>

     <td><strong>ATTACHMENT</strong></td>
    <td><input type="file" name="attachment" ></td>
  </tr>
  <tr>
    <td colspan="4" style="text-align: right;"><button type="submit" class="btn btn-success">Update</button></td>
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


<div id="myModal1" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">RESOLVED PROBLEM</h4>
      </div>
      <div class="modal-body">
        <form action="/usercompalintresolved" method="post">
          {{csrf_field()}}
          <table class="table table-responsive table-hover table-bordered table-striped">
            <input type="hidden" name="compid" id="compid">
            <tr>
              <td>REMARKS</td>
                 <td>
                  <textarea class="form-control" name="remark"></textarea>
                 </td>

            </tr>
            <tr>
              <td colspan="2">
                <button type="submit" class="btn btn-success">PROBLEM RESOLVED</button>
              </td>
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

for pending::->red;

<script type="text/javascript">
  function editcomplant(id,date,to,from,description,type,cc) {

    $("#cid").val(id);
    $("#date").val(date);
     
    $("#description").val(description);
    $('#type option[value="'+type+'"]').attr("selected", "selected");
    $('#touserid option[value="'+to+'"]').attr("selected", "selected");
    $('#cc option[value="'+cc+'"]').attr("selected", "selected");
    $("#myModal").modal('show');

   
  }
  function resolvedproblem(id)
  {
    $("#compid").val(id);
    $("#myModal1").modal('show')
  }
   function filterbystatus(type)
      {
        if(type!='')
         {
        location.href='?type='+type;
        }
      }
</script>
@endsection

