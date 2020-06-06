@extends('layouts.account')
@section('content')
<table class="table table-responsive table-hover table-bordered table-striped">
	<tr class="bg-blue">
		<td class="text-center">ADD LEDGER</td>
	</tr>
</table>
 @if ($errors->any())
     @foreach ($errors->all() as $error)
         <p class="alert alert-danger text-center">{{ $error }}</p>
     @endforeach
 @endif
  @if(Session::has('msg'))
   <p class="alert alert-success text-center">{{ Session::get('msg') }}</p>
   @endif
   @if(Session::has('err'))
   <p class="alert alert-danger text-center">{{ Session::get('err') }}</p>
   @endif
<div class="well">
	<form action="/saveaddledger" name="ledgerform" method="post" enctype="multipart/form-data"> 
		{{csrf_field()}}
<table class="table table-responsive table-hover table-bordered table-striped">
	  <tr>
	  	<td><strong>LEDGER ENTRY FOR DATE</strong></td>
	  	<td><input type="text" class="form-control" value="{{date('Y-m-d')}}" readonly=""></td>
	  </tr>
	  <tr>
	  	<td>
	  		<strong>SELECT A BANK</strong>
	  	</td>
	  	<td>
	  		<select class="form-control select2" name="bankid" required="">

	  			<option value="">Select a Bank</option>
	  			@foreach($banks as $bank)
                   <option value="{{$bank->id}}">{{$bank->bankname}}/{{$bank->accountholdername}}/{{$bank->acno}}/{{$bank-> ifsccode}}</option>

	  			@endforeach
	  			
	  		</select>
	  	</td>
	  </tr>
	  <tr>
	  	<td><strong>Credited Amount</strong></td>
	  	<td><input type="text" name="cr" class="form-control" placeholder="Enter Credited Amount" value="0" required="" autocomplete="off" id="cr1"></td>
	  </tr>
	  <tr>
	  	<td><strong>Debited Amount</strong></td>
	  	<td><input type="text" name="dr" value="0" class="form-control" placeholder="Enter Debited Amount" required="" autocomplete="off" id="dr1"></td>
	  </tr>
	  @if(date('D')=='Fri')
	  <tr id="image">
        <td><strong>Upload Attachment</strong></td>
        <td>
         <input type="file" id="image" name="image" onchange="readURL(this);" required="">
           <p class="help-block">Upload a File</p>
        </td>
      </tr>
      @endif

	  <tr>
	  	<td colspan="2" style="text-align: right;"><button class="btn btn-success" type="submit" id="submitbutton" onclick="return confirm('Do You want to save ?')">SUBMIT</button></td>
	  </tr>

</table>
</form>
</div>

<table class="table table-responsive table-hover table-bordered table-striped datatable1">
	<thead>
		<tr class="bg-navy">
			<td>SL_NO</td>
			<td>ACCOUNT HOLDER NAME</td>
			<td>Bank Name</td>
			<td>Ac No.</td>
			<td>CR</td>
			<td>DR</td>
			<td>DATE</td>
			<td>ATTACHMENT</td>
			@if(Auth::user()->usertype=="MASTER ADMIN")
			<td>Edit</td>
			@endif
			<td>Created At</td>
		</tr>
		
	</thead>
	<tbody>
		
			@foreach($ledgers as $key=>$ledger)
			<tr>
			<td>{{$ledger->id}}</td>
			<td>{{$ledger->accountholdername}}</td>
			<td>{{$ledger->bankname}}</td>
			<td>{{$ledger->acno}}</td>
			<td>{{$ledger->cr}}</td>
			<td>{{$ledger->dr}}</td>
			<td>{{$ledger->date}}</td>
			@if($ledger->image != "")
			<td>
				<a href="{{asset('img/ledger/'.$ledger->image)}}" target="_blank">
          		<img style="height:50px;width:50px;" src="{{asset('img/ledger/'.$ledger->image)}}" alt="click to view" id="imgshow">
          		</a>
			</td>
			@else
			<td>NO FILE FOUND</td>
			@endif
			@php
			$date = \Carbon\Carbon::parse($ledger->created_at);
			$now = \Carbon\Carbon::now();
			$diff = $date->diffInDays($now);
			@endphp
			@if(Auth::user()->usertype=="MASTER ADMIN")
			@if($diff <= 2)
			<td>
				<button class="btn btn-info" onclick="editledger('{{$ledger->id}}','{{$ledger->bankid}}','{{$ledger->acno}}','{{$ledger->accountholdername}}','{{$ledger->cr}}','{{$ledger->dr}}','{{$ledger->image}}');" type="button">EDIT</button>
			</td>
			@else
			<td>
				<button class="btn btn-info" disabled="" type="button">EDIT</button>
			</td>
			@endif
			@endif

			<td>{{$ledger->created_at}}</td>
			</tr>
			@endforeach	
	</tbody>
