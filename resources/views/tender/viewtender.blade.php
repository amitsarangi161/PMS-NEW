@extends('layouts.tender')
@section('content')
@inject('provider', 'App\Http\Controllers\TenderController')

<table class="table">
	<tr class="bg-navy">
		<td class="text-center">VIEW TENDER</td>
		
	</tr>
</table>




<table class="table table-responsive table-hover table-bordered table-striped">
<tr>
	<td width="20%"><strong>Name Of the Work *</strong></td>
	<td width="30%"><textarea name="nameofthework" class="form-control" placeholder="Enter Name of The Work" disabled="">{{$tender->nameofthework}}</textarea></td>
	<td width="20%"><strong>Client Name *</strong></td>
	<td width="30%">
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
	<td><strong>Work Value in Word</strong></td>
	<td>
       <textarea class="form-control" readonly="" name="workvalueinword" id="workvalueinword">{{$tender->workvalueinword}}</textarea>
	</td>
</tr>
<tr>


	<td><strong>NIT PUBLICATION DATE *</strong></td>
	<td><input type="text" name="nitpublicationdate" class="form-control readonly" disabled="" value="{{$provider::changedateformat($tender->nitpublicationdate)}}"></td>
	<td></td>
	<td></td>
	
</tr>
<tr>
	<td><strong>SOURCE *</strong></td>
	<td><input type="text" name="source" class="form-control" placeholder="Enter Source Name" disabled="" value="{{$tender->source}}"></td>

	<td><strong>TENDER PRIORITY *</strong></td>
	<td>
		<form action="/changepriorityadmin/{{$tender->id}}" method="post">
			{{csrf_field()}}
		<select class="form-control select2" name="tenderpriority" required="">
			<option value="HIGH" {{ ( $tender->tenderpriority == 'HIGH') ? 'selected' : '' }}>HIGH</option>
			<option value="MEDIUM" {{ ( $tender->tenderpriority == 'MEDIUM') ? 'selected' : '' }}>MEDIUM</option>
			<option value="LOW" {{ ( $tender->tenderpriority == 'LOW') ? 'selected' : '' }}>LOW</option>
			
		</select>
         <button type="submit" class="btn btn-success">Change</button>
       </form>
	</td>

</tr>
<tr>
	<td><strong>Type Of Work *</strong></td>
	<td>

		<input type="text" disabled="" class="form-control" value="{{$tender->typeofwork}}">
	</td>
	<td><strong>LAST DATE OF SUBMISSION *</strong></td>
	<td><input type="text" class="form-control  readonly" name="lastdateofsubmisssion" disabled="" value="{{$provider::changedateformat($tender->lastdateofsubmisssion)}}"></td>
	
</tr>
<tr>
	<td><strong>TENDER VALIDITY IN DAYS *(Ex.20)</strong></td>
	<td><input type="text" name="tendervalidityindays" id="tendervalidityindays" class="form-control chngdate" value="{{$tender->tendervalidityindays}}" disabled=""></td>

	<td><strong>LAST DATE OF TENDER VALIDATITY</strong></td>
	<td><input type="text" name="tendervaliditydate" id="tendervaliditydate" class="form-control" disabled="" value="{{$provider::changedateformat($tender->tendervaliditydate)}}"></td>
</tr>
<tr>
	<td><strong>RFP AVAILABLE DATE *</strong></td>
	<td><input type="text" class="form-control readonly" name="rfpavailabledate" disabled="" value="{{$provider::changedateformat($tender->rfpavailabledate)}}"></td>

	<td><strong>REF PAGE NO OF RFP DOCUMENT *</strong></td>
	<td>
    <textarea disabled="">{{$tender->refpageofrfp}}</textarea>
	</td>


</tr>
<tr>
	<td><strong>DOCUMENT DOWNLOAD/SALE START DATE *</strong></td>
	<td><input type="text" name="salestartdate" class="form-control" value="{{$provider::changedatetimeformat($tender->salestartdate)}}" disabled=""></td>
	<td><strong>DOCUMENT DOWNLOAD/SALE END DATE *</strong></td>
	<td><input type="text" name="saleenddate" class="form-control" value="{{$provider::changedatetimeformat($tender->saleenddate)}}" disabled=""></td>
	
