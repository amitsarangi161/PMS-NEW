@extends('layouts.account')
@section('content')

<table class="table table-responsive table-hover table-bordered table-striped">
	<tr class="bg-blue">
		<td class="text-center">VIEW EXPENSE ENTRY DETAILS</td>
	</tr>
	
</table>
<div class="well">
<table class="table">
	<tr>
		<td><strong>EXPENSE ENTRY ID:</strong></td>
		<td><strong>#{{$expenseentry->id}}</strong></td>
		<td><strong>FOR EMPLOYEE</strong></td>
		<td><strong>{{$expenseentry->for}}</strong></td>
		
	</tr>

	<tr>
		<td><strong>PROJECT NAME :</strong></td>
		<td width="40%"><strong>{{$expenseentry->projectname}}</strong></td>
		<td><strong>FOR CLIENT</strong></td>
		<td><strong>{{$expenseentry->clientname}}</strong></td>
		
	</tr>
	<tr>
		<td><strong>EXPENSE HEAD NAME :</strong></td>
		<td><strong>{{$expenseentry->expenseheadname}}</strong></td>
		<td><strong>PARTICULAR NAME</strong></td>
		<td><strong>{{$expenseentry->particularname}}</strong></td>
		
	</tr>
	<tr>
		<td><strong>VENDOR NAME :</strong></td>
		<td><strong>{{$expenseentry->vendorname}}</strong></td>
		<td><strong>AMOUNT</strong></td>
		<td style="background-color: chartreuse;"><strong>{{$expenseentry->amount}}</strong></td>
		
	</tr>
		<tr>
		<td><strong>APPROVAL AMOUNT :</strong></td>
		<td><strong>{{$expenseentry->approvalamount}}</strong></td>
		<td><strong>APPROVED BY</strong></td>
		<td><strong>{{$expenseentry->approvedbyname}}</strong></td>
		
	</tr>
	<tr>
		<td><strong>ENTRY BY</strong></td>
		<td><strong>{{$expenseentry->by}}</strong></td>
		<td><strong>CREATED_AT</strong></td>
		<td><strong>{{$expenseentry->created_at}}</strong></td>
		
	</tr>
	@if($expenseentry->version=='NEW')
     @if($expenseentry->type!="OTHERS")
     <tr class="bg-info">
		<td><strong>DATE FROM</strong></td>
		<td ><strong>{{$expenseentry->fromdate}}</strong></td>
		<td><strong>DATE TO</strong></td>
		<td ><strong>{{$expenseentry->todate}}</strong></td>
		
	</tr>
	@else
	<tr class="bg-info">
		<td><strong>FOR DATE</strong></td>
		<td ><strong>{{$expenseentry->date}}</strong></td>
		<td></td>
		<td ></td>
		
	</tr>

	@endif
	@else
	<tr class="bg-info">
		<td><strong>DATE FROM</strong></td>
		<td ><strong>{{$expenseentry->fromdate}}</strong></td>
		<td><strong>DATE TO</strong></td>
		<td ><strong>{{$expenseentry->todate}}</strong></td>
		
	</tr>
    @endif
	<tr>
		<td><strong>DESCRIPTIONS</strong></td>
		<td style="background-color: skyblue;"><strong>{{$expenseentry->description}}</strong></td>
		<td><strong>TYPE</strong></td>
		<td style="background-color: aqua; "><strong>{{$expenseentry->type}}</strong></td>
		
	</tr>
	<tr>
		<td><strong>UPLOADED FILE</strong></td>
		 <td>
		 	<a href="{{ asset('/img/expenseuploadedfile/'.$expenseentry->uploadedfile )}}" target="_blank">
		 	<img title="click to view the image" style="height:100px;width:150px;" alt="click to view" src="{{ asset('/img/expenseuploadedfile/'.$expenseentry->uploadedfile )}}">
		 	<strong>Click Here To View</strong>
		 	</a>
		 </td>
		 <td>
		 	 <a href="{{ asset('/img/expenseuploadedfile/'.$expenseentry->uploadedfile )}}" download>
		 	 	<button class="btn"><i class="fa fa-download"></i> Download</button>
		 	 </a>
		 </td>
	</tr>
	<tr>
		<td><strong>STATUS</strong></td>
		<td><span class="label label-info">{{$expenseentry->status}}</span></td>
		<td><strong>REMARKS :</strong></td>
		<td><strong>{{$expenseentry->remarks}}</strong></td>
	</tr>
</table>

</div>
	@if($vendor)
<table class="table table-responsive table-hover table-bordered table-striped">
	<tr class="bg-blue">
		<td class="text-center">VENDOR DETAILS</td>
	</tr>
	
</table>

<div class="well">

