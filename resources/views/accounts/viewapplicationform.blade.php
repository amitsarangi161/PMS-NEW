@extends('layouts.account')
@section('content')
@inject('provider', 'App\Http\Controllers\AccountController')
<style type="text/css">
    .b {
    white-space: nowrap; 
    width: 150px; 
    overflow: hidden;
    text-overflow: ellipsis; 
   
}
</style>
<h3 style="text-align: center;color: blue;font-weight: bold;">VIEW ALL REQUISITIONS</h3>
<div class="table-responsive">
	

<table class="table table-responsive table-hover table-bordered table-striped datatable1">
	<thead>
		<tr class="bg-navy">
			<th>ID</th>
			<th>NAME</th>
			<th>PROJECT NAME</th>
			<th>AUTHOR</th>
			<th>TOTAL AMOUNT</th>
			<th>APPROVAL AMOUNT</th>
			<th>APPROVED BY</th>
			<th>STATUS</th>
			<th>CREATED AT</th>
			<th>FROM-TO</th>
			<th>VIEW</th>
			<!-- <th>EDIT</th> -->
			<th>DELETE</th>
			
		</tr>
	</thead>
	<tbody>
		@foreach($requisitions as $requisition)
		<tr>

			  <td><a href="/viewapplicationdetails/{{$requisition->id}}" class="btn btn-info">{{$requisition->id}}</a></td>
			  <td>{{$requisition->employee}}</td>
			 @if($requisition->projectname!='')
			   <td><p class="b" title="{{$requisition->projectname}}">{{$requisition->projectname}}</p></td>
			  @else
              <td>OTHERS</td>
			  @endif
			  <td>{{$requisition->author}}</td>
			  <td>{{$provider::moneyFormatIndia($requisition->totalamount)}}</td>
			  <td>{{$provider::moneyFormatIndia($requisition->approvalamount)}}</td>
			  <td>{{$requisition->approver}}</td>
			  @if($requisition->status=='PENDING')
			  <td><span class="label label-danger">{{$requisition->status}}</span></td>
			  @else
                <td><span class="label label-primary">{{$requisition->status}}</span></td>
			  @endif
			  <td>{{$requisition->created_at}}</td>
			  @if($requisition->datefrom!='')
			  <td>({{$requisition->datefrom}})||({{$requisition->dateto}})</td>
			  @else
			    <td></td>
			  @endif
             <td><a href="/viewapplicationdetails/{{$requisition->id}}" class="btn btn-info">VIEW</a></td>
			  @if($requisition->status=='PENDING MGR' || $requisition->status=='PENDING')
			  <!-- <td><a href="/editrequisition/{{$requisition->id}}" class="btn btn-primary">EDIT</a></td> -->
			  <td>
			  	<form action="/deleterequisition/{{$requisition->id}}" method="POST">
			  		{{csrf_field()}}
			  		{{method_field('DELETE')}}
			  		<button type="submit" class="btn btn-danger" onclick="return confirm('Do You Want This Requisition');">DELETE</button>

			  		
			  	</form>
			  </td>
			  @else
              <!--  <td><button class="btn btn-primary" type="button" disabled="">EDIT</button></td> -->
               <td><button class="btn btn-danger" type="button" disabled="">DELETE</button></td>
               

			  @endif

		</tr>
		@endforeach
	</tbody>
</table>

</div>
@endsection