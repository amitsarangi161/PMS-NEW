@extends('layouts.tender')
@section('content')


<table class="table">
	<tr class="bg-navy">
		<td class="text-center">CREATE TENDER</td>
		
		
	</tr>
</table>
@if(Session::has('msg'))
<div class="alert alert-success alert-block">

	<button type="button" class="close" data-dismiss="alert">×</button>	

        <p style="text-align: center;"><strong>{{ Session::get('msg') }}</strong></p>

</div>
@endif


<form action="/savetender" method="POST" enctype="multipart/form-data">
	{{csrf_field()}}

<table class="table table-responsive table-hover table-bordered table-striped">
<tr>

	<td><strong>Name Of the Work *</strong></td>
	<td><textarea name="nameofthework" class="form-control" placeholder="Enter Name of The Work" required=""></textarea></td>
	<td><strong>Client Name *</strong></td>
	<td>
		<input type="text" name="clientname" class="form-control" placeholder="Enter Name of the Work" required="">
	</td>
</tr>
<tr>
	<td><strong>TENDER REF NO/TENDER ID *</strong></td>
	<td>
		
        <input type="text" name="tenderrefno" id="tenderrefno" class="form-control" placeholder="Enter Tender Reference No" autocomplete="off" required="" onkeyup="searchtenderno(this.value)">
        <div id="searchlist" style="background-color: #d9d9d9">
        	
        </div>
	</td>
	<td><strong>NO OF COVERS *</strong></td>
	<td>
		<input type="number" name="noofcovers" class="form-control" placeholder="Enter No of Covers" required="">
	</td>
</tr>
<tr>
	<td><strong>Work Value *</strong></td>
	<td><input type="text" name="workvalue" class="form-control" placeholder="Enter Work Value" required="" value="0" autocomplete="off"></td>


	<td><strong>NIT PUBLICATION DATE *</strong></td>
	<td><input type="text" name="nitpublicationdate" class="form-control datepicker1 readonly" required="" autocomplete="off"></td>
	
</tr>
<tr>
	<td><strong>SOURCE *</strong></td>
	<td><input type="text" name="source" class="form-control" placeholder="Enter Source Name" value="NA" required=""></td>

	<td><strong>TENDER PRIORITY *</strong></td>
	<td>
		<select class="form-control select2" name="tenderpriority" required="">
			<option value="HIGH">HIGH</option>
			<option value="MEDIUM" selected>MEDIUM</option>
			<option value="LOW">LOW</option>
			
		</select>
	</td>

</tr>
<tr>
	<td><strong>Type Of Work *</strong></td>
	<td>
		<select class="form-control select2" name="typeofwork" required="">
			<option value="">--Select a Work Type--</option>
			<option value="DPR">DPR</option>
			<option value="SURVEY">SURVEY</option>
			<option value="GEOTECH">GEOTECH</option>
			<option value="RAILWAY">RAILWAY</option>
			<option value="SURVEY AND GEOTECH">SURVEY AND GEOTECH</option>
			<option value="PMC">PMC</option>
			<option value="AE">AE</option>
			<option value="OTHERS" selected="">OTHERS</option>
			
		</select>
	</td>
	<td><strong>LAST DATE OF SUBMISSION *</strong></td>
	<td><input type="text" class="form-control datepicker readonly" name="lastdateofsubmisssion" id="lastdateofsubmisssion" required="" autocomplete="off"></td>
	
</tr>
<tr>
	<td><strong>TENDER VALIDITY IN DAYS(Ex.20)</strong></td>
	<td><input type="text" name="tendervalidityindays" id="tendervalidityindays" class="form-control chngdate"></td>

	<td><strong>LAST DATE OF TENDER VALIDITY</strong></td>
	<td><input type="text" autocomplete="off" name="tendervaliditydate" id="tendervaliditydate" class="form-control" readonly=""></td>
</tr>
<tr>
	<td><strong>RFP AVAILABLE DATE *</strong></td>
	<td><input type="text" class="form-control datepicker readonly" name="rfpavailabledate" required="" autocomplete="off"></td>
	<td><strong>RFP DOCUMENT/NIT/QUOTATION *</strong></td>

	<td><input type="file" name="rfpdocument[]" class="form-control" multiple  required=""></td>
	
</tr>

<tr>
	<td><strong>REF PAGE NO OF RFP DOCUMENT *</strong></td>
	<td>
		<textarea name="refpageofrfp" class="form-control" placeholder="Enter Reference Page No of RFP Document" required="">NOT MENTIONED</textarea>
        
	</td>
	<td><strong>CORRIGENDUM FILE</strong></td>
	<td><input type="file" name="corrigendumfile[]" multiple class="form-control"></td>
</tr>
<tr>
	<td><strong>DOCUMENT DOWNLOAD/SALE START DATE</strong></td>
	<td><input type="text" name="salestartdate" class="form-control datetimepicker1" ></td>
	<td><strong>DOCUMENT DOWNLOAD/SALE END DATE</strong></td>
	<td><input type="text" name="saleenddate" class="form-control datetimepicker1" ></td>
	
</tr>
<tr>
	<td><strong>BID SUBMISSION START DATE</strong></td>
	<td><input type="text" name="bidstartdate" class="form-control datetimepicker1" ></td>
	<td><strong>BID SUBMISSION END DATE</strong></td>
	<td><input type="text" name="bidenddate" class="form-control datetimepicker1" ></td>
	