</tr>
<tr>
	<td><strong>BID SUBMISSION START DATE *</strong></td>
	<td><input type="text" name="bidstartdate" class="form-control" value="{{$provider::changedatetimeformat($tender->bidstartdate)}}" disabled=""></td>
	<td><strong>BID SUBMISSION END DATE *</strong></td>
	<td><input type="text" name="bidenddate" class="form-control" disabled="" value="{{$provider::changedatetimeformat($tender->bidenddate)}}"></td>
	
</tr>

<tr>
	<td><strong>PRE-BID MEETING START DATE*</strong></td>
	<td><input type="text" name="prebidmeetingdate" class="form-control" value="{{$provider::changedatetimeformat($tender->prebidmeetingdate)}}" disabled=""></td>

	
	
	<td></td>
	<td></td>
</tr>

<tr>
	<form action="/changerecomendtender/{{$tender->id}}" method="post">
		{{csrf_field()}}
	<td><strong>RECOMENDED FOR</strong></td>
	
	<td>
			<input type="radio" name="recomended" value="SOLE" {{ ( $tender->recomended == 'SOLE') ? 'checked' : '' }}>SOLE &nbsp;&nbsp;&nbsp;

			<input type="radio" name="recomended" value="ASSOCIATION" {{ ( $tender->recomended == 'ASSOCIATION') ? 'checked' : '' }}>ASSOCIATION &nbsp;&nbsp;&nbsp;

			<input type="radio" name="recomended" value="JV" {{ ( $tender->recomended == 'JV') ? 'checked' : '' }}>JV



           

	</td>
	<td><strong>SELECT A ASSOCIATE PARTNER</strong></td>

	<td>
		   @if(Auth::user()->usertype=='MASTER ADMIN')
		      @php
		        if($tender->recomended=='ASSOCIATION' ||$tender->recomended=='JV')
		         $val="";
		         else
		         $val="disabled";
		      @endphp
            <select id="selected" class="form-control select2" name="associatepartner"  {{$val}} required="">
            	<option value="">Select a Partner</option>
            	@foreach($associatepartners as $associatepartner)
            	<option value="{{$associatepartner->id}}" {{($tender->associatepartner==$associatepartner->id)? 'selected':''}}>{{$associatepartner->associatepartnername}}</option>
            	@endforeach
            </select>
            @else
             <td></td>
            @endif
			@if(Auth::user()->usertype=='MASTER ADMIN')
			<button type="submit" class="btn btn-success">Change</button>
			@endif
	</td>
</form>
</tr>
<tr>
	<td><strong>CHANGE STATUS *</strong></td>
	<td>
		<form action="/changestatus/{{$tender->id}}" method="post">
			{{csrf_field()}}
		<select class="form-control select2" name="status" required="">
			<option value="">ALL</option>
			<option value="ADMIN APPROVED" {{ ( $tender->status == 'ADMIN APPROVED') ? 'selected' : '' }}>ADMIN APPROVED</option>
			<option value="ADMIN REJECTED" {{ ( $tender->status == 'ADMIN REJECTED') ? 'selected' : '' }}>ADMIN REJECTED</option>
			<option value="APPLIED" {{ ( $tender->status == 'APPLIED') ? 'selected' : '' }}>APPLIED</option>
			<option value="NOT APPLIED" {{ ( $tender->status == 'NOT APPLIED') ? 'selected' : '' }}>NOT APPLIED</option>

			<option value="COMMITEE APPROVED" {{ ( $tender->status == 'COMMITEE APPROVED') ? 'selected' : '' }}>COMMITEE APPROVED</option>

			<option value="COMMITTEE REJECTED" {{ ( $tender->status == 'COMMITTEE REJECTED') ? 'selected' : '' }}>COMMITTEE REJECTED</option>

			<option value="NOT INTERESTED" {{ ( $tender->status == 'NOT INTERESTED') ? 'selected' : '' }}>NOT INTERESTED</option>
	
		</select>
         <button type="submit" class="btn btn-success">Change</button>
       </form>
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
	<tr>
		<td>TENDER WEBSITE LINK</td>
		<td><a href="{{$tender->tender_website}}" target="_blank">{{$tender->tender_website}}</a></td>
		<td>TENDER SITE LINK</td>
		<td><a href="{{$tender->tender_site_ref}}" target="_blank">{{$tender->tender_site_ref}}</a></td>
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
	<tfoot>
		<tr>
			<td colspan="3"><a href="{{$tender->tender_site_ref}}" target="_blank">{{$tender->tender_site_ref}}</a></td>
		</tr>
	</tfoot>
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
           
           <td>  
     <a href="{{asset('img/tender/'.$corrigendumfile->file)}}" target="_blank">
            Click to View
        </a>
        <a href="{{asset('img/tender/'.$corrigendumfile->file)}}" class="btn btn-primary btn-sm" download>
               <span class="glyphicon glyphicon-download-alt"></span> Download
        </a>

    </td>
 
        </tr>
		@endforeach
		
	</tbody>
