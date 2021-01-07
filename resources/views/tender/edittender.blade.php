@extends('layouts.tender')
@section('content')


<table class="table">
	<tr class="bg-navy">
		<td class="text-center">EDIT TENDER</td>
		
		
	</tr>
</table>
@if(Session::has('msg'))
<div class="alert alert-success alert-block">

	<button type="button" class="close" data-dismiss="alert">X</button>	

        <p style="text-align: center;"><strong>{{ Session::get('msg') }}</strong></p>

</div>
@endif


<form action="/updatetender/{{$tender->id}}" method="POST" enctype="multipart/form-data">
	{{csrf_field()}}

<table class="table table-responsive table-hover table-bordered table-striped">
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
		<td><input type="text" name="emdamount" id="emdamount" class="form-control convert" placeholder="Enter Emd Amount" autocomplete="off" value="{{$tender->emdamount}}" ></td>
		<td><strong>Amount in Word</strong></td>
		<td>
			<textarea class="form-control" id="amountinword" name="amountinword" readonly="">{{$tender->amountinword}}</textarea>
		</td>
	</tr>
	<tr>
		<td><strong>EMD in the form of *</strong></td>
		<td>
			<select class="form-control select2" name="emdinformof" >
				<option value="">--Choose a Type--</option>
				<option value="DD" {{ ( $tender->emdinformof == 'DD') ? 'selected' : '' }}>DD</option>
				<option value="BG" {{ ( $tender->emdinformof == 'BG') ? 'selected' : '' }}>BG</option>
				<option value="ONLINE" {{ ( $tender->emdinformof == 'ONLINE') ? 'selected' : '' }}>ONLINE</option>
				<option value="TDR" {{ ( $tender->emdinformof == 'TDR') ? 'selected' : '' }}>TDR</option>
				<option value="KVP" {{ ( $tender->emdinformof == 'KVP') ? 'selected' : '' }}>KVP</option>
				<option value="EXEMPTED" {{ ( $tender->emdinformof == 'EXEMPTED') ? 'selected' : '' }}>EXEMPTED</option>
			
		    </select>
	</td>
	<td><strong>EMD Payable To*</strong></td>
	<td>
		<textarea name="emdpayableto" class="form-control">{{$tender->emdpayableto}}</textarea>
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
		<td><input type="text" name="gstpercnt" id="gstpercnt" class="form-control calc" autocomplete="off" value="{{$tender->gstpercnt}}" placeholder="Enter GST Percentage" value="0" ></td>
		<td><strong>GST AMOUNT</strong></td> 
		<td><input type="text" name="gstamount" id="gstamount" class="form-control convert1" autocomplete="off" value="{{$tender->gstamount}}" placeholder="Enter Tender Amount"  ></td>
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
		<td><input type="text" name="registrationamount" id="registrationamount" class="form-control convert2" value="{{$tender->registrationamount}}" autocomplete="off" placeholder="Enter Tender Amount"></td>
		<td><strong>Registration Amount in Word</strong></td>
		<td>
			<textarea class="form-control" id="registrationamountinword" name="registrationamountinword" readonly="">{{$tender->registrationamountinword}}</textarea>
		</td>
	</tr>
	<tr>
		<td><strong>Registration Amount in the form of *</strong></td>
		<td>
			<select class="form-control select2" name="registrationamountinformof">
					<option value="">--Choose a Type--</option>
				<option value="DD" {{ ( $tender->registrationamountinformof == 'DD') ? 'selected' : '' }}>DD</option>
				<option value="BG" {{ ( $tender->registrationamountinformof == 'BG') ? 'selected' : '' }}>BG</option>
				<option value="ONLINE" {{ ( $tender->registrationamountinformof == 'ONLINE') ? 'selected' : '' }}>ONLINE</option>
				<option value="TDR" {{ ( $tender->registrationamountinformof == 'TDR') ? 'selected' : '' }}>TDR</option>
				<option value="KVP" {{ ( $tender->registrationamountinformof == 'KVP') ? 'selected' : '' }}>KVP</option>
				<option value="EXEMPTED" {{ ( $tender->registrationamountinformof == 'EXEMPTED') ? 'selected' : '' }}>EXEMPTED</option>
			
		    </select>
	</td>
	<td><strong>Registration FEE Payable To*</strong></td>
	<td>
		<textarea name="registrationamountpayableto" class="form-control">{{$tender->registrationamountpayableto}}</textarea>
	</td>
	</tr>
	
