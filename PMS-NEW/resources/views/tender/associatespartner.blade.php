@extends('layouts.tender')
@section('content')

<table class="table table-responsive table-hover table-bordered table-striped" >
        <tr>
            <td colspan="4" class="text-center bg-navy">ADD A NEW ASSOCIATE</td>
        </tr>
        <tr>
@if(session('message'))
            <div class="alert alert-success text-center"  id="id">
                {{session('message')}}
            </div>
 @endif
<form action="/saveassociatepartner" method="POST" enctype="multipart/form-data">
    {{csrf_field()}}
         <td><strong>ASSOCIATE PARTNER NAME</strong><span style="color: red"> *</span></td>
         <td><input type="text" name="associatepartnername" class="form-control" placeholder="Enter Associate Partner Name Name" required=""></td>
         	<td><strong>OFFICE ADDRESS</strong><span style="color: red"> *</span></td>
        	<td><textarea name="officeaddress" class="form-control" placeholder="Enter Office address" required=""></textarea></td>
        </tr>
        <tr>
        	<td><strong>CONTACT NO</strong><span style="color: red"> *</span></td>
           <td><input type="number" name="contact1" class="form-control" placeholder="Enter Contact No"></td>
           <td><strong>ALTERNATIVE CONTACT NO</strong></td>
           <td><input type="number" name="contact2" class="form-control" placeholder="Enter Alternative Contact No"></td>
        </tr>
        <tr>
        	<td><strong>OFFICE CONTACT NO</strong></td>
           <td><input type="number" name="officecontact" class="form-control" placeholder="Enter Office  Contact No"></td>
        
           	<td><strong>EMAIL</strong></td>
           	<td><input type="email" name="email" class="form-control" placeholder="Enter Email Here"></td>
          
        </tr>

             <tr>
            <td><strong>GSTN</strong></td>
           <td><input type="text" name="gstn" class="form-control" placeholder="Enter Client GST No"></td>
        
            <td><strong>PAN NO</strong></td>
            <td><input type="text" name="panno" class="form-control" placeholder="Enter Client PAN No"></td>
          
        </tr>
    
        <tr>
        	<td><strong>CITY</strong><span style="color: red"> *</span></td>
         <td><input type="text" name="city" class="form-control" placeholder="Enter city Here" required=""></td>
         <td><strong>DISTICT</strong><span style="color: red"> *</span></td>
         <td><input type="text" name="dist" class="form-control" placeholder="Enter Distict Here" required=""></td>
        </tr>
        <tr>
        	<td><strong>STATE</strong><span style="color: red"> *</span></td>
         <td><input type="text" name="state" class="form-control" placeholder="Enter state Here" required=""></td>
         <td><strong>COUNTRY</strong><span style="color: red"> *</span></td>
         <td><input type="text" name="country" class="form-control" placeholder="Enter Country Here" required=""></td>
        </tr>
        <tr>
        	<td><strong>ADDITIONAL INFO</strong></td>
        	<td><textarea name="additionalinfo" class="form-control" placeholder="Enter Addional Info"></textarea></td>
        </tr>

                <tr>
            <td></td>
             <td colspan="4">
                <button type="submit" class="btn btn-success btn-lg" onclick="return confirm('Do You Want to Save This?')">Save</button>

</tr>
</table>

</form>
<table>
    