</table>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="text-align: center;font-weight: bold;color: red;">DESCRIBE WHY WE ARE NOT ELLIGIBLE?</h4>
      </div>
      <div class="modal-body">
      	<form action="/tendernotelligible/{{$tender->id}}" method="post">
      		{{csrf_field()}}
         <table class="table">
         	<tr>
         		<td>
         			<input type="hidden" name="tid" id="tid">
         			<textarea name="notelligiblereason" placeholder="Describe why we are not elligible" required="" class="form-control"></textarea>
         		</td>

         	</tr>
         	<tr>
         		<td><button type="submit" onclick="return confirm('Do You Want to proceed ?')" class="btn btn-success">SAVE</button></td>
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
@if($tender->status=='PENDING')

<table class="table">
   <tr>
   	<td>
   		<form action="/tenderelligible/{{$tender->id}}" method="POST">
   			{{csrf_field()}}
   		<button type="submit" onclick="return confirm('Do you want to proceed?')" class="btn btn-primary btn-lg">WE ARE ELLIGIBLE?</button>
   	    </form>
   	</td>
   		<td>
   		<form action="/tendernotintrested/{{$tender->id}}" method="POST">
   			{{csrf_field()}}
   		<button type="submit" onclick="return confirm('Do you want to proceed?')" class="btn btn-warning btn-lg">NOT INTRESTED ?</button>
   	    </form>
   	</td>


   	<td><button type="button" class="btn btn-danger btn-lg" onclick="opennotilligiblemodal('{{$tender->id}}');">NOT ELLIGIBLE ?</button></td>
   </tr>	
</table>

@else
  @if($tender->status=='ELLIGIBLE')
<h1 style="text-align: center;color: blue;font-weight: bold;">WE ARE ELLIGIBLE FOR THIS TENDER</h1>
@endif
@if($tender->status=='NOT ELLIGIBLE')
<h1 style="text-align: center;color: red;font-weight: bold;">WE ARE NOT ELLIGIBLE FOR THIS TENDER</h1>
<table class="table">
	<tr>
		<td class="text-center"><strong>DESCRIPTION FOR NOT ELLIGIBLE?</strong></td>
	</tr>
	<tr>
		<td><strong>{{$tender->notelligiblereason}}</strong></td>
	</tr>

</table>
@endif
@endif
@if(sizeof($users)>0)
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
@endif

