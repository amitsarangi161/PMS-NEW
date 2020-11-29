@extends('layouts.app')
@section('content')
@if(Session::has('msg'))
   <p class="alert alert-success text-center">{{ Session::get('msg') }}</p>
@endif

<table class="table table-responsive table-hover table-bordered table-striped">
	<tr class="bg-navy">
		 <td class="text-center">REQUISITIONS</td>
	</tr>

</table>

<!-- <div class="well" style="font-size: 20px;background-color: violet;">
  <div class="table-responsive">
    <table class="table">
      <tr>

      <td><strong>TOTAL PAID AMOUNT TILL DATE :</strong>  0</td>
      <td><strong>TOTAL EXPENSE TILL DATE :</strong>0</td>
      <td><strong>BALANCE AMOUNT :</strong> 0</td>
       <td><strong>+</strong> <img src="{{asset('wallet.png')}}" style="height: 40px;width: 40px;">Rs. 0</td>
      </tr>
      
    </table>
    
  </div>
  
</div> -->


<form action="/saveuserrequisitions" method="post" enctype="multipart/form-data">
	{{csrf_field()}}
<div class="col-sm-12">
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label>SELECT A SITE/PROJECT NAME *</label>
          <select class="form-control select2" id="projectid" onchange="showclient();"  name="projectid" required="" style="width: 100%;">
            <option value="">SELECT A PROJECT</option>
               @foreach($projects as $key => $project)
               <option value="{{$project->id}}" title="{{$project->clientname}}">{{$project->projectname}}</option>
               @endforeach
          </select>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>CLIENT NAME *</label>
          <input type="text" class="form-control" name="clientname" id="clientname" readonly="">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label>DATE FROM *</label>
          <input type="text" class="form-control readonly datepicker" id="fromdate" name="datefrom"  autocomplete="off"  required="">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>DATE TO *</label>
          <input type="text" class="form-control readonly datepicker" id="todate" name="dateto" autocomplete="off"   required="">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label>DESCRIPTION *</label>
          <textarea class="form-control" name="description1" required></textarea>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>Support Document *</label>
          <input name="supportdocument" onchange="readURL1(this)" type="file">
          <img id="imgshow1" src="#" alt="No Image Selected" style="height: 60px;width: 50px;">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label>Author Name *</label>
          <input type="text" class="form-control" name="reqaddby" required="">
      </div>
    </div>
  </div>
</div>

	<table class="table table-responsive table-hover table-bordered table-striped">
	<tr class="bg-navy">
		 <td class="text-center">REQUISITIONS DETAILS</td>
	</tr>
    </table>
<div class="table-responsive">
      <table class="table table-striped table-bordered" >
		<thead class="bg-navy">
		  <tr style="border:1px,solid,#000;">
			<td>EXPENSE HEAD</td>
			<td>PARTICULARS</td>
			<td>DESCRIPTION</td>
      <td>PAY TO</td>
			<td>AMOUNT</td>
			<td>ADD</td>
		  </tr>
		</thead>
		<tbody class="authorslist">

			<tr>
			
			 <td>
			    <select class="form-control select2" onchange="getparticulars();" id="expenseheadid" >
      			<option value="">Select a Expense Head</option>
      			@foreach($expenseheads as $expensehead)
                 <option value="{{$expensehead->id}}">{{$expensehead->expenseheadname}}</option>
      			@endforeach
      			
      		</select>
			 </td>
			 <td> 
                <select class="form-control select2"  id="particularid">
      			
      		    </select>
			 </td> 
			 <td>
			 	<textarea autocomplete="off"  rows="1" id="description"></textarea>
			 </td> 
       <td>
         <select id="payto"  class="form-control">
            <option value="SELF" selected>SELF</option>
            <!-- <option value="TO VENDOR">TO VENDOR</option> -->
         </select>
       </td>
			 <td><input type="number" autocomplete="off" class="form-control" id="amount"></td> 
			 <td><button type="button" id="addnew" class="addauthor btn btn-primary">ADD</button></td>
 
			 
			</tr>
									 
	    </tbody>				
	</table>
