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
		<td class="text-center">VIEW TENDER APPROVED BY COMMITEE</td>
		
	</tr>
</table>

<table class="table table-responsive table-hover table-bordered table-striped">
	<input type="hidden" id="tenderid" value="{{$tender->id}}">
<tr>

	<td><strong>Name Of the Work *</strong></td>
	<td><textarea name="nameofthework" class="form-control" required="" placeholder="Enter Name of The Work" >{{$tender->nameofthework}}</textarea></td>
	<td><strong>Client Name *</strong></td>
	<td>
		<input type="text" name="clientname" value="{{$tender->clientname}}" class="form-control" placeholder="Enter Name of the Work" >
	</td>
</tr>
<tr>
	<td><strong>Location</strong></td>
	<td><input type="text" name="location" class="form-control" placeholder="Enter Work Location" value="{{$tender->location}}"></td>
	<td><strong>Evaluation Process</strong></td>
	<td>
		<select class="form-control" name="evaluationprocess" >
			<option value="" selected>--Select a Evaluationprocess--</option>
			<option value="ONLINE" {{ ( $tender->evaluationprocess == 'ONLINE') ? 'selected' : '' }}>ONLINE</option>
			<option value="OFFLINE" {{ ( $tender->evaluationprocess == 'OFFLINE') ? 'selected' : '' }} >OFFLINE</option>
			
		</select>
	</td>
	
</tr>
<!-- <tr id="evaluationscore" style="display: none;background-color: gray;">
	<td><strong>TECHNICAL</strong></td>
	<td><input type="number" name="evaluationtechnical" id="evaluationtechnical" class="form-control"></td>
	<td><strong>FINANCIAL</strong></td>
	<td><input type="number" name="evaluationfinancial" id="evaluationfinancial" class="form-control"></td>
	
</tr> -->
<tr>
	<td><strong>TENDER REF NO/TENDER ID *</strong></td>
	<td>
           <input type="text" name="tenderrefno" id="tenderrefno" class="form-control" value="{{$tender->tenderrefno}}" placeholder="Enter Tender Reference No"  onkeyup="searchtenderno(this.value)">
        <div id="searchlist" style="background-color: #d9d9d9">
        	
        </div>
	</td>
	<td><strong>TENDER DATE*</strong></td>
	<td><input type="text" name="tenderdate" value="{{$tender->tenderdate}}" class="form-control datepicker"></td>
</tr>
<tr>
	<td><strong>Work Value *</strong></td>
	<td><input type="text" name="workvalue" id="workvalue" value="{{$tender->workvalue}}" class="form-control convert3" placeholder="Enter Work Value"  autocomplete="off"></td>
    <td><strong>Work Value in Word</strong></td>
	<td>
       <textarea class="form-control" readonly="" name="workvalueinword" id="workvalueinword">{{$tender->workvalueinword}}</textarea>
	</td>
	
</tr>
<tr>
	<td><strong>Type Of Work *</strong></td>
	<td>
		<select class="form-control select2" name="typeofwork" >
			<option value="" selected="">--Select a Work Type--</option>
			<option value="ELECTRICAL" {{ ( $tender->typeofwork == 'ELECTRICAL') ? 'selected' : '' }}>ELECTRICAL</option>
			<option value="CIVIL" {{ ( $tender->typeofwork == 'CIVIL') ? 'selected' : '' }}>CIVIL</option>
			<option value="OTHERS" {{ ( $tender->typeofwork == 'OTHERS') ? 'selected' : '' }}>OTHERS</option>
			
		</select>
	</td>
	<td><strong>LAST DATE OF SUBMISSION *</strong></td>
	<td><input type="text" class="form-control datepicker readonly" name="lastdateofsubmisssion" value="{{$tender->lastdateofsubmisssion}}" id="lastdateofsubmisssion"  autocomplete="off"></td>
	
</tr>
<tr>
	<td><strong>TENDER VALIDITY IN DAYS *(Ex.20)</strong></td>
	<td><input type="text" name="tendervalidityindays" value="{{$tender->tendervalidityindays}}" id="tendervalidityindays" class="form-control chngdate"></td>

	<td><strong>LAST DATE OF TENDER VALIDITY</strong></td>
	<td><input type="text" autocomplete="off" name="tendervaliditydate" id="tendervaliditydate" class="form-control" readonly="" value="{{$tender->tendervaliditydate}}"></td>