<input type="hidden" id="tenderid" value="{{$tender->id}}">
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
				<select class="form-control select2" id="participant2" name="participant2">
				<option value="">Select a Participant</option>
				@foreach($participants as $participant)
                  <option value="{{$participant->id}}">{{$participant->associatepartnername}}</option>
				@endforeach
				</select>
			</td>
			<td>
				<select class="form-control select2" id="participant3" name="participant3">
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
				<button type="button" onclick="savetenderparticipant('{{$tender->id}}');" id="addnew" class="addauthor btn btn-primary">ADD</button>
			</td>
		</tr>
	</tbody>
	
	 
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
	<tbody id="participant_id">
		<!-- @foreach($tenderparticipants as $tenderparticipant)
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
		@endforeach -->
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
	
	
	<tbody>
		<tr>
			<td>
				<select class="form-control select2" id="tparticipant" name="participant">
				<option value="">Select a Participant</option>
				@foreach($participants as $participant)
                  <option value="{{$participant->id}}">{{$participant->associatepartnername}}</option>
				@endforeach
				</select>
			</td>
			<td>
				<select class="form-control select2" id="tparticipant2" name="participant2">
				<option value="">Select a Participant</option>
				@foreach($participants as $participant)
                  <option value="{{$participant->id}}">{{$participant->associatepartnername}}</option>
				@endforeach
				</select>
			</td>
			<td>
				<select class="form-control select2" id="tparticipant3" name="participant3">
				<option value="">Select a Participant</option>
				@foreach($participants as $participant)
                  <option value="{{$participant->id}}">{{$participant->associatepartnername}}</option>
				@endforeach
				</select>
			</td>
			<td>
				<input type="text" id="tfinalscore" name="finalscore" placeholder="Final Score" class="form-control">
			</td>
			<td>
				<button type="button" onclick="savetenderaward('{{$tender->id}}');" id="addnew" class="addauthor btn btn-primary">ADD</button>
			</td>
		</tr>
	</tbody>
	
	 
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
	<tbody id="tenderreward_id">
		<!-- @foreach($tenderrewards as $tenderreward)
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
		@endforeach -->
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
	  	<td colspan="2" style="text-align: right;"><button class="btn btn-success" onclick="ajaxupdateaward();"  type="button">UPDATE</button></td>
	  </tr>

</table>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<div id="myModalparticipant" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><b>EDIT PARTICIPANT</b></h4>
      </div>
      <div class="modal-body">

  
<table class="table table-responsive table-hover table-bordered table-striped">
		<input type="hidden" id="uid" name="uid">
	
	  <tr>
	  	<td><strong>Participant1</strong></td>
	  	<td><input type="text" disabled="" name="associatepartnername" id="associatepartnername1" class="form-control" placeholder="Enter Acount No"></td>
	  </tr>
	  <tr>
	  	<td><strong>Participant2</strong></td>
	  	<td><input type="text" disabled="" name="associatepartnername2" id="associatepartnername2" class="form-control" placeholder="Enter Acount No"></td>
	  </tr>
	    <tr>
	  	<td><strong>Participant3</strong></td>
	  	<td><input type="text" disabled="" name="associatepartnername3" id="associatepartnername3" class="form-control" placeholder="Enter Acount No"></td>
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
	  	<td colspan="2" style="text-align: right;"><button onclick="ajaxupdateparticipant();" class="btn btn-success" type="button">UPDATE</button></td>
	  </tr>

