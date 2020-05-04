@extends('layouts.account')
@section('content')
@if(Session::has('msg'))
   <p class="alert alert-warning text-center">{{ Session::get('msg') }}</p>
@endif

<table class="table table-responsive table-hover table-bordered table-striped">
	<tr class="bg-navy">
		 <td class="text-center">REQUISITIONS</td>
	</tr>

</table>


<form action="/updaterequisitions/{{$requisitionheader->id}}" method="post">
	{{csrf_field()}}

	<table class="table table-responsive table-hover table-bordered table-striped">
      <tr>
      	 <td>SELECT EMPLOYEE</td>
      	 <td>
      	 	<select class="form-control select2" name="employeeid" required="">
      	 		<option value="">Select a User</option>
      	 		@foreach($users as $user)
               <option value="{{$user->id}}" {{ ( $user->id == $requisitionheader->employeeid) ? 'selected' : '' }}>{{$user->name}}</option>

      	 		@endforeach
      	 		
      	 	</select>
      	 </td>
      </tr>

      <tr>
      	 <td>SELECT A SITE/PROJECT NAME</td>
      	 <td>
      	 	<select class="form-control select2" id="projectid" onchange="showclient();"  name="projectid" required="">

            
      	 		<option value="OTHERS" selected="">OTHERS</option>
      	 	@foreach($projects as $project)
             <option value="{{$project->id}}" title="{{$project->orgname}}" {{ ( $project->id == $requisitionheader->projectid) ? 'selected' : '' }}>{{$project->projectname}}</option>
                 
      	 	@endforeach 
      	 	</select>
      	 </td>
      </tr>
      <tr>
      	<td>CLIENT NAME</td>
      	<td>
      		<input type="text" class="form-control" name="clientname" id="clientname" readonly="">
      	</td>
      </tr>

        <tr>
        <td><strong>DATE FROM *</strong></td>
        <td><input type="text" name="datefrom" value="{{$requisitionheader->datefrom}}" class="form-control datepicker readonly" required=""></td>
       
        
      </tr>
      <tr>
         <td><strong>DATE TO *</strong></td>
        <td><input type="text" name="dateto" value="{{$requisitionheader->dateto}}" class="form-control datepicker readonly" required="" ></td>
      </tr>
      <tr>
        <td><strong>DESCRIPTION</strong></td>
        <td><textarea class="form-control" name="description1">{{$requisitionheader->description}}</textarea></td>
      </tr>

      
      

	</table>
	<table class="table table-responsive table-hover table-bordered table-striped">
	<tr class="bg-navy">
		 <td class="text-center">REQUISITIONS DETAILS</td>
	</tr>
    </table>

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
			    <select class="form-control select2" onchange="getparticulars();" id="expenseheadid">
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
            <option value="TO VENDOR">TO VENDOR</option>
         </select>
       </td>
			 <td><input type="text" autocomplete="off" class="form-control" id="amount"></td> 
			 <td><button type="button" id="addnew" class="addauthor btn btn-primary">ADD</button></td>
 
			 
			</tr>
									 
	    </tbody>				
	</table>
	<table class="table table-responsive table-hover table-bordered table-striped">
	    <tr class="bg-navy">
		 <td class="text-center">ADDED REQUISITIONS DETAILS</td>
	    </tr>
    </table>
    <table class="table table-responsive table-hover table-bordered table-striped">
    	<thead>
    		<tr class="bg-primary">
    		<th>EXPENSE HEAD</th>
    		<th>PARTICULARS</th>
        <th>DESCIPTION</th>
    		<th>PAY TO</th>
    		<th>AMOUNT</th>
    		<th>ACTION</th>
           </tr>
    	</thead>
       <tbody class="addnewrow">
           @foreach($requisitions as $requisition)
             <tr>
               <td>{{$requisition->expenseheadname}}<input type="hidden" name="expenseheadid[]" value="{{$requisition->expenseheadid}}"></td>
               <td>{{$requisition->particularname}}<input type="hidden" name="particularid[]"value="{{$requisition->particularid}}"/></td>
               <td>{{$requisition->description}}<input type="hidden" name="description[]" value="{{$requisition->description}}"/></td>

               <td>{{$requisition->payto}}<input type="hidden" name="payto[]" value="{{$requisition->payto}}"/></td>

               <td>{{$requisition->amount}}<input type="hidden" name="amount[]" class="countable" value="{{$requisition->amount}}" class="calcin"/></td>
               <td>
                    <button onclick="openeditmodal('{{$requisition->id}}','{{$requisition->expenseheadid}}','{{$requisition->particularid}}','{{trim(preg_replace('/\s+/', ' ',$requisition->description))}}','{{$requisition->amount}}','{{$requisition->payto}}');" class="btn btn-warning" type="button"><i class="fa fa-pencil" style="font-size: 1em;"></i></button>
                  <a href="/deleterequisitionedit/{{$requisition->id}}" class="btn btn-danger" onclick="return confirm('Dou You Want to delete This?');">X</a>


               </td>
             </tr>

           @endforeach        				 
	    </tbody>	

	    <tfoot>
	    	<tr></tr>
	    	<tr>
	    		
	    		<td></td>
	    		<td></td>
	    		<td><strong>TOTAL AMOUNT</strong></td>
	    		<td><input type="text" id="totalamt" name="totalamt" readonly=""></td>
	    	</tr>
	    </tfoot>		
    </table>
