@extends('layouts.account')
@section('content')
   @if(Session::has('msg'))
   <p class="alert alert-success text-center">{{ Session::get('msg') }}</p>
   @endif
   @if(Session::has('status'))
   <p class="alert alert-success text-center">{{ Session::get('status') }}</p>
   @endif
   @if(Session::has('error'))
    <p class="alert alert-danger text-center">{{ Session::get('error') }}</p>
   @endif

   @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div><br />
      @endif
<div class="box">
   <div class="box-header">
    <div class="row">
        <p>
            <span class="pull-right"><button type="submit" class="btn bg-navy btn-flat margin" data-toggle="modal" data-target="#importvendor" onclick="importvendor();"><i class="fa fa-file-excel-o"></i> Import Vendor</button>
                <a href="/VendorImportSample.xlsx" download="/vendorsample.xlsx" class="btn bg-orange btn-flat margin"><i class="fa fa-download"></i> Sample</a>
          </span>
          
        </p>
    </div>
  </div>
<div class="box-body">
<div class="table-responsive">
<table class="table  table-hover table-bordered table-striped datatable1">
       <thead class="bg-navy">
       	   <tr>
       	   	<th>Sl. No</th>
            <th>VENDOR TYPE</th>
            <th>PARTY NAME</th>
       	   	<th>MOBILE</th>
            <th>EMAIL</th>
       	   	<th>ADDRESS</th>
            <th>GSTN</th>
            <th>PAN</th>
            <th>TIN</th>
            <th>BANK NAME</th>
            <th>ACCOUNT NO</th>
            <th>IFSC CODE</th>
            <th>BRANCH NAME</th>
            <th>AUTHOR</th>
       	   	<th>EDIT</th>
       	   	<th>ACCOUNTS</th>
       	   </tr>
       </thead>
       <tbody>
       	@foreach($vendors as $key=>$vendor)
           <tr>
           	<td>{{++$key}}</td>
            <td>{{$vendor->vendortype}}</td>
           	<td>{{$vendor->vendorname}}</td>
           	<td>{{$vendor->mobile}}</td>
           	<td>{{$vendor->email}}</td>
            <td>{{$vendor->details}}</td>
            <td>{{$vendor->gstno}}</td>
            <td>{{$vendor->panno}}</td>
            <td>{{$vendor->tinno}}</td>
            <td>{{$vendor->bankname}}</td>
            <td>{{$vendor->acno}}</td>
            <td>{{$vendor->ifsccode}}</td>
            <td>{{$vendor->branchname}}</td>
            <td>{{$vendor->name}}</td>
           	<td><a href="/editvendor/{{$vendor->id}}" class="btn btn-primary">EDIT</a></td>
           	<td><a href="/account-report/{{$vendor->id}}" class="btn btn-primary">AC Report</a></td>
           </tr>
       	@endforeach
       
       </tbody>
	</table>
</div>
</div>

<div class="modal fade in" id="importvendor">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <form method="post" enctype="multipart/form-data" action="/importvendor">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
      </button>
        <h4 class="modal-title text-center">Upload Vendor Excel</h4>
      </div>
      <div class="modal-body">
        
        
          {{ csrf_field() }}
          <div class="form-group">
        <label>Select File for Upload Vendor</label>
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
    function importvendor(){
    alert("Do You Want To Upload Vendor Excel"); 
  }
</script>
@endsection