</table>
  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script type="text/javascript">
	tenderrewardlist();
	function tenderrewardlist(){
		var tenderid=$("#tenderid").val();
		        $.ajaxSetup({
		            headers:{
		                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
		            }
		        });
              

              $.ajax({
               type:'POST',
              
               url:'{{url("/ajaxgettenderawardlist")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                      tenderid:tenderid,
                     },
               success:function(data) { 
               				//console.log(data);
                         $("#tenderreward_id").empty();
                         
                        $("#tenderreward_id").show();
                     $.each(data,function(key,value){

                     	var x='<tr>'+
                     	       '<td>'+value.associatepartnername+'</td>'+
                     	       '<td>'+value.associatepartnername2+'</td>'+
                     	       '<td>'+value.associatepartnername3+'</td>'+
                     	       '<td>'+value.finalscore+'</td>'+
                     	       '<td><button class="btn btn-info" onclick="editaward('+value.id+',\''+value.associatepartnername+'\',\''+value.associatepartnername2+'\',\''+value.associatepartnername3+'\',\''+value.finalscore+'\');" type="button">EDIT</button></td>'+
                     	       '<td><button type="button" class="btn btn-danger"onclick="deletetenderaward('+value.id+');">X</button></td>'+
                     	       '</tr>';
                     	       

                        $("#tenderreward_id").append(x);
                     });
                 
                }
              });


	}
		tenderparticipantlist();
	function tenderparticipantlist(){
		var tenderid=$("#tenderid").val();
		        $.ajaxSetup({
		            headers:{
		                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
		            }
		        });
              

              $.ajax({
               type:'POST',
              
               url:'{{url("/ajaxgetparticipantlist")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                      tenderid:tenderid,
                     },
               success:function(data) { 
               				//console.log(data);
                         $("#participant_id").empty();
                         
                        $("#participant_id").show();
                     $.each(data,function(key,value){

                     	var x='<tr>'+
                     	       '<td>'+value.associatepartnername+'</td>'+
                     	       '<td>'+value.associatepartnername2+'</td>'+
                     	       '<td>'+value.associatepartnername3+'</td>'+
                     	       '<td>'+value.techscore+'</td>'+
                     	       '<td>'+value.financialscore+'</td>'+
                     	       '<td><button class="btn btn-info" onclick="editparticipant('+value.id+',\''+value.associatepartnername+'\',\''+value.associatepartnername2+'\',\''+value.associatepartnername3+'\',\''+value.techscore+'\',\''+value.financialscore+'\');" type="button">EDIT</button></td>'+
                     	       '<td><button type="button" class="btn btn-danger"onclick="deleteparticipant('+value.id+');">X</button></td>'+
                     	       '</tr>';
                     	       

                        $("#participant_id").append(x);
                     });
                 
                }
              });


	}
		function savetenderparticipant(id){

		var participant = $('#participant').val();
		var participant2 = $('#participant2').val();
		var participant3 = $('#participant3').val();
		var techscore = $('#techscore').val();
		var financialscore = $('#financialscore').val();
		if(participant != ""){
		$.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });

           $.ajax({
               type:'POST',
               url:'{{url("/ajaxsaveparticipants")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                     id:id,
                     participant:participant,
                     participant2:participant2,
                     participant3:participant3,
                     techscore:techscore,
                     financialscore:financialscore,
                     },
                     success:function(data) { 
                     	tenderparticipantlist();

                     
                     
               }

             });

		}else{
  		alert("please enter a participant");
		}
		
	}
	function ajaxupdateparticipant(){
		var id=$('#uid').val();
		var techscore = $('#techscore1').val();
		var financialscore = $('#financialscore1').val();
		$.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });
           $.ajax({
               type:'POST',
               url:'{{url("/ajaxupdateparticipants")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                     id:id,
                     techscore:techscore,
                     financialscore:financialscore,
                     },

                     success:function(data) {
                     	$('#myModalparticipant').modal('toggle');
                     	tenderparticipantlist();

                     
                     
               }

             });

		}
		function deleteparticipant(id){
		$.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });
           $.ajax({
               type:'POST',
               url:'{{url("/ajaxdeleteparticipants")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                     id:id,
                     },

                     success:function(data) {
                     	tenderparticipantlist();
                     
               }

             });

		}
		function savetenderaward(id){
		var participant = $('#tparticipant').val();
		var participant2 = $('#tparticipant2').val();
		var participant3 = $('#tparticipant3').val();
		var finalscore = $('#tfinalscore').val();
		if(participant != ""){
		$.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });

           $.ajax({
               type:'POST',
               url:'{{url("/ajaxsavetenderaward")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                     id:id,
                     participant:participant,
                     participant2:participant2,
                     participant3:participant3,
                     finalscore:finalscore,
                     },
                     success:function(data) { 
                     	tenderrewardlist();

                     
                     
               }

             });

		}else{
  		alert("please enter a participant");
		}
		
	}
	function ajaxupdateaward(){
		var id=$('#awid').val();
		var finalscore = $('#finalscore1').val();
		$.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });
           $.ajax({
               type:'POST',
               url:'{{url("/ajaxupdateaward")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                     id:id,
                     finalscore:finalscore,
                     },
                     success:function(data) {
                     	$('#myModal2').modal('toggle');
                     	tenderrewardlist();

                     
                     
               }

             });
	}
	function deletetenderaward(id){
		$.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });
           $.ajax({
               type:'POST',
               url:'{{url("/ajaxdeletetenderaward")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                     id:id,
                     },

                     success:function(data) {
                     	tenderrewardlist();
                     
               }

             });
	}
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
		$("#myModalparticipant").modal('show');
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
	function opennotilligiblemodal(tid) {
      $("#tid").val(tid);
      $("#myModal").modal('show');
		
	}

   $('input[type=radio][name=recomended]').change(function() {
    if (this.value == 'ASSOCIATION' || this.value=='JV') {
        $("#selected").attr( "disabled",false);
    }
    else{
        $("#selected").attr( "disabled",true);
    }
});
</script>

@endsection