</tr>
<tr>
	<td><strong>NIT DOCUMENT/NIT/QUOTATION *</strong></td>

	<td><input type="file" name="rfpdocument[]" class="form-control" multiple  ></td>
	
</tr>

<tr>
	<td><strong>REF PAGE NO OF NIT DOCUMENT *</strong></td>
	<td>
	
		<textarea name="refpageofrfp" class="form-control" placeholder="Enter Reference Page No of RFP Document" >{{$tender->refpageofrfp}}</textarea>
        
	</td>
	<td><strong>CORRIGENDUM FILE *</strong></td>
	<td>
		<input type="file" name="corrigendumfile[]" class="form-control" multiple>
	</td>
</tr>
<tr>
	<td><strong>PRE-BID MEETING START DATE*</strong></td>
	<td><input type="text" value="{{$tender->prebidmeetingdate}}" name="prebidmeetingdate" class="form-control datetimepicker1" ></td>
	<td><strong>RECOMENDED FOR</strong></td>
	<td>
			<input type="radio" name="recomended" value="SOLE" {{ ( $tender->recomended == 'SOLE') ? 'checked' : '' }}>SOLE &nbsp;&nbsp;&nbsp;
			<input type="radio" name="recomended" value="OSIC" {{ ( $tender->recomended == 'OSIC') ? 'checked' : '' }}>OSIC &nbsp;&nbsp;&nbsp;
			<input type="radio" name="recomended" value="NSIC" {{ ( $tender->recomended == 'NSIC') ? 'checked' : '' }}>NSIC &nbsp;&nbsp;&nbsp;
			<input type="radio" name="recomended" value="JV" {{ ( $tender->recomended == 'JV') ? 'checked' : '' }} >JV
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
		<td class="text-center">PAPER COST</td>
		
	</tr>
</table>

<table class="table table-responsive table-hover table-bordered table-striped">
	<tr>
		<td><strong>PAPER AMOUNT</strong></td> 
		<td><input type="text" name="paperamount" id="paperamount" class="form-control convert4 calc" value="{{$tender->paperamount}}" autocomplete="off" placeholder="Enter Paper Amount"  ></td>
		<td><strong>Amount in Word</strong></td>
		<td>
			<textarea class="form-control" id="tenderpaperamountinword" name="tenderpaperamountinword" readonly="">{{$tender->tenderpaperamountinword}}</textarea>
		</td>
	</tr>
	<tr>
		<td><strong>PAPER COST in the form of </strong></td>
		<td>
			<select class="form-control select2" name="papercostinformof">
				<option value="">--Choose a Type--</option>
				<option value="DD" {{ ( $tender->papercostinformof == 'DD') ? 'selected' : '' }}>DD</option>
				<option value="BG" {{ ( $tender->papercostinformof == 'BG') ? 'selected' : '' }}>BG</option>
				<option value="ONLINE" {{ ( $tender->papercostinformof == 'ONLINE') ? 'selected' : '' }}>ONLINE</option>
				<option value="TDR" {{ ( $tender->papercostinformof == 'TDR') ? 'selected' : '' }}>TDR</option>
				<option value="KVP" {{ ( $tender->papercostinformof == 'KVP') ? 'selected' : '' }}>KVP</option>
				<option value="EXEMPTED" {{ ( $tender->papercostinformof == 'EXEMPTED') ? 'selected' : '' }}>EXEMPTED</option>
			
		    </select>
	</td>
	<td><strong>PAPER FEE Payable To</strong></td>
	<td>
		<textarea name="paperfeepayableto" class="form-control">{{$tender->paperfeepayableto}}</textarea>
	</td>
	</tr>
	<tr>
		<td><strong>GST IN(%)</strong></td> 
		<td><input type="text" name="gstpercnt" id="gstpercnt" class="form-control calc" autocomplete="off" value={{$tender->gstpercnt}} placeholder="Enter GST Percentage" value="0" ></td>
		<td><strong>GST AMOUNT</strong></td> 
		<td><input type="text" name="gstamount" id="gstamount" class="form-control convert1" autocomplete="off" value={{$tender->gstamount}} placeholder="Enter Tender Amount"  ></td>
	</tr>
	<!-- <tr>
		<td><strong>TOTAL PAPER AMOUNT</strong></td> 
		<td><input type="text" name="totalpaperamt" id="totalpaperamt" class="form-control calc" autocomplete="off" readonly=""></td>
	</tr> -->

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
<table class="table">
	<tr>
		<td><strong>Select a User</strong></td>
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
<table class="table">
	<tr>
		<td><button type="button" onclick="openapprovemodal('{{$tender->id}}');" class="btn btn-success btn-lg">APPROVE</button></td>
		<td><button type="button" onclick="revokestatus('{{$tender->id}}');" class="btn btn-warning btn-lg">REVOKE</button></td>
		<td><button type="button" onclick="openrejectmodal('{{$tender->id}}')" class="btn btn-danger btn-lg">REJECT</button></td>
	</tr>
	
