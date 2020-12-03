@extends('layouts.app')

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
  <form method="post" action="/savevisitor" enctype="multipart/form-data">
    {{csrf_field()}}
     @if(Session::has('msg'))
     <p class="alert alert-success text-center">{{ Session::get('msg') }}</p>
    @endif
  <table class="table table-striped table-condensed table-bordered">
    <thead>
      <tr class="bg-navy">
        <td colspan="2" class="text-center"><strong>ADD NEW VISITORS</strong>
          <a href="/rcp/viewallvisitors/" class="btn btn-info pull-right">View all Visitors</a></td>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Visitor Name</td>
        <td>
          <input type="text" name="visitorname" class="form-control" placeholder="Enter Visitor Name" required>
        </td>
      </tr>
      <tr>
        <td>Mobile Number</td>
        <td>
          <input type="text" required="" name="mobile" class="form-control" placeholder="Enter Mobile Number">
        </td>
      </tr>
      <tr>
            <td>ADDRESS</td>
		        <td>
                   <div class="box">
		            <div class="box-body pad">
		                  <textarea class="form-control" required="" type="text" name="address"placeholder="your  address"></textarea>
		             
		            </div>
		          </div>
		       </td>
       </tr>
       <tr>
        <td>Whom To Meet</td>
        <td>
          <input type="text" name="whomtomeet" class="form-control" placeholder="Enter Whom To Meet" required>
        </td>
      </tr>
       
       <tr>
            <td>Purpose</td>
		        <td>
                   <div class="box">
		            <div class="box-body pad">
		                  <textarea class="form-control" type="text" name="purpose" placeholder="Purpose"></textarea>
		             
		            </div>
		          </div>
		       </td>
       </tr>
      <tr>
        <td>Entry Time</td>
        <td>
          <input type="text" name="entrytime" class="form-control datetimepicker1" placeholder="Enter Entry Time" >
        </td>
      </tr>
      <tr>
        <td>Exit Time</td>
        <td>
          <input type="text" name="exittime" class="form-control datetimepicker1" placeholder="Enter Exit Time" required>
        </td>
      </tr>
      <tr>
            <td>Remarks</td>
		        <td>
                   <div class="box">
		            <div class="box-body pad">
		                  <textarea class="form-control" type="text" name="remarks" requiredplaceholder="Remarks"></textarea>
		             
		            </div>
		          </div>
		       </td>
       </tr>
       <tr>

        <td>Photo</td>
        <td> <input name="photo" type="file" onchange="readURL(this);"><img style="height:70px;width:95px;" alt="noimage"  id="imgshow"></td>
       
      </tr>
          
    </tbody>

    <tfoot>
      <tr>
        <td></td>
        <td class="text-center"><button type="submit" class="btn btn-success pull-right">SAVE</button></td>
      </tr>
    </tfoot>

 </table>
</form>
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