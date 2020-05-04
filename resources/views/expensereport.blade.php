@extends('layouts.app')

@section('content')
@inject('provider', 'App\Http\Controllers\AccountController')
<style type="text/css">
    .b {
    white-space: nowrap; 
    width: 100px; 
    overflow: hidden;
    text-overflow: ellipsis; 
   
}
</style>
<table class="table">
    <tr class="bg-blue">
		 <td class="text-center">EXPENSE REPORTS</td>
	</tr>

	
</table>
<table class="table">
	<tr class="bg-yellow">
		<td colspan="6" class="text-center">FILTER</td>
	</tr>
		<tr>
		<td width="10%"><strong>DATE FROM</strong></td>
		<td width="23%"><input type="text" class="form-control datepicker readonly" name="fromdate" id="fromdate" autocomplete="off" value="{{ Request::get('fromdate') }}"></td>
		<td width="10%"><strong>DATE TO</strong></td>
		<td width="23%"><input type="text" class="form-control datepicker readonly" name="todate" id="todate" autocomplete="" value="{{ Request::get('todate') }}"></td>
		<td width="10%"><strong>SELECT USER</strong></td>
		<td width="23%">
			<select class="form-control select2" name="user" id="user">
				<option value="">Select user</option>
				@foreach($users as $user)
                <option value="{{$user->id}}" {{ ( $user->id == Request::get('user')) ? 'selected' : '' }}>{{$user->name}}</option>
				@endforeach
				
			</select>
		</td>
	</tr>

	<tr>
		<td width="10%"><strong>SELECT A PROJECT</strong></td>
		<td width="23%">
		<select class="form-control select2" name="projectname" id="projectname">
		 <option value="">Select a project</option>
		  <option value="OTHERS" {{ (Request::get('projectname')=="OTHERS") ? 'selected' : '' }}>OTHERS</option>
			@foreach($projects as $project)
               <option value="{{$project->id}}" {{ ( $project->id == Request::get('projectname')) ? 'selected' : '' }}>{{$project->projectname}}</option>
			@endforeach
		</select>
	    </td>
	    <td width="10%"><strong>EXPENSE HEAD</strong></td>
	    <td width="23%">
	    	<select class="form-control select2" name="expenseheadname" id="expenseheadname">
	    		<option value="">select a expensehead</option>
	    		@foreach($expenseheads as $expensehead)
                  <option value="{{$expensehead->id}}" {{ ( $expensehead->id == Request::get('expenseheadname')) ? 'selected' : '' }}>{{$expensehead->expenseheadname}}</option>
	    		@endforeach
	    		
	    	</select>
	    </td>
	    <td width="10%"><strong>STATUS</strong></td>
	    <td width="23%">
	    	
	    	<select class="form-control" id="status">
	    		<option value="">Select a Status</option>
	    		<option value="PENDING" {{ Request::get('status')=="PENDING" ? 'selected' : '' }}>PENDING</option>
	    		<option value="APPROVED" {{ Request::get('status')=="APPROVED" ? 'selected' : '' }}>APPROVED</option>
	    		<option value="PARTIALLY APPROVED" {{ Request::get('status')=="PARTIALLY APPROVED" ? 'selected' : '' }}>PARTIALLY APPROVED</option>
	    		<option value="CANCELLED" {{ Request::get('status')=="CANCELLED" ? 'selected' : '' }}>CANCELLED</option>

	    	</select>
	    	
	    </td>
	</tr>
	<tr>
		<td><button type="button" class="btn btn-primary" onclick="filter();">FILTER</button></td>
	</tr>
	
</table>
	@if($searchcount>0)
  <table class="table">
  
    <tr class="bg-gray">

    	 <td  class="text-center"><strong style="font-size: 20px;color: blue;"><span class="label label-success">{{count($expenseentries)}} records Found)</span></strong></td>
          <td ><a href="/reports/expensereport" class="btn btn-danger">Clear Search</a></td>
     

    </tr>
    
  </table>
  @endif

<hr>

<div class="table-responsive">
	<table class="table table-responsive table-hover table-bordered table-striped datatable1" width="100%">
	<thead>
		<tr class="bg-navy" style="font-size: 10px;">
			<td>ID</td>
			<td>NAME</td>
			<td>PROJECT</td>
			<td>EXPENSEHEAD</td>
			<td>PARTICULAR</td>
			<td>DESCRIPTION</td>
			<td>AMOUNT</td>
			<td>APPROVAL AMOUNT</td>
			<td>STATUS</td>
			<td>REMARKS</td>
			<td>EXPENSE FOR DATES</td>
			<td>CREATED AT</td>
		</tr>
	</thead>
	<tbody>
		@foreach($expenseentries as $expenseentry)
		<tr style="font-size: 12px;">
			<td><a target="_blank" href="/viewexpenseentrydetails/{{$expenseentry->id}}" class="btn btn-info">{{$expenseentry->id}}</a></td>
			<td>{{$expenseentry->name}}</td>
			@if($expenseentry->projectname!='')
			<td><p class="b" title="{{$expenseentry->projectname}}">{{$expenseentry->projectname}}</p></td>
			@else
             <td>OTHERS</td>
			@endif
			<td>{{$expenseentry->expenseheadname}}</td>
			<td>{{$expenseentry->particularname}}</td>
			<td><p class="b" title="{{$expenseentry->description}}">{{$expenseentry->description}}</p></td>
			<td style="text-align: right;">{{$provider::moneyFormatIndia($expenseentry->amount)}}</td>
			<td style="text-align: right;">{{$provider::moneyFormatIndia($expenseentry->approvalamount)}}</td>
			<td>{{$expenseentry->status}}</td>
			<td>{{$expenseentry->remarks}}</td>

			@if($expenseentry->fromdate!='')
            <td>({{$expenseentry->fromdate}} - {{$expenseentry->todate}})</td>
			@else
			<td></td>

			@endif
			<td>{{$expenseentry->created_at}}</td>
			
		</tr>
		@endforeach
	</tbody>
	<tfoot>
		<tr class="bg-gray">
			<td colspan="6" class="text-center">TOTAL</td>
			<td style="text-align: right;">Rs.{{$provider::moneyFormatIndia($expenseentries->sum('amount'))}}</td>
			<td style="text-align: right;">Rs.{{$provider::moneyFormatIndia($expenseentries->sum('approvalamount'))}}</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>

		</tr>
		
	</tfoot>
	
</table>
</div>
<script type="text/javascript">
	function filter()
	{
	
      var fromdate=$("#fromdate").val();
       var todate=$("#todate").val();
       var user=$("#user").val();
       var projectname=$("#projectname").val();
       var expenseheadname=$("#expenseheadname").val();
       var status=$("#status").val();

           location.href='?fromdate='+fromdate+'& todate='+todate+'& user='+user+' &projectname='+projectname+'& expenseheadname='+expenseheadname+'& status='+status;

	}
</script>
@endsection