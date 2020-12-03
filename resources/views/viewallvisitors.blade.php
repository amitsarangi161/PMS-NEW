@extends('layouts.app')

@section('content')

<style type="text/css">
  .status{
    cursor: pointer;
  }
</style>
<div class="box">
@if(Session::has('message'))
<p class="alert alert-success">{{ Session::get('message') }}</p>
@endif
@if(Session::has('error'))
<p class="alert alert-danger">{{ Session::get('error') }}</p>
@endif
      <div class="box-body table-responsive">
        <table class="table table-bordered table-striped datatablescrollexport">
        <thead>
          <tr class="bg-navy">
            <td>Id</td>
            <td>VISITORS NAME</td>
            <td>MOBILE NUMBER</td>
            <td>ADDRESS</td>
            <td>PURPOSE </td>
            <td>ENTRY TIME</td>
            <td>EXIT TIME</td>
            <td>WHOM TO MEET</td>
            <td>EDIT</td>
          </tr>
        </thead>
        <tbody>
          @foreach($receptiondetails as $key=>$receptiondetail)
          <tr>
            <td><a href="/rcp/viewreception/{{$receptiondetail->id}}"><button class="btn btn-info btn-sm btn-flat">{{$receptiondetail->id}}</button></a></td>
            <td>{{$receptiondetail->visitorname}}</td>
            <td>{{$receptiondetail->mobile}}</td>
            <td>{{$receptiondetail->address}}</td>
            <td>{{$receptiondetail->purpose }}</td>
            <td>{{$receptiondetail->entrytime}}</td>
            <td>{{$receptiondetail->exittime}}</td>
            <td>{{$receptiondetail->whomtomeet}}</td>
            <td><a href="/rcp/editreception/{{$receptiondetail->id}}" onclick="return confirm('are you sure to edit this ??')" ><button class="btn btn-primary btn-flat">Edit</button></a></td>
          </tr>
          @endforeach
        </tbody>
      
      </table>
  </div>

</div>


@endsection