<table class="table table-responsive">
	<tr>
		<td ><button type="submit" class="btn btn-success pull-right" onclick="return confirm('Do You Want to Proceed?')">UPDATE</button></td>
	</tr>
</table>

</form>



<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center"><b><i>EDIT</i></b></h4>
      </div>
      <div class="modal-body">
      <form action="/updatesubrequisitions" method="post">
        {{csrf_field()}}

      <table class="table">
        <tr>
          <input type="hidden" id="editid" name="editid">
          <td><strong>Select a Expense Head</strong></td>
          <td>
            <select  name="expid" id="expid" class="form-control" onchange="getparticulars2();">
             
             <option value="">Select a Expense Head</option>
            @foreach($expenseheads as $expensehead)
                 <option value="{{$expensehead->id}}">{{$expensehead->expenseheadname}}</option>
            @endforeach
            </select>
          </td>
        </tr>
        <tr>
          <td><strong>Select a Particular</strong></td>
          <td>
            <select  name="partid" id="partid" class="form-control" >
              
            </select>
          </td>
        </tr>
        <tr>
          <td><strong>Description</strong></td>
          <td>
            <textarea name="description2" id="description2" class="form-control"></textarea>
          </td>
        </tr>
        <tr>
          <td><strong>PAY TO *</strong></td>
           <td>
         <select id="payto1" name="payto1"  class="form-control">
            <option value="SELF">SELF</option>
            <option value="TO VENDOR">TO VENDOR</option>
         </select>
       </td>
        </tr>
        <tr>
          <td><strong>Amount</strong></td>
          <td><input type="number" class="form-control" id="amount2" name="amount2" required=""></td>
        </tr>
        <tr>
          <td colspan="2" style="text-align: right;"><button type="submit" class="btn btn-success">UPDATE</button></td>
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
<script type="text/javascript">


  function openeditmodal(id,expenseheadid,particularid,description,amount,payto)
  {
       $("#payto1").val(payto);
      
      $("#editid").val(id);
    
      $("#expid").val(expenseheadid);
      getparticulars1(particularid);
      $("#description2").val(description);
      $("#amount2").val(amount);
      $("#partid").val(particularid).change();
      $("#myModal").modal('show');

  }

$(document).ready(function(){
showclient();
sumofduration();
});

	
	function showclient()
	{
		var cn=$("#projectid option:selected" ).attr("title");
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


  function getparticulars1(particularid)
  {

 
    var expid=$("#expid").val();

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
                    
                      expenseheadid:expid

                     },

               success:function(data) { 
                             if(particularid=='')
                             { 
                               var y="<option value='' selected>NONE</option>";
                             }
                             else
                             {
                                var y="<option value=''>NONE</option>";
                             }
                            
                           $.each(data,function(key,value){
                             
                             if(value.id==particularid)
                             {
                                  var x='<option value="'+value.id+'" selected>'+value.particularname+'</option>';
                             }
                             else
                             {
                                   var x='<option value="'+value.id+'">'+value.particularname+'</option>';
                             }
                           
                             y=y+x;
                            

                           });
                           $("#partid").html(y);

                        
                     
                 
                }
              });


  }


  function getparticulars2()
	{

 
		var expid=$("#expid").val();

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
                    
                      expenseheadid:expid

                     },

               success:function(data) { 
                            
                                var y="<option value=''>NONE</option>";
                             
                            
                           $.each(data,function(key,value){
                             
                            
                                   var x='<option value="'+value.id+'">'+value.particularname+'</option>';
                             
                           
                             y=y+x;
                           	

                           });
                           $("#partid").html(y);

                        
                     
                 
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
  var payto=$("#payto").val();
	var description=$("#description").val();
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