
@extends('layouts.app')

@section('content')

  <table class="table">
<tr>
    <!-- <td><button class="btn btn-primary btn-lg" type="button" onclick="openaction('{{$complaint->id}}');">ACTION</button></td> -->
   @if($complaint->status!='RESOLVED')
      <td>
        <button type="button" class="btn btn-danger btn-lg" onclick="opensolvedmodal('{{$complaint->id}}');">?RESOLVED</button>
      </td>
      @else
      <td><button type="button" class="btn btn-danger btn-lg" disabled="">?RESOLVED</button></td>
    @endif
</tr>
  </table>
  


<div class="well" style="background-color: burlywood;">
  <div class="table-responsive">
      <table class="table ">

        <tr class="bg-navy">
          <td colspan="4" class="text-center">COMPLAINT DETAILS</td>
        </tr>
           <tr>
             <td><strong>COMPLAIN ID</strong></td>
             <td>#{{$complaint->id}}</td>
             <td><strong>TYPE</strong></td>
             <td>{{$complaint->type}}</td>
           </tr>
           <tr>
             <td><strong>COMPLAINT FROM</strong></td>
             <td>{{$complaint->from}}</td>
             <td><strong>COMPLAINT TO</strong></td>
             <td>{{$complaint->to}}</td>
           </tr>
          <tr>
             <td><strong>COPY TO</strong></td>
             <td>{{$complaint->ccname}}</td>
             <td><strong>DATE OF POST</strong></td>
             <td>{{$complaint->created_at}}</td>
           </tr>

           <tr>
             <td><strong>COMPLAINT DESCRIPTION</strong></td>
             <td>{{$complaint->description}}</td>
             <td><strong>LAST DATE TO SOLVE</strong></td>
             <td>{{$complaint->lastdate}}</td>
           </tr>

           <tr>
             <td><strong>STATUS</strong></td>
             <td>{{$complaint->status}}</td>
             <td><strong>RESOLVED DATE</strong></td>
             <td>{{$complaint->resolveddate}}</td>
           </tr>
           <tr>
             <td>
               CREATED AT
             </td>
             <td>{{$complaint->created_at}}</td>
              @if($complaint->attachment!='')
                <td><strong>ATTACHMENT</strong></td>
                <td>
                  <a href="{{ asset('/img/complaints/'.$complaint->attachment )}}" target="_blank">
      <img title="click to view the image" style="height:100px;width:150px;" alt="no uploadedfile" src="{{ asset('/img/complaints/'.$complaint->attachment )}}"></a>
     
       <a href="{{ asset('/img/complaints/'.$complaint->attachment )}}" download>
        <button class="btn"><i class="fa fa-download"></i> Download</button>
       </a>
                </td>


                @endif
           </tr>
      </table>
  </div>
  
</div>

<div class="well">
  <div class="table-responsive">
    <table class="table table-responsive table-hover table-bordered table-striped datatable">
      <thead>
         <tr class="bg-blue">
          <td colspan="4" style="text-align: center;">COMPLAINT LOGS</td>
        </tr>
      </thead>
        <thead>
          <tr class="bg-navy">
          <td>NAME</td>
          <td>MESSAGE</td>
          <td>DIFFER DATE</td>
          <td>TIME</td>
        </tr>
        </thead>
        
        <tbody>
           @foreach($complaintlogs as $complaintlog)
            <tr>
              <td>{{$complaintlog->name}}</td>
              <td>{{$complaintlog->message}}</td>
              <td>{{$complaintlog->differdate}}</td>
              <td>{{\Carbon\Carbon::createFromTimeStamp(strtotime($complaintlog->created_at))->diffForHumans()}}</td>
            </tr>
           
           @endforeach
        </tbody>
    </table>
    
  </div>
  
</div>


@if($complaint->status!='RESOLVED')
<div class="well">
  <form action="/savecomplaintlog/{{$complaint->id}}" method="post">
    {{csrf_field()}}
<table class="table table-responsive table-hover table-bordered table-striped datatable">
   <tr class="bg-navy"><td colspan="2" class="text-center">WRITE A MESSAGE</td></tr>

   <tr>
     
       <td><strong>WRITE A DECRIPTION</strong></td>
       <td><textarea class="form-control" required=""   name="message" placeholder="Enter Your message Here"></textarea></td>
    
   </tr>
   <tr>
     <td><strong>DIFFER DATE</strong></td>
     <td><input type="text" autocomplete="off" placeholder="Enter Differ date Here" name="lastdate" class="form-control datepicker2 readonly" required=""></td>
   </tr>
   <tr>
     <td colspan="2" style="text-align: right;"><button class="btn btn-success" type="submit">SEND</button></td>
   </tr>

</table>
</form>
</div>
@endif

 <table class="table">
<tr>
    <!-- <td><button class="btn btn-primary btn-lg" type="button" onclick="openaction('{{$complaint->id}}');">ACTION</button></td> -->
     @if($complaint->status!='RESOLVED')
      <td>
        <button type="button" class="btn btn-danger btn-lg" onclick="opensolvedmodal('{{$complaint->id}}');">?RESOLVED</button>
      </td>
      @else
      <td><button type="button" class="btn btn-danger btn-lg" disabled="">?RESOLVED</button></td>
    @endif
</tr>
  </table>

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
            <input type="text" name="lastdate" class="form-control datepicker1">
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
        <form action="/complaintresolved" method="post">
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
</script>
@endsection