</tr>
<tr>
	<td><strong>PRE-BID MEETING START DATE</strong></td>
	<td><input type="text" name="prebidmeetingdate" class="form-control datetimepicker1" ></td>

	<td><strong>RECOMENDED FOR</strong></td>
	<td>
			<input type="radio" name="recomended" value="SOLE" checked="">SOLE &nbsp;&nbsp;&nbsp;
			<input type="radio" name="recomended" value="ASSOCIATION">ASSOCIATION &nbsp;&nbsp;&nbsp;
			<input type="radio" name="recomended" value="JV" >JV
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
		<td><input type="text" name="emdamount" id="emdamount" class="form-control convert" placeholder="Enter Emd Amount" autocomplete="off"></td>
		<td><strong>Amount in Word</strong></td>
		<td>
			<textarea class="form-control" id="amountinword" name="amountinword" readonly=""></textarea>
		</td>
	</tr>
	<tr>
		<td><strong>EMD in the form of</strong></td>
		<td>
			<select class="form-control select2" name="emdinformof">
				<option value="">--Choose a Type--</option>
				<option value="DD">DD</option>
				<option value="BG">BG</option>
				<option value="ONLINE">ONLINE</option>
				<option value="TDR">TDR</option>
				<option value="KVP">KVP</option>
				<option value="EXEMPTED">EXEMPTED</option>
			
		    </select>
	</td>
	<td><strong>EMD Payable To</strong></td>
	<td>
		<textarea name="emdpayableto" class="form-control"></textarea>
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
		<td><strong>TENDER AMOUNT</strong></td> 
		<td><input type="text" name="tenderamount" id="tenderamount" class="form-control convert1" autocomplete="off" placeholder="Enter Tender Amount"  ></td>
		<td><strong>Amount in Word</strong></td>
		<td>
			<textarea class="form-control" id="tenderamountinword" name="tenderamountinword" readonly=""></textarea>
		</td>
	</tr>
	<tr>
		<td><strong>TENDER COST in the form of </strong></td>
		<td>
			<select class="form-control select2" name="tendercostinformof">
				<option value="">--Choose a Type--</option>
				<option value="DD">DD</option>
				<option value="BG">BG</option>
				<option value="ONLINE">ONLINE</option>
				<option value="TDR">TDR</option>
				<option value="KVP">KVP</option>
				<option value="EXEMPTED">EXEMPTED</option>
			
		    </select>
	</td>
	<td><strong>TENDER FEE Payable To</strong></td>
	<td>
		<textarea name="tenderfeepayableto" class="form-control"></textarea>
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
		<td><input type="text" name="registrationamount" id="registrationamount" class="form-control convert2" autocomplete="off" placeholder="Enter Tender Amount"></td>
		<td><strong>Registration Amount in Word</strong></td>
		<td>
			<textarea class="form-control" id="registrationamountinword" name="registrationamountinword" readonly=""></textarea>
		</td>
	</tr>
	<tr>
		<td><strong>Registration Amount in the form of</strong></td>
		<td>
			<select class="form-control select2" name="registrationamountinformof">
				<option value="">--Choose a Type--</option>
				<option value="DD">DD</option>
				<option value="BG">BG</option>
				<option value="ONLINE">ONLINE</option>
				<option value="TDR">TDR</option>
				<option value="KVP">KVP</option>
				<option value="EXEMPTED">EXEMPTED</option>
			
		    </select>
	</td>
	<td><strong>Registration FEE Payable To</strong></td>
	<td>
		<textarea name="registrationamountpayableto" class="form-control"></textarea>
	</td>
	</tr>
	
</table>


	<table class="table">
			<tr>
				<td class="text-right"><button type="submit" class="btn btn-success btn-lg" style="width: 100px;" onclick="return confirm('Do You Want to Save this Tender?')" id="savebtn">SAVE</button>
                 <p id="warningmsg" style="font-size: 22px;font-weight: bold;color: red;text-align: center;"></p>

				</td>
			</tr>
			
	</table>
</form>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" integrity="sha256-yMjaV542P+q1RnH6XByCPDfUFhmOafWbeLPmqKh11zo=" crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js" integrity="sha256-5YmaxAwMjIpMrVlK84Y/+NjCpKnFYa8bWWBbUHSBGfU=" crossorigin="anonymous"></script>

<script type="text/javascript">


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
 $( ".convert2" ).on("change paste keyup", function() {
 var money1=RsPaise(Math.round(document.getElementById('registrationamount').value*100)/100);
document.getElementById('registrationamountinword').value=money1;

	
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
$("input[name='tenderrefno']").on("propertychange change click keyup input paste blur", function(){
	var tenderrefno=$("#tenderrefno").val();
   searchtenderno(tenderrefno);
})

function searchtenderno(value=null)
{
      
      if(value!='')
      {


           $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });

           $.ajax({
               type:'POST',
              
               url:'{{url("/ajaxsearchtenderno")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                     value:value,
                     },

               success:function(data) { 
               	$("#searchlist").empty();
                    $.each(data.lists,function(key,value){
                    	console.log(value.tenderrefno);
                    	$("#searchlist").append('<div style="font-weight:bold;color:blue;">'+value.tenderrefno+'</div>')
                    })

                    if (data.found==true) {

                    	
                    	$("#savebtn").prop('disabled',true);
                    	$("#warningmsg").html("Detecting a Duplicate Entry This Tenderid Already Present");

                    }
                    else
                    {
                    	$("#savebtn").prop('disabled',false);
                    	$("#warningmsg").html('');
                    }
               }
               
             });

       }
       else
       {
       	$("#searchlist").empty();
       	$("#savebtn").prop('disabled',false);
       	$("#warningmsg").html('');
       }

} 


</script>

@endsection