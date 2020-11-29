@extends('layouts.tender')
@section('content')
@inject('provider', 'App\Http\Controllers\TenderController')

<table class="table">
	<tr class="bg-navy">
		<td class="text-center">CREATE TENDER</td>
		
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
	<td><input type="text" name="nitpublicationdate" class="form-control readonly" disabled="" value="{{$provider::changedateformat($tender->nitpublicationdate)}}"></td>
	
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
		        if($tender->recomended=='ASSOCIATION')
		         $val="";
		         else
		         $val="disabled";
		      @endphp
            <select id="selected" class="form-control select2" name="associatepartner"  {{$val}} required="">
            	<option value="">Select a Partner</option>
            	@foreach($associatepartners as $associatepartner)
            	<option value="{{$associatepartner->id}}">{{$associatepartner->associatepartnername}}</option>
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




<script type="text/javascript">
	function opennotilligiblemodal(tid) {
      $("#tid").val(tid);
      $("#myModal").modal('show');
		
	}

   $('input[type=radio][name=recomended]').change(function() {
    if (this.value == 'ASSOCIATION') {
        $("#selected").attr( "disabled",false);
    }
    else{
        $("#selected").attr( "disabled",true);
    }
});
</script>

@endsection