<table class="table">
	<tr>
		<td><strong>VENDOR ID</strong></td>
		<td><strong>#{{$vendor->id}}</strong></td>
		<td><strong>VENDOR NAME</strong></td>
		<td><strong>{{$vendor->name}}</strong></td>
	</tr>

	<tr>
		<td><strong>VENDOR MOBILE</strong></td>
		<td><strong>{{$vendor->mobile}}</strong></td>
		<td><strong>VENDOR DETAILS</strong></td>
		<td><strong>{{$vendor->details}}</strong></td>
	</tr>
	<tr>
		<td><strong>VENDOR ID PROOF</strong></td>
		   <td> <a href="{{ asset('/img/vendor/'.$vendor->vendoridproof )}}" target="_blank">
			<img title="click Here to view Full image" style="height:70px;width:95px;" src="{{ asset('/img/vendor/'.$vendor->vendoridproof )}}"></a>
			
				<a href="{{ asset('/img/vendor/'.$vendor->vendoridproof )}}" download>
		 	 	<button class="btn"><i class="fa fa-download"></i> Download</button>
		 	     </a>
			</td>
		
		<td><strong>VENDOR PHOTO</strong></td>
		<td><a href="{{ asset('/img/vendor/'.$vendor->photo )}}" target="_blank">
		<img title="click Here to view Full image" style="height:70px;width:95px;" src="{{ asset('/img/vendor/'.$vendor->photo )}}"> </a>
		
			<a href="{{ asset('/img/vendor/'.$vendor->photo )}}" download>
		 	 	<button class="btn"><i class="fa fa-download"></i> Download</button>
		 	 </a>
		</td>
	   
	</tr>
	<tr>
		<td><strong>VENDOR ADDED BY</strong></td>
		<td><strong>{{$vendor->name}}</strong></td>
		<td><strong>CREATED AT</strong></td>
		<td><strong>{{$vendor->created_at}}</strong></td>
	</tr>
</table>

</div>
@endif


@if($expenseentry->type=='VEHICLE PAYMENT' && $expenseentry->version=='NEW')
@if($expenseentrydailyvehicle)
<table class="table table-responsive table-hover table-bordered table-striped">
	<tr class="bg-blue">
		<td class="text-center">VEHICLE DETAILS</td>
	</tr>
	
</table>
<div class="table-responsive">
<table class="table table-responsive table-hover table-bordered table-striped">
<thead>
	<tr class="bg-navy">
		<td>Sl.No</td>
		<td>VEHICLE NAME</td>
		<td>VEHICLE NO</td>
		<td>DATE</td>
		<td>START TIME</td>
		<td>END TIME</td>
		<td>START METER REDING</td>
		<td>END METER REDING</td>
		<td>PURPOSE</td>
		<td>IMAGE</td>
		<td>VEHICLE DETAILS</td>
	</tr>

</thead>
<tbody>
	@foreach($expenseentrydailyvehicle as $key=>$ev)
      <tr>
      	<td>{{++$key}}</td>
      	<td>{{$ev->vehiclename}}</td>
      	<td>{{$ev->vehicleno}}</td>
      	<td>{{$ev->date}}</td>
      	<td>{{$ev->starttime}}</td>
      	<td>{{$ev->endtime}}</td>
      	<td>{{$ev->startmeterreading}}</td>
      	<td>{{$ev->endmeterreading}}</td>
      	<td>{{$ev->description}}</td>
      	<td>
      		<a href="{{ asset('/img/dailyvehicle/'.$ev->image )}}" target="_blank">
			<img title="click Here to view Full image" style="height:70px;width:95px;" src="{{ asset('/img/dailyvehicle/'.$ev->image )}}"></a>
		</td>
		<td>
			<a href="/vehicledetailsshowacc/{{$ev->vehicleid}}" class="btn btn-primary" target="_blank">DETAILS</a>
		</td>

      </tr>
	@endforeach
</tbody>
	
</table>
</div>
@endif
@endif

@if($expenseentry->type=='LABOUR PAYMENT' && $expenseentry->version=='NEW')
@if($engagedlaboursarr)
<div class="table-responsive">
<table class="table table-responsive table-hover table-bordered table-striped">
<thead>
	<tr class="bg-navy">
		<td>Sl.No</td>
		<td>DATE</td>
		<td>DESCRIPTION</td>
		<td>NO OF LABOUR</td>
		<td>IMAGE</td>
		<td>VIEW DETAILS</td>

	</tr>

</thead>
<tbody>
	@foreach($engagedlaboursarr as $key=>$el)
      <tr>
      	<td>{{++$key}}</td>
      	<td>{{$el['date']}}</td>
      	<td>{{$el['description']}}</td>
      	<td>{{$el['nooflabour']}}</td>
      	<td>
      		<a href="{{ asset('/img/engagedlabourimg/'.$el['labourimage'] )}}" target="_blank">
			<img title="click Here to view Full image" style="height:70px;width:95px;" src="{{ asset('/img/engagedlabourimg/'.$el['labourimage'] )}}"></a>
		</td>
		<td>
			<a href="/dailylabourdetailsshowacc/{{$el['id']}}" class="btn btn-primary" target="_blank">DETAILS</a>
		</td>

      </tr>
	@endforeach
</tbody>
	
</table>
</div>
@endif
@endif
@endsection