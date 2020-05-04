<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\employeedetail;
use App\employeecompanydetail;
use App\employeebankaccountsdetail;
use App\employeedocument;

class MdController extends Controller
{
    public function mdhome(){

    	return view('md.home');
    }
    public function currentemployeelist(){

    $employeedetails=employeedetail::select('employeedetails.*','employeedocuments.*','employeebankaccountsdetails.*','employeecompanydetails.*')
              ->leftJoin('employeedocuments','employeedetails.id','=','employeedocuments.employee_id')
              ->leftJoin('employeebankaccountsdetails','employeedetails.id','=','employeebankaccountsdetails.employee_id')
              ->leftJoin('employeecompanydetails','employeedetails.id','=','employeecompanydetails.employee_id')
              ->where('status','PRESENT')
              ->get();
     //return $employeedetails;

     return view('md.currentemployeelist',compact('employeedetails'));
    }

}
