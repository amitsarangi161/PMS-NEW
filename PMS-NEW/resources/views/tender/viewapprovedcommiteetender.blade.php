@extends('layouts.tender')
@section('content')

<table class="table">
	<tr class="bg-navy">
		<td class="text-center">VIEW TENDER APPROVED BY COMMITEE</td>
		
	</tr>
</table>

<table class="table table-responsive table-hover table-bordered table-striped">
<tr>
	<td><strong>Name Of the Work *</strong></td>
	<td><textarea name="nameofthework" class="form-control" placeholder="Enter Name of The Work" disabled="">{{$tender->nameofthework}}</textarea></td>
	<td><strong>Client Name *</strong></td>
	<td>
		<input type="text" name="clientname" class="form-control" placeholder="Enter Name of the Work" value="{{$tender->clientname}}" disabled="">
	</td>
</tr>
<tr>
	<td><strong>TENDER REF NO/TENDER ID *</strong></td>
	<td><textarea name="tenderrefno" class="form-control" placeholder="Enter Tender Reference No" disabled="">{{$tender->tenderrefno}}</textarea></td>
	<td><strong>NO OF COVERS *</strong></td>
	<td>
		<input type="number" name="noofcovers" class="form-control" placeholder="Enter No of Covers" disabled="" value="{{$tender->noofcovers}}">
	</td>
</tr>
<tr>
	<td><strong>Work Value *</strong></td>
	<td><input type="text" name="workvalue" class="form-control" placeholder="Enter Work Value" disabled="" value="{{$tender->workvalue}}" ></td>


	<td><strong>NIT PUBLICATION DATE *</strong></td>
	<td><input type="text" name="nitpublicationdate" class="form-control readonly" disabled="" value="{{$tender->nitpublicationdate}}"></td>
	
</tr>
<tr>
	<td><strong>SOURCE *</strong></td>
	<td><input type="text" name="source" class="form-control" placeholder="Enter Source Name" disabled="" value="{{$tender->source}}"></td>

	<td><strong>TENDER PRIORITY *</strong></td>
	<td>
		<input type="text" disabled="" class="form-control" value="{{$tender->tenderpriority}}">
	</td>

</tr>
<tr>
	<td><strong>Type Of Work *</strong></td>
	<td>

		<input type="text" disabled="" class="form-control" value="{{$tender->typeofwork}}">
	</td>
	<td><strong>LAST DATE OF SUBMISSION *</strong></td>
	<td><input type="text" class="form-control  readonly" name="lastdateofsubmisssion" disabled="" value="{{$tender->lastdateofsubmisssion}}"></td>
	
</tr>
<tr>
	<td><strong>TENDER VALIDITY IN DAYS *(Ex.20)</strong></td>
	<td><input type="text" name="tendervalidityindays" id="tendervalidityindays" class="form-control chngdate" value="{{$tender->tendervalidityindays}}" disabled=""></td>

	<td><strong>LAST DATE OF TENDER VALIDATITY</strong></td>
	<td><input type="text" name="tendervaliditydate" id="tendervaliditydate" class="form-control" disabled="" value="{{$tender->tendervaliditydate}}"></td>
</tr>
<tr>
	<td><strong>RFP AVAILABLE DATE *</strong></td>
	<td><input type="text" class="form-control readonly" name="rfpavailabledate" disabled="" value="{{$tender->rfpavailabledate}}"></td>
	

	<td><strong>REF PAGE NO OF RFP DOCUMENT *</strong></td>
	<td>
		<textarea disabled="">{{$tender->refpageofrfp}}</textarea>
	</td>
	

</tr>
<tr>
	<td><strong>DOCUMENT DOWNLOAD/SALE START DATE *</strong></td>
	<td><input type="text" name="salestartdate" class="form-control" value="{{$tender->salestartdate}}" disabled=""></td>
	<td><strong>DOCUMENT DOWNLOAD/SALE END DATE *</strong></td>
	<td><input type="text" name="saleenddate" class="form-control" value="{{$tender->saleenddate}}" disabled=""></td>
	
</tr>
<tr>
	<td><strong>BID SUBMISSION START DATE *</strong></td>
	<td><input type="text" name="bidstartdate" class="form-control" value="{{$tender->bidstartdate}}" disabled=""></td>
	<td><strong>BID SUBMISSION END DATE *</strong></td>
	<td><input type="text" name="bidenddate" class="form-control" disabled="" value="{{$tender->bidenddate}}"></td>
	
