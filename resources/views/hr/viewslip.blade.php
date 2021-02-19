<style>
.salary-slip{
      margin: 15px;
      .empDetail {
        width: 100%;
        text-align: left;
        border: 2px solid black;
        border-collapse: collapse;
        table-layout: fixed;
      }
      
      .head {
        margin: 10px;
        margin-bottom: 50px;
        width: 100%;
      }
      
      .companyName {
        text-align: right;
        font-size: 25px;
        font-weight: bold;
      }
      
      .salaryMonth {
        text-align: center;
      }
      
      .table-border-bottom {
        border-bottom: 1px solid;
      }
      
      .table-border-right {
        border-right: 1px solid;
      }
      
      .myBackground {
        padding-top: 10px;
        text-align: left;
        border: 1px solid black;
        height: 40px;
      }
      
      .myAlign {
        text-align: center;
        border-right: 1px solid black;
      }
      
      .myTotalBackground {
        padding-top: 10px;
        text-align: left;
        background-color: #EBF1DE;
        border-spacing: 0px;
      }
      
      .align-4 {
        width: 25%;
        float: left;
      }
      
      .tail {
        margin-top: 35px;
      }
      
      .align-2 {
        margin-top: 25px;
        width: 50%;
        float: left;
      }
      
      .border-center {
        text-align: center;
      }
      .border-center th, .border-center td {
        border: 1px solid black;
      }
      
      th, td {
        padding-left: 6px;
      }
}
</style>

