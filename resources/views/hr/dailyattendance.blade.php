@extends('layouts.labour')

@section('content')
<style type="text/css">
  .select2-selection__choice {
    background-color: #e16767!important;
  }
</style>
@if(Session::has('msg'))
   <p class="alert alert-success text-center">{{ Session::get('msg') }}</p>
@endif

<table class="table table-responsive table-hover table-bordered table-striped">
	<tr class="bg-navy">
		 <td class="text-center">Daily Attendance Report</td>
	</tr>

</table>


<form action="/saveattendancereportgrp" method="post" enctype="multipart/form-data">
	{{csrf_field()}}
<div class="col-sm-12">
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label>SELECT A GROUP NAME *</label>
          <select class="form-control select2" onchange="fetchlabour(this.value);" id="groupid"  name="groupid" required="" style="width: 100%;">
            <option value="">SELECT A GROUP</option>
               @foreach($groups as $key => $group)
               <option value="{{$group->id}}">{{$group->groupname}}</option>
               @endforeach
          </select>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>SELECT LABOUR*</label>
          <select class="form-control select2" id="labour"  name="labour[]" required="" style="width: 100%;" multiple>


          </select>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>ENTRY TIME*</label>
          <input type="text" class="form-control datetimepicker1" autocomplete="off" name="entrytime" id="entrytime">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>DEPARTURE TIME</label>
          <input type="text" class="form-control datetimepicker1" autocomplete="off" id="departuretime" name="departuretime">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>Number Of Hour</label>
          <input type="text" value="8" class="form-control" autocomplete="off" id="nof" name="nof">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label></label>
          <button type="button" class="btn btn-success" onclick="fetchlabourdetails();">Fetch</button>
      </div>
    </div>
  </div>

  <div style="display: none;" id="labourdtldiv">
    <table class="table">
      <thead>
        <tr>
          <td>Slno</td>
          <th>EmpId</th>
          <th>Name</th>
         <!--  <th>Entry</th>
          <th>Departure</th> -->
          <th>Tot. hours</th>
          <th>OT Hr</th>
          <th>Wages</th>
          <th>Ot Amt</th>
          <th>Tot Amt.</th>
        </tr>
      </thead>
      <tbody id="labourdtl">
        
      </tbody>

      
    </table>

  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label>NUMBER OF WORKERS*</label>
          <input type="text" id="noofworkerid" class="form-control" name="noofworkerspresent">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>TOTAL WAGES*</label>
          <input type="text" id="totalwagesid" class="form-control" name="twages">
      </div>
    </div>

  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label>TOTAL OT*</label>
          <input type="text" id="totalotid" class="form-control" name="tot">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>TOTAL AMOUNT*</label>
          <input type="text" id="totalotamt" class="form-control" name="tamt">
      </div>
    </div>
  </div>

    <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label>ITEM DESCRIPTION*</label>
          <input type="text" class="form-control" name="itemdescription">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>UNIT(Kg/No.)*</label>
          <input type="text" class="form-control" name="unit">
      </div>
    </div>
  </div>

    <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label>QUANTITY*</label>
          <input type="text" class="form-control" name="quantity">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>AMOUNT*</label>
          <input type="text" class="form-control" name="amount">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label>WORK ASSIGNMENT*</label>
          <textarea class="form-control" name="workassignment"></textarea>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>REMARKS*</label>
          <textarea class="form-control" name="remarks"></textarea>
      </div>
    </div>
    
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label>Group Photo*<span style="color: red;font-weight: bold;">(Multiple images uplaod)</span></label>
          <input name="photo[]" type="file" multiple="" onchange="readURL1(this)">
          <img id="imgshow1" src="#" alt="No Image Selected" style="height: 60px;width: 50px;">
      </div>
    </div>
  </div>
</div>

</div>
<div style="display: none;" id="submitbtnid">
<table class="table table-responsive">
	<tr>
		<td ><button type="submit" class="btn btn-success pull-right" onclick="return confirm('Do You Want to Proceed?')">Submit</button></td>
	</tr>
</table>
</div>

