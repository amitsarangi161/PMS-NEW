@extends('layouts.app')

@section('content')
@if(Session::has('message'))
   <p class="alert alert-info text-center">{{ Session::get('message') }}</p>
   @endif
<table class="table">
    <tr class="bg-blue">
        <td class="text-center">VIEW ALL CLIENTS DETAILS</td>
    </tr>
    
</table>
<div class="box">
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
            <td><a title="click to view all projects of this client" href="/projects/viewallproject?client={{$client->id}}&status=ALL" target="_blank">{{$client->clientname}}</a></td>
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


@endsection
