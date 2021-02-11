@extends('layouts.hr')

@section('content')

@if(Session::has('msg'))
   <p class="alert alert-success text-center">{{ Session::get('msg') }}</p>
@endif

 <style type="text/css">
  .thumb-image
  {
    height: 100px;
    width: 100px;
  }
</style>
  <table class="table table-striped table-condensed table-bordered">
    <thead>
      <tr class="bg-navy">
        <td colspan="2" class="text-center"><strong>LEAVE APPLY FORM</strong>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><strong>Applicant Name</strong></td>
        <td>
          <input type="text" name="appliername" value="{{$leave->name}}" class="form-control" placeholder="Enter Applicant Name" >
        </td>
      </tr>
       <tr>
        <td><strong>LEAVE TYPE*</strong></td>
          <td>
            <select class="form-control select2" id="laevetypeid"  name="laevetypeid">
            <option value="">SELECT A LEAVE TYPE</option>
               @foreach($leavetypes as $key => $leavetype)
               <option value="{{$leavetype->id}}" {{ ( $leavetype->id == $leave->laevetypeid) ? 'selected' : '' }}>{{$leavetype->leavetypename}}</option>
               @endforeach
          </select>
           </td>
     </tr>      
       <tr>
        <td><strong>FULL DAY/ HALF DAY*</strong></td>
          <td>
            <select class="form-control" name="fullhalf">
            <option value=''>--Select a Day--</option>
            <option value='FULL DAY'{{ ( $leave->fullhalf == "FULL DAY") ? 'selected' : '' }}>FULL DAY</option>
            <option value='HALF DAY'{{ ( $leave->fullhalf == "HALF DAY") ? 'selected' : '' }}>HALF DAY</option>
            </select>
           </td>
     </tr>

     	  <tr>
        <td><strong>RELIEVER*</strong></td>
          <td>
            <select class="form-control select2" id="relieverid" name="relieverid">
          <option value="">select a employee</option>
          @foreach($users as $user)
             <option value="{{$user->id}}" {{ ( $user->id == $leave->relieverid) ? 'selected' : '' }}>{{$user->name}}</option>
            @endforeach 
          </select>
           </td>
     </tr>
      <tr>
        <td><strong>From Date</strong></td>
        <td>
          <input type="text" name="fromdate" class="form-control datepicker" value="{{$leave->fromdate}}" placeholder="Enter Entry Time"required >
        </td>
      </tr>
      <tr>
        <td><strong>To Date</strong></td>
        <td>
          <input type="text" name="todate" class="form-control datepicker" value="{{$leave->todate}}" placeholder="Enter Exit Time">
        </td>
      </tr>
      <tr>
        <td><strong>Upload Doc* </strong></td>
        <td>
          <input type="file"  name="photo"><strong>
              Upload .png, .jpg or .jpeg image files only</strong>
                    <a href="{{asset('img/leavephoto/'.$leave->photo)}}" target="_blank">
                     <strong><i class="fa fa-paperclip" aria-hidden="true"></i> click to view </strong>
                  </a>
        </td>
      </tr>
      <tr>
            <td><strong>Purpose</strong></td>
            <td>
                   <div class="box">
                <div class="form-group">
                      <textarea class="form-control" style="height: 400px;" type="text" name="purpose" placeholder="Purpose">{{$leave->purpose}}</textarea>
                 
                </div>
              </div>
           </td>
       </tr>
          
    </tbody>

    <!-- <tfoot>
      <tr>
        <form method="post" action="/approveleaveall/{{$leave->id}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <td class="text-center"><button type="submit" class="btn btn-success pull-right">APPROVE</button></td>
       </form>
       <form method="post" action="/rejectleaveall/{{$leave->id}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <td class="text-center"><button type="submit" class="btn btn-danger pull-left">REJECT</button></td>
      </form>
      </tr>
    </tfoot> -->

 </table>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" integrity="sha256-yMjaV542P+q1RnH6XByCPDfUFhmOafWbeLPmqKh11zo=" crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js" integrity="sha256-5YmaxAwMjIpMrVlK84Y/+NjCpKnFYa8bWWBbUHSBGfU=" crossorigin="anonymous"></script>
<script type="text/javascript">
	$('.datetimepicker1').datetimepicker({ 
  format: 'YYYY-MM-DD hh:mm A'
});
function readURL1(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#imgshow1').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
  }
  function readURL(input) {
    

       if (input.files && input.files[0]) {
            var reader = new FileReader();
              
            reader.onload = function (e) {
                $('#imgshow')
                    .attr('src', e.target.result)
                    .width(95)
                    .height(70);
          
            };

            reader.readAsDataURL(input.files[0]);

        }
    }

   </script>

@endsection