<div class="salary-slip" >
            <table class="empDetail">
              <tr height="100px" style='background-color: #c2d69b'>
                <td colspan='8' class="companyName"><span> PBITRA ELECTRICAL WORKSHOP PVT. LTD.</span></br></br>
                  <span> Mail:hr.satyajit@pabitragroups.com</span></br>
                  <span> Phone.:79782 61752</span></br>
                  <span><img style="height:70px;width:95px;margin-left: 799px;margin-top: -66px;" src="/logo_final.png" alt="noimage" id="imgshow"></span>
                  </td>
              </tr>

              <tr>
                <th>
                  Name
      </th>
                <td>
                  {{$salaryslip->employeename}}
      </td>
                <td></td>
                <th>
                  Ifsc Code
      </th>
                <td>
                  {{$salaryslip->ifsc}}
      </td>
                <td></td>
                <th>
                  Branch Name
      </th>
                <td>
                  {{$salaryslip->branch}}
                </td>
              </tr>
              <tr>
                <th>
                  Employee Code
      </th>
                <td>
                  {{$salaryslip->empcodeno}}
      </td>
                <td></td>
                <th>
                  Bank Name
      </th>
                <td>
                  {{$salaryslip->bankname}}
      </td>
                <td></td>
                <th>
                  Payslip no.
      </th>
                <td>
                  {{$salaryslip->id}}
      </td>
              </tr>
              <tr>
                <th>
                  Designaion 
      </th>
                <td>
                  {{$salaryslip->designation}}
      </td><td></td>
                <th>
                  Bank Branch
      </th>
                <td>
                  {{$salaryslip->branch}}
      </td><td></td>
                  <th>
                   Pan No.
      </th>
                <td>
                {{$salaryslip->pan}}
      </td>
              </tr>
              <tr>
                <th>
                  Department:
      </th>
                <td>
                  {{$salaryslip->department}}
      </td><td></td>
                <th>
                  Bank A/C no.
      </th>
                <td>
                  {{$salaryslip->accountnumber}}
      </td><td></td>
             
              </tr>
              <tr>
                <td></td>
                <td></td>
              </tr>
              <tr height="2px" style='background-color: #c2d69b'>
                <td colspan='8' class="companyName"></td>
              </tr>
              <tr class="myBackground">
                <th colspan="2" style="color: blue;">
                  Payments
      </th>
                <th >
                 
      </th>
                <th class="table-border-right">
                  Amount (Rs.)
      </th>
                <th colspan="2" style="color: blue;">
                  Deductions
      </th>
                <th >
                  
      </th>
                <th >
                  Amount (Rs.)
      </th>
              </tr>
              <tr>
                <th colspan="2">
                  Basic Salary
      </th>
                <td></td>
                <td class="myAlign">
                  {{$salaryslip->basicsalary}}
      </td>
                <th colspan="2" >
                  Provident Fund
      </th >
                <td></td>

                <td class="myAlign">
                  {{$salaryslip->epfdeduction}}
      </td>
              </tr >
              <tr>
                <th colspan="2">
                  Medical Allowance
      </th>
                <td></td>

                <td class="myAlign">
                  {{$salaryslip->medicalall}}
      </td>
                <th colspan="2" >
                  ESIC
      </th >
                <td></td>

                <td class="myAlign">
                  {{$salaryslip->esicdeduction}}
      </td>
              </tr >
              <tr>
                <th colspan="2">
                  Conveyance Allowance
      </th>
                <td></td>

                <td class="myAlign">
                  {{$salaryslip->conveyanceall}}
      </td>
                <th colspan="2" >
                  Professional Tax
      </th >
                <td></td>

                <td class="myAlign">
                  {{$salaryslip->professionaltax}}
      </td>
              </tr >
              <tr>
                <th colspan="2">
                  House Rent Allowance
      </th>
                <td></td>
                <td class="myAlign">
                  {{$salaryslip->houserentall}}
      </td>
                <th colspan="2" >
                  Income Tax
      </th >
                <td></td>
                <td class="myAlign">
                  {{$salaryslip->incometax}}
      </td>
              </tr >
              <tr>
                <th colspan="2">
                  Other Allowances
      </th>
                <td></td>

                <td class="myAlign">
                  {{$salaryslip->dearnessall}}
      </td>
                <th colspan="2" >
                  Welfare Fund
      </th >
                <td></td>

                <td class="myAlign">
                 {{$salaryslip->welfarefund}}
      </td>
              </tr >
              <tr>
                <th colspan="2">
                  Misc. Allowances
      </th>
                <td></td>

                <td class="myAlign">
                  {{$salaryslip->miscall}}
      </td>
                <th colspan="2" >
                  
      </th >
                <td></td>

                <td class="myAlign">
                 
      </td>
              </tr >
              <tr>
                <th colspan="2">
                  
      </th> <td></td>
                <td class="myAlign">
                
      </td>
                <th colspan="2" >
                  
      </th >
                <td></td>
                <td class="myAlign">
      </td>
              </tr >
              <tr>
                <th colspan="2">
      </th>
                <td></td>
                <td class="myAlign">
      </td>
                <th colspan="2" >
      </th >
                <td></td>
                <td class="myAlign">
    
      </td>
              </tr >
              <tr>
                <th colspan="2">
      </th>
                <td></td>
                <td class="myAlign">
      </td>
                <th colspan="2" >
                  
      </th >
                <td></td>
                <td class="myAlign">
                  
      </td>
              </tr >
              <tr>
                <td colspan="4" class="table-border-right"></td>
                <th colspan="2" >
                 
      </th >
                <td></td>
                <td class="myAlign">
                  
      </td>
              </tr >
              <tr>
                <td colspan="4" class="table-border-right"></td>
                <th colspan="2" >
                
      </th >
                <td></td>
                <td class="myAlign">
               
      </td>
              </tr >
              <tr>
                <td colspan="4" class="table-border-right"></td>
                <th colspan="2" >
                  
      </th > <td></td>
                <td class="myAlign">
                
      </td>
              </tr >
              <tr class="myBackground">
                <th colspan="3">
                  Total Payments
      </th>
                <td class="myAlign">
                  {{$salaryslip->totalpaymemt}}
      </td>
                <th colspan="3" >
                  Total Deductions
      </th >
                <td class="myAlign">
                  {{$salaryslip->totaldeduction}}
      </td>
              </tr >
              <tr height="3px" style='background-color: #c2d69b'>
                <td colspan='8' class="companyName"></td>
              </tr>

              <tbody class="border-center">
                <tr>
                  <th>
                    <!-- Present -->
      </th>
                  <th>
                     <!-- Total days In Month -->
      </th>
                  <th>
                    <!-- Days Paid -->
      </th>
                  <th>
                    <!-- Days Not Paid -->
      </th>
             <!--      <th>
                    Leave Pending
      </th>
                  <th>
                    Casula Leave
      </th>
                  <th>
                    Total Pending
      </th> --><th></th>
                <th></th>
                <th></th>
                </tr>
                <tr>
                  <td ></td>
                  <td ></td>
                  <td ></td>
                  <td ></td>
                  <td ></td>
                  <td ></td>
                  <td ></td>
                  <!-- <td>Total in this Year</td>
                  <td>{{$salaryslip->totalleave}}</td>
                  <td>{{$salaryslip->totalbalanceleave}}</td> -->
                </tr >
                <tr>
                  <th ><!-- Current Month --></th>
                  <td ><!-- &nbsp;{{$salaryslip->totaldays}} --></td>
                  <td ><!-- {{$salaryslip->empttotpresent}} --></td>
                  <td ><!-- {{$salaryslip->empttotabsent}} --></td>
                </tr>
                <tr>
                  <td colspan="4"> &nbsp; </td>
                  <td > </td>
                  <td > </td>
                  <td > </td>
                  <td > </td>
                </tr >
                <tr>
                  <td colspan="4"></td>
                  <td><b>Salary Payble To</b></td>
                  <td>{{$salaryslip->totalpaybleto}}</td>
                  <td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Authorized</br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Signatory</td>
                  <td ></td>
                </tr >
              </tbody>
            </table >

          </div >
     