
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
<table class="table">
      @if($filterreq)
    <tr>
      <td ><a href="/hrcom/complainttoresolve" class="btn btn-danger">Clear Search</a></td>
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
<table class="table table-responsive table-hover table-bordered table-striped datatable" style="width: 100%;">
  <thead>
    <tr class="bg-navy" style="font-size: 10px;">
        <td>DATE OF POST</td>
      <td>TYPE</td>
      <td>COMPLAINT ID</td>

      <td>COMPLAINT FORM</td>
      
      <td>COMPLAINT TO</td>
      <td>CC</td>
    
      <td>DESCRIPTION</td>
      <td>EXP.DATE TO SOLVE</td>
      <td>REMARK</td>
      <td>RESOLVED DATE</td>
      <td>STATUS</td>
      <td>VIEW</td>
      <!-- <td>ACTION</td> -->
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
       <td>{{$compalint->created_at}}</td>
      <td>{{$compalint->type}}</td>
      <td>{{$compalint->id}}</td>
      <td>{{$compalint->from}}</td>
      <td>{{$compalint->to}}</td>
      <td>{{$compalint->ccname}}</td>
      <td><p class="b" title="{{$compalint->description}}">{{$compalint->description}}</p></td>
      <td>{{$compalint->lastdate}}</td>
      <td><p class="b" title="{{$compalint->remark}}">{{$compalint->remark}}</p></td>
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
      <!-- <td><button class="btn btn-primary" type="button" onclick="openaction('{{$compalint->id}}');">ACTION</button></td>-->
      <td> 
           <button type="button" class="btn btn-danger" onclick="opensolvedmodal('{{$compalint->id}}');">?RESOLVED</button>
      </td>
      @else
     <!--  <td><button class="btn btn-primary" type="button" disabled="">ACTION</button></td> -->
      <td><button class="btn btn-danger" type="button" disabled="">?RESOLVED</button></td>
      @endif
    </tr>
    @endforeach
  </tbody>

</table>
</div>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">ACTION</h4>
      </div>
      <div class="modal-body">
        <form action="/complaintaction" method="post">
        {{csrf_field()}}
       <table class="table table-responsive table-hover table-bordered table-striped datatable">
        <input type="hidden" name="cid" id="cid">
        <tr>
          <td>Expect Date to Resolve</td>
          <td>
            <input type="text" name="lastdate" class="form-control datepicker2 readonly" autocomplete="off">
          </td>
        </tr>
        <tr>
          <td>Remarks</td>
          <td>
            <textarea name="remark" class="form-control"></textarea>
          </td>
        </tr>
        <tr>
          <td colspan="2"><button type="submit" class="btn btn-success">Submit</button></td>
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
        <h4 class="modal-title">RESOLVED</h4>
      </div>
      <div class="modal-body">
        <form action="/usercomplaintresolved" method="post">
        {{csrf_field()}}
       <table class="table table-responsive table-hover table-bordered table-striped datatable">
        <input type="hidden" name="compid" id="compid">
        <tr>
          <td>Remarks</td>
          <td>
            <textarea name="remark" class="form-control"></textarea>
          </td>
        </tr>
        <tr>
          <td colspan="2"><button type="submit" class="btn btn-success">Submit</button></td>
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
<script type="text/javascript">
   function openaction(id) {
       $("#cid").val(id);
       $("#myModal").modal('show');
   }
   function opensolvedmodal(id)
   {
     $("#compid").val(id);
     $("#myModal1").modal('show');
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