</div>

	<table class="table table-responsive table-hover table-bordered table-striped">
	    <tr class="bg-navy">
		 <td class="text-center">ADDED REQUISITIONS DETAILS</td>
	    </tr>
    </table>
    <div class="table-responsive">
    <table class="table table-responsive table-hover table-bordered table-striped">
    	<thead>
    		<tr class="bg-primary">
    		<th>EXPENSE HEAD</th>
    		<th>PARTICULARS</th>
    		<th>DESCIPTION</th>
        <th>PAY TO</th>
    		<th>AMOUNT</th>
    		<th>REMOVE</th>
           </tr>
    	</thead>
       <tbody class="addnewrow">
            
			
									 
	    </tbody>	

	    <tfoot>
	    	<tr></tr>
	    	<tr>
	    		
          <td></td>
	    		<td></td>
	    		<td></td>
	    		<td><strong>TOTAL AMOUNT</strong></td>
	    		<td><input type="text" id="totalamt" name="totalamt" readonly=""></td>
	    	</tr>
	    </tfoot>		
    </table>
  </div>
<table class="table table-responsive">
	<tr>
		<td ><button type="submit" class="btn btn-success pull-right" onclick="return confirm('Do You Want to Proceed?')">Submit</button></td>
	</tr>
</table>

</form>






<script type="text/javascript">
  function readURL1(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#imgshow1').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
  }
	function showclient()
	{
		var cn=$("#projectid option:selected" ).attr("title");
    //alert(cn);
		$("#clientname").val(cn);
	}



function getparticulars()
	{
		var expenseheadid=$("#expenseheadid").val();

 $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });

   //var u="business.draquaro.com/api.php?id=9658438020";

           $.ajax({
               type:'POST',
              
               url:'{{url("/ajaxgetparticulars")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                    
                      expenseheadid:expenseheadid

                     },

               success:function(data) { 
                            var y="<option value=''>NONE</option>";
                           $.each(data,function(key,value){

                           	var x='<option value="'+value.id+'">'+value.particularname+'</option>';
                             y=y+x;
                           	

                           });
                           $("#particularid").html(y);

                        
                     
                 
                }
              });


	}



var counter = 0;
var gdtotal = 0;


var count=0;
jQuery('#addnew').click(function(event){
   
	var expenseheadid = jQuery('#expenseheadid').val();
	var expensehead=$( "#expenseheadid option:selected" ).text();

	var particularid = jQuery('#particularid').val();
	var particular=$( "#particularid option:selected" ).text();

  var description=$("#description").val();
	var payto=$("#payto").val();
	var amount=$("#amount").val();

   
	if(expenseheadid!='' && amount!='')
	{
		  
		   
		  event.preventDefault();
    counter++;

    var newRow = jQuery('<tr>'+
    	  
    	 '<td>'+expensehead+'<input type="hidden" name="expenseheadid[]" value="'+expenseheadid+'"></td>'+
    	  '<td>'+particular+'<input type="hidden" name="particularid[]"value="'+particularid+'" class="calcin"/></td>'+
    	  '<td>'+description+'<input type="hidden" name="description[]" value="'+description+'"/></td>'+

        '<td>'+payto+'<input type="hidden" name="payto[]" value="'+payto+'"/></td>'+

    	  '<td>'+amount+'<input type="hidden" name="amount[]" class="countable" value="'+amount+'" class="calcin"/></td>'+

    	  '<td><button type="button" class="btn btn-danger remove_field" id="'+counter+'">X</button></td></tr>');
    jQuery('.addnewrow').append(newRow);
    count++;

    sumofduration();
   

$("#description").val('');
$("#amount").val('');
	}
	else
	{
		alert("Expense Head or Amount Can't be null");
	}
	
	
}); 


jQuery(".addnewrow").on("click",".remove_field", function(e){ //user click on remove text
e.preventDefault();
jQuery(this).parent('td').parent('tr').remove(); counter--;
	
sumofduration();

});

function sumofduration()
{

    var totals = 0;
    $('.countable').each(function (index, element) {
        totals = totals + parseFloat($(element).val());
    });
    $("#totalamt").val(totals);
    

   
}
</script>
@endsection