</table>


	<table class="table">
			<tr>
				<td class="text-right"><button type="submit" class="btn btn-success btn-lg" style="width: 100px;" onclick="return confirm('Do You Want to Save this Tender?')">UPDATE</button></td>
			</tr>
			
		</table>
</form>
<h1 style="text-align: center;font-weight: bold;">TENDER FILES</h1>
<table class="table table-responsive table-hover table-bordered table-striped">
	<thead>
	<tr class="bg-navy">
		<td>ID</td>
		<td>FILE NAME</td>
		<td>FILE</td>
		<td>DELETE</td>
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
        <td>
        	<form action="/deletetenderdocument/{{$tenderdocument->id}}" method="post">
        		{{csrf_field()}}
        		{{method_field('delete')}}
        		<button type="submit" class="btn btn-danger" onclick="return confirm('Do You Want to delete This');">X</button>

        		
        	</form>
        </td>
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
		<td>DELETE</td>
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
        <td>
        	<form action="/deletecorrigendumfile/{{$corrigendumfile->id}}" method="post">
        		{{csrf_field()}}
        		{{method_field('delete')}}
        		<button type="submit" class="btn btn-danger" onclick="return confirm('Do You Want to delete This');">X</button>

        		
        	</form>
        </td>
        </tr>
		@endforeach
		
	</tbody>
</table>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" integrity="sha256-yMjaV542P+q1RnH6XByCPDfUFhmOafWbeLPmqKh11zo=" crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js" integrity="sha256-5YmaxAwMjIpMrVlK84Y/+NjCpKnFYa8bWWBbUHSBGfU=" crossorigin="anonymous"></script>

<script type="text/javascript">
	$(".calc").on('change input', function(){
        var paperamount=parseFloat($("#paperamount").val());
        var gstpercnt=parseFloat($("#gstpercnt").val());
         amt=paperamount*(gstpercnt/100);
         if (amt) {
         	gamt=amt;
         }
         else{
         	gamt=0;
         }
        var totalpaperamt=paperamount+gamt;

        $("#gstamount").val(gamt);
        $("#totalpaperamt").val(totalpaperamt);
	});
	$('input[type=radio][name=evaluationprocess]').change(function() {
       if (this.value=='QCBS') {
       	    $("#evaluationscore").show();

       }
       else{
       	   $("#evaluationscore").hide();
       }
    });
    $('input:radio[name="gender"]').filter('[value="Male"]').attr('checked', true);

	 $( ".convert2" ).on("change paste keyup", function() {
 var money1=RsPaise(Math.round(document.getElementById('registrationamount').value*100)/100);
document.getElementById('registrationamountinword').value=money1;

	
 });


	$(".chngdate").on("change keyup paste", function(){
    
          var myDate = $("#lastdateofsubmisssion").val();
          var days=parseInt($("#tendervalidityindays").val());



          if(myDate!='' && days!='' && days>=0)
          {
              
          	 date = new Date(myDate);

            next_date = new Date(date.setDate(date.getDate() + days));
            
            formatted = next_date.getUTCFullYear() + '-' + padNumber(next_date.getUTCMonth() + 1) + '-' + padNumber(next_date.getUTCDate());

            $("#tendervaliditydate").val(formatted);
          }
          else
          {
          	 $("#tendervaliditydate").val('');


          }
})

 function padNumber(number) {
                var string  = '' + number;
                string      = string.length < 2 ? '0' + string : string;
                return string;
            } 
	
	$( ".convert" ).on("change paste keyup", function() {
 var money=RsPaise(Math.round(document.getElementById('emdamount').value*100)/100);
document.getElementById('amountinword').value=money;

	
 });

 $( ".convert1" ).on("change paste keyup", function() {
 var money1=RsPaise(Math.round(document.getElementById('tenderamount').value*100)/100);
document.getElementById('tenderamountinword').value=money1;

	
 });
   $( ".convert3" ).on("change paste keyup", function() {
 var money1=RsPaise(Math.round(document.getElementById('workvalue').value*100)/100);
document.getElementById('workvalueinword').value=money1;

	
 });
 $( ".convert4" ).on("change paste keyup", function() {
 var money1=RsPaise(Math.round(document.getElementById('paperamount').value*100)/100);
document.getElementById('tenderpaperamountinword').value=money1;

	
 });