</tr>
<tr>
	<td><strong>PRE-BID MEETING START DATE*</strong></td>
	<td><input type="text" name="prebidmeetingdate" class="form-control" value="{{$tender->prebidmeetingdate}}" disabled=""></td>
	
	
</tr>
	
</table>

<table class="table">
	<tr class="bg-blue">
		<td class="text-center">EMD DETAILS</td>
		
	</tr>
</table>

<table class="table table-responsive table-hover table-bordered table-striped">
	<tr>
		<td><strong>EMD AMOUNT</strong></td> 
		<td><input type="text" name="emdamount" id="emdamount" class="form-control convert" placeholder="Enter Emd Amount" value="{{$tender->emdamount}}" disabled=""></td>
		<td><strong>Amount in Word</strong></td>
		<td>
			<textarea class="form-control" id="amountinword" name="amountinword" disabled="">{{$tender->amountinword}}</textarea>
		</td>
	</tr>
	<tr>
		<td><strong>EMD in the form of *</strong></td>
		<td>
		    <input type="text" disabled="" class="form-control" value="{{$tender->emdinformof}}">

	</td>

	<td><strong>EMD Payable To*</strong></td>
	<td>
		<textarea name="emdpayableto" class="form-control" disabled="">{{$tender->emdpayableto}}</textarea>
	</td>
	</tr>
	
</table>

<table class="table">
	<tr class="bg-blue">
		<td class="text-center">TENDER COST</td>
		
	</tr>
</table>

<table class="table table-responsive table-hover table-bordered table-striped">
	<tr>
		<td><strong>TENDER COST</strong></td> 
		<td><input type="text" name="tenderamount" id="tenderamount" class="form-control convert1" placeholder="Enter Tender Amount"  disabled="" value="{{$tender->tenderamount}}"></td>
		<td><strong>Amount in Word</strong></td>
		<td>
			<textarea class="form-control" id="tenderamountinword" name="tenderamountinword" disabled="">{{$tender->tenderamountinword}}</textarea>
		</td>
	</tr>
	<tr>
		<td><strong>TENDER COST in the form of *</strong></td>
		<td>

		    <input type="text" class="form-control" disabled="" value="{{$tender->tendercostinformof}}">
	</td>
		<td><strong>TENDER FEE Payable To*</strong></td>
	<td>
		<textarea name="tenderfeepayableto" class="form-control" disabled="">{{$tender->tenderfeepayableto}}</textarea>
	</td>
	</tr>
	

</table>
<table class="table">
	<tr class="bg-blue">
		<td class="text-center">REGISTRATION COST/OTHER FEES</td>
		
	</tr>
</table>

<table class="table table-responsive table-hover table-bordered table-striped">
	<tr>
		<td><strong>REGISTRATION AMOUNT</strong></td> 
		<td><input type="text" disabled="" id="registrationamount" class="form-control convert2" value="{{$tender->registrationamount}}" autocomplete="off" placeholder="Enter Tender Amount"></td>
		<td><strong>Registration Amount in Word</strong></td>
		<td>
			<textarea class="form-control" id="registrationamountinword" name="registrationamountinword" disabled="">{{$tender->registrationamountinword}}</textarea>
		</td>
	</tr>
	<tr>
		<td><strong>Registration Amount in the form of *</strong></td>
		<td>
	
		   <input type="text" disabled="" value="{{$tender->registrationamountinformof}}">
	</td>
	<td><strong>Registration FEE Payable To*</strong></td>
	<td>
		<textarea name="registrationamountpayableto" disabled="" class="form-control">{{$tender->registrationamountpayableto}}</textarea>
	</td>
	</tr>
	
