@extends('layouts.account')
@section('content')

@if(Session::has('msg'))
   <p class="alert alert-warning text-center">{{ Session::get('msg') }}</p>
@endif

<table class="table table-responsive table-hover table-bordered table-striped">
	<tr class="bg-navy">
		 <td class="text-center">EXPENSE ENTRY</td>
	</tr>

</table>


<div class="well" >
<form action="/saveexpenseentry" method="post" enctype="multipart/form-data">
	{{csrf_field()}}

	<table class="table table-responsive table-hover table-bordered table-striped">

      <tr>
      	 <td>SELECT EMPLOYEE</td>
      	 <td>
      	 	<select class="form-control select2 calc" name="employeeid" onchange="getuserproject(this.value);" required="" id="employeeid">
      	 		<option value="">Select a User</option>

      	 		@foreach($users as $user)
               <option value="{{$user->id}}">{{$user->name}}</option>

      	 		@endforeach
      	 		
      	 	</select>
      	 </td>
      </tr>
     
      <tr>
      	 <td>SELECT A SITE/PROJECT NAME</td>
      	 <td>
      	 	<select class="form-control select2 calc" id="projectid" onchange="showclient();"  name="projectid" required="">

      	 		
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
      	<td>EXPENSE HEAD</td>
      	<td>
      		<select class="form-control select2 calc" name="expenseheadid" onchange="getparticulars();" id="expenseheadid" required="">
      			<option value="">Select a Expense Head</option>

      			@foreach($expenseheads as $expensehead)
                 <option value="{{$expensehead->id}}">{{$expensehead->expenseheadname}}</option>

      			@endforeach
      			
      		</select>
      	</td>
      </tr>
       <tr>
        <td><strong>TOTAL UPDATE AMOUNT RECIVED TILL DATE</strong></td>
        <td>
          <input type="text" readonly=""  class="form-control" id="totalamt">
        </td>
      </tr>
      <tr>
        <td><strong>TOTAL EXPENSES MADE TILL DATE</strong></td>
        <td>
          <input type="text" readonly=""  class="form-control" id="totalexpense">
        </td>
      </tr>
      <tr>
        <td><strong>BALANCE AMOUNT AVILABLE</strong></td>
        <td>
          <input type="text" readonly=""  class="form-control" id="balance">
          <input type="hidden" id="bala">
        </td>
      </tr>
    
      <tr>
      	<td>PARTICULARS</td>
      	<td>
      		<select class="form-control select2" name="particularid" id="particularid">
      			
      		</select>
      	</td>
      </tr>
     
        <tr>
          <td>VENDOR</td>
          <td>
            <select class="form-control select2" name="vendorid">
              <option value="">Select a Vendor</option>
              @foreach($vendors as $vendor)
              <option value="{{$vendor->id}}">{{$vendor->vendorname}}</option>
              @endforeach              
            </select>
          </td>
        </tr>
      <tr>

      	<td>AMOUNT</td>
      	<td>
      	   <input type="text" name="amount" placeholder="Enter Amount Here" autocomplete="off" class="form-control" id="amount" required="">
      	</td>
      </tr>
       <tr>
          <td><strong>DESCRIPTION</strong></td>
          <td>
            <textarea class="form-control" name="description" required="" placeholder="Enter Expense Description"></textarea>
          </td>
        </tr>
      <tr>
        <td>Upload Copy Of Invoice</td>
        <td>
          <input type="file" name="uploadedfile" onchange="readURL(this);" required="">
           <p class="help-block">Upload .png, .jpg or .jpeg image files only</p>

            <img style="height:70px;width:95px;" alt="noimage" id="imgshow">
        </td>
      </tr>
      <tr>
        <td colspan="2" style="text-align: center;font-size: 30px;"> <p id="errormsg" style="color: red;"></p></td>
      </tr>
      <tr>
      	<td colspan="2" style="text-align: right;"><button type="submit" class="btn btn-success" id="subbutton" onclick="return confirm('Do You Want to Proceed?');">SAVE</button></td>
      </tr>

	</table>

</form>

</div>


<script type="text/javascript">

   function readURL(input) {
    

       if (input.files && input.files[0]) {
            var reader = new FileReader();
              
            reader.onload = function (e) {
                $('#imgshow')
                    .attr('src', e.target.result)
                    .width(95)
                    .height(70);
          
            };

            reader.readAsDataURL(input.files[0]);

        }
    }

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

  function getuserproject(uid)
  {
       if(uid!='')
       {
              $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });

           $.ajax({
               type:'POST',
              
               url:'{{url("/ajaxgetuserprojects")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                    
                      userid:uid

                     },

               success:function(data) { 
                   $.each(data,function(key,value){
                        if(value.projectname==null)
                        {
                             var x='<option title="OTHERS" value="OTHERS">OTHERS</option>';
                        }
                        else
                        {
                           var x='<option title="'+value.orgname+'" value="'+value.proid+'">'+value.projectname+'</option>';
                        }
                       
                       
                    $("#projectid").append(x);
                   });
                   showclient();
               }
             });

       }
  }

  $( ".calc" ).change(function() {
     var pid=$("#projectid").val();
     var eid=$("#expenseheadid").val();
     var empid=$("#employeeid").val();

     if(pid!='' && eid!='' && empid!='')
     {
             $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });

   //var u="business.draquaro.com/api.php?id=9658438020";

           $.ajax({
               type:'POST',
              
               url:'{{url("/ajaxgetamountuser1")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                    
                      projectid:pid,
                      employeeid:empid,
                      expenseheadid:eid

                     },

               success:function(data) { 

                $("#totalamt").val(data.totalamt);
                $("#totalexpense").val(data.totalexpense);
                $("#balance").val(data.balance);
                $("#bala").val(data.balance);
                 $("#amount").val('');
               }
             });
     }
});

$("#amount").on('change input', function(){
     
      $("#balance").val($("#bala").val()-$('#amount').val());
       var bal=$("#bala").val()-$('#amount').val();
       if(bal<0)
      {
         $("#subbutton").attr("disabled", true);
         $("#errormsg").html("Your Amount Must be less than balance amount");
      }
      else
      {
         $("#subbutton").removeAttr("disabled");
         $("#errormsg").html("");
      }
     
});
</script>
@endsection