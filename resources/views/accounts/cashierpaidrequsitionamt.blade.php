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
<table class="table">
	<tr class="bg-blue">
		<td class="text-center">REQUISITION PAID AMOUNT FROM BANK</td>
	</tr>
	 
</table>

 <div class="row">
   <form action="/prb/requisitiononlinepaid" method="get">
  <div class="col-md-6">
     <select class="form-control select2" name="projectname" required="">
            
            <option value="ALL" {{(Request::get('projectname')=='ALL')?'selected':''}}>PROJECT</option>
            @foreach($projects as $project)
            <option value="{{$project->id}}" {{($project->id==Request::get('projectname'))?'selected':''}}>{{$project->projectname}}@if($project->schemename!='') [Scheme : {{$project->schemename}}]@endif</option>
            @endforeach
      </select>
  </div>
  <div class="col-md-3">
    <button type="submit" class="btn btn-primary">Filter</button>
   @if(Request::has('projectname') )
 <a href="/prb/requisitiononlinepaid" class="btn btn-danger">Clear</a>
  @endif
  </div>
  </form>
</div>
   

     






    
  </table>
<div class="table-responsive">
<table class="table  table-hover table-bordered table-striped datatablescrollexport">
     <thead>
     	<tr class="bg-navy">
     		<th>ID</th>
        <th>PROJECT NAME</th>
        <th>REQUISITION ID</th>
     		<th>NAME</th>
     		<th>AMOUNT</th>
     		<th>PAYMENT TYPE</th>
        <th>TRANSACTION ID</th>
        <th>CHEQUE NO</th>
     		<th>REMARKS</th>
     		<th>PAYMENT STATUS</th>
        <th>DATE OF PAYMENT</th>
     		
     		<th>VIEW</th>


     	</tr>
	
     </thead>
     <tbody>
     	@foreach($requisitionpayments as $requisitionpayment)
           <tr>
           	  <td>{{$requisitionpayment->id}}</td>
              <td><p class="b" title="{{$requisitionpayment->projectname}}">{{$requisitionpayment->projectname}}
              </p>
              <p>
              @if($requisitionpayment->schemename!='')
                [Scheme : {{$requisitionpayment->schemename}}]
                @endif
              </p>
            </td>
              <td>{{$requisitionpayment->rid}}</td>
           	  <td>{{$requisitionpayment->name}}</td>
           	  <td>{{$requisitionpayment->amount}}</td>
           	  <td>{{$requisitionpayment->paymenttype}}</td>
              <td>{{$requisitionpayment->transactionid}}</td>
              <td>{{$requisitionpayment->chequeno}}</td>
           	  <td>{{$requisitionpayment->remarks}}</td>
           	  <td>{{$requisitionpayment->paymentstatus}}</td>
           	  <td>{{$provider::changedateformat($requisitionpayment->dateofpayment)}}</td>
           	  <!-- <td><button type="button" class="btn btn-primary" onclick="payonline('{{$requisitionpayment->id}}');">PAID</button></td> -->
              <td><a href="/cashierviewdetailsonlinepayment/{{$requisitionpayment->id}}" class="btn btn-primary">VIEW</a></td>
           </tr>

     	@endforeach
     </tbody>
     <tfoot>
       <tr style="background-color: greenyellow;">
         <td></td>
         <td></td>
         <td></td>
         <td><strong>TOTAL</strong></td>
         <td><strong>{{$requisitionpayments->sum('amount')}}</strong></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>

       </tr>
     </tfoot>
</table>
</div>


@endsection