@extends('layouts.account')
@section('content')
<style type="text/css">
.bigdrop {
    width: 700px !important;
}
.select2-container {
  width: 700px!important;
}


  .select2-container--default .select2-selection--multiple .select2-selection__choice {

    background-color: black!important;
    border: 1px solid black!important;
  
}

.select2-search__field{
  width: 650px!important;
}

</style>
@if(Session::has('msg'))
   <p class="alert alert-warning text-center">{{ Session::get('msg') }}</p>
@endif

<table class="table table-responsive table-hover table-bordered table-striped">
  <tr class="bg-navy">
     <td class="text-center">CREATE TEMP SALARY</td>
  </tr>

</table>


<form action="/savetempsalary" method="post" enctype="multipart/form-data">
  {{csrf_field()}}
<div class="table-responsive">
  <table class="table table-responsive table-hover">
     <tr>
         <td><strong>EMPLOYEE NAME</strong> *</td>
         <td>
          <select class="form-control select2" name="userid" required="">
            <option value="">Select a Employee</option>
            @foreach($employees as $employee)
               <option value="{{$employee->id}}">{{$employee->name}}</option>
            @endforeach
          </select>
 
         </td>
      </tr>
      <tr>
        <td><strong>SALARY TYPE *</strong></td>
        <td>
          <select class="form-control" name="salarytype" required="">
            <option value="SALARY">SALARY</option>
            <option value="ADVANCE SALARY">ADVANCE SALARY</option>
            
          </select>
        </td>
      </tr>
        <tr>
        <td><strong>FOR YEAR*</strong></td>
        <td>
          <select class="form-control" name="foryear" required="">
            <option value="2021">2019</option>
            <option value="2020" selected="">2020</option>
            <option value="2021">2021</option>
            
          </select>
        </td>
      </tr>
          <tr>
        <td><strong>FOR MONTH*</strong></td>
        <td>
    <select class="form-control select2" name="formonth" required="">
    <option value=''>--Select Month--</option>
    <option selected value='Janaury'>Janaury</option>
    <option value='February'>February</option>
    <option value='March'>March</option>
    <option value='April'>April</option>
    <option value='May'>May</option>
    <option value='June'>June</option>
    <option value='July'>July</option>
    <option value='August'>August</option>
    <option value='September'>September</option>
    <option value='October'>October</option>
    <option value='November'>November</option>
    <option value='December'>December</option>
            
            
          </select>
        </td>
      </tr>
      <tr>
         <tr>

        <td><strong>AMOUNT *</strong></td>
        <td>
           <input type="text" name="amount" id="amount" placeholder="Enter Amount Here" autocomplete="off" class="form-control" required="">
        </td>
      </tr>


          <tr>
          <td><strong>DESCRIPTION *</strong></td>
          <td>
            <textarea class="form-control" name="description" required="" placeholder="Enter  Description"></textarea>
          </td>
        </tr>
        
      </tr>
        <tr>
         <td><strong>FROM BANK</strong> *</td>
         <td>
             <select class="form-control select2" name="frombank" required="">
              <option value="">Selectr a Bank</option>
                @foreach($banks as $bank)
                  <option value="{{$bank->id}}">{{$bank->bankname}}/{{$bank->acno}}/{{$bank->branchname}}</option>
                @endforeach
             </select>  
         </td>
      </tr>
      <tr>
         <td><strong>DATE OF TRANSACTION </strong> *</td>
         <td>
            <input type="text" name="dateofpayment" class="form-control datepicker" required="">
         </td>
      </tr>
         <tr>
         <td><strong>TRANSACTION ID </strong> *</td>
         <td>
            <input type="text" name="trnid" class="form-control" required="">
         </td>
      </tr>
      
    
       
     
      <tr>
        <td colspan="2" style="text-align: right;"><button type="submit" class="btn btn-success btn-lg" id="subbutton" onclick="return confirm('Do You Want to Proceed?');">SAVE</button></td>
       
      </tr>

  </table>
</div>
</form>
<script type="text/javascript">

 
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

</script>



@endsection