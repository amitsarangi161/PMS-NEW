@extends('layouts.app')

@section('content')
<style type="text/css">
  .select2-selection__choice{
    background-color: #3c8dbc!important;
    border-color: #367fa9;
    padding: 1px 10px;
    color: #fff;
}
.select2-selection__choice__remove {
    color: #a60c0c!important;}
</style>
@if(Session::has('message'))
   <p class="alert alert-success text-center">{{ Session::get('message') }}</p>
   @endif
 @if(Session::has('status'))
 <p class="alert alert-success text-center">{{ Session::get('status') }}</p>
 @endif
 @if(Session::has('error'))
 <p class="alert alert-danger text-center">{{ Session::get('error') }}</p>
 @endif
 @if(Session::has('msg'))
   <p class="alert alert-success text-center">{{ Session::get('msg') }}</p>
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
<form action="/saveclient" method="post">
	{{csrf_field()}}
<table class="table table-responsive table-hover table-bordered table-striped" >
        <tr>
            <td colspan="4" class="text-center bg-navy">ADD A NEW CLIENT</td>
        </tr>
        <tr>
         <td><strong>DEPARTMENT NAME</strong><span style="color: red"> *</span></td>
         <td><input type="text" name="clientname" class="form-control" placeholder="Enter Client Name" required=""></td>
           <td><strong>CONTACT NO</strong></td>
           <td><input type="number" name="contact1" class="form-control" placeholder="Enter Contact No"></td>
        </tr>
        <tr>
          <td><strong>ALTERNATIVE CONTACT NO</strong></td>
           <td><input type="number" name="contact2" class="form-control" placeholder="Enter Alternative Contact No"></td>
        	<td><strong>OFICE CONTACT NO</strong></td>
           <td><input type="number" name="officecontact" class="form-control" placeholder="Enter Office  Contact No"></td>          
        </tr>
          <tr>
            <td><strong>EMAIL</strong></td>
            <td><input type="email" name="email" class="form-control" placeholder="Enter Email Here"></td>
            <td><strong>GSTN</strong></td>
           <td><input type="text" name="gstn" class="form-control" placeholder="Enter Client GST No"></td>          
        </tr>
        <tr>
          <td><strong>PAN NO</strong></td>
            <td><input type="text" name="panno" class="form-control" placeholder="Enter Client PAN No"></td>
          <td><strong>TAN NUMBER</strong></td>
         <td><input type="text" name="tanno" class="form-control" placeholder="Enter Tan Number"></td>
        </tr>
        <tr>
          <td><strong>TIN NUMBER</strong></td>
         <td><input type="text" name="tinno" class="form-control" placeholder="Enter Tin Number"></td>
         <td><strong>STATE</strong></td>
         <td><input type="text" name="state" class="form-control" placeholder="Enter state Here"></td>

        </tr>
        <tr>
          <td><strong>CITY</strong></td>
         <td><input type="text" name="city" class="form-control" placeholder="Enter city Here"></td>
         <td><strong>COUNTRY</strong></td>
         <td><input type="text" name="country" class="form-control" placeholder="Enter Country Here"></td>
        </tr>
        <tr>
          <td><strong>RESIDENT ADDRESS</strong></td>
          <td><textarea name="residentaddress" class="form-control" placeholder="Enter Resident address"></textarea></td>
          <td><strong>OFFICE ADDRESS</strong></td>
          <td><textarea name="officeaddress" class="form-control" placeholder="Enter Office address"></textarea></td>
        </tr>
        <tr>
        	<td><strong>ADDITIONAL INFO</strong></td>
        	<td><textarea name="additionalinfo" class="form-control" placeholder="Enter Addional Info"></textarea></td>
        </tr>
                <tr>
            <td></td>
             <td colspan="4"><input type="submit" value="Submit" class="btn btn-success btn-flat" style="float: right ;"></td>
</tr>
</table>

</form>
   
@if($clients)
<div class="box">
<div class="box-header">
     <span class="pull-right"><button type="submit" class="btn bg-navy btn-flat margin" data-toggle="modal" data-target="#importclient" onclick="importclient();"><i class="fa fa-file-excel-o"></i> Import Client</button>
     <a href="/Debitor Import Sample.xlsx" download="/debitorSample.xlsx" class="btn bg-orange btn-flat margin"><i class="fa fa-download"></i> Sample</a>
          </span>
</div>
<div class="box-body">
    <div class="table-responsive">
<table class="table table-hover table-bordered table-striped datatable" width="100%">
    <thead>
        <tr class="bg-navy" style="font-size: 10px;">
            <th>ID</th>
            <th>DEPARTMENT NAME</th>
            <th>CONTACT</th>
            <!-- <th>OFFICE CONTACT</th> -->
            <th>OFC ADD</th>
            <th>CITY</th>
            <th>STATE</th>
            <th>COUNTRY</th>
            <th>GST NO</th>
            <th>PAN NO</th>
            <th>EDIT</th>
           <!--  <th>DELETE</th> -->
        </tr>
    </thead>
    <tbody>
        @foreach($clients as $client)
        <tr style="font-size: 12px;">
            <td>{{$client->id}}</td>
            <td><a href="/projects/viewallproject?client={{$client->id}}&status=ALL" target="_blank">{{$client->clientname}}</a></td>
            <td>{{$client->contact1}}</td>
            <!-- <td>{{$client->officecontact}}</td> -->
            <td>{{$client->officeaddress}}</td>
            <td>{{$client->city}}</td>
            <td>{{$client->state}}</td>
            <td>{{$client->country}}</td>
            <td>{{$client->gstn}}</td>
            <td>{{$client->panno}}</td>
           
            <td><a href="/projects/editclient/{{$client->id}}" class="btn btn-primary">EDIT</a></td>
        </tr>

        @endforeach
    </tbody>
</table>
</div>
</div>
</div>
@endif


<div class="modal fade in" id="importclient">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <form method="post" enctype="multipart/form-data" action="/importclient">
      <div class="modal-header bg-navy">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" style="color: #fff;">×</span>
      </button>
        <h4 class="modal-title text-center">Upload Debitor Excel</h4>
      </div>
      <div class="modal-body">
        
              
                {{ csrf_field() }}
                <div class="form-group">
                <label>Select File for Upload Client</label>
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
    function importclient(){
        alert("Do You Want To Upload Debitor Excel");
    }

</script>
@endsection