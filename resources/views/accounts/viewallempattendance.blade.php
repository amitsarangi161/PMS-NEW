@extends('layouts.account')
@section('content')
@if(Session::has('msg'))
   <p class="alert alert-success text-center">{{ Session::get('msg') }}</p>
@endif
@if(Session::has('error'))
   <p class="alert alert-danger text-center">{{ Session::get('error') }}</p>
@endif
<div class="row">
 <div class="col-md-12">
  <div class="box">
    <div class="box-header bg-gray">
      <form action="/empattendance/viewallempattendance" method="get">
    <div class="form-group">

      <label  class="col-sm-2 control-label">From Month</label>
       <div class="col-sm-3">
          <select required="" class="form-control select2" id="fromyear" name="fromyear">
        <option value="2021" {{(Request::get('fromyear')=='2021')?'selected':''}}>2021</option>
        <option value="2020"{{(Request::get('fromyear')=='2020')?'selected':''}}>2020</option>
        <option value="2019"{{(Request::get('fromyear')=='2019')?'selected':''}}>2019</option>
        <option value="2018"{{(Request::get('fromyear')=='2018')?'selected':''}}>2018</option>
        <option value="2017"{{(Request::get('fromyear')=='2017')?'selected':''}}>2017</option>
        <option value="2016"{{(Request::get('fromyear')=='2016')?'selected':''}}>2016</option>
        <option value="2015"{{(Request::get('fromyear')=='2015')?'selected':''}}>2015</option>
        <option value="2014"{{(Request::get('fromyear')=='2014')?'selected':''}}>2014</option>
        <option value="2013" {{(Request::get('fromyear')=='2013')?'selected':''}}>2013</option>
          
      </select>
      <select  required="" class="form-control select2" id="frommonth" name="frommonth" >
          <option value="01"{{(Request::get('frommonth')=='01')?'selected':''}}>January</option>
          <option value="02"{{(Request::get('frommonth')=='02')?'selected':''}}>February</option>
          <option value="03"{{(Request::get('frommonth')=='03')?'selected':''}}>March</option>
          <option value="04"{{(Request::get('frommonth')=='04')?'selected':''}}>April</option>
          <option value="05"{{(Request::get('frommonth')=='05')?'selected':''}}>May</option>
          <option value="06"{{(Request::get('frommonth')=='06')?'selected':''}}>June</option>
          <option value="07"{{(Request::get('frommonth')=='07')?'selected':''}}>July</option>
          <option value="08"{{(Request::get('frommonth')=='08')?'selected':''}}>August</option>
          <option value="09"{{(Request::get('frommonth')=='09')?'selected':''}}>September</option>
          <option value="10"{{(Request::get('frommonth')=='10')?'selected':''}}>October</option>
          <option value="11"{{(Request::get('frommonth')=='11')?'selected':''}}>November</option>
          <option value="12"{{(Request::get('frommonth')=='12')?'selected':''}}>December</option>
      </select>
      
      </div>
      <div  class="col-md-3">
      <div class="form-group">
        <label>SELECT A GROUP NAME *</label>
          <select required="" class="form-control select2" id="empgroupid"  name="empgroupid" required="" style="width: 100%;">
            <option value="">SELECT A GROUP</option>
               @foreach($empgroups as $key => $group)
               <option value="{{$group->id}}" {{(Request::get('empgroupid')==$group->id)?'selected':''}}>{{$group->groupname}}</option>
               @endforeach
          </select>
      </div>
    </div>
      <div class="col-sm-1">
        <button type="submit" class="btn btn-success">Fetch</button>
      </div>
    </div>
  </form>
  </div>
</div>