</table>
<h1 style="text-align: center;font-weight: bold;">TENDER FILES</h1>
<table class="table table-responsive table-hover table-bordered table-striped">
	<thead>
	<tr class="bg-navy">
		<td>ID</td>
		<td>FILE NAME</td>
		<td>FILE</td>
		
	</tr>
	</thead>
	<tbody>
		@foreach($tenderdocuments as $tenderdocument)
		<tr>
           <td>{{$tenderdocument->id}}</td>
           <td>{{$tenderdocument->file}}</td>
           
           <td>  <a href="{{asset('img/tender/'.$tenderdocument->file)}}" target="_blank">
            Click to View
        </a>
        <a href="{{asset('img/tender/'.$tenderdocument->file)}}" class="btn btn-primary btn-sm" download>
               <span class="glyphicon glyphicon-download-alt"></span> Download
        </a></td>
        
        </tr>
		@endforeach
		
	</tbody>
</table>

<h1 style="text-align: center;font-weight: bold;">CORRIGENDUM FILE</h1>
<table class="table table-responsive table-hover table-bordered table-striped">
	<thead>
	<tr class="bg-navy">
		<td>ID</td>
		<td>FILE NAME</td>
		<td>FILE</td>
	</tr>
	</thead>
	<tbody>
		@foreach($corrigendumfiles as $corrigendumfile)
		<tr>
           <td>{{$corrigendumfile->id}}</td>
           <td>{{$corrigendumfile->file}}</td>
           
           <td>  <a href="{{asset('img/tender/'.$corrigendumfile->file)}}" target="_blank">
            Click to View
        </a>
        <a href="{{asset('img/tender/'.$corrigendumfile->file)}}" class="btn btn-primary btn-sm" download>
               <span class="glyphicon glyphicon-download-alt"></span> Download
        </a></td>

 
        </tr>
		@endforeach
		
	</tbody>
</table>


<table class="table">
	<tr class="bg-blue">
		<td class="text-center">SITE APPRECIATION</td>
		
	</tr>
</table>
<table class="table table-responsive table-hover table-bordered table-striped">
	<tr>
		<td><strong>SITE VISIT REQUIRED? (Y OR N)</strong></td>
		<td>
			<input type="radio" name="sitevisitrequired" value="YES" {{ ( $tender->sitevisitrequired == 'YES') ? 'checked' : '' }}>YES &nbsp;&nbsp;&nbsp;
			<input type="radio" name="sitevisitrequired" value="NO" {{ ( $tender->sitevisitrequired == 'NO') ? 'checked' : '' }}> NO
		</td>
	
		<td><strong>If Yes who will Visit?</strong></td>
		<td>
			<textarea class="form-control" name="sitevisitdescription" disabled="">{{$tender->sitevisitdescription}}</textarea>
		</td>
	</tr>
	<tr>
		<td><strong>WORKABLE SITE? (Y OR N)</strong></td>
		<td>
			<input type="radio" name="workablesite" value="YES" {{ ( $tender->workablesite == 'YES') ? 'checked' : '' }}>YES &nbsp;&nbsp;&nbsp;
			<input type="radio" name="workablesite" value="NO" {{ ( $tender->workablesite == 'NO') ? 'checked' : '' }}> NO
		</td>
	
		<td><strong>Any Safety Concern?</strong></td>
		<td>
			<textarea class="form-control" name="safetyconcern" disabled="">{{$tender->safetyconcern}}</textarea>
		</td>
	</tr>
	<tr>
		<td><strong>Third party Approval Required? (Y OR N)</strong></td>
		<td>
			<input type="radio" name="thirdpartyapproval" value="YES" {{ ( $tender->thirdpartyapproval == 'YES') ? 'checked' : '' }}>YES &nbsp;&nbsp;&nbsp;
			<input type="radio" name="thirdpartyapproval" value="NO" {{ ( $tender->thirdpartyapproval == 'NO') ? 'checked' : '' }}> NO
		</td>
	
		<td><strong>If Yes write Details</strong></td>
		<td>
			<textarea class="form-control" name="thirdpartyapprovaldetails" disabled="">{{$tender->thirdpartyapprovaldetails}}</textarea>
		</td>
	</tr>
		<tr>
		<td><strong>Payment System?</strong></td>
		<td>
			<input type="radio" name="paymentsystem" value="MONTHLY" {{ ( $tender->paymentsystem == 'MONTHLY') ? 'checked' : '' }}>MONTHLY &nbsp;&nbsp;&nbsp;
			<input type="radio" name="paymentsystem" value="STAGE" {{ ( $tender->paymentsystem == 'STAGE') ? 'checked' : '' }}> STAGE
			&nbsp;&nbsp;
			<input type="radio" name="paymentsystem" value="PERCENTAGE WISE" {{ ( $tender->paymentsystem == 'PERCENTAGE WISE') ? 'checked' : '' }}>PERCENTAGE WISE


		</td>
	
		<td><strong>write in Details</strong></td>
		<td>
			<textarea class="form-control" name="paymentsystemdetails" disabled="">{{$tender->paymentsystemdetails}}</textarea>
		</td>
	</tr>