</table>

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
			<textarea readonly class="form-control" id="paymentsystemdetails1" name="paymentsystemdetails">{{$tender->paymentsystemdetails}}</textarea>
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
<div id="approvemodal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="text-align: center;"><strong>APPROVE MODAL</strong></h4>
      </div>
      <div class="modal-body">
      	<form action="/approvetenderbyadmin" method="post">
      		{{csrf_field()}}

          <table class="table">
          	<input type="hidden" name="taid" id="taid">
          	<tr>
          		<td><strong>Assign To Office</strong></td>
          		<td>
          			<select class="form-control" name="assignedoffice" required="">
          				<option value="">Select a Office</option>
          				@foreach($offices as $office)
                         <option value="{{$office->id}}">{{$office->name}}</option>
          				@endforeach
          			</select>
          		</td>
          	</tr>
          	<tr>
          		<td><strong>NOTES</strong></td>
          		<td><textarea name="notes" class="form-control"></textarea></td>

          	</tr>
          	<tr>
          		<td><button type="submit" onclick="return confirm('Do You Want to Approve this Tender?')" class="btn btn-success">APPROVE</button></td>
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


<div id="rejectmodal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="text-align: center;"><strong>REJECT MODAL</strong></h4>
      </div>
      <div class="modal-body">
        <form action="/rejecttenderbyadmin" method="post">
      		{{csrf_field()}}

          <table class="table">
          	<input type="hidden" name="trid" id="trid">
          	<tr>
          		<td><strong>NOTES</strong></td>
          		<td><textarea required="" name="rejectnotes" class="form-control"></textarea></td>

          	</tr>
          	<tr>
          		<td><button type="submit" onclick="return confirm('Do You Want to Approve this Tender?')" class="btn btn-danger">REJECT</button></td>
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
@if(Auth::user()->usertype=='MASTER ADMIN')
<div id="revokeModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">CHANGE STATUS</h4>
      </div>
      <div class="modal-body">
        <form action="/revokestatusadmin" method="POST">
          {{csrf_field()}}
        <table class="table">
          <input type="hidden" name="tid" id="tid" required="">
          <tr>
          <td><strong>Select a Status</strong></td>
          <td>
         <select class="form-control" name="status" required="">
              <option value="">Select a Status</option>
                              <option value="ASSIGNED TO USER">ASSIGNED TO USER</option>
                              <option value="ELLIGIBLE">TO COMMITTEE</option>
                              
                            
            </select>
          </td>
          </tr>
          <tr>
            <td><strong>REMARKS</strong></td>
            <td>
              <textarea name="remarks" class="form-control" required=""></textarea>
            </td>
          </tr>
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
@endif
<script type="text/javascript">
	function revokestatus(id)
  {
       $("#tid").val(id);
       $('#revokeModal').modal('show');
  }
  
	function openapprovemodal(id)
	{
       $("#taid").val(id);
       $("#approvemodal").modal('show');
	}
	function openrejectmodal(id)
	{
       $("#trid").val(id);
       $("#rejectmodal").modal('show');
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
               	     	if(data.comment.participation == 'YES'){
               	     		
               	     		$("#participation").html('<span class="badge bg-green" >'+data.comment.participation+'</span>');
               	     	}
               	     	else{
               	     		$("#participation").html('<span class="badge bg-red" >'+data.comment.participation+'</span>');
               	     	}
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