</div>
</div>
  @if(sizeof($customarray) > 0)
  <div class="box-body table-responsive" id="labourdtldiv">
    <table class="table table-bordered table-striped datatablescrollexport">
      <thead>
        <tr class="bg-navy">
          <th>Sl No.</th>
          <th>NAME</th>
          <th>YEAR</th>
          <th>MONTH</th>
          <th>GROSS SALARY</th>
          <!-- <th>BASIC SALARY</th> -->
          <th>TOTAL PRESENT</th>
          <th>TOTAL ABSENT</th>
          <th>TOTAL HALFDAY</th>
          <th>TOTAL DAYS</th>
          <th>TOTAL HOLIDAY</th>
          <th>TOTAL LEAVE</th>
          <th>TOTAL LEAVE TAKEN</th>
          <th>TOTAL AVAILABLE LEAVE</th>
          <th>PAY SLIP</th>
        </tr>
      </thead>
      <tbody id="empdetail">
        @foreach($customarray as $cust)
        <tr>
          <td>{{$cust['employee']->id}}</td>
          <td>{{$cust['employee']->employeename}}</td>
          <td>{{$cust['year']}}</td>
          <td>{{$cust['month']}}</td>
          <td>{{$cust['employee']->emptotalwages}}</td>
          <!-- <td>{{$cust['employee']->basicsalary}}</td> -->
          <td>{{$cust['empttotpresent']}}</td>
          <td>{{$cust['empttotabsent']}}</td>
          <td>{{$cust['emptothalfday']}}</td>
          <td>{{$cust['totmonthdate']}}</td>
          <td>{{$cust['totholiday']}}</td>
          <td>{{$cust['totalleave']}}</td>
          <td>{{$cust['totleavetaken']}}</td>
          <td>{{$cust['totalbalanceleave']}}</td>
          <td>
            @php
               $year=Request::get('fromyear');
               $month=Request::get('frommonth');
                  $check=\App\Addemployeesalarysheet::where('employee_id',$cust['employee']->id)
                  ->where('year',$year)
                  ->where('month',$month)
                  ->count();
            @endphp
            @if($check == 0)
            <button type="button" class="btn btn-primary" onclick="calculate('{{$cust['employee']->id}}','{{$cust['employee']->emptotalwages}}','{{$cust['employee']->basicsalary}}','{{$cust['employee']->professionaltax}}','{{$cust['employee']->incometax}}','{{$cust['employee']-> welfarefund }}','{{$cust['empttotpresent']}}','{{$cust['empttotabsent']}}','{{$cust['emptothalfday']}}','{{$cust['thismonthleave']}}','{{$cust['totleavetaken']}}','{{$cust['totalleave']}}','{{$cust['totalbalanceleave']}}','{{$cust['totmonthdate']}}','{{$cust['totholiday']}}','{{$cust['employee']->employeename}}','{{$cust['year']}}','{{$cust['month']}}');">Generate</button>
            @else
            <button type="button" disabled="" class="btn btn-danger">Done</button>
            @endif
          </td>
        </tr>

        @endforeach
        
      </tbody>

      
    </table>