</table>
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Edit Associate Partner</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       <form action="/updateassociatepartner" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
    <table class="table table-hover table-bordered table-striped datatable1">
        <input type="hidden" name="apid" id="apid">
        <tr>
            <td><strong>ASSOCIATE PARTNER NAME</strong></td>
            <td><input type="text" class="form-control" autocomplete="off" placeholder="Enter ASSOCIATE Name" name="associatepartnername" id="associatepartnername"></td>
        </tr>
        <tr>
            <td><strong>OFFICE ADDRESS</strong></td>
            <td><textarea name="officeaddress" id="officeaddress" class="form-control" placeholder="Enter Office address"></textarea></td>
        </tr>
        <tr>
            <td><strong>CONTACT NO</strong></td>
            <td><input type="text" class="form-control" autocomplete="off" placeholder="Enter contact No." name="contact1" id="contact1"></td>
        </tr>
        <tr>
            <td><strong>ALTERNATIVE CONTACT NO</strong></td>
            <td><input type="text" class="form-control" autocomplete="off" placeholder="Enter Alternative contact No." name="contact2" id="contact2"></td>
        </tr>
        <tr>
            <td><strong>OFFICE CONTACT NO</strong></td>
            <td><input type="text" class="form-control" autocomplete="off" placeholder="Enter Office contact No." name="officecontact" id="officecontact"></td>
        </tr>
        <tr>
            <td><strong>EMAIL</strong></td>
            <td><input type="text" class="form-control" autocomplete="off" placeholder="Enter Email" name="email" id="email"></td>
        </tr>
        <tr>
            <td><strong>GSTN</strong></td>
            <td><input type="text" class="form-control" autocomplete="off" placeholder="Enter gstn" name="gstn" id="gstn"></td>
        </tr>
        <tr>
            <td><strong>PAN NO</strong></td>
            <td><input type="text" class="form-control" autocomplete="off" placeholder="Enter Pan No." name="panno" id="panno"></td>
        </tr>
        <tr>
            <td><strong>CITY</strong></td>
            <td><input type="text" class="form-control" autocomplete="off" placeholder="Enter City" name="city" id="city"></td>
        </tr>
        <tr>
            <td><strong>DISTICT</strong></td>
            <td><input type="text" class="form-control" autocomplete="off" placeholder="Enter DISTICT" name="dist" id="dist"></td>
        </tr>
        <tr>
            <td><strong>STATE</strong></td>
            <td><input type="text" class="form-control" autocomplete="off" placeholder="Enter State" name="state" id="state"></td>
        </tr>
        <tr>
            <td><strong>COUNTRY</strong></td>
            <td><input type="text" class="form-control" autocomplete="off" placeholder="Enter Country" name="country" id="country"></td>
        </tr>
        <tr>
            <td><strong>ADDITIONAL INFO</strong></td>
            <td><textarea name="additionalinfo" id="additionalinfo" class="form-control" placeholder="Enter Additional Information"></textarea></td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: right;">
                <button type="submit" class="btn btn-success btn-lg" onclick="return confirm('Do You Want to Update This?')">Update</button>
                
            </td>
        </tr>
    
    </table>
   </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

@if($associatepartners)
<div class="box">
<div class="box-body">
    <div style="overflow-x:auto;">
<table class="table table-responsive table-hover table-bordered table-striped datatable" width="100%">
    <thead>
        <tr class="bg-navy" style="font-size: 10px;">
            <th>ID</th>
            <th>ASSOCIATE PARTNER NAME</th>
            <th>OFFICE ADDRESS</th>
            <th>CONTACT NO</th>
            <th>ALTERNATIVE CONTACT NO</th>
            <th>OFFICE CONTACT NO</th>
            <th>GSTN</th>
            <th>PAN NO</th>
            <th>CITY</th>
            <th>STATE</th>
            <th>COUNTRY</th>
            <th>EDIT</th>
            <!-- <th>DELETE</th> -->
        </tr>
    </thead>
    <tbody>
        @foreach($associatepartners as $associatepartner)
        <tr style="font-size: 12px;">
            <td>{{$associatepartner->id}}</td>
            <td>{{$associatepartner->associatepartnername}}</td>
            <td>{{$associatepartner->officeaddress}}</td>
            <td>{{$associatepartner->contact1}}</td>
            <td>{{$associatepartner->contact2}}</td>
            <td>{{$associatepartner->officecontact}}</td>
            <td>{{$associatepartner->gstn}}</td>
            <td>{{$associatepartner->panno}}</td>
            <td>{{$associatepartner->city}}</td>
            <td>{{$associatepartner->state}}</td>
            <td>{{$associatepartner->country}}</td>
            <td><button type="button" onclick="openeditmodal('{{$associatepartner->id}}','{{$associatepartner->associatepartnername}}','{{$associatepartner->officeaddress}}','{{$associatepartner->contact1}}','{{$associatepartner->contact2}}','{{$associatepartner->officecontact}}','{{$associatepartner->email}}','{{$associatepartner->gstn}}','{{$associatepartner->panno}}','{{$associatepartner->city}}','{{$associatepartner->dist}}','{{$associatepartner->state}}','{{$associatepartner->country}}','{{$associatepartner->additionalinfo}}');" class="btn btn-primary">EDIT</button></td>

            <!-- <td>
                <form action="/deleteassociatepartner/{{$associatepartner->id}}" method="post">
                     {{method_field('DELETE')}}
                     {{csrf_field()}}
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Do You Want Delete this Client');">DELETE</button>
                    
                </form>
            </td> -->

        </tr>

@endforeach
    </tbody>
</table>
</div>
</div>
</div>
@endif
<script type="text/javascript">
    function openeditmodal(id,associatepartnername,officeaddress,contact1,contact2,officecontact,email,gstn,panno,city,dist,state,country,additionalinfo){

        $("#apid").val(id);
        $("#associatepartnername").val(associatepartnername);
        $("#officeaddress").val(officeaddress);
        $("#contact1").val(contact1);
        $("#contact2").val(contact2);
        $("#officecontact").val(officecontact);
        $("#email").val(email);
        $("#gstn").val(gstn);
        $("#panno").val(panno);
        $("#city").val(city);
        $("#dist").val(dist);
        $("#state").val(state);
        $("#country").val(country);
        $("#additionalinfo").val(additionalinfo);
        $("#myModal").modal('show');
        
       
    }
</script>
@endsection