function Rs(amount){
var words = new Array();
words[0] = 'Zero';words[1] = 'One';words[2] = 'Two';words[3] = 'Three';words[4] = 'Four';words[5] = 'Five';words[6] = 'Six';words[7] = 'Seven';words[8] = 'Eight';words[9] = 'Nine';words[10] = 'Ten';words[11] = 'Eleven';words[12] = 'Twelve';words[13] = 'Thirteen';words[14] = 'Fourteen';words[15] = 'Fifteen';words[16] = 'Sixteen';words[17] = 'Seventeen';words[18] = 'Eighteen';words[19] = 'Nineteen';words[20] = 'Twenty';words[30] = 'Thirty';words[40] = 'Forty';words[50] = 'Fifty';words[60] = 'Sixty';words[70] = 'Seventy';words[80] = 'Eighty';words[90] = 'Ninety';var op;
amount = amount.toString();
var atemp = amount.split(".");
var number = atemp[0].split(",").join("");
var n_length = number.length;
var words_string = "";
if(n_length <= 9){
var n_array = new Array(0, 0, 0, 0, 0, 0, 0, 0, 0);
var received_n_array = new Array();
for (var i = 0; i < n_length; i++){
received_n_array[i] = number.substr(i, 1);}
for (var i = 9 - n_length, j = 0; i < 9; i++, j++){
n_array[i] = received_n_array[j];}
for (var i = 0, j = 1; i < 9; i++, j++){
if(i == 0 || i == 2 || i == 4 || i == 7){
if(n_array[i] == 1){
n_array[j] = 10 + parseInt(n_array[j]);
n_array[i] = 0;}}}
value = "";
for (var i = 0; i < 9; i++){
if(i == 0 || i == 2 || i == 4 || i == 7){
value = n_array[i] * 10;} else {
value = n_array[i];}
if(value != 0){
words_string += words[value] + " ";}
if((i == 1 && value != 0) || (i == 0 && value != 0 && n_array[i + 1] == 0)){
words_string += "Crores ";}
if((i == 3 && value != 0) || (i == 2 && value != 0 && n_array[i + 1] == 0)){
words_string += "Lakhs ";}
if((i == 5 && value != 0) || (i == 4 && value != 0 && n_array[i + 1] == 0)){
words_string += "Thousand ";}
if(i == 6 && value != 0 && (n_array[i + 1] != 0 && n_array[i + 2] != 0)){
words_string += "Hundred and ";} else if(i == 6 && value != 0){
words_string += "Hundred ";}}
words_string = words_string.split(" ").join(" ");}
return words_string;}


function RsPaise(n){
nums = n.toString().split('.')
var whole = Rs(nums[0])
if(nums[1]==null)nums[1]=0;
if(nums[1].length == 1 )nums[1]=nums[1]+'0';
if(nums[1].length> 2){nums[1]=nums[1].substring(2,length - 1)}
if(nums.length == 2){
if(nums[0]<=9){nums[0]=nums[0]*10} else {nums[0]=nums[0]};
var fraction = Rs(nums[1])
if(whole=='' && fraction==''){op= 'Zero only';}
if(whole=='' && fraction!=''){op= fraction + 'paise only';}
if(whole!='' && fraction==''){op=whole + ' only';} 
if(whole!='' && fraction!=''){op=whole + 'and ' + fraction + 'paise only';}
amt=document.getElementById('emdamount').value;

if(amt > 999999999.99){op='Oops!!! The amount is too big to convert';}
if(isNaN(amt) == true ){op='Error : Amount in number appears to be incorrect. Please Check.';}

return op;
}}


$('.datetimepicker1').datetimepicker({ 
	format: 'YYYY-MM-DD hh:mm A'
});



</script>

@endsection