</div>
@endif

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Calculate Salary For</h4>
      </div>
      <div class="modal-body">
        <form action="/addemployeesalaryshee" method="post">
          {{csrf_field()}}


            <table class="table table-responsive table-hover table-bordered table-striped">
     <input type="hidden" name="did" id="did">
     <input type="hidden" name="employeename" id="employeename">
     <input type="hidden" name="year" id="year">
     <input type="hidden" name="month" id="month">
    <tr>
     <tr>
     <td><strong>Total Leave<span style="color: red"> *</span></strong></td>
     <td><input type="text" readonly="" autocomplete="off" name="totalleave" id="totalleave" placeholder="Enter Group Name" class="form-control"></td>
     <td><strong>Total Leave Taken<span style="color: red"> *</span></strong></td>
     <td><input type="text" readonly="" autocomplete="off" name="totleavetaken" id="totleavetaken" placeholder="Enter Group Name" class="form-control"></td>
   </tr>
   <tr>
     <td><strong>Available Leave<span style="color: red"> *</span></strong></td>
     <td><input type="text" readonly="" autocomplete="off" name="totalbalanceleave" id="totalbalanceleave" placeholder="Enter Group Name" class="form-control"></td>
     <td><strong>This Month Leave<span style="color: red"> *</span></strong></td>
     <td><input type="text" readonly="" autocomplete="off" name="thismonthleave" id="thismonthleave" placeholder="Enter Group Name" class="form-control"></td>
   </tr>
  
   <tr>
     <td><strong>Employee salary<span style="color: red"> *</span></strong></td>
     <td><input type="text" readonly="" autocomplete="off" name="employeesalary" id="emptotalwages" placeholder="Enter Group Name" class="form-control calc"></td>
     <td><strong>EPF DEDUCTION<span style="color: red"> *</span></strong></td>
     <td><input type="text" autocomplete="off" name="epfdeduction" id="epfdeduction" placeholder="Enter Group Name" class="form-control calc"></td>
     
  </tr>
  <tr>
  <td><strong>Month Total Days<span style="color: red"> *</span></strong></td>
     <td><input type="text" readonly="" autocomplete="off" name="totmonthdate" id="totmonthdate" placeholder="Enter Group Name" class="form-control calc"></td>
     <td><strong>ESIC DEDUCTION<span style="color: red"> *</span></strong></td>
     <td><input type="text"  autocomplete="off" name="esicdeduction" id="esicdeduction" placeholder="Enter Group Name" class="form-control calc"></td>
  </tr>
  <tr>
    <td><strong>Total Holiday<span style="color: red"> *</span></strong></td>
     <td><input type="text" readonly="" autocomplete="off" name="totholiday" id="totholiday" placeholder="Enter Group Name" class="form-control calc"></td>
      <td><strong>SALARY ADVANCE<span style="color: red"> *</span></strong></td>
     <td><input type="text" autocomplete="off" name="salaryadvance" id="salaryadvance" value="0" placeholder="Enter Group Name" class="form-control calc"></td>
  </tr>
  <tr>
    <td><strong>Total Present<span style="color: red"> *</span></strong></td>
     <td><input type="text" readonly="" autocomplete="off" name="empttotpresent" id="empttotpresent" placeholder="Enter Group Name" class="form-control decalc"></td>
      <td><strong>ADVANCE<span style="color: red"> *</span></strong></td>
     <td><input type="text" autocomplete="off" name="advance" id="advance" placeholder="Enter Group Name" value="0" class="form-control calc"></td>
  </tr>
  <tr>
    <td><strong>Total Absent<span style="color: red"> *</span></strong></td>
     <td><input type="text" readonly="" autocomplete="off" name="empttotabsent" id="empttotabsent" placeholder="Enter Group Name" class="form-control calc"></td>
      <td><strong>PROFESSIONAL TAX<span style="color: red"> *</span></strong></td>
     <td><input type="text" autocomplete="off" name="professionaltax" id="professionaltax" value="0" placeholder="" class="form-control calc"></td>
  </tr>
  <tr>
  <td><strong>Basic Salary<span style="color: red"> *</span></strong></td>
     <td><input type="text" readonly="" autocomplete="off" name="basicsalary" id="basicsalary" placeholder="Enter Group Name" class="form-control calc"></td>
     <td><strong>INCOME TAX<span style="color: red"> *</span></strong></td>
     <td><input type="text" autocomplete="off" name="incometax" id="incometax" placeholder="Enter Group Name" value="0" class="form-control calc"></td>
  </tr>
  <tr>
  <td><strong>CONVEYANCE ALLOWANCE<span style="color: red"> *</span></strong></td>
     <td><input type="text" readonly="" autocomplete="off" name="conveyanceall" id="conveyanceall" placeholder="Enter Group Name" class="form-control calc"></td>
      <td><strong>WELFARE FUND<span style="color: red"> *</span></strong></td>
     <td><input type="text" autocomplete="off" name="welfarefund" id="welfarefund" value="0" class="form-control calc"></td>
  </tr>
  <tr>
  <td><strong>OTHER ALLOWANCES<span style="color: red"> *</span></strong></td>
     <td><input type="text" readonly="" autocomplete="off" name="dearnessall" id="dearnessall" placeholder="Enter Group Name" class="form-control calc"></td>
     <td><strong>HALF DAY<span style="color: red"> *</span></strong></td>
     <td><input type="text" autocomplete="off" readonly="" name="emptothalfday" id="emptothalfday" placeholder="Enter Total Half Day" class="form-control calc"></td>
  </tr>
  <tr>
  <td><strong>MEDICAL ALLOWANCE<span style="color: red"> *</span></strong></td>
     <td><input type="text" readonly="" autocomplete="off" name="medicalall" id="medicalall" placeholder="Enter Group Name" class="form-control calc"></td>
      <td><strong>Total Deduction<span style="color: red"> *</span></strong></td>
     <td><input type="text" autocomplete="off" readonly="" name="totaldeduction" id="totaldeduction" placeholder="Enter Group Name" class="form-control"></td>
    
  </tr>
  <tr>
  <td><strong>HOUSERENT ALLOWANCE<span style="color: red"> *</span></strong></td>
     <td><input type="text" readonly="" autocomplete="off" name="houserentall" id="houserentall" placeholder="Enter Group Name" class="form-control calc"></td>
     
  </tr>
   <tr>
     <td><strong>Per Day Salary<span style="color: red"> *</span></strong></td>
     <td><input type="text"  readonly="" autocomplete="off" name="perdaysalary" id="perdaysalary" placeholder="Enter Group Name" class="form-control calc"></td>
   </tr>
   <tr>
     <td><strong> Payments<span style="color: red"> *</span></strong></td>
     <td><input type="text" readonly="" autocomplete="off" name="thismonthsalary" id="thismonthsalary" placeholder="Enter Group Name" class="form-control"></td>
   </tr>
   <tr>
  <td><strong>MISC. ALLOWANCE<span style="color: red"> *</span></strong></td>
     <td><input type="text" autocomplete="off" name="miscall" id="miscall" placeholder="Enter Misc. ALLOWANCE" class="form-control calc"></td>
     
  </tr>
  <tr>
     <td><strong>Total Payments<span style="color: red"> *</span></strong></td>
     <td><input type="text" readonly="" autocomplete="off" name="totalpaymemt" id="totalpaymemt" placeholder="Enter Group Name" class="form-control"></td>
   </tr>
   <tr style="color: red">
     <td><strong>Total Payble To<span style="color: red"> *</span></strong></td>
     <td><input type="text" readonly="" autocomplete="off" name="totalpaybleto" id="totalpaybleto" placeholder="Enter Group Name" class="form-control"></td>
   </tr>
   <tr>
    <td colspan="4" style="text-align: right;"><button type="submit" class="btn btn-success">Generate</button></td>
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
  var esic_deducpercnt=0.75;
  var epf_deducpercnt=12;
  var basic_per=50;
  var hra_per=15;
  var med_per=15;
  var da_per=10;
  var conv_per=10;



  function calc(){
    var emptotalwages= ($("#emptotalwages").val())?$("#emptotalwages").val():0;
    var empttotpresent= ($("#empttotpresent").val())?$("#empttotpresent").val():0;
    var empttotabsent= ($("#empttotabsent").val())?$("#empttotabsent").val():0;
    var emptothalfday= ($("#emptothalfday").val())?$("#emptothalfday").val():0;
    var thismonthleave= ($("#thismonthleave").val())?$("#thismonthleave").val():0;
    var totleavetaken= ($("#totleavetaken").val())?$("#totleavetaken").val():0;
    var totalleave= ($("#totalleave").val())?$("#totalleave").val():0;
    var totalbalanceleave= ($("#totalbalanceleave").val())?$("#totalbalanceleave").val():0;
    var totmonthdate= ($("#totmonthdate").val())?$("#totmonthdate").val():0;
    var totholiday= ($("#totholiday").val())?$("#totholiday").val():0;
    var employeename= ($("#employeename").val())?$("#employeename").val():0;
    var basicsalary= ($("#basicsalary").val())?$("#basicsalary").val():0;
    var conveyanceall= ($("#conveyanceall").val())?$("#conveyanceall").val():0;
    var dearnessall= ($("#dearnessall").val())?$("#dearnessall").val():0;
    var medicalall= ($("#medicalall").val())?$("#medicalall").val():0;
    var houserentall= ($("#houserentall").val())?$("#houserentall").val():0;
    var perdaysalary= ($("#perdaysalary").val())?$("#perdaysalary").val():0;
    var epfdeduction= ($("#epfdeduction").val())?$("#epfdeduction").val():0;
    var esicdeduction= ($("#esicdeduction").val())?$("#esicdeduction").val():0;
    var salaryadvance= ($("#salaryadvance").val())?$("#salaryadvance").val():0;
    var advance= ($("#advance").val())?$("#advance").val():0;
    var professionaltax= ($("#professionaltax").val())?$("#professionaltax").val():0;
    var incometax= ($("#incometax").val())?$("#incometax").val():0;
    var welfarefund= ($("#welfarefund").val())?$("#welfarefund").val():0;
    var miscall= ($("#miscall").val())?$("#miscall").val():0;
    var thismonthsalary= ($("#thismonthsalary").val())?$("#thismonthsalary").val():0;
    var totalpaymemt= ($("#totalpaymemt").val())?$("#totalpaymemt").val():0;
    console.log(miscall);
    // var totaladdition=parseFloat(miscall)+parseFloat(basicsalary)+parseFloat(conveyanceall)+parseFloat(dearnessall)+parseFloat(medicalall)+parseFloat(houserentall)+parseFloat(miscall);
    //console.log(totaladdition);
    var caltotholiday=parseFloat(perdaysalary)/2*parseFloat(emptothalfday);
    //$("#emptothalfday").val(caltotholiday.toFixed(2));
    var totaldeduction=parseFloat(epfdeduction)+parseFloat(esicdeduction)+parseFloat(salaryadvance)+parseFloat(advance)+parseFloat(professionaltax)+parseFloat(incometax)+parseFloat(welfarefund)+parseFloat(caltotholiday);
         $("#totaldeduction").val(totaldeduction.toFixed(2));
         //var thismonthsalary=parseFloat(totaladdition.toFixed(2));
         // $("#thismonthsalary").val(thismonthsalary);
         //console.log(thismonthsalary+"======"+totaldeduction);
         //var thismonthsalary=parseFloat(totaladdition.toFixed(2));
         var totalpaymemt=parseFloat(thismonthsalary)+parseFloat(miscall);
         $("#totalpaymemt").val(totalpaymemt);
         var totalpayble=parseFloat(totalpaymemt)-parseFloat(totaldeduction);
         //console.log(totalpayble);
        $("#totalpaybleto").val(totalpayble.toFixed(2));



  }
