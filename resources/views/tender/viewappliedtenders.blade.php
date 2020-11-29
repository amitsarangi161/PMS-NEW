@extends('layouts.tender')
@section('content')

 @if(Session::has('msg'))
   <p class="alert alert-success text-center">{{ Session::get('msg') }}</p>
   @endif

<style type="text/css">
.rbox{
padding: 4px;
width: 25%;
text-align: center;
}
.wrkbg{
	background-color: #FBAB7E;
background-image: linear-gradient(62deg, #FBAB7E 0%, #F7CE68 50%, #fade9b 100%);

}
.extremist{
background-color: #FBAB7E;
background-image: linear-gradient(62deg, #FBAB7E 0%, #F7CE68 50%, #fade9b 100%);

}
</style>
<table class="table">
	<tr class="bg-navy">
		<td class="text-center">VIEW APPLIED TENDER</td>
		
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
	<td><strong>Location</strong></td>
	<td><input type="text" name="location" class="form-control" placeholder="Enter Work Location" value="{{$tender->location}}"></td>
	<td><strong>Evaluation Process</strong></td>
	<td>
		<input type="radio" value="LCS" name="evaluationprocess" {{($tender->evaluationprocess=='LCS')? 'checked':''}}><strong>LCS</strong>
		<input type="radio" value="QCBS" name="evaluationprocess" {{($tender->evaluationprocess=='QCBS')? 'checked':''}}><strong>QCBS</strong>
	
	@if($tender->evaluationprocess=='QCBS')	
	<strong>TS</strong><input type="number" name="evaluationtechnical" id="evaluationtechnical" value="{{$tender->evaluationtechnical}}" style="width:15%">
	<strong>FS</strong><input type="number" name="evaluationfinancial" id="evaluationfinancial" value="{{$tender->evaluationfinancial}}" style="width:15%">
    @endif
	
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
	<td><strong>RECOMENDED FOR</strong></td>
		<td>
			<input type="radio" name="recomended" value="SOLE" {{ ( $tender->recomended == 'SOLE') ? 'checked' : '' }}>SOLE &nbsp;&nbsp;&nbsp;
			<input type="radio" name="recomended" value="ASSOCIATION" {{ ( $tender->recomended == 'ASSOCIATION') ? 'checked' : '' }}>ASSOCIATION &nbsp;&nbsp;&nbsp;
			<input type="radio" name="recomended" value="JV" {{ ( $tender->recomended == 'JV') ? 'checked' : '' }}>JV
	</td>
	
	
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
	<tr>
		<td><strong>Choose a User to see the comments</strong></td>
		<td>
			<select class="form-control select2" id="selecteduser" onchange="fetchcomment();">
				<option value="">Select User</option>
				<option value="COMMITTEE">COMMITTEE</option>
				@foreach($users as $user)
				  <option value="{{$user->userid}}">{{$user->name}}</option>
				@endforeach
			</select>
		</td>
	</tr>
</table>




<div id="committeecommenttable" style="display: none;">
	<table class="table">
	<tr class="bg-red">
		<td class="text-center">COMMITTEE COMMENTS</td>
		
	</tr>
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

</div>

<div id="commenttable" style="display: none;">
	<table class="table">
	<tr class="bg-red">
		<td class="text-center" id="commentby"></td>
		
	</tr>
</table>

<!--santosh-->
<table class="table">
	<tr class="bg-blue">
		<td class="text-center">SITE APPRECIATION</td>
		
	</tr>
</table>
<table class="table table-responsive table-hover table-bordered table-striped">
	<tr>
		<td><strong>SITE VISIT REQUIRED? (Y OR N)</strong></td>
		<td id="sitevisitrequired1"></td>
		<td><strong>If Yes who will Visit?</strong></td>
		<td>
			<textarea class="form-control" id="sitevisitdescription1" name="sitevisitdescription" readonly></textarea>
		</td>
	</tr>
	<tr id="notworkable">
		<td><strong>WORKABLE SITE? (Y OR N)</strong></td>
		<td id="workablesite1">
			
		</td>
	
		<td><strong>Any Safety Concern ?</strong></td>
		<td>
			<label  id="safetyconcern1" name="safetyconcern1"></label>
		</td>
	</tr>
	<tr>
		<td><strong>Third party Approval Required? (Y OR N)</strong></td>
		<td id="thirdpartyapproval1">
			
		</td>
	
		<td><strong>If Yes write Details</strong></td>
		<td>
			<textarea readonly class="form-control" id="thirdpartyapprovaldetails1" name="thirdpartyapprovaldetails">{{$tender->thirdpartyapprovaldetails}}</textarea>
		</td>
	</tr>
		<tr>
		<td><strong>Payment System?</strong></td>
		<td id="paymentsystem1">

		</td>
	
		<td><strong>write in Details</strong></td>
		<td>
			<textarea readonly class="form-control" id="paymentsystemdetails1" name="paymentsystemdetails">{{$tender->paymentsystemdetails}}</textarea>
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
		<td id="inhousecapacity1">
			
		</td>
	
	</tr>
	<tr>
		<td><strong>INVOLVEMENT REQUIREMENT OF ANY THIRD PARTY?</strong></td>
		<td id="thirdpartyinvolvement1">

		</td>
	</tr>
		<tr id="extremist">
		<td><strong>IS THE AREA AFFECTED BY ANY EXTREMIST ORGANIZATION?</strong></td>
		<td id="areaaffectedbyextremist1">
			
		</td>
	</tr>
	<tr>
		<td><strong>CAN THE KEY PERSON BE MANAGED?</strong></td>
		<td id="keypositionbemanaged1">
			
		</td>
	</tr>
	<tr>
		<td><strong>PROJECT DURATION ASSIGNED IS SUFFICIENT?</strong></td>
		<td id="projectdurationsufficient1">

		</td>
	</tr>
	<tr>
		<td><strong>LOCAL OFFICE TO BE SET UP?</strong></td>
		<td id="localofficesetup1">
			
		</td>
	</tr>
</table>

<table class="table table-responsive table-hover table-bordered table-striped">
	<tr>
		<td><strong>PAYMENT SCHEDULE IS CLEAR?</strong></td>
		<td id="paymentscheduleclear1">
						
		</td>
		<td><strong>IF NO ,IS THERE ANY AMBIGUTY?</strong></td>
		<td>
			<textarea readonly name="paymentscheduleambiguty" id="paymentscheduleambiguty1" class="form-control" placeholder="Describe The AMBIGUTY"></textarea>
		</td>
	</tr>
	<tr>
		<td><strong>IS THERE ANY PENALITY CLAUSE?</strong></td>
		<td id="penalityclause1">
			
		</td>
		<td><strong>IF NO ,IS THERE ANY AMBIGUTY?</strong></td>
		<td>
			<textarea readonly name="penalityclauseambiguty" id="penalityclauseambiguty1" class="form-control" placeholder="Describe The AMBIGUTY">{{$tender->penalityclauseambiguty}}</textarea>
		</td>
		
	</tr>
	<tr>
		<td><strong>DO WE HAVE EXPERTISE IN NATURE OF WORK?</strong></td>
		<td id="wehaveexpertise1">
						
		</td>
		<td><strong>IF NO ,IS THERE ANY AMBIGUTY?</strong></td>
		<td>
			<textarea readonly name="wehaveexpertisedescription" id="wehaveexpertisedescription1" class="form-control" placeholder="Describe The AMBIGUTY"></textarea>
		</td>
		
	</tr>
	<tr>
		<td><strong>ANY CONTRACTUAL AMBIGUTY?</strong></td>
		<td id="contractualambiguty1">
			
		</td>
		<td><strong>IF NO ,IS THERE ANY AMBIGUTY?</strong></td>
		<td>
			<textarea readonly name="contractualambigutydescription" id="contractualambigutydescription1" class="form-control" placeholder="Describe The AMBIGUTY"></textarea>
		</td>
		
	</tr>

	<tr>
		<td><strong>ANY EXTENSIVE FIELD INVESTICATION REQUIRED?</strong></td>
		<td id="extensivefieldinvestigation1">
						
		</td>
		<td><strong>IF NO ,IS THERE ANY AMBIGUTY?</strong></td>
		<td>
			<textarea readonly name="extensivefieldinvestigationdescription" id="extensivefieldinvestigationdescription1" class="form-control" placeholder="Describe The AMBIGUTY"></textarea>
		</td>
		
	</tr>
		<tr>
		<td><strong>MEETING THE REQUIRED EXPERIENSE OF FIRM?</strong></td>
		<td id="requiredexperienceoffirm1">
			
		</td>
		<td><strong>IF NO ,IS THERE ANY AMBIGUTY?</strong></td>
		<td>
			<textarea readonly name="requiredexperienceoffirmdescription" id="requiredexperienceoffirmdescription1" class="form-control" placeholder="Describe The AMBIGUTY"></textarea>
		</td>
		
		</tr>

			<tr>
		<td><strong>RECORD ANY OTHER REQUIREMENT?</strong></td>
		<td colspan="3">
			<textarea readonly name="anyotherrequirement" id="anyotherrequirement1" class="form-control" placeholder="Describe"></textarea>
		</td>
		
		</tr>

			<tr>
		<td><strong>RATE TO BE QUOTED?</strong></td>
		<td colspan="3" id="ratetobequoted1">
			
		</td>
		
		</tr>
</table>
</div>
<input type="hidden" id="tenderid" value="{{$tender->id}}">

<table class="table">
	<tr class="bg-blue">
		<td class="text-center"><strong>TENDER COST DOC</strong></td>
		
	</tr>
</table>
<form action="/tendercostdetailupdate/{{$tender->id}}" method="post" enctype="multipart/form-data">
	{{csrf_field()}}
<table class="table">
	<tr>
		<td><strong>TENDER COST</strong></td>
		<td><input type="text" class="form-control" placeholder="Enter Tender Cost" name="tendercost" value="{{$tender->tendercost}}">
		</td>
		<td><strong>IN THE FORM OF</strong></td>
		<td>
			<select name="tendercostintheformof" class="select2 form-control">
				<option value="">Select a Option</option>
				<option value="ONLINE" {{($tender->tendercostintheformof=="ONLINE")? 'selected' : ''}}>ONLINE</option>
				<option value="BG" {{($tender->tendercostintheformof=="BG")? 'selected' : ''}}>BG</option>
				<option value="DD" {{($tender->tendercostintheformof=="DD")? 'selected' : ''}}>DD</option>
				<option value="FDR" {{($tender->tendercostintheformof=="FDR")? 'selected' : ''}}>FDR</option>
				<option value="CASH" {{($tender->tendercostintheformof=="CASH")? 'selected' : ''}}>CASH</option>
				
			</select>
		</td>
	</tr>
	<tr>
		<td><strong>DATE</strong></td>
		<td><input type="text" class="datepicker form-control readonly" name="tendercostdate" value="{{$tender->tendercostdate}}"></td>
		<td><strong>TENDER COST DOCUMENT</strong></td>
		<td>
			<input type="file" name="tendercostdoc">
			@if($tender->tendercostdoc!='')
            <a href="{{asset('img/posttenderdoc/'.$tender->tendercostdoc)}}" target="_blank">
            Click to View the document
            </a>
			@else
             <p style="color:red;">No doc Uploaded</p>
			@endif
		</td>
	</tr>
	<tr>
		<td>
		<button type="submit" class="btn btn-success">Save</button>
	    </td>
	</tr>
	
</table>
</form>
<table class="table">
	<tr class="bg-navy">
		<td class="text-center"><strong>EMD</strong></td>
		
	</tr>
</table>
<form action="/emddetailsupdate/{{$tender->id}}" method="post" enctype="multipart/form-data">
	{{csrf_field()}}
<table class="table">
	<tr>
		<td><strong>EMD COST</strong></td>
		<td><input type="text" value="{{$tender->emdamt}}" class="form-control" placeholder="Enter EMD Cost" name="emdamt">
		</td>
		<td><strong>IN THE FORM OF</strong></td>
		<td>
			<select name="emdamtintheformsof" class="select2 form-control">
				<option value="">Select a Option</option>
				<option value="ONLINE" {{($tender->emdamtintheformsof=="ONLINE")? 'selected' : ''}}>ONLINE</option>
				<option value="BG" {{($tender->emdamtintheformsof=="BG")? 'selected' : ''}}>BG</option>
				<option value="DD" {{($tender->emdamtintheformsof=="DD")? 'selected' : ''}}>DD</option>
				<option value="FDR" {{($tender->emdamtintheformsof=="FDR")? 'selected' : ''}}>FDR</option>
				<option value="CASH" {{($tender->emdamtintheformsof=="CASH")? 'selected' : ''}}>CASH</option>
				
			</select>
		</td>
	</tr>
	<tr>
		<td><strong>DATE</strong></td>
		<td><input type="text" class="datepicker form-control readonly" name="emdamtdate" value="{{$tender->emdamtdate}}"></td>
		<td><strong>EMD DOCUMENT</strong></td>
		<td>
			<input type="file" name="emd">
			@if($tender->emd!='')
            <a href="{{asset('img/posttenderdoc/'.$tender->emd)}}" target="_blank">
            Click to View the document
            </a>
			@else
             <p style="color:red;">No doc Uploaded</p>
			@endif
		</td>
	</tr>
	<tr>
		<td>
		<button type="submit" class="btn btn-success">Save</button>
	    </td>
	</tr>
	
</table>
</form>

<table class="table">
	<tr class="bg-blue">
		<td class="text-center"><strong>TENDER POST DOCUMENT UPLOAD</strong></td>
		
	</tr>
</table>

<form action="/uploadposttenderdocuments/{{$tender->id}}" method="post" enctype="multipart/form-data">
	{{csrf_field()}}
<table class="table">

	<tr>
		<td><strong>TECHNICAL PROPOSAL</strong></td>
		<td><input type="file" name="technicalproposal"></td>
		<td>
			@if($tender->technicalproposal!='')
            <a href="{{asset('img/posttenderdoc/'.$tender->technicalproposal)}}" target="_blank">
            Click to View the document
            </a>
			@else
             <p style="color:red;">No doc Uploaded</p>
			@endif
		</td>
	</tr>
	<tr>
		<td><strong>FINANCIAL PROPOSAL</strong></td>
		<td><input type="file" name="financialproposal"></td>
		<td>
			@if($tender->financialproposal!='')
            <a href="{{asset('img/posttenderdoc/'.$tender->financialproposal)}}" target="_blank">
            Click to View the document
            </a>
			@else
             <p style="color:red;">No doc Uploaded</p>
			@endif
		</td>
	</tr>
		<tr>
		<td><strong>LIST OF PARTICIPANT UPLOAD</strong></td>
		<td><input type="file" name="participantlistupload"></td>
		<td>
			@if($tender->participantlistupload!='')
            <a href="{{asset('img/posttenderdoc/'.$tender->participantlistupload)}}" target="_blank">
            Click to View the document
            </a>
			@else
             <p style="color:red;">No doc Uploaded</p>
			@endif
		</td>
	</tr>
	<tr>
		<td><strong>TECHNICAL SCORE UPLOAD</strong></td>
		<td><input type="file" name="technicalscoreupload"></td>
		<td>
			@if($tender->technicalscoreupload!='')
            <a href="{{asset('img/posttenderdoc/'.$tender->technicalscoreupload)}}" target="_blank">
            Click to View the document
            </a>
			@else
             <p style="color:red;">No doc Uploaded</p>
			@endif
		</td>
	</tr>
	<tr>
		<td><strong>FINANCIAL SCORE UPLOAD</strong></td>
		<td><input type="file" name="financialscoreupload"></td>
		<td>
			@if($tender->financialscoreupload!='')
            <a href="{{asset('img/posttenderdoc/'.$tender->financialscoreupload)}}" target="_blank">
            Click to View the document
            </a>
			@else
             <p style="color:red;">No doc Uploaded</p>
			@endif
		</td>
	</tr>
	<tr>
		<td colspan="3"><button type="submit" class="btn btn-primary">Upload</button></td>
	</tr>
	
</table>
</form>
<table class="table">
	<tr class="bg-green">
		<td class="text-center"><strong>LIST OF PARTICIPANTS & SCORE</strong></td>
		
	</tr>
</table>
<table class="table table-responsive table-hover table-bordered table-striped">
	<thead>
		<tr class="bg-navy">
			<td><strong>Participant1</strong></td>
			<td><strong>Participant2</strong></td>
			<td><strong>Participant3</strong></td>
			<td><strong>Technical Score</strong></td>
			<td><strong>Financial Score</strong></td>
            <td><strong>ACTION</strong></td>

		</tr>
	</thead>
	<form action="/savetenderparticipants/{{$tender->id}}" method="post">
		{{csrf_field()}}
	
	<tbody>
		<tr>
			<td>
				<select class="form-control select2" id="participant" name="participant">
				<option value="">Select a Participant</option>
				@foreach($participants as $participant)
                  <option value="{{$participant->id}}">{{$participant->associatepartnername}}</option>
				@endforeach
				</select>
			</td>
			<td>
				<select class="form-control select2"  name="participant2">
				<option value="">Select a Participant</option>
				@foreach($participants as $participant)
                  <option value="{{$participant->id}}">{{$participant->associatepartnername}}</option>
				@endforeach
				</select>
			</td>
			<td>
				<select class="form-control select2"  name="participant3">
				<option value="">Select a Participant</option>
				@foreach($participants as $participant)
                  <option value="{{$participant->id}}">{{$participant->associatepartnername}}</option>
				@endforeach
				</select>
			</td>
			<td>
				<input type="text" id="techscore" name="techscore" placeholder="Technical Score" class="form-control">
			</td>
			<td>
				<input type="text" id="financialscore" name="financialscore" placeholder="Financial Score" class="form-control">
			</td>
			<td>
				<button type="submit" id="addnew" class="addauthor btn btn-primary">ADD</button>
			</td>
		</tr>
	</tbody>
</form>
	
	 
</table>
<table class="table">
	<thead>
		<tr class="bg-gray">
			<td>Participant1</td>
			<td>Participant2</td>
			<td>Participant3</td>
			<td>Technical Score</td>
			<td>Financial Score</td>
			<td>Edit</td>
			<td>Remove</td>
		</tr>

		
	</thead>
	<tbody>
		@foreach($tenderparticipants as $tenderparticipant)
          <tr>
          	<td>{{$tenderparticipant->associatepartnername}}</td>
          	<td>{{$tenderparticipant->associatepartnername2}}</td>
          	<td>{{$tenderparticipant->associatepartnername3}}</td>
          	<td>{{$tenderparticipant->techscore}}</td>
          	<td>{{$tenderparticipant->financialscore}}</td>
          	<td>
				<button class="btn btn-info" onclick="editparticipant('{{$tenderparticipant->id}}','{{$tenderparticipant->associatepartnername}}','{{$tenderparticipant->associatepartnername2}}','{{$tenderparticipant->associatepartnername3}}','{{$tenderparticipant->techscore}}','{{$tenderparticipant->financialscore}}');" type="button">EDIT</button>
			</td>
          	<td>
          		<form action="/removeparticipants/{{$tenderparticipant->id}}" method="post">
          			{{method_field('DELETE')}}
          			{{csrf_field()}}
          			
          			<button type="submit" class="btn btn-danger" onclick="return confirm('Do You want to Remove this Participant ?');">Delete</button>
          		</form>
          			
          	</td>
          </tr>
		@endforeach
	</tbody>
	
</table>
<table class="table">
	<tr class="bg-blue">
		<td class="text-center"><strong>TENDER AWARDS</strong></td>
		
	</tr>
</table>
<table class="table table-responsive table-hover table-bordered table-striped">
	<thead>
		<tr class="bg-navy">
			<td><strong>Participant1</strong></td>
			<td><strong>Participant2</strong></td>
			<td><strong>Participant3</strong></td>
			<td><strong>Financial Score</strong></td>
            <td><strong>ACTION</strong></td>

		</tr>
	</thead>
	<form action="/savetenderawards/{{$tender->id}}" method="post">
		{{csrf_field()}}
	
	<tbody>
		<tr>
			<td>
				<select class="form-control select2" id="participant" name="participant">
				<option value="">Select a Participant</option>
				@foreach($participants as $participant)
                  <option value="{{$participant->id}}">{{$participant->associatepartnername}}</option>
				@endforeach
				</select>
			</td>
			<td>
				<select class="form-control select2"  name="participant2">
				<option value="">Select a Participant</option>
				@foreach($participants as $participant)
                  <option value="{{$participant->id}}">{{$participant->associatepartnername}}</option>
				@endforeach
				</select>
			</td>
			<td>
				<select class="form-control select2"  name="participant3">
				<option value="">Select a Participant</option>
				@foreach($participants as $participant)
                  <option value="{{$participant->id}}">{{$participant->associatepartnername}}</option>
				@endforeach
				</select>
			</td>
			<td>
				<input type="text" id="finalscore" name="finalscore" placeholder="Financial Score" class="form-control">
			</td>
			<td>
				<button type="submit" id="addnew" class="addauthor btn btn-primary">ADD</button>
			</td>
		</tr>
	</tbody>
</form>
	
	 
</table>
<table class="table">
	<thead>
		<tr class="bg-gray">
			<td>Participant1</td>
			<td>Participant2</td>
			<td>Participant3</td>
			<td>Final Score</td>
			<td>Edit</td>
			<td>Remove</td>
		</tr>

		
	</thead>
	<tbody>
		@foreach($tenderrewards as $tenderreward)
          <tr>
          	<td>{{$tenderreward->associatepartnername}}</td>
          	<td>{{$tenderreward->associatepartnername2}}</td>
          	<td>{{$tenderreward->associatepartnername3}}</td>
          	<td>{{$tenderreward->finalscore}}</td>
          	<td>
			<button class="btn btn-info" onclick="editaward('{{$tenderreward->id}}','{{$tenderreward->associatepartnername}}','{{$tenderreward->associatepartnername2}}','{{$tenderreward->associatepartnername3}}','{{$tenderreward->finalscore}}');" type="button">EDIT</button>
			</td>
          	<td>
          		<form action="/removeawards/{{$tenderreward->id}}" method="post">
          			{{method_field('DELETE')}}
          			{{csrf_field()}}
          			
          			<button type="submit" class="btn btn-danger" onclick="return confirm('Do You want to Remove this?');">Delete</button>
          		</form>
          			
          	</td>
          </tr>
		@endforeach
	</tbody>
	
</table>
<table class="table">
	<form action="/addagreementvalue/{{$tender->id}}" method="POST">
		{{csrf_field()}}
	<tr>
		<td><strong>AGREEMENT VALUE</strong></td>
		<td>
			<input type="text" name="agreementvalue" value="{{$tender->agreementvalue}}" class="form-control" required="">
			
		</td>
		<td>
			<button type="submit" class="btn btn-success">CHANGE</button>
		</td>
	</tr>
	</form>
</table>
 <div id="myModal2" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><b>EDIT TENDER AWARDS</b></h4>
      </div>
      <div class="modal-body">

    <form action="/updateaward" method="post" enctype="multipart/form-data"> 
		{{csrf_field()}}
<table class="table table-responsive table-hover table-bordered table-striped">
		<input type="hidden" id="awid" name="awid">
	
	  <tr>
	  	<td><strong>Participant1</strong></td>
	  	<td><input type="text" disabled="" name="associatepartnername" id="associatepartnername5" class="form-control" placeholder="Enter Acount No"></td>
	  </tr>
	  <tr>
	  	<td><strong>Participant2</strong></td>
	  	<td><input type="text" disabled="" name="associatepartnername" id="associatepartnername6" class="form-control" placeholder="Enter Acount No"></td>
	  </tr>
	    <tr>
	  	<td><strong>Participant3</strong></td>
	  	<td><input type="text" disabled="" name="associatepartnername" id="associatepartnername7" class="form-control" placeholder="Enter Acount No"></td>
	  </tr>
	  <tr>
	  	<td><strong>Final Score</strong></td>
	  	<td><input type="text" id="finalscore1" name="finalscore" class="form-control" placeholder="Enter Financial Score"autocomplete="off"></td>
	  </tr>
	  <tr>
	  	<td colspan="2" style="text-align: right;"><button class="btn btn-success" type="submit">UPDATE</button></td>
	  </tr>

</table>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><b>EDIT PARTICIPANT</b></h4>
      </div>
      <div class="modal-body">

    <form action="/updateparticipant" method="post" enctype="multipart/form-data"> 
		{{csrf_field()}}
<table class="table table-responsive table-hover table-bordered table-striped">
		<input type="hidden" id="uid" name="uid">
	
	  <tr>
	  	<td><strong>Participant1</strong></td>
	  	<td><input type="text" disabled="" name="associatepartnername" id="associatepartnername1" class="form-control"></td>
	  </tr>
	   <tr>
	  	<td><strong>Participant2</strong></td>
	  	<td><input type="text" disabled="" name="associatepartnername2" id="associatepartnername2" class="form-control"></td>
	  </tr>
	    <tr>
	  	<td><strong>Participant3</strong></td>
	  	<td><input type="text" disabled="" name="associatepartnername3" id="associatepartnername3" class="form-control"></td>
	  </tr>
	  <tr>
	  	<td><strong>Technical Score</strong></td>
	  	<td><input type="text" name="techscore" id="techscore1" class="form-control" placeholder="Enter Technical Score"></td>
	  </tr>
	  <tr>
	  	<td><strong>Financial Score</strong></td>
	  	<td><input type="text" id="financialscore1" name="financialscore" class="form-control" placeholder="Enter Financial Score"autocomplete="off"></td>
	  </tr>
	  <tr>
	  	<td colspan="2" style="text-align: right;"><button class="btn btn-success" type="submit">UPDATE</button></td>
	  </tr>

</table>
</form>
  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<script>
	function editaward(id,associatepartnername,associatepartnername2,associatepartnername3,finalscore) {
		//alert(finalscore);
		//alert(id);
		$("#awid").val(id);
		$("#associatepartnername5").val(associatepartnername);
		$("#associatepartnername6").val(associatepartnername2);
		$("#associatepartnername7").val(associatepartnername3);
        $("#finalscore1").val(finalscore);
		$("#myModal2").modal('show');
	}
	function editparticipant(id,associatepartnername,associatepartnername2,associatepartnername3,techscore,financialscore) {
		$("#uid").val(id);
		//alert(associatepartnername2);
		$("#associatepartnername1").val(associatepartnername);
		$("#associatepartnername2").val(associatepartnername2);
		$("#associatepartnername3").val(associatepartnername3);
		$("#techscore1").val(techscore);
        $("#financialscore1").val(financialscore);
		$("#myModal").modal('show');
	}
	function fetchcomment(argument) {
		var selecteduser=$("#selecteduser").val();
		var tenderid=$("#tenderid").val();
		if (selecteduser=='') {
			 $("#commenttable").hide();
              $("#committeecommenttable").hide();
		}
		else if(selecteduser=='COMMITTEE') {
              $("#commenttable").hide();
              $("#committeecommenttable").show();

		}
		else
		{
		$.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });

           $.ajax({
               type:'POST',
              
               url:'{{url("/ajaxfetchtendercomment")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                     user:selecteduser,
                     tenderid:tenderid
                     },

               success:function(data) { 
               	     if(data.comment)
               	     {
               	     	
               	     	if(data.comment.sitevisitrequired == 'YES'){
               	     		
               	     		$("#sitevisitrequired1").html('<span class="badge bg-green" >'+data.comment.sitevisitrequired+'</span>');
               	     	}
               	     	else{
               	     		$("#sitevisitrequired1").html('<span class="badge bg-red" >'+data.comment.sitevisitrequired+'</span>');
               	     	}

               	     	if(data.comment.workablesite == 'YES'){
               	     		
               	     		$("#workablesite1").html('<span class="badge bg-green" >'+data.comment.workablesite+'</span>');
               	     	}
               	     	else{
               	     		$("#workablesite1").html('<span class="badge bg-red" >'+data.comment.workablesite+'</span>');
               	     	$("#notworkable").addClass("wrkbg");
               	     	}


               	     	if(data.comment.thirdpartyapproval == 'YES'){
               	     		
               	     		$("#thirdpartyapproval1").html('<span class="badge bg-green" >'+data.comment.thirdpartyapproval+'</span>');
               	     	}
               	     	else{
               	     		$("#thirdpartyapproval1").html('<span class="badge bg-red" >'+data.comment.thirdpartyapproval+'</span>');
               	     	}

               	     	if(data.comment.paymentsystem == 'MONTHLY'){
               	     		
               	     		$("#paymentsystem1").html('<span class="badge bg-green" >'+data.comment.paymentsystem+'</span>');
               	     	}
               	     	else if(data.comment.paymentsystem == "STAGE"){
               	     		$("#paymentsystem1").html('<span class="badge bg-green" >'+data.comment.paymentsystem+'</span>');
               	     	}
               	     	else{
               	     		$("#paymentsystem1").html('<span class="badge bg-green" >'+data.comment.paymentsystem+'</span>');
               	     	}

               	     	if(data.comment.inhousecapacity == 'YES'){
               	     		
               	     		$("#inhousecapacity1").html('<span class="badge bg-green" >'+data.comment.inhousecapacity+'</span>');
               	     	}
               	     	else{
               	     		$("#inhousecapacity1").html('<span class="badge bg-red" >'+data.comment.inhousecapacity+'</span>');
               	     	}

               	     	if(data.comment.thirdpartyinvolvement == 'YES'){
               	     		
               	     		$("#thirdpartyinvolvement1").html('<span class="badge bg-green" >'+data.comment.thirdpartyinvolvement+'</span>');
               	     	}
               	     	else if(data.comment.thirdpartyinvolvement == "NO"){
               	     		$("#thirdpartyinvolvement1").html('<span class="badge bg-red" >'+data.comment.thirdpartyinvolvement+'</span>');
               	     	}
               	     	else{
               	     		$("#thirdpartyinvolvement1").html('<span class="badge bg-yellow" >'+data.comment.thirdpartyinvolvement+'</span>');
               	     	}

               	     	if(data.comment.areaaffectedbyextremist == 'YES'){
               	     		
               	     		$("#areaaffectedbyextremist1").html('<span class="badge bg-green" >'+data.comment.areaaffectedbyextremist+'</span>');
               	     		$("#extremist").addClass("extremist");
               	     	}
               	     	else if(data.comment.areaaffectedbyextremist == "NO"){
               	     		$("#areaaffectedbyextremist1").html('<span class="badge bg-red" >'+data.comment.areaaffectedbyextremist+'</span>');
               	     	}
               	     	else{
               	     		$("#thirdpartyinvolvement1").html('<span class="badge bg-yellow" >'+data.comment.thirdpartyinvolvement+'</span>');
               	     	}

               	     	if(data.comment.keypositionbemanaged == 'YES'){
               	     		
               	     		$("#keypositionbemanaged1").html('<span class="badge bg-green" >'+data.comment.keypositionbemanaged+'</span>');
               	     	}
               	     	else if(data.comment.keypositionbemanaged == "NO"){
               	     		$("#keypositionbemanaged1").html('<span class="badge bg-red" >'+data.comment.keypositionbemanaged+'</span>');
               	     	}
               	     	else{
               	     		$("#keypositionbemanaged1").html('<span class="badge bg-yellow" >'+data.comment.keypositionbemanaged+'</span>');
               	     	}

               	     	if(data.comment.projectdurationsufficient == 'YES'){
               	     		
               	     		$("#projectdurationsufficient1").html('<span class="badge bg-green" >'+data.comment.projectdurationsufficient+'</span>');
               	     	}
               	     	else if(data.comment.projectdurationsufficient == "NO"){
               	     		$("#projectdurationsufficient1").html('<span class="badge bg-red" >'+data.comment.projectdurationsufficient+'</span>');
               	     	}
               	     	else{
               	     		$("#projectdurationsufficient1").html('<span class="badge bg-yellow" >'+data.comment.projectdurationsufficient+'</span>');
               	     	}

               	     	if(data.comment.localofficesetup == 'YES'){
               	     		
               	     		$("#localofficesetup1").html('<span class="badge bg-green" >'+data.comment.localofficesetup+'</span>');
               	     	}
               	     	else if(data.comment.localofficesetup == "NO"){
               	     		$("#localofficesetup1").html('<span class="badge bg-red" >'+data.comment.localofficesetup+'</span>');
               	     	}
               	     	else{
               	     		$("#localofficesetup1").html('<span class="badge bg-yellow" >'+data.comment.localofficesetup+'</span>');
               	     	}

               	     	if(data.comment.paymentscheduleclear == 'YES'){
               	     		
               	     		$("#paymentscheduleclear1").html('<span class="badge bg-green" >'+data.comment.paymentscheduleclear+'</span>');
               	     	}
               	     	else if(data.comment.paymentscheduleclear == "NO"){
               	     		$("#paymentscheduleclear1").html('<span class="badge bg-red" >'+data.comment.paymentscheduleclear+'</span>');
               	     	}
               	     	else{
               	     		$("#paymentscheduleclear1").html('<span class="badge bg-yellow" >'+data.comment.paymentscheduleclear+'</span>');
               	     	}

               	     	if(data.comment.penalityclause == 'YES'){
               	     		
               	     		$("#penalityclause1").html('<span class="badge bg-green" >'+data.comment.penalityclause+'</span>');
               	     	}
               	     	else if(data.comment.penalityclause == "NO"){
               	     		$("#penalityclause1").html('<span class="badge bg-red" >'+data.comment.penalityclause+'</span>');
               	     	}
               	     	else{
               	     		$("#penalityclause1").html('<span class="badge bg-yellow" >'+data.comment.penalityclause+'</span>');
               	     	}

               	     	if(data.comment.wehaveexpertise == 'YES'){
               	     		
               	     		$("#wehaveexpertise1").html('<span class="badge bg-green" >'+data.comment.wehaveexpertise+'</span>');
               	     	}
               	     	else if(data.comment.wehaveexpertise == "NO"){
               	     		$("#wehaveexpertise1").html('<span class="badge bg-red" >'+data.comment.wehaveexpertise+'</span>');
               	     	}
               	     	else{
               	     		$("#wehaveexpertise1").html('<span class="badge bg-yellow" >'+data.comment.wehaveexpertise+'</span>');
               	     	}

               	     	if(data.comment.contractualambiguty == 'YES'){
               	     		
               	     		$("#contractualambiguty1").html('<span class="badge bg-green" >'+data.comment.contractualambiguty+'</span>');
               	     	}
               	     	else if(data.comment.contractualambiguty == "NO"){
               	     		$("#contractualambiguty1").html('<span class="badge bg-red" >'+data.comment.contractualambiguty+'</span>');
               	     	}
               	     	else{
               	     		$("#contractualambiguty1").html('<span class="badge bg-yellow" >'+data.comment.contractualambiguty+'</span>');
               	     	}

               	     	if(data.comment.extensivefieldinvestigation == 'YES'){
               	     		
               	     		$("#extensivefieldinvestigation1").html('<span class="badge bg-green" >'+data.comment.extensivefieldinvestigation+'</span>');
               	     	}
               	     	else if(data.comment.extensivefieldinvestigation == "NO"){
               	     		$("#extensivefieldinvestigation1").html('<span class="badge bg-red" >'+data.comment.extensivefieldinvestigation+'</span>');
               	     	}
               	     	else{
               	     		$("#extensivefieldinvestigation1").html('<span class="badge bg-yellow" >'+data.comment.extensivefieldinvestigation+'</span>');
               	     	}

               	     	if(data.comment.requiredexperienceoffirm == 'YES'){
               	     		
               	     		$("#requiredexperienceoffirm1").html('<span class="badge bg-green" >'+data.comment.requiredexperienceoffirm+'</span>');
               	     	}
               	     	else if(data.comment.requiredexperienceoffirm == "NO"){
               	     		$("#requiredexperienceoffirm1").html('<span class="badge bg-red" >'+data.comment.requiredexperienceoffirm+'</span>');
               	     	}
               	     	else{
               	     		$("#requiredexperienceoffirm1").html('<span class="badge bg-yellow" >'+data.comment.requiredexperienceoffirm+'</span>');
               	     	}

               	     	$("#sitevisitdescription1").val(data.comment.sitevisitdescription);
               	     	$("#safetyconcern1").html(data.comment.safetyconcern);
               	     	$("#thirdpartyapprovaldetails1").val(data.comment.thirdpartyapprovaldetails);
               	     	$("#paymentsystemdetails1").val(data.comment.paymentsystemdetails);
               	     	$("#paymentscheduleambiguty1").val(data.comment.paymentscheduleambiguty);
               	     	$("#penalityclauseambiguty1").val(data.comment.penalityclauseambiguty);
               	     	$("#wehaveexpertisedescription1").val(data.comment.wehaveexpertisedescription);
               	     	$("#contractualambigutydescription1").val(data.comment.contractualambigutydescription);
               	     	$("#extensivefieldinvestigationdescription1").val(data.comment.extensivefieldinvestigationdescription);
               	     	$("#requiredexperienceoffirmdescription1").val(data.comment.requiredexperienceoffirmdescription);
               	     	$("#anyotherrequirement1").val(data.comment.anyotherrequirement);

               	     	$("#ratetobequoted1").html(data.comment.ratetobequoted);
               	     	$("#ratetobequoted1").html('<h4 class="small-box bg-blue rbox">'+data.comment.ratetobequoted+'</h4>');

               	     	$("#commenttable").show();
               	     	$("#committeecommenttable").hide();

               	     	$("#commentby").text('COMMENT OF '+data.user.name);

               	     }
               	     else
               	     {
               	     	$("#commenttable").hide();
               	     	
               	     }
                     
               }
               
             });

       }
	}
</script>




@endsection