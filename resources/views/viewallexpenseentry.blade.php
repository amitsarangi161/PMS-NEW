@extends('layouts.app')
@section('content')

<style type="text/css">



       .b {
    white-space: nowrap; 
    width: 120px; 
    overflow: hidden;
    text-overflow: ellipsis; 
   

}
</style>
<div class="row">
 <div class="col-md-12">
  <div class="box">
    <div class="box-header bg-gray">
  <form method="get" action="/useraccounts/viewallexpenseentry">
    <div class="form-group">
      <label  class="col-sm-2 control-label">Select A Status</label>
      <div class="col-sm-4">
        <select class="form-control" required="" name="status">
            <option value="">Select A Status</option>
            <option value="APPROVED" {{ Request::get('status')=="APPROVED" ? 'selected' : '' }}>APPROVED</option>
            <option value="PENDING" {{ Request::get('status')=="PENDING" ? 'selected' : '' }}>PENDING</option>
            <option value="PARTIALLY APPROVED" {{ Request::get('status')=="PARTIALLY APPROVED" ? 'selected' : '' }}>PARTIALLY APPROVED </option>
            <option value="CANCELLED" {{ Request::get('status')=="CANCELLED" ? 'selected' : '' }}>CANCELLED </option>
        </select>
      </div>
      <div class="col-sm-1">
        <button type="submit" class="btn  btn-primary">Filter</button>
      </div>
      @if(Request::has('status'))
      <div class="col-sm-1">
        <a href="/useraccounts/viewallexpenseentry"  class="btn  btn-danger">Clear Filter</a>
      </div>
      @endif
    </div>
  </form>
  </div>
</div>
</div>
</div>

<div style="overflow-x:auto;">
<table class="table table-responsive table-hover table-bordered table-striped datatable1">
	<thead>
		<tr class="bg-navy" style="font-size: 10px;">
			<th>ID</th>
			<th>EMPLOYEE</th>
			<th>PROJECT</th>
	
			<th>EXPENSE HEAD</th>
      <th>PARTICULAR</th>
			<th>VENDOR</th>
      <th>STATUS</th>
      <th>AMOUNT</th>
			<th>APPROVAL AMOUNT</th>
      <th>ADDED BY</th>
			<th>APPROVED BY</th>

			<th>CREATED AT</th>
      <th>UPLOADED FILE</th>
      <th>VIEW</th>
			<!-- <th class="noprint">DELETE</th> -->

		</tr>
	</thead>
	<tbody>
    @foreach($expenseentries as $expenseentry)
		<tr style="font-size: 12px;">
       @if($expenseentry->status=='CANCELLED')
        <td><a href="/viewuserexpenseentrydetails/{{$expenseentry->id}}" class="btn bg-red">{{$expenseentry->id}}</a></td>
        @elseif($expenseentry->status=='PARTIALLY APPROVED')
        <td><a href="/viewuserexpenseentrydetails/{{$expenseentry->id}}" class="btn bg-orange">{{$expenseentry->id}}</a></td>@elseif($expenseentry->status=='APPROVED')
        <td><a href="/viewuserexpenseentrydetails/{{$expenseentry->id}}" class="btn bg-green">{{$expenseentry->id}}</a></td>
        @else
        <td><a href="/viewuserexpenseentrydetails/{{$expenseentry->id}}" class="btn btn-primary">{{$expenseentry->id}}</a></td>
         @endif
        <td>{{$expenseentry->for}}</td>
        @if($expenseentry->projectname!='')
        <td><p class="b" title="{{$expenseentry->projectname}}">{{$expenseentry->projectname}}</p></td>
        @else
        <td><strong>OTHERS</strong></td>
        @endif
      
        <td>{{$expenseentry->expenseheadname}}</td>
        <td>{{$expenseentry->particularname}}</td>
        <td>{{$expenseentry->vendorname}}</td>
        <td>{{$expenseentry->status}}</td>
        <td>{{$expenseentry->amount}}</td>
        <td>{{$expenseentry->approvalamount}}</td>
        <td>{{$expenseentry->by}}</td>
        <td>{{$expenseentry->approvedbyname}}</td>
			  <td>{{$expenseentry->created_at}}</td>
         <td>
          <a href="{{ asset('/img/expenseuploadedfile/'.$expenseentry->uploadedfile )}}" target="_blank">
          <img style="height:70px;width:95px;" alt="click to view" src="{{ asset('/img/expenseuploadedfile/'.$expenseentry->uploadedfile )}}"></a>
        </td>
         
        <td><a href="/viewuserexpenseentrydetails/{{$expenseentry->id}}" class="btn btn-warning">VIEW</a></td>

<!--         @if($expenseentry->status=='PENDING')
        <td>
          <form action="/deleteexpenseentry/{{$expenseentry->id}}" method="post">
            {{csrf_field()}}
            {{method_field('DELETE')}}
            <button type="submit" class="btn btn-danger" onclick="return confirm('Do You Want to Delete This Expense Entry');">DELETE</button>

            
          </form>
        </td>
        @else
          <td> <button type="button" class="btn btn-danger" disabled>DELETE</button></td>

        @endif -->
        

		</tr>
    @endforeach
	</tbody>
<tfoot>
    <tr class="bg-gray">
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td>TOTAL EXPENSE</td>
      <td><strong>Rs.{{$expenseentries->sum('approvalamount')}}</strong></td>
      <td>TOTAL WALLET EXPENSE</td>
      <td><strong>Rs.{{$expenseentries1->sum('approvalamount')}}</strong></td>
      <td>ACCTUAL EXPENSE MADE</td>
      <td><strong>{{$expenseentries->sum('approvalamount')-$expenseentries1->sum('approvalamount')}}</strong></td>
      <td></td>
      <!-- <td></td> -->
      
    </tr>
  </tfoot>
	
</table>
</div>
@endsection