</form>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" integrity="sha256-yMjaV542P+q1RnH6XByCPDfUFhmOafWbeLPmqKh11zo=" crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js" integrity="sha256-5YmaxAwMjIpMrVlK84Y/+NjCpKnFYa8bWWBbUHSBGfU=" crossorigin="anonymous"></script>
<script>
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
  function fetchlabour(groupid){
    $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });

   //var u="business.draquaro.com/api.php?id=9658438020";

           $.ajax({
               type:'POST',
              
               url:'{{url("/ajaxfetchlabour")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                      groupid:groupid,

                     },

               success:function(data) { 
                $.each(data, function (i, item) {
  
     $('#labour')
         .append($("<option></option>")
                    .attr("value", item.id)
                    .attr("selected", "")
                    .text(item.employeename));
});
               }
             });

  }
  function fetchlabourdetails(selected){
    var entrytime=$("#entrytime").val();
    var nof=$("#nof").val();
    var departuretime=$("#departuretime").val();
    var labour=$("#labour").val();
    var groupid=$("#groupid").val();
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });

   //var u="business.draquaro.com/api.php?id=9658438020";

           $.ajax({
               type:'POST',
              
               url:'{{url("/ajaxfetchlabourfromgrp")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                    
                      entrytime:entrytime,
                      departuretime:departuretime,
                      labour:labour,
                      groupid:groupid,
                      nof:nof,

                     },

               success:function(data) { 
                var html='';
                var totalwages=0;
                var totalot=0;
                var subtotal=0;
                $.each(data, function (i, value) {
                  html+='<tr>'+
                        '<td>'+(++i)+'</td>'+
                        '<td>'+'<input type="hidden" class="countlab" name="id[]" value="'+value.id+'">'+value.id+'</td>'+
                        '<td>'+'<input type="hidden" name="employeename[]" value="'+value.employeename+'">'+value.employeename+'</td>'+
                        // '<td>'+'<input type="hidden" name="entrytime[]" value="'+value.entrytime+'">'+value.entrytime+'</td>'+
                        // '<td>'+'<input type="hidden" name="departuretime[]" value="'+value.departuretime+'">'+value.departuretime+'</td>'+
                        '<td>'+'<input type="hidden" class="counttothr" name="totnoofhour[]" value="'+value.totnoofhour+'">'+value.totnoofhour+'</td>'+
                        '<td>'+'<input type="hidden" class="countothr" name="othours[]" value="'+value.othours+'">'+value.othours+'</td>'+
                        '<td>'+'<input type="hidden" class="countwages" name="wages[]" value="'+value.wages+'">'+value.wages+'</td>'+
                        '<td>'+'<input type="hidden" class="countotamt" name="otamount[]" value="'+value.otamount+'">'+value.otamount+'</td>'+
                        '<td>'+'<input type="hidden" class="counttotamt" name="totamt[]" value="'+value.totamt+'">'+value.totamt+'</td>'+
                        '</tr>';
                
                });
                 $("#labourdtl").html(html);
                 $("#labourdtldiv").show();
                 $("#submitbtnid").show();
                 $("#fetchbtnid").hide();
                 sumofrow();

               }
             });
     }
function sumofrow()
{

    var totallabour = 0;
    var totalwages=0;
    var totalotamt=0;
    var totalamt=0;
    var totalothr=0;
    var totalhr=0;
    $('.countlab').each(function (index, element) {
        totallabour =totallabour+1; 
    });
    $('.countwages').each(function (index, element) {
            totalwages = totalwages + parseFloat($(element).val());
        });
    $('.countotamt').each(function (index, element) {
            totalotamt = totalotamt + parseFloat($(element).val());
        });
    $('.counttotamt').each(function (index, element) {
            totalamt = totalamt + parseFloat($(element).val());
        });
    $('.countothr').each(function (index, element) {
            totalothr = totalothr + parseFloat($(element).val());
        });
    $('.counttothr').each(function (index, element) {
            totalhr = totalhr + parseFloat($(element).val());
        });
  $('#totalwagesid').val(totalwages);
  $('#totalotid').val(totalotamt);
  $('#totalotamt').val(totalamt);
  $('#noofworkerid').val(totallabour);



}
</script>
@endsection