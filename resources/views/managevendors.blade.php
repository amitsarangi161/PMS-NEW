@extends('layouts.app')
@section('content')

<table class="table table-responsive table-hover table-bordered table-striped datatable">
       <thead class="bg-navy">
       	   <tr>
       	   	<th>ID</th>
       	   	<th>VENDOR NAME</th>
       	   	<th>MOBILE</th>
       	   	<th>DETAILS</th>
       	   	<th>VENDORS ID PROOF</th>
       	   	<th>PHOTO</th>
       	   	<th>ADDED BY</th>
       	   	<th>EDIT</th>
       	   <!-- 	<th>DELETE</th> -->
       	   </tr>
       </thead>
       <tbody>
       	@foreach($vendors as $vendor)
           <tr>
           	<td>{{$vendor->id}}</td>
           	<td>{{$vendor->vendorname}}</td>
           	<td>{{$vendor->mobile}}</td>
           	<td>{{$vendor->details}}</td>
           	<td>
              <a href="{{ asset('/img/vendor/'.$vendor->vendoridproof )}}" target="_blank">
              <img style="height:70px;width:95px;" alt="click to view the file"  src="{{ asset('/img/vendor/'.$vendor->vendoridproof )}}">
            </a>
            </td>
           	<td>
              <a href="{{ asset('/img/vendor/'.$vendor->photo )}}" target="_blank">
              <img style="height:70px;width:95px;" alt="click to view the file"  src="{{ asset('/img/vendor/'.$vendor->photo )}}">
            </a>
            </td>
           	<td>{{$vendor->name}}</td>
           	<td><a href="/edituservendor/{{$vendor->id}}" class="btn btn-primary">EDIT</a></td>
         <!--   	<td>
           		<form action="/deletevendor/{{$vendor->id}}" method="post">
           			{{csrf_field()}}
           			{{method_field('DELETE')}}
           			<button class="btn btn-danger" type="submit" onclick="return confirm('Do You Want to Delete this Vendor?')">DELETE</button>
           			
           		</form>
           			
           	</td> -->
           </tr>
       	@endforeach
       
       </tbody>
	</table>
@endsection