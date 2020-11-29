@extends('layouts.app')
@section('content')

@if(Session::has('msg'))
   <p class="alert alert-warning text-center">{{ Session::get('msg') }}</p>
@endif

<!-- <table class="table table-responsive table-hover table-bordered table-striped">
	<tr class="bg-navy">
		 <td class="text-center">EDIT EXPENSE ENTRY</td>
	</tr>

</table>

 
<div class="well" >

<form action="/updateuserexpenseentry/{{$expenseentry->id}}" method="post" enctype="multipart/form-data">
	{{csrf_field()}}

	<table class="table table-responsive table-hover table-bordered table-striped">

      <tr>
      	 <td>SELECT A SITE/PROJECT NAME</td>
      	 <td>
      	 	<select class="form-control select2" id="projectid" onchange="showclient();"  name="projectid" required="">

      	 		<option value="">select a project</option>
      	 	@foreach($projects as $project)
             <option value="{{$project->id}}" title="{{$project->orgname}}" {{ ( $project->id == $expenseentry->projectid) ? 'selected' : '' }}>{{$project->projectname}}</option>
                 
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
      	<td>EXPENSE HEAD</td>
      	<td>
      		<select class="form-control select2" name="expenseheadid" onchange="getparticulars();" id="expenseheadid" required="">
      			<option value="">Select a Expense Head</option>

      			@foreach($expenseheads as $expensehead)
                 <option value="{{$expensehead->id}}" {{ ( $expensehead->id == $expenseentry->expenseheadid) ? 'selected' : '' }}>{{$expensehead->expenseheadname}}</option>

      			@endforeach
      			
      		</select>
      	</td>
      </tr>
      <tr>
      	<td>PARTICULARS</td>
      	<td>
      		<select class="form-control select2" name="particularid" id="particularid">
            @foreach($particulars as $particular)
               <option value="{{$particular->id}}" {{ ( $particular->id == $expenseentry->particularid) ? 'selected' : '' }}>{{$particular->particularname}}</option>
            @endforeach
      			
      		</select>
      	</td>
      </tr>

        <tr>
          <td>VENDOR</td>
          <td>
            <select class="form-control select2" name="vendorid">
              <option value="">Select a Vendor</option>
              @foreach($vendors as $vendor)
              <option value="{{$vendor->id}}" {{ ( $vendor->id == $expenseentry->vendorid) ? 'selected' : '' }}>{{$vendor->vendorname}}</option>
              @endforeach              
            </select>
          </td>
        </tr>
      <tr>
      	<td>AMOUNT</td>
      	<td>
      	   <input type="text" name="amount" value="{{$expenseentry->amount}}" autocomplete="off" class="form-control" required="">
      	</td>
      </tr>
       <tr>
        <td>Upload Copy Of Invoice</td>
        <td>
          <input type="file" name="uploadedfile" onchange="readURL(this);">
           <p class="help-block">Upload .png, .jpg or .jpeg image files only</p>

            <td><img style="height:70px;width:95px;" id="imgshow" alt="no uploadedfile" src="{{ asset('/img/expenseuploadedfile/'.$expenseentry->uploadedfile )}}"></td>

        </td>
      </tr>
      <tr>
      	<td colspan="2" style="text-align: right;"><button type="submit" class="btn btn-success">UPDATE</button></td>
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


    $( document ).ready(function() {
   
   showclient();
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
</script> -->
@endsection