</table>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><b>EDIT BANK LEDGER</b></h4>
      </div>
      <div class="modal-body">

    <form action="/updatebankledger" method="post" enctype="multipart/form-data"> 
		{{csrf_field()}}
<table class="table table-responsive table-hover table-bordered table-striped">
<input type="hidden" id="uid" name="uid">
	
	  <tr>
	  	<td>
	  		<strong>SELECT A BANK</strong>
	  	</td>
	  	<td>
	  		<select class="form-control" disabled="" name="bankid" id="bankid" required="">

	  			<option value="">Select a Bank</option>
	  			@foreach($banks as $bank)
                   <option value="{{$bank->id}}">{{$bank->bankname}}</option>
	  			@endforeach
	  			
	  		</select>
	  	</td>
	  </tr>
	  <tr>
	  	<td><strong>ACCOUNT NO</strong></td>
	  	<td><input type="number" disabled="" name="acno" id="acno" class="form-control" placeholder="Enter Acount No"></td>
	  </tr>
	  <tr>
	  	<td><strong>ACCOUNT HOLDER NAME</strong></td>
	  	<td><input type="text" disabled="" name="accountholdername" id="accountholdername" class="form-control" placeholder="Enter Acount Holder Name"></td>
	  </tr>
	  <tr>
	  	<td><strong>CREDITED AMOUNT</strong></td>
	  	<td><input type="text" id="cr" name="cr" class="form-control" placeholder="Enter Credited Amount" value="0" required="" autocomplete="off"></td>
	  </tr>
	  <tr>
	  	<td><strong>DEBITED AMOUNT</strong></td>
	  	<td><input type="text" id="dr" name="dr" value="0" class="form-control" placeholder="Enter Debited Amount" required="" autocomplete="off"></td>
	  </tr>
	  	<tr id="notshow" style="display: none;">
	  		<td><strong>Attachment</strong></td>
	  		<td>
	  			 	<input name="image" type="file"  onchange="readURL2(this);">
                     <p class="help-block">Upload .png, .jpg or .jpeg image files only</p>
            <img style="height:70px;width:95px;" alt="noimage" id="imgshow1">
	  		</td>
	  	</tr>
	  <tr>
	  	<td colspan="2" style="text-align: right;"><button class="btn btn-success" type="submit">UPDATE</button></td>
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
    function editledger(id,bankid,acno,accountholdername,cr,dr,image) {
    	if(image != ""){
    		$("#notshow").show();
    	}else{
    		$("#notshow").hide();
    	}
		$("#uid").val(id);
		$('#bankid option[value="'+bankid+'"]').attr("selected", "selected");
		$("#acno").val(acno);
		$("#accountholdername").val(accountholdername);
        $("#cr").val(cr);
        $("#dr").val(dr);
        $("#imgshow1").attr('src','/img/ledger/'+image)
                    .width(95)
                    .height(70);
		$("#myModal").modal('show');
	}
	 function readURL1(input) {
    

       if (input.files && input.files[0]) {
            var reader = new FileReader();
              
            reader.onload = function (e) {
                $('#imgshow1')
                    .attr('src', e.target.result)
                    .width(95)
                    .height(70);
          
            };

            reader.readAsDataURL(input.files[0]);

        }
    }

     function readURL2(input) {
    

       if (input.files && input.files[0]) {
            var reader = new FileReader();
              
            reader.onload = function (e) {
                $('#imgshow1')
                    .attr('src', e.target.result)
                    .width(95)
                    .height(70);
          
            };

            reader.readAsDataURL(input.files[0]);

        }
    }
</script>

@endsection