$( ".calc" ).on("change paste keyup", function() {
   calc();      
  });

  function calculate(id,emptotalwages,basicsalary,professionaltax,incometax,welfarefund,empttotpresent,empttotabsent,emptothalfday,thismonthleave,totleavetaken,totalleave,totalbalanceleave,totmonthdate,totholiday,employeename,year,month,miscall,totalpaymemt){
    //alert(id);
    $("#did").val(id);
    $("#emptotalwages").val(emptotalwages);
    $("#empttotpresent").val(empttotpresent);
    $("#empttotabsent").val(empttotabsent);
    $("#emptothalfday").val(emptothalfday);
    $("#thismonthleave").val(thismonthleave);
    $("#totleavetaken").val(totleavetaken);
    $("#totalleave").val(totalleave);
    $("#totalbalanceleave").val(totalbalanceleave);
    $("#totmonthdate").val(totmonthdate);
    $("#totholiday").val(totholiday);
    $("#employeename").val(employeename);
    $("#year").val(year);
    $("#month").val(month);

    var empsalarydays=parseFloat(empttotpresent)+parseFloat(totholiday);

    var basicsalary=parseFloat(emptotalwages)*basic_per/100;
    var thismonthbasicsalary=(basicsalary/totmonthdate)*empsalarydays;
    //console.log((parseFloat(empttotpresent)+parseFloat(totholiday)));
    $("#basicsalary").val(thismonthbasicsalary.toFixed(2));

    var houserentall=(parseFloat(emptotalwages/totmonthdate)*hra_per/100)*empsalarydays;
    $("#houserentall").val(houserentall.toFixed(2));

    var medicalall=(parseFloat(emptotalwages/totmonthdate)*med_per/100)*empsalarydays;
    $("#medicalall").val(medicalall.toFixed(2));
    var dearnessall=(parseFloat(emptotalwages/totmonthdate)*da_per/100)*empsalarydays;
    $("#dearnessall").val(dearnessall.toFixed(2));
    var conveyanceall=(parseFloat(emptotalwages/totmonthdate)*conv_per/100)*empsalarydays;
    $("#conveyanceall").val(conveyanceall.toFixed(2));


    var epfdeduction=parseFloat(thismonthbasicsalary)*epf_deducpercnt/100;
    $("#epfdeduction").val(epfdeduction.toFixed(2));
    var esicdeduction=(parseFloat(emptotalwages/totmonthdate)*esic_deducpercnt/100)*empsalarydays;
    $("#esicdeduction").val(esicdeduction.toFixed(2));
    var totaldeduction=(parseFloat(epfdeduction)+parseFloat(esicdeduction)).toFixed(2);
    $("#totaldeduction").val(totaldeduction);


      if(parseFloat(totalleave)<parseFloat(totleavetaken)){
           var diff=parseFloat(totleavetaken)-parseFloat(totalleave);//3
           if(diff<empttotabsent){
               var extraleave=diff;
           }
           else{
                var extraleave=empttotabsent;
           }
           //18
      }
      else{
        var extraleave=0;
      }

    var perdaysalary=parseFloat(emptotalwages)/parseFloat(totmonthdate);
    if(extraleave==0){
      var thismonthsalary=parseFloat(perdaysalary)*(parseFloat(empttotpresent)+parseFloat(totholiday)+parseFloat(thismonthleave));
      console.log(perdaysalary+"=====perday"+empttotpresent+"=======totalpresent"+totholiday+"========totalholiday"+thismonthleave+"========thismonth");
    }
    
       else{
        
        var thismonthsalary=parseFloat(perdaysalary)*(parseFloat(empttotpresent)+parseFloat(totholiday)-parseFloat(extraleave));
           console.log(extraleave+"extra Leave");
           console.log(parseFloat(empttotpresent)+parseFloat(totholiday)-parseFloat(extraleave)+"total days count");

           console.log(perdaysalary+"per day sal");
           console.log(thismonthsalary+"this mon sal");
       }
        

    $("#thismonthsalary").val(thismonthsalary.toFixed(2));
    var totalpaybleto=(parseFloat(thismonthsalary)-parseFloat(totaldeduction)).toFixed(2);
    $("#totalpaybleto").val(totalpaybleto);
    $("#perdaysalary").val(perdaysalary.toFixed(2));
    $("#myModal").modal('show');
    calc();
  }

  function fetchlattendanceemp(selected){
    var fromyear=$("#fromyear").val();
    var frommonth=$("#frommonth").val();
    var empgroupid=$("#empgroupid").val();

    //alert(tomonth+tomonth);
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });

   //var u="business.draquaro.com/api.php?id=9658438020";

           $.ajax({
               type:'POST',
              
               url:'{{url("/ajaxfetchattendanceemp")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                    
                      fromyear:fromyear,
                      frommonth:frommonth,
                      empgroupid:empgroupid

                     },

               success:function(data) { 
                var html='';
                $.each(data.employees, function (index, value) {
                  html+='<tr id="color'+index+'">'+
                        '<td>'+'<input type="hidden" class="countlab" name="id[]" value="'+value.id+'">'+value.id+'</td>'+
                        '<td>'+'<input type="hidden" name="employeename[]" value="'+value.employeename+'">'+value.employeename+'</td>'+
                        '<td>'+'<input type="hidden" class="countlab" name="attendancedate[]" value="'+data.attendancedate+'">'+data.attendancedate+'</td>'+
                         '<td>'+
                           '<select  class="form-control" name="present[]" onchange="changeRowColor(this.value,'+index+')">'+
                           '<option value="Y">PRESENT</option>'+
                           '<option value="N">ABSENT</option>'+
                          '</select>'+
                        '</td>'+
                        '<td>'+
                           '<select  class="form-control" name="halffull[]">'+
                           '<option value="F">FULL</option>'+
                           '<option value="H">HALF</option>'+
                          '</select>'+
                        '</td>'+
                        '</tr>';
                
                });
                 $("#empdetail").html(html);
                 $("#labourdtldiv").show();
                 $("#submitbtnid").show();
                 $("#fetchbtnid").hide();
                 sumofrow();

               }
             });
     }
</script>

@endsection