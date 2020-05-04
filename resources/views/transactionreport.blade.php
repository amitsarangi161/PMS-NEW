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

.babar { animation: disparais 0s 5s forwards;
 }

@keyframes disparais {
  to   { visibility: hidden; }
}

</style>
<table class="table">
	<tr class="bg-blue">
		<td class="text-center">TRANSACTION REPORT</strong></td>
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
    <td width="23%"><input type="text" class="form-control datepicker readonly" name="todate" id="todate" autocomplete="off" value="{{ Request::get('todate') }}"></td>
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
      <td width="10%"><strong>STATUS</strong></td>
      <td width="23%">
        <select class="form-control" id="status">
          <option value="">Select a Status</option>
          <option value="PENDING" {{ Request::get('status')=="PENDING" ? 'selected' : '' }}>PENDING</option>
          <option value="PAID" {{ Request::get('status')=="PAID" ? 'selected' : '' }}>PAID</option>
         
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


       <td  class="text-center"><strong style="font-size: 20px;color: blue;"><span class="label label-success">{{count($requisitionpayments)}} records Found)</span></strong></td>
          <td ><a href="/reports/paymentreports" class="btn btn-danger">Clear Search</a></td>
     

    </tr>
    
  </table>
  @endif





<table class="table table-responsive table-hover table-bordered table-striped datatable1">
     <thead>
     	<tr class="bg-navy">
     		<th>ID</th>
        <th>REQUISITION ID</th>
        <th>FOR PROJECT</th>
     		<th>NAME</th>
     		<th>AMOUNT</th>
     		<th>PAYMENT TYPE</th>
        <th>TRANSACTION ID</th>
     		<th>REMARKS</th>
     		<th>PAYMENT STATUS</th>
        <th>DATE OF PAYMENT</th>
     		<th>ENTRY DATE</th>
   


     	</tr>
	
     </thead>
     <tbody>
     	@foreach($requisitionpayments as $requisitionpayment)
           <tr>
           	  <td>{{$requisitionpayment->id}}</td>
              <td>{{$requisitionpayment->rid}}</td>
           
              @if($requisitionpayment->projectname!='')
      <td><p class="b" title="{{$requisitionpayment->projectname}}">{{$requisitionpayment->projectname}}</p></td>
      @else
             <td>OTHERS</td>
      @endif
           	  <td>{{$requisitionpayment->name}}</td>
           	  <td>{{$provider::moneyFormatIndia($requisitionpayment->amount)}}</td>
           	  <td>{{$requisitionpayment->paymenttype}}</td>
              <td>{{$requisitionpayment->transactionid}}</td>
           	  <td>{{$requisitionpayment->remarks}}</td>
           	  <td>{{$requisitionpayment->paymentstatus}}</td>
              <td>{{$requisitionpayment->dateofpayment}}</td>
           	  <td>{{$requisitionpayment->created_at}}</td>
       
             
           </tr>

     	@endforeach
     </tbody>
     <tbody>
       <tr style="background-color: greenyellow;">
         <td></td>
         <td></td>
         <td></td>
         <td><strong>TOTAL</strong></td>
         <td><strong>{{$provider::moneyFormatIndia($requisitionpayments->sum('amount'))}}</strong></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         

       </tr>
     </tbody>
</table>
<script type="text/javascript">
  function filter()
  {
  
      var fromdate=$("#fromdate").val();
       var todate=$("#todate").val();
       var user=$("#user").val();
       var projectname=$("#projectname").val();
       var status=$("#status").val();

           location.href='?fromdate='+fromdate+'& todate='+todate+'& user='+user+' &projectname='+projectname+'& status='+status;

  }
</script>


@endsection