</table>
<table class="table">
	<tr class="bg-blue">
		<td class="text-center">OUT SOURCING</td>
		
	</tr>
</table>
<table class="table">
	<tr>
		<td><strong>IN HOUSE CAPACITY? (Y OR N)</strong></td>
		<td>
			<input type="radio" name="inhousecapacity" value="YES" {{ ( $tender->inhousecapacity == 'YES') ? 'checked' : '' }}>YES &nbsp;&nbsp;&nbsp;
			<input type="radio" name="inhousecapacity" value="NO" {{ ( $tender->inhousecapacity == 'NO') ? 'checked' : '' }}> NO (ANY WORK TO BE OUT SOURCED?)
		</td>
	
	</tr>
	<tr>
		<td><strong>INVOLVEMENT REQUIREMENT OF ANY THIRD PARTY?</strong></td>
		<td>
			<input type="radio" name="thirdpartyinvolvement" value="YES" {{ ( $tender->thirdpartyinvolvement == 'YES') ? 'checked' : '' }}>YES &nbsp;&nbsp;&nbsp;
			<input type="radio" name="thirdpartyinvolvement" value="NO" {{ ( $tender->thirdpartyinvolvement == 'NO') ? 'checked' : '' }}>NO &nbsp;&nbsp;&nbsp;
			<input type="radio" name="thirdpartyinvolvement" value="CANTSAY" {{ ( $tender->thirdpartyinvolvement == 'CANTSAY') ? 'checked' : '' }}>Can't Say 
		</td>
	</tr>
		<tr>
		<td><strong>IS THE AREA AFFECTED BY ANY EXTREMIST ORGANIZATION?</strong></td>
		<td>
			<input type="radio" name="areaaffectedbyextremist" value="YES" {{ ( $tender->areaaffectedbyextremist == 'YES') ? 'checked' : '' }}>YES &nbsp;&nbsp;&nbsp;
			<input type="radio" name="areaaffectedbyextremist" value="NO" {{ ( $tender->areaaffectedbyextremist == 'NO') ? 'checked' : '' }}>NO &nbsp;&nbsp;&nbsp;
			<input type="radio" name="areaaffectedbyextremist" value="CANTSAY" {{ ( $tender->areaaffectedbyextremist == 'CANTSAY') ? 'checked' : '' }}>Can't Say 
		</td>
	</tr>
	<tr>
		<td><strong>CAN THE KEY PERSON BE MANAGED?</strong></td>
		<td>
			<input type="radio" name="keypositionbemanaged" value="YES" {{ ( $tender->keypositionbemanaged == 'YES') ? 'checked' : '' }}>YES &nbsp;&nbsp;&nbsp;
			<input type="radio" name="keypositionbemanaged" value="NO" {{ ( $tender->keypositionbemanaged == 'NO') ? 'checked' : '' }}>NO &nbsp;&nbsp;&nbsp;
			<input type="radio" name="keypositionbemanaged" value="CANTSAY" {{ ( $tender->keypositionbemanaged == 'CANTSAY') ? 'checked' : '' }}>Can't Say 
		</td>
	</tr>
	<tr>
		<td><strong>PROJECT DURATION ASSIGNED IS SUFFICIENT?</strong></td>
		<td>
			<input type="radio" name="projectdurationsufficient" value="YES"  {{ ( $tender->projectdurationsufficient == 'YES') ? 'checked' : '' }}>YES &nbsp;&nbsp;&nbsp;
			<input type="radio" name="projectdurationsufficient" value="NO" {{ ( $tender->projectdurationsufficient == 'NO') ? 'checked' : '' }} >NO &nbsp;&nbsp;&nbsp;
			<input type="radio" name="projectdurationsufficient" value="CANTSAY" {{ ( $tender->projectdurationsufficient == 'CANTSAY') ? 'checked' : '' }}>Can't Say 
		</td>
	</tr>
	<tr>
		<td><strong>LOCAL OFFICE TO BE SET UP?</strong></td>
		<td>
			<input type="radio" name="localofficesetup" value="YES" {{ ( $tender->localofficesetup == 'YES') ? 'checked' : '' }}>YES &nbsp;&nbsp;&nbsp;
			<input type="radio" name="localofficesetup" value="NO" {{ ( $tender->localofficesetup == 'NO') ? 'checked' : '' }}>NO &nbsp;&nbsp;&nbsp;
			<input type="radio" name="localofficesetup" value="CANTSAY" {{ ( $tender->localofficesetup == 'CANTSAY') ? 'checked' : '' }}>Can't Say 
		</td>
	</tr>

		<tr>
		<td><strong>RECOMENDED FOR</strong></td>
		<td>
			<input type="radio" name="recomended" value="SOLE" {{ ( $tender->recomended == 'SOLE') ? 'checked' : '' }}>SOLE &nbsp;&nbsp;&nbsp;
			<input type="radio" name="recomended" value="ASSOCIATION" {{ ( $tender->recomended == 'ASSOCIATION') ? 'checked' : '' }}>ASSOCIATION &nbsp;&nbsp;&nbsp;
			<input type="radio" name="recomended" value="JV" {{ ( $tender->recomended == 'JV') ? 'checked' : '' }}>JV
		</td>
	</tr>



</table>

<table class="table table-responsive table-hover table-bordered table-striped">
	<tr>
		<td><strong>PAYMENT SCHEDULE IS CLEAR?</strong></td>
		<td>
			<input type="radio" name="paymentscheduleclear" value="YES" {{ ( $tender->paymentscheduleclear == 'YES') ? 'checked' : '' }}>YES &nbsp;&nbsp;&nbsp;
			<input type="radio" name="paymentscheduleclear" value="NO" {{ ( $tender->paymentscheduleclear == 'NO') ? 'checked' : '' }}>NO &nbsp;&nbsp;&nbsp;
			<input type="radio" name="paymentscheduleclear" value="CANTSAY" {{ ( $tender->paymentscheduleclear == 'CANTSAY') ? 'checked' : '' }}>Can't Say 
			
		</td>
		<td><strong>IF NO ,IS THERE ANY AMBIGUTY?</strong></td>
		<td>
			<textarea name="paymentscheduleambiguty" class="form-control" placeholder="Describe The AMBIGUTY" disabled="">{{$tender->paymentscheduleambiguty}}</textarea>
		</td>
	</tr>
	<tr>
		<td><strong>IS THERE ANY PENALITY CLAUSE?</strong></td>
		<td>
			<input type="radio" name="penalityclause" value="YES" {{ ( $tender->penalityclause == 'YES') ? 'checked' : '' }}>YES &nbsp;&nbsp;&nbsp;
			<input type="radio" name="penalityclause" value="NO" {{ ( $tender->penalityclause == 'NO') ? 'checked' : '' }}>NO &nbsp;&nbsp;&nbsp;
			<input type="radio" name="penalityclause" value="CANTSAY" {{ ( $tender->penalityclause == 'CANTSAY') ? 'checked' : '' }}>Can't Say 
			
		</td>
		<td><strong>IF NO ,IS THERE ANY AMBIGUTY?</strong></td>
		<td>
			<textarea name="penalityclauseambiguty" class="form-control" placeholder="Describe The AMBIGUTY" disabled="">{{$tender->penalityclauseambiguty}}</textarea>
		</td>
		
	</tr>
	<tr>
		<td><strong>DO WE HAVE EXPERTISE IN NATURE OF WORK?</strong></td>
		<td>
			<input type="radio" name="wehaveexpertise" value="YES" {{ ( $tender->wehaveexpertise == 'YES') ? 'checked' : '' }}>YES &nbsp;&nbsp;&nbsp;
			<input type="radio" name="wehaveexpertise" value="NO" {{ ( $tender->wehaveexpertise == 'NO') ? 'checked' : '' }}>NO &nbsp;&nbsp;&nbsp;
			<input type="radio" name="wehaveexpertise" value="CANTSAY" {{ ( $tender->wehaveexpertise == 'CANTSAY') ? 'checked' : '' }} >Can't Say 
			
		</td>
		<td><strong>IF NO ,IS THERE ANY AMBIGUTY?</strong></td>
		<td>
			<textarea name="wehaveexpertisedescription" class="form-control" placeholder="Describe The AMBIGUTY" disabled="">{{$tender->wehaveexpertisedescription}}</textarea>
		</td>
		
	</tr>
	<tr>
		<td><strong>ANY CONTRACTUAL AMBIGUTY?</strong></td>
		<td>
			<input type="radio" name="contractualambiguty" value="YES" {{ ( $tender->contractualambiguty == 'YES') ? 'checked' : '' }}>YES &nbsp;&nbsp;&nbsp;
			<input type="radio" name="contractualambiguty" value="NO" {{ ( $tender->contractualambiguty == 'NO') ? 'checked' : '' }}>NO &nbsp;&nbsp;&nbsp;
			<input type="radio" name="contractualambiguty" value="CANTSAY"  {{ ( $tender->contractualambiguty == 'CANTSAY') ? 'checked' : '' }}>Can't Say 
			
		</td>
		<td><strong>IF NO ,IS THERE ANY AMBIGUTY?</strong></td>
		<td>
			<textarea name="contractualambigutydescription" class="form-control" placeholder="Describe The AMBIGUTY" disabled="">{{$tender->contractualambigutydescription}}</textarea>
		</td>
		
	</tr>

	<tr>
		<td><strong>ANY EXTENSIVE FIELD INVESTICATION REQUIRED?</strong></td>
		<td>
			<input type="radio" name="extensivefieldinvestigation" value="YES" {{ ( $tender->extensivefieldinvestigation == 'YES') ? 'checked' : '' }}>YES &nbsp;&nbsp;&nbsp;
			<input type="radio" name="extensivefieldinvestigation" value="NO" {{ ( $tender->extensivefieldinvestigation == 'NO') ? 'checked' : '' }}>NO &nbsp;&nbsp;&nbsp;
			<input type="radio" name="extensivefieldinvestigation" value="CANTSAY" {{ ( $tender->extensivefieldinvestigation == 'CANTSAY') ? 'checked' : '' }}>Can't Say 
			
		</td>
		<td><strong>IF NO ,IS THERE ANY AMBIGUTY?</strong></td>
		<td>
			<textarea name="extensivefieldinvestigationdescription" class="form-control" placeholder="Describe The AMBIGUTY" disabled="">{{$tender->extensivefieldinvestigationdescription}}</textarea>
		</td>
		
	</tr>
		<tr>
		<td><strong>MEETING THE REQUIRED EXPERIENSE OF FIRM?</strong></td>
		<td>
			<input type="radio" name="requiredexperienceoffirm" value="YES" {{ ( $tender->requiredexperienceoffirm == 'YES') ? 'checked' : '' }}>YES &nbsp;&nbsp;&nbsp;
			<input type="radio" name="requiredexperienceoffirm" value="NO" {{ ( $tender->requiredexperienceoffirm == 'NO') ? 'checked' : '' }}>NO &nbsp;&nbsp;&nbsp;
			<input type="radio" name="requiredexperienceoffirm" value="CANTSAY" {{ ( $tender->requiredexperienceoffirm == 'CANTSAY') ? 'checked' : '' }}>Can't Say 
			
		</td>
		<td><strong>IF NO ,IS THERE ANY AMBIGUTY?</strong></td>
		<td>
			<textarea name="requiredexperienceoffirmdescription" class="form-control" placeholder="Describe The AMBIGUTY" disabled="">{{$tender->requiredexperienceoffirmdescription}}</textarea>
		</td>
		
		</tr>

			<tr>
		<td><strong>RECORD ANY OTHER REQUIREMENT?</strong></td>
		<td colspan="3">
			<textarea name="anyotherrequirement" class="form-control" placeholder="Describe" disabled="">{{$tender->anyotherrequirement}}</textarea>
		</td>
		
		</tr>

			<tr>
		<td><strong>RATE TO BE QUOTED?</strong></td>
		<td colspan="3">
			<input type="text" name="ratetobequoted" class="form-control" placeholder="Enter Rate to be QUOTED" value="{{$tender->ratetobequoted}}" disabled="">
		</td>
		
		</tr>




</table>









@endsection