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
		 <td class="text-center">PAYMENT REPORTS</td>
	</tr>

	
</table>
<table class="table">
	<tr class="bg-yellow">
		<td colspan="6" class="text-center">FILTER</td>
	</tr>
		<tr>
		<td width="10%"><strong>DATE FROM</strong></td>
		<td width="23%"><input type="text" class="form-control datepicker readonly" name="fromdate" autocomplete="off" id="fromdate" value="{{ Request::get('fromdate') }}"></td>
		<td width="10%"><strong>DATE TO</strong></td>
		<td width="23%"><input type="text" autocomplete="off" class="form-control datepicker readonly" name="todate" value="{{ Request::get('todate') }}" id="todate"></td>
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
	    <td colspan="2" class="text-center" width="33%">
	    	<button type="button" class="btn btn-primary" onclick="filter();">FILTER</button>
	    </td>
	</tr>
	
</table>
	@if($searchcount>0)
  <table class="table">
  
    <tr class="bg-gray">

    	 <td  class="text-center"><strong style="font-size: 20px;color: blue;"><span class="label label-success">{{count($requisitions)}} records Found)</span></strong></td>
          <td ><a href="/reports/paymentreports" class="btn btn-danger">Clear Search</a></td>
     

    </tr>
    
  </table>
  @endif

<hr>

<div class="table-responsive">
	<table class="table table-responsive table-hover table-bordered table-striped datatable1" width="100%">
	<thead>
		<tr class="bg-navy" style="font-size: 10px;">
			<td>ID</td>
			<td>RID</td>
			<td>NAME</td>
			<td>PROJECT</td>
			<td>EXPENSEHEAD</td>
			<td>PARTICULAR</td>
			<td>DESCRIPTION</td>
			<td>AMOUNT</td>
			<td>APPROVAL AMOUNT</td>
			<td>STATUS</td>
			<td>REMARKS</td>
			<td>REQUISITION FOR DATES</td>
			<td>CREATED AT</td>
		</tr>
	</thead>
	<tbody>
		@foreach($requisitions as $requisition)
		<tr style="font-size: 12px;">
			<td>{{$requisition->id}}</td>
			<td>{{$requisition->requisitionheaderid}}</td>
			<td>{{$requisition->name}}</td>
			@if($requisition->projectname!='')
			<td><p class="b" title="{{$requisition->projectname}}">{{$requisition->projectname}}</p></td>
			@else
             <td>OTHERS</td>
			@endif
			<td>{{$requisition->expenseheadname}}</td>
			<td>{{$requisition->particularname}}</td>
			<td><p class="b" title="{{$requisition->description}}">{{$requisition->description}}</p></td>
			<td>{{$provider::moneyFormatIndia($requisition->amount)}}</td>
			<td>{{$provider::moneyFormatIndia($requisition->approvedamount)}}</td>
			<td>{{$requisition->approvestatus}}</td>
			<td>{{$requisition->remarks}}</td>

			@if($requisition->datefrom!='')
            <td>({{$requisition->datefrom}} - {{$requisition->dateto}})</td>
			@else
			<td></td>

			@endif
			<td>{{$requisition->created_at}}</td>
			
		</tr>
		@endforeach
	</tbody>
	<tfoot>
		<tr class="bg-gray">
			
			<td colspan="7" class="text-center">TOTAL</td>
			<td>Rs.{{$provider::moneyFormatIndia($requisitions->sum('amount'))}}</td>
			<td>Rs.{{$provider::moneyFormatIndia($requisitions->sum('approvedamount'))}}</td>
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

           location.href='?fromdate='+fromdate+'& todate='+todate+'& user='+user+' &projectname='+projectname+'& expenseheadname='+expenseheadname;

	}
</script>
@endsection