@extends('layouts.app')
@section('content')
@php
if($compdetails){
$name=$compdetails->companyname;
$id=$compdetails->id;
$phone=$compdetails->phone;
$mobile=$compdetails->mobile;
$fax=$compdetails->fax;
$websitelink=$compdetails->websitelink;
$email=$compdetails->email;
$gst=$compdetails->gst;
$pan=$compdetails->pan;
$tinno=$compdetails->tinno;
$tanno=$compdetails->tanno;
$servicetaxno=$compdetails->servicetaxno;
$exciseno=$compdetails->exciseno;
$address=$compdetails->address;
$logo=$compdetails->logo;
$value="Update Details";
}
else{
$name='';
$id='';
$phone='';
$mobile='';
$fax='';
$websitelink='';
$email='';
$gst='';
$pan='';
$tinno='';
$tanno='';
$servicetaxno='';
$exciseno='';
$address='';
$logo='';
$value="Save Details";
}

@endphp
@if(Session::has('message'))
<p class="alert alert-success text-center successmsg">{{ Session::get('message') }}</p>
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
<div class="row">
        <div class="col-md-12">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Company Details</h3>
            </div>
            <form method="post" action="/companysetup" enctype="multipart/form-data">
            	{{csrf_field()}}
              <div class="box-body">
                <div class="form-group col-md-6">
                  <label>Company Name <span style="color: red"> *</span></label>
                  <input type="text" class="form-control" palceholder="Comapny Name" value="{{$name}}"name="name">
                </div>
                <div class="form-group col-md-6">
                  <label>Website</label>
                  <input type="text" class="form-control" palceholder="Website link"  value="{{$websitelink}}"name="website">
                </div>
                <div class="form-group col-md-6">
                  <label>Mobile No <span style="color: red"> *</span></label>
                  <input type="text" class="form-control" palceholder="mobile number" value="{{$mobile}}"name="mobile">
                </div>
                <div class="form-group col-md-6">
                  <label>Phone No</label>
                  <input type="text" class="form-control" palceholder="phone number"  value="{{$phone}}"name="phone">
                </div>
                <div class="form-group col-md-6">
                  <label>Email <span style="color: red"> *</span></label>
                  <input type="email" class="form-control" palceholder="enter your email" value="{{$email}}"name="email">
                </div>
                <div class="form-group col-md-6">
                  <label>Fax No</label>
                  <input type="text" class="form-control" palceholder="fax number"  value="{{$fax}}"name="fax">
                </div>
                <div class="form-group col-md-6">
                  <label>Pan</label>
                  <input type="text" class="form-control" palceholder="pan number"  value="{{$pan}}"name="pan">
                </div>
                <div class="form-group col-md-6">
                  <label>TIN No</label>
                  <input type="text" class="form-control" palceholder="tin number"  value="{{$tinno}}"name="tinno">
                </div>
                <div class="form-group col-md-6">
                  <label>TAN No</label>
                  <input type="text" class="form-control" palceholder="tan number"  value="{{$tanno}}"name="tanno">
                </div>
                <div class="form-group col-md-6">
                  <label>SERVICE TAX No</label>
                  <input type="text" class="form-control" palceholder="servicetax number"  value="{{$servicetaxno}}"name="servicetaxno">
                </div>
                <div class="form-group col-md-6">
                  <label>EXCISE No</label>
                  <input type="text" class="form-control" palceholder="excise number"  value="{{$exciseno}}"name="exciseno">
                </div>
                <div class="form-group col-md-6">
                  <label>GST No <span style="color: red"> *</span></label>
                  <input type="text" class="form-control" palceholder="gst number" value="{{$gst}}"name="gst">
                </div>
                <div class="form-group col-md-6">
                  <label>Address <span style="color: red"> *</span></label>
                  <textarea class="form-control" name="address" placeholder="Address" rows="3">{{$address}}</textarea>
                </div>
                <div class="form-group col-md-4">
                  <label>Logo</label>
                  <input type="file" value="{{$name}}"name="logo" onchange="readURL(this);">
                </div>
                <div class="form-group col-md-2">
                  <img src="/img/company/{{$logo}}" id="imgshow" class="img-responsive">
                </div>
                <input type="hidden"  name="id"  value="{{$id}}">
                <div class="row">
	                <div class="form-group col-md-12">
	                	<button type="submit" class="btn btn-success btn-flat pull-right">{{$value}}</button>
	                </div>
            	</div>
            </div>
        </form>
    </div>
</div>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.js"></script>
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
<script>
  $('.successmsg').delay(5000).fadeOut(1000);
	 function readURL(input) {
    

       if (input.files && input.files[0]) {
            var reader = new FileReader();
              
            reader.onload = function (e) {
                $('#imgshow')
                    .attr('src', e.target.result)
            };

            reader.readAsDataURL(input.files[0]);

        }
    }
</script>

@endsection