@extends('layouts.app')

@section('content')
@if(Session::has('message'))
   <p class="alert alert-info text-center">{{ Session::get('message') }}</p>
   @endif
<form action="/updateclient/{{$client->id}}" method="post">
	{{csrf_field()}}
<table class="table table-responsive table-hover table-bordered table-striped" >
        <tr>
            <td colspan="4" class="text-center bg-navy">UPDATE DEBITOR</td>
        </tr>
        <tr>
         <td><strong>DEPARTMENT NAME</strong><span style="color: red"> *</span></td>
         <td><input type="text" name="clientname" value="{{$client->clientname}}" class="form-control" placeholder="Enter Client Name" required=""></td>
         <td><strong>TAN NUMBER</strong></td>
         <td><input type="text" value="{{$client->tanno}}" name="tanno" class="form-control" placeholder="Enter Tan Number"></td>
        </tr>
        <tr>
        	<td><strong>CONTACT NO</strong></td>
           <td><input type="number" name="contact1" value="{{$client->contact1}}" class="form-control" placeholder="Enter Contact No"></td>
           <td><strong>ALTERNATIVE CONTACT NO</strong></td>
           <td><input type="number" name="contact2" value="{{$client->contact2}}" class="form-control" placeholder="Enter Alternative Contact No"></td>
        </tr>
        <tr>
        	<td><strong>OFICE CONTACT NO</strong></td>
           <td><input type="number" name="officecontact" value="{{$client->officecontact}}" class="form-control" placeholder="Enter Office  Contact No"></td>
        
           	<td><strong>EMAIL</strong></td>
           	<td><input type="email" name="email" value="{{$client->email}}" class="form-control" placeholder="Enter Email Here"></td>
          
        </tr>
         <tr>
            <td><strong>GSTN <span style="color: red"> *</span></strong></td>
           <td><input type="text" value="{{$client->gstn}}" name="gstn" class="form-control" required placeholder="Enter Client GST No"></td>
        
            <td><strong>PAN NO <span style="color: red"> *</span></strong></td>
            <td><input type="text" name="panno" value="{{$client->panno}}" class="form-control" required placeholder="Enter Client PAN No"></td>
          
        </tr>
        <tr>
        	<td><strong>RESIDENT ADDRESS</strong></td>
        	<td><textarea name="residentaddress" class="form-control" placeholder="Enter Resident address"> {{$client->residentaddress}}   
            </textarea></td>
             
        	<td><strong>OFFICE ADDRESS</strong></td>
        	<td><textarea name="officeaddress" class="form-control" placeholder="Enter Office address">{{$client->officeaddress}} 
            </textarea></td>
        </tr>
        
        <tr>
        	<td><strong>STATE</strong></td>
         <td><input type="text" name="state" value="{{$client->state}}" class="form-control" placeholder="Enter state Here"></td>
         <td><strong>COUNTRY</strong></td>
         <td><input type="text" name="country" value="{{$client->country}}" class="form-control" placeholder="Enter Country Here"></td>
        </tr>
        <tr>
        	<td><strong>ADDITIONAL INFO</strong></td>
        	<td><textarea name="additionalinfo" class="form-control" placeholder="Enter Addional Info">{{$client->additionalinfo}}   
            </textarea></td>
            <td><strong>TIN NUMBER</strong></td>
         <td><input type="text" name="tinno" value="{{$client->tinno}}" class="form-control" placeholder="Enter Tin Number"></td>
        </tr>
        <tr>
            <td><strong>CITY</strong></td>
         <td><input type="text" name="city" value="{{$client->city}}" class="form-control" placeholder="Enter city Here"></td>
         
        </tr>

                <tr>
            <td></td>
             <td colspan="4"><input type="submit" value="Submit" class="btn btn-success" style="float: right ;"></td>
</tr>
</table>

</form>
<table>
    
</table>
@endsection