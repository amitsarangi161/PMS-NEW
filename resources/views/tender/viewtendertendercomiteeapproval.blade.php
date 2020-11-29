@extends('layouts.tender')
@section('content')
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
		<td class="text-center">TENDER COMMITEE APPROVAL</td>
		
	</tr>
</table>

<table class="table table-responsive table-hover table-bordered table-striped">
<tr>
	<input type="hidden" id="tenderid" value="{{$tender->id}}">
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


<form action="/approvetenderbycommitee/{{$tender->id}}" method="POST">
	{{csrf_field()}}
<table class="table">
	<tr>
		<td><strong>COMMITTEE COMMENTS</strong></td>
		<td colspan="3">
			<textarea class="form-control" name="committeecomment" placeholder="Write Your Comment Here" required=""></textarea>
		</td>
		
		
	
	</tr>
	<tr>
	<td><strong>RECOMENDED FOR</strong></td>
	
	<td>
			<input type="radio" name="recomended" value="SOLE" {{ ( $tender->committee_recomend == 'SOLE') ? 'checked' : '' }}>SOLE &nbsp;&nbsp;&nbsp;

			<input type="radio" name="recomended" value="ASSOCIATION" {{ ( $tender->committee_recomend == 'ASSOCIATION') ? 'checked' : '' }}>ASSOCIATION &nbsp;&nbsp;&nbsp;

			<input type="radio" name="recomended" value="JV" {{ ( $tender->committee_recomend == 'JV') ? 'checked' : '' }}>JV
	</td>
	<td><strong>SELECT A ASSOCIATE PARTNER</strong></td>
	<td>
	@php
		        if($tender->committee_recomend=='ASSOCIATION' ||$tender->committee_recomend=='JV')
		         $val="";
		         else
		         $val="disabled";
		      @endphp
            <select id="selected" class="form-control select2" name="committee_associatepartner"  {{$val}} required="">
            	<option value="">Select a Partner</option>
            	@foreach($associatepartners as $associatepartner)
            	<option value="{{$associatepartner->id}}" {{($tender->committee_associatepartner==$associatepartner->id)? 'selected':''}}>{{$associatepartner->associatepartnername}}</option>
            	@endforeach
            </select>
        </td>

</tr>
	
</table>
<h4 class="text-center"><strong>COMMITTEE REMARKS</strong></h4>
<table class="table">
	<thead>
		<tr class="bg-green">
			<td>SL_NO</td>
			<td>NAME</td>
			<td>REMARKS</td>
			<td>CREATED_AT</td>
		</tr>
	</thead>
	@foreach($remarks as $key=>$remark)
	
	<tr>
	<td>{{++$key}}</td>		
	<td>{{$remark->name}}</td>		
	<td>{{$remark->remarks}}</td>		
	<td>{{$remark->created_at}}</td>	
	
	</tr>
    @endforeach

	
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
			<textarea class="form-control" name="sitevisitdescription">{{$tender->sitevisitdescription}}</textarea>
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
			<textarea class="form-control" name="safetyconcern">{{$tender->safetyconcern}}</textarea>
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
			<textarea class="form-control" name="thirdpartyapprovaldetails">{{$tender->thirdpartyapprovaldetails}}</textarea>
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
			<textarea class="form-control" name="paymentsystemdetails">{{$tender->paymentsystemdetails}}</textarea>
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
			<textarea name="paymentscheduleambiguty" class="form-control" placeholder="Describe The AMBIGUTY">{{$tender->paymentscheduleambiguty}}</textarea>
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
			<textarea name="penalityclauseambiguty" class="form-control" placeholder="Describe The AMBIGUTY">{{$tender->penalityclauseambiguty}}</textarea>
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
			<textarea name="wehaveexpertisedescription" class="form-control" placeholder="Describe The AMBIGUTY">{{$tender->wehaveexpertisedescription}}</textarea>
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
			<textarea name="contractualambigutydescription" class="form-control" placeholder="Describe The AMBIGUTY">{{$tender->contractualambigutydescription}}</textarea>
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
			<textarea name="extensivefieldinvestigationdescription" class="form-control" placeholder="Describe The AMBIGUTY">{{$tender->extensivefieldinvestigationdescription}}</textarea>
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
			<textarea name="requiredexperienceoffirmdescription" class="form-control" placeholder="Describe The AMBIGUTY">{{$tender->requiredexperienceoffirmdescription}}</textarea>
		</td>
		
		</tr>

			<tr>
		<td><strong>RECORD ANY OTHER REQUIREMENT?</strong></td>
		<td colspan="3">
			<textarea name="anyotherrequirement" class="form-control" placeholder="Describe">{{$tender->anyotherrequirement}}</textarea>
		</td>
		
		</tr>

			<tr>
		<td><strong>RATE TO BE QUOTED?</strong></td>
		<td colspan="3">
			<input type="text" name="ratetobequoted" class="form-control" placeholder="Enter Rate to be QUOTED" value="{{$tender->ratetobequoted}}">
		</td>
		
		</tr>

	


</table>
</div>
<table class="table">
	<tr class="bg-navy">
		<td class="text-center">ASSIGNED USER COMMENTS</td>
		
	</tr>
</table>
<table class="table">
	<tr>
		<td><strong>Select a User</strong></td>
		<td>
			<select class="form-control select2" id="selecteduser" onchange="fetchcomment();">
				<option value="">Select User</option>
				@foreach($users as $user)
				  <option value="{{$user->userid}}">{{$user->name}}</option>
				@endforeach
			</select>
		</td>
	</tr>
</table>

<table class="table">
	<tr>
		<td colspan="4" style="text-align: left;"><button class="btn btn-danger btn-lg" type="button" onclick="rejecttender();">COMMITEE REJECT</button></td>
		<td><button type="button" onclick="revokestatus('{{$tender->id}}');" class="btn btn-warning btn-lg">REVOKE</button></td>
		<td><button type="submit" class="btn btn-primary btn-lg" name="SAVE" value="SAVE">SAVE</button></td>
		<td colspan="4" style="text-align: right;"><button class="btn btn-success btn-lg" type="submit" name="SUBMIT" value="SUBMIT">APPROVE COMMITEE</button></td>
	</tr>
</table>
</form>
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
	<tr>
		<td><strong>WORKABLE SITE? (Y OR N)</strong></td>
		<td id="workablesite1">
			
		</td>
	
		<td><strong>Any Safety Concern?</strong></td>
		<td>
			<textarea readonly class="form-control" id="safetyconcern1" name="safetyconcern1"></textarea>
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
			<textarea readonly class="form-control" id="paymentsystemdetails1" name="paymentsystemdetails"></textarea>
		</td>
	</tr>
	<tr>
		<td><strong>PROJECT DURATION IN(MONTH,DAYS,YEAR)</strong></td>
		<td>
			<span id="durationtype" class="badge bg-green"></span>

		</td>
		<td><strong>Duration (IN Number Eg:120)</strong></td>
		<td>
			<input type="text" readonly class="form-control"  id="duration">
		</td>
	</tr>
	<tr>
		<td><strong>IF DURATION IS SUFFICIENT ?</strong></td>
		<td>
			<span id="durationsufficient"></span>
		</td>
		<td><strong>IF NO DESCRIBE</strong></td>
		<td>
			<textarea readonly class="form-control" id="durationsufficientdescription"></textarea>
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
		<tr>
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
	<tr class="wrkbg">
		<td><strong>RECOMENDED FOR</strong></td>
		<td>
			<span id="recomended"></span>
		</td>
	</tr>
	<tr class="wrkbg">
		<td><strong>SELECT ASSOCIATE PARTNER</strong></td>
		<td>
			<span id="associatepartner"></span>
      </td>
	</tr>
	<tr>
		<td><strong>WILL WE PARTICIPATE IN THIS TENDER ?</strong></td>
		<td id="participation">
			
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
<table class="table">
	<thead>
		<tr class="bg-green">
		<td>USERNAME</td>
		<td>REMARKS</td>
		<td>CREATED_AT</td>
	    </tr>
	</thead>
	<tbody id="userremark">
		
	</tbody>
</table>
</div>
<div class="modal fade" id="rejectModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align: center;color: red;font-weight: bold;">Reject Modal</h4>
        </div>
        <div class="modal-body">
        	<form action="/committeereject/{{$tender->id}}" method="post">
        		{{csrf_field()}}	
           <table class="table">
           	    <tr>
           	    	<td><strong>Describe Reason</strong></td>
           	    	<td><textarea name="committeerejectreason" class="form-control" required="" placeholder="Describe Cancelation Reason"></textarea></td>
           	    </tr>
           	    <tr>
           	    	<td>
           	    		<button class="btn btn-danger btn-lg" style="text-align: right;" type="submit" onclick="return confirm('Do You Want to reject this tender?')">REJECT</button>
           	    	</td>
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

<div id="revokeModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">CHANGE STATUS</h4>
      </div>
      <div class="modal-body">
        <form action="/revokestatustendercommittee" method="POST">
          {{csrf_field()}}
        <table class="table">
          <input type="hidden" name="tid" id="tid" required="">
          <td><strong>Select a Status</strong></td>
          <td>
         <select class="form-control" name="status" required="">
              <option value="">Select a Status</option>
                              <option value="ASSIGNED TO USER">ASSIGNED TO USER</option>
                              <option value="ELLIGIBLE">TO COMMITTEE</option>
                              
                            
            </select>
          </td>
          <td>
            <button type="submit" class="btn btn-success" onclick="confirm('Do You want to change this ?')">CHANGE</button>
          </td>
          
        </table>
        </form>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<script type="text/javascript">

	$('input[type=radio][name=recomended]').change(function() {
    if (this.value == 'ASSOCIATION' || this.value=='JV') {
        $("#selected").attr( "disabled",false);
    }
    else{
        $("#selected").attr( "disabled",true);
    }
});
		function revokestatus(id)
  {
       $("#tid").val(id);
       $('#revokeModal').modal('show');
  }
	function rejecttender()
	{
      $("#rejectModal").modal('show');
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

               	     	if(data.comment.participation == 'YES'){
               	     		
               	     		$("#participation").html('<span class="badge bg-green" >'+data.comment.participation+'</span>');
               	     	}
               	     	else{
               	     		$("#participation").html('<span class="badge bg-red" >'+data.comment.participation+'</span>');
               	     	}
               	     	
               	     	$("#recomended").html('<span class="badge bg-green" >'+data.comment.recomended+'</span>');
               	     	
               	     	$("#associatepartner").html('<span class="badge bg-green" >'+data.comment.associatepartnername+'</span>');
               	     	

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
               	     	if(data.comment.durationsufficient == 'YES'){
               	     		
               	     		$("#durationsufficient").html('<span class="badge bg-green" >'+data.comment.durationsufficient+'</span>');
               	     	}
               	     	else{
               	     		$("#durationsufficient").html('<span class="badge bg-red" >'+data.comment.durationsufficient+'</span>');
               	     	}

               	     	$("#sitevisitdescription1").val(data.comment.sitevisitdescription);
               	     	$("#safetyconcern1").val(data.comment.safetyconcern);
               	     	$("#thirdpartyapprovaldetails1").val(data.comment.thirdpartyapprovaldetails);
               	     	$("#paymentsystemdetails1").val(data.comment.paymentsystemdetails);
               	     	$("#durationsufficientdescription").val(data.comment.durationsufficientdescription);
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
               	     	$("#durationtype").text(data.comment.durationtype);
               	     	$("#duration").val(data.comment.duration);
                        	$("#userremark").empty();
               	     	$.each(data.remarks,function (key,value) {
               	     		var x='<tr><td>'+value.name+'</td><td>'+value.remarks+'</td><td>'+value.created_at+'</td><td><tr>';
               	     		$("#userremark").append(x);
               	     	})
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