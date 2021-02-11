<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\activity;
use App\userrequest;
use Session;
use Mail;
use App\complaint;
use Auth;
use App\complaintlog;
use DataTables;
use DB;
use App\todo;
use Carbon\Carbon;
use App\notice;
use App\document;
use App\department; 
use App\designation; 
use App\employeedetail;
use App\employeecompanydetail;
use App\employeebankaccountsdetail;
use App\employeedocument;
use App\employeeotherdocument;
use App\attendance;
use App\Addgroup;
use App\Addempgroup;
use App\Dailyattendancegroup;
use App\Dailyattendancegroupdetail;
use App\Dailyattendanceimage;
use App\Addleavetype;
use App\Salarydeduction;
use App\Applyleave;
use App\Empdailyattendancegroupdetail;
use App\Empdailyattendancegroup;
use App\Approvedleave;
use App\Addemployeesalarysheet;
use Excel;
use App\Http\Controllers\AccountController as Money;
class HrController extends Controller
{
  //-------------PMS HR ------------//
  public function viewapplicantleaveuser($id){
    $leave=Applyleave::select('applyleaves.*','users.name')
        ->leftJoin('users','applyleaves.appliername','=','users.id')
        ->find($id);

      $leavetypes=Addleavetype::all();
      $users=User::all();
      //return $leave;
    return view('viewapplicantleaveuser',compact('leave','leavetypes','users'));
  }
  public function viewuserleave(){
    $uid=Auth::id();
    $viewapplies=Applyleave::select('applyleaves.*','u1.name as name','addleavetypes.leavetypename','u2.name as releivername')
          ->leftJoin('users as u1','applyleaves.appliername','=','u1.id')
          ->leftJoin('users as u2','applyleaves.relieverid','=','u2.id')
          ->leftJoin('addleavetypes','applyleaves.laevetypeid','=','addleavetypes.id')
          ->where('applyleaves.employeeid',Auth::user()->employee_id)
          ->get();
     //return $viewapplies;
    return view('viewuserleave',compact('viewapplies'));

  }
  public function updateadjustleave(Request $request)
   {
        $fromdate=$request->fromdate;
        $todate=$request->todate;
       $updateleave=Applyleave::find($request->did);
       $updateleave->status="ACCEPTED";
       $updateleave->fromdate=$request->fromdate;
       $updateleave->todate=$request->todate;
       $updateleave->save();
       if($updateleave->status == "ACCEPTED"){
      //return 2;
        $begin = strtotime($fromdate);
        $end = strtotime($todate);
        for ( $i = $begin; $i <= $end; $i = $i + 86400 ) {
          $thisDate = date( 'Y-m-d', $i ); // 2010-05-01, 2010-05-02, etc
          $chk=Approvedleave::where('date',$thisDate)
                    ->where('employee_id',$updateleave->employeeid)
                    ->count();
          if($chk == 0){
         $approvedleave=new Approvedleave();
         $approvedleave->applyleaveid=$updateleave->id;
         $approvedleave->date=$thisDate;
         $approvedleave->employee_id=$updateleave->employeeid;
         $approvedleave->save();

          }
      }

    }
       Session::flash('msg','Update Leave Successfully');
       return redirect('/leave/viewpendingleves');
   }
  public function viewatendances($date,$id){
    $viewatendances=Empdailyattendancegroupdetail::where('dailyattendanceid',$id)
    ->where('attendancedate',$date)
    ->get();
    //return $viewatendances;

    return view('hr.viewatendances',compact('viewatendances'));
  }
  public function recviewatendances($date,$id){
    $viewatendances=Empdailyattendancegroupdetail::where('dailyattendanceid',$id)
    ->where('attendancedate',$date)
    ->get();
    //return $viewatendances;

    return view('viewatendances',compact('viewatendances'));
  }
  public function viewslip($id){
    $salaryslip=Addemployeesalarysheet::select('addemployeesalarysheets.*','employeecompanydetails.department','employeecompanydetails.designation','employeebankaccountsdetails.ifsc','employeebankaccountsdetails.branch','employeebankaccountsdetails.pan','employeebankaccountsdetails.accountnumber','employeedetails.empcodeno')
    ->leftJoin('employeebankaccountsdetails','addemployeesalarysheets.employee_id','=','employeebankaccountsdetails.employee_id')
    ->leftJoin('employeecompanydetails','addemployeesalarysheets.employee_id','=','employeecompanydetails.employee_id')
    ->leftJoin('employeedetails','addemployeesalarysheets.employee_id','=','employeedetails.id')->find($id);
    //return $salaryslip;
    return view('hr.viewslip',compact('salaryslip'));
  }
  public function viewemployeepayslip(Request $request){
  
    $users=User::all();
    $salaryslips=Addemployeesalarysheet::select('addemployeesalarysheets.*','employeecompanydetails.department','employeecompanydetails.designation','employeebankaccountsdetails.ifsc','employeebankaccountsdetails.branch','employeebankaccountsdetails.pan','employeebankaccountsdetails.accountnumber','employeedetails.empcodeno')
    ->leftJoin('employeebankaccountsdetails','addemployeesalarysheets.employee_id','=','employeebankaccountsdetails.employee_id')
    ->leftJoin('employeecompanydetails','addemployeesalarysheets.employee_id','=','employeecompanydetails.employee_id')
    ->leftJoin('employeedetails','addemployeesalarysheets.employee_id','=','employeedetails.id');
      if ($request->has('employeeid') && $request->get('employeeid')!=''){
           $salaryslips=$salaryslips->where('addemployeesalarysheets.employee_id',$request->employeeid);
        }
        if ($request->has('fromyear') && $request->get('fromyear')!=''){
           $salaryslips=$salaryslips->where('addemployeesalarysheets.year',$request->fromyear);
        }
        if ($request->has('frommonth') && $request->get('frommonth')!=''){
           $salaryslips=$salaryslips->where('addemployeesalarysheets.month',$request->frommonth);
        }

    $salaryslips=$salaryslips->get();
    //$sds=Addemployeesalarysheet::all();
    //return $salaryslips;
    return view('hr.viewemployeepayslip',compact('salaryslips','users'));
  }
  public function addemployeesalaryshee(Request $request){
    //return $request->all();
    $calculate=new Addemployeesalarysheet();
    $calculate->employee_id=$request->did;
    $calculate->employeename=$request->employeename;
    $calculate->year=$request->year;
    $calculate->month=$request->month;
    $calculate->empcodeno=$request->empcodeno;
    $calculate->department=$request->department;
    $calculate->designation=$request->designation;
    $calculate->ifsc=$request->ifsc;
    $calculate->bankname=$request->bankname;
    $calculate->branch=$request->branch;
    $calculate->pan=$request->pan;
    $calculate->accountnumber=$request->accountnumber;
    $calculate->totalleave=$request->totalleave;
    $calculate->totleavetaken=$request->totleavetaken;
    $calculate->totalbalanceleave=$request->totalbalanceleave;
    $calculate->emptotalwages=$request->emptotalwages;
    $calculate->basicsalary=$request->basicsalary;
    $calculate->conveyanceall=$request->conveyanceall;
    $calculate->salaryadvance=$request->salaryadvance;
    $calculate->dearnessall=$request->dearnessall;
    $calculate->medicalall=$request->medicalall;
    $calculate->houserentall=$request->houserentall;
    $calculate->totaldays=$request->totmonthdate;
    $calculate->totholiday=$request->totholiday;
    $calculate->empttotpresent=$request->empttotpresent;
    $calculate->perdaysalary=$request->perdaysalary;
    $calculate->thismonthsalary=$request->thismonthsalary;
    $calculate->epfdeduction=$request->epfdeduction;
    $calculate->esicdeduction=$request->esicdeduction;
    $calculate->advance=$request->advance;
    $calculate->professionaltax=$request->professionaltax;
    $calculate->incometax=$request->incometax;
    $calculate->welfarefund=$request->welfarefund;
    $calculate->totaldeduction=$request->totaldeduction;
    $calculate->totalpaybleto=$request->totalpaybleto;
    $calculate->save();
    Session::flash('msg','Leave Applied Successfully');
    return back();


  }
  public function viewattendanceemployee(){
    $attendances=Empdailyattendancegroup::select('empdailyattendancegroups.*','addempgroups.groupname','users.name')
    ->leftjoin('addempgroups','empdailyattendancegroups.empgroupid','=','addempgroups.id')
    ->leftjoin('users','empdailyattendancegroups.entryby','=','users.id')
    ->orderBy('date','DESC')
    ->paginate(25);
    //return $attendances;
    return view('hr.viewattendanceemployee',compact('attendances'));
  }
  public function recviewattendanceemployee(){
    $attendances=Empdailyattendancegroup::select('empdailyattendancegroups.*','addempgroups.groupname','users.name')
    ->leftjoin('addempgroups','empdailyattendancegroups.empgroupid','=','addempgroups.id')
    ->leftjoin('users','empdailyattendancegroups.entryby','=','users.id')
    ->orderBy('date','DESC')
    ->paginate(25);
    //return $attendances;
    return view('recviewattendanceemployee',compact('attendances'));
  }
  public function viewallempattendance(Request $request){
    $empgroups=Addempgroup::all();
    $customarray=array();
    if($request->has('empgroupid')){
      
    $employees=employeedetail::where('empgroupid',$request->empgroupid)
              ->where('emptype','Employee')
              ->get();
      $totmonthdate=cal_days_in_month(CAL_GREGORIAN,$request->frommonth,$request->fromyear);
      $totholiday=Empdailyattendancegroup::whereYear('date', '=', $request->fromyear)
              ->whereMonth('date', '=', $request->frommonth)
              ->where('type','HOLIDAY')
              ->count();
      //return compact('totmonthdate','totholiday');


    foreach ($employees as $key => $employee) {
            $empttotpresent=Empdailyattendancegroupdetail::where('employee_id',$employee->id)
                    ->whereYear('attendancedate', '=', $request->fromyear)
                    ->whereMonth('attendancedate', '=', $request->frommonth)
                    ->where('present','Y')
                    ->count();
            $empttotabsent=Empdailyattendancegroupdetail::where('employee_id',$employee->id)
                    ->whereYear('attendancedate', '=', $request->fromyear)
                    ->whereMonth('attendancedate', '=', $request->frommonth)
                    ->where('present','N')
                    ->count();
           $thismonthleave=Approvedleave::where('employee_id',$employee->id)
                    ->whereYear('date', '=', $request->fromyear)
                    ->whereMonth('date', '=', $request->frommonth)
                    ->count();
          $emptotholiday=Empdailyattendancegroupdetail::where('employee_id',$employee->id)
                    ->whereYear('attendancedate', '=', $request->fromyear)
                    ->whereMonth('attendancedate', '=', $request->frommonth)
                    ->where('present','H')
                    ->count();
          //return $emptotholiday;
          $totleavetaken=Approvedleave::where('employee_id',$employee->id)->count();
          $totalleave=15;
          $totalbalanceleave=$totalleave-$totleavetaken;
          //return $totmonthdate;
          $customarray[]=array('employee'=>$employee,'empttotpresent'=>$empttotpresent,'empttotabsent'=>$empttotabsent,'thismonthleave'=>$thismonthleave,'totleavetaken'=>$totleavetaken,'totalleave'=>$totalleave,'totalbalanceleave'=>$totalbalanceleave,'totmonthdate'=>$totmonthdate,'totholiday'=>$totholiday,'year'=>$request->fromyear,'month'=>$request->frommonth,'emptotholiday'=>$emptotholiday);

        
    }
    }
    //return $customarray;
    return view('hr.viewallempattendance',compact('empgroups','customarray'));
}
  public function approveleaveall(Request $request,$id){
    $approveleave=Applyleave::find($id);
    $approveleave->status="ACCEPTED";
    $approveleave->fromdate=$request->fromdate;
    $approveleave->todate=$request->todate;
    $approveleave->save();
    return redirect('/leave/viewalleave');

  }
  public function rejectleaveall(Request $request,$id){
    $approveleave=Applyleave::find($id);
    $approveleave->status="REJECTED";
    $approveleave->fromdate=$request->fromdate;
    $approveleave->todate=$request->todate;
    $approveleave->save();
    return redirect('/leave/viewalleave');

  }
  public function approveleave(Request $request,$id){
     return $request->all();
    $approveleave=Applyleave::find($id);
    $approveleave->status="ACCEPTED";
    $approveleave->fromdate=$request->fromdate;
    $approveleave->todate=$request->todate;
    $approveleave->save();
    return redirect('/leave/viewpendingleves');

  }
  public function rejectleave(Request $request,$id){
    $approveleave=Applyleave::find($id);
    $approveleave->status="REJECTED";
    $approveleave->save();
    return redirect('/leave/viewpendingleves');

  }
  public function viewapplicantleave($id){
      $leave=Applyleave::select('applyleaves.*','users.name')
        ->leftJoin('users','applyleaves.appliername','=','users.id')
        ->find($id);

      $leavetypes=Addleavetype::all();
      $users=User::all();
      //return $leave;
    return view('hr.viewapplicantleave',compact('leave','leavetypes','users'));
  }
   public function viewapplicantleaveall($id){
      $leave=Applyleave::select('applyleaves.*','users.name')
        ->leftJoin('users','applyleaves.appliername','=','users.id')
        ->find($id);

      $leavetypes=Addleavetype::all();
      $users=User::all();
      //return $leave;
    return view('hr.viewapplicantleaveall',compact('leave','leavetypes','users'));
  }
  public function viewpendingleves(){
    $viewapplies=Applyleave::select('applyleaves.*','u1.name as name','addleavetypes.leavetypename','u2.name as releivername')
          ->leftJoin('users as u1','applyleaves.appliername','=','u1.id')
          ->leftJoin('addleavetypes','applyleaves.laevetypeid','=','addleavetypes.id')
          ->leftJoin('users as u2','applyleaves.relieverid','=','u2.id')
          ->where('applyleaves.status','PENDING','desc')
          ->get();
    //return $viewapplies;
    return view('hr.viewpendingleves',compact('viewapplies'));

  }
  public function viewalleave(){
    $viewapplies=Applyleave::select('applyleaves.*','u1.name as name','addleavetypes.leavetypename','u2.name as releivername')
          ->leftJoin('users as u1','applyleaves.appliername','=','u1.id')
          ->leftJoin('users as u2','applyleaves.relieverid','=','u2.id')
          ->leftJoin('addleavetypes','applyleaves.laevetypeid','=','addleavetypes.id')
          ->where('status','REJECTED')
          ->orWhere('status', 'ACCEPTED')
          ->get();
    //return $viewapplies;
    return view('hr.viewalleave',compact('viewapplies'));

  }
  public function saveleaveapply(Request $request){
    //return $request->all();
    $apply=new Applyleave();
    $apply->purpose=$request->purpose;
    $apply->laevetypeid=$request->laevetypeid;
    $apply->otherreason=$request->otherreason;
    $apply->fullhalf=$request->fullhalf;
    $apply->employeeid=Auth::user()->employee_id;
    $apply->relieverid=$request->relieverid;
    $apply->fromdate=$request->fromdate;
    $apply->todate=$request->todate;
    $rarefile = $request->file('photo');    
        if($rarefile!=''){
        $raupload = public_path() .'/img/leavephoto/';
        $rarefilename=time().'.'.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$rarefilename);
        $apply->photo = $rarefilename;
        }
    $apply->appliername=Auth::id();
    $apply->save();
    Session::flash('msg','Leave Applied Successfully');
    return back();

  }
  public function saveuserleaveapply(Request $request){
    //return $request->all();
    $apply=new Applyleave();
    $apply->purpose=$request->purpose;
    $apply->laevetypeid=$request->laevetypeid;
    $apply->otherreason=$request->otherreason;
    $apply->fullhalf=$request->fullhalf;
    $apply->employeeid=Auth::user()->employee_id;
    $apply->relieverid=$request->relieverid;
    $apply->fromdate=$request->fromdate;
    $apply->todate=$request->todate;
    $rarefile = $request->file('photo');    
        if($rarefile!=''){
        $raupload = public_path() .'/img/leavephoto/';
        $rarefilename=time().'.'.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$rarefilename);
        $apply->photo = $rarefilename;
        }
    $apply->appliername=Auth::id();
    $apply->save();
    Session::flash('msg','Leave Applied Successfully');
    return back();

  }
  public function applyleave(){
    $leavetypes=Addleavetype::all();
    $users=User::all();
    return view('hr.applyleave',compact('leavetypes','users'));
  }
  public function updatedeductiontype(Request $request)
   {
       $updatesalarydeduction=Salarydeduction::find($request->did);
       $updatesalarydeduction->deductionname=$request->deductionname;
       $updatesalarydeduction->save();
       Session::flash('msg','Salarydeduction Updated Successfully');
       return back();
   }
  public function saveaddsalarydeduction(Request $request){
      $Salarydeduction=new Salarydeduction();
       $Salarydeduction->deductionname=$request->deductionname;
       $Salarydeduction->save();
       Session::flash('msg','Salarydeduction Saved Successfully');
       return back();
  }
  public function addsalarydecuction(){
    $addsalarydeductions=Salarydeduction::all();
  return view('hr.addsalarydeduction',compact('addsalarydeductions'));
  }
  public function saveaddleavetype(Request $request){
      $addleavetype=new Addleavetype();
       $addleavetype->leavetypename=$request->leavetypename;
       $addleavetype->save();
       Session::flash('msg','Leavetype Saved Successfully');
       return back();
  }
   public function updatleavetype(Request $request)
   {
       $updateleavetype=Addleavetype::find($request->did);
       $updateleavetype->leavetypename=$request->leavetypename;
       $updateleavetype->save();
       Session::flash('msg','Leavetype Updated Successfully');
       return back();
   }
  public function addleavetype(){
  $addleavetypes=Addleavetype::all();
  return view('hr.addleavetype1',compact('addleavetypes'));
}
   public static function changedateformat($date)
   {
    $originalDate = $date;
    $newDate = date("d-m-Y", strtotime($originalDate));
    return $newDate;
   }
  public static function changedatetimeformat($datetime)
   {
    $originalDate = $datetime;
    $newDate = date("d-m-Y H:i:s", strtotime($originalDate));
    return $newDate;
   }
  public function updateattendance(Request $request){
       $attendance=Dailyattendancegroup::find($request->uid);
       $attendance->itemdescription=$request->itemdescription;
       $attendance->unit=$request->unit;
       $attendance->quantity=$request->quantity;
       $attendance->amount=$request->amount;
       $attendance->workassignment=$request->workassignment;
       $attendance->remarks=$request->remarks;
       $attendance->save();
       Session::flash('msg','Attendance Updated Successfully');
       return back();
  }
  public function admininlabour()
  {
     return view('labour.home');
  }
  public function updategroupdetail(Request $request)
   {
       $groupdetails=Dailyattendancegroupdetail::find($request->did);
       $groupdetails->totnoofhour=$request->totnoofhour;
       $groupdetails->save();
       Session::flash('msg','Group Updated Successfully');
       return back();
   }
  public function viewattendancegroup(Request $request,$id){
      $editdailyattendancegroup=Dailyattendancegroup::find($id);
      //return $editdailyattendancegroup;
     $dailyattendanceimages=Dailyattendanceimage::where('attendance_id',$id)->get();
     //return $dailyattendanceimages;
     $dailyattendancegroupdetails=Dailyattendancegroupdetail::select('dailyattendancegroupdetails.*','employeedetails.employeename')
                 ->where('dailyattendanceid',$id)
                ->leftJoin('employeedetails','dailyattendancegroupdetails.employee_id','=','employeedetails.id')
                                 ->get();
    //return $dailyattendancegroupdetails;
    $groups=Addgroup::all();
    return view('hr.viewattendancegroup',compact('groups','editdailyattendancegroup','dailyattendanceimages','dailyattendancegroupdetails'));
  }
  public function labourviewattendancegroup(Request $request,$id){
      $editdailyattendancegroup=Dailyattendancegroup::find($id);
     $dailyattendanceimages=Dailyattendanceimage::where('attendance_id',$id)->get();
     $dailyattendancegroupdetails=Dailyattendancegroupdetail::select('dailyattendancegroupdetails.*','employeedetails.employeename')
                 ->where('dailyattendanceid',$id)
                ->leftJoin('employeedetails','dailyattendancegroupdetails.employee_id','=','employeedetails.id')
                                 ->get();
    //return $dailyattendancegroupdetails;
    $groups=Addgroup::all();
    return view('labour.viewattendancegroup',compact('groups','editdailyattendancegroup','dailyattendanceimages','dailyattendancegroupdetails'));
  }
  public function updateattendancephoto(Request $request)
       {
        $attendancegroup=Dailyattendanceimage::find($request->uid);
        $rarefile = $request->file('photo');    
        if($rarefile!=''){
        $raupload = public_path() .'/image/dailyattendancegroup/';
        $rarefilename=time().'.'.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$rarefilename);
        $attendancegroup->photo = $rarefilename;
        }
        $attendancegroup->save();
        Session::flash('msg','Photo Updated Successfully');
        return back();
       }
  public function updateattendancereportgrp(Request $request,$id){
    $attendancegroup=Dailyattendancegroup::find($id);
    $attendancegroup->groupid=$request->groupid;
    $attendancegroup->entrytime=$request->entrytime;
    $attendancegroup->workassignment=$request->workassignment;
    $attendancegroup->departuretime=$request->departuretime;
    $attendancegroup->noofworkerspresent=$request->noofworkerspresent;
    $attendancegroup->wages=$request->wages;
    $attendancegroup->ot=$request->ot;
    $attendancegroup->remarks=$request->remarks;
    $attendancegroup->itemdescription=$request->itemdescription;
    $attendancegroup->unit=$request->unit;
    $attendancegroup->quantity=$request->quantity;
    $attendancegroup->amount=$request->amount;
    $attendancegroup->save();
    Session::flash('msg','Document Update Successfully');
    return back();

  }
  public function editdailyattendancegroup($id){
     $editdailyattendancegroup=Dailyattendancegroup::find($id);
     $dailyattendanceimages=Dailyattendanceimage::where('attendance_id',$id)->get();
     //return $dailyattendanceimages;
    $groups=Addgroup::all();
    //return $groups;
    return view('hr.editdailyattendancegroup',compact('groups','editdailyattendancegroup','dailyattendanceimages'));
  }
  public function viewallattendance(Request $request){

    $allattendancegroups=Dailyattendancegroup::select('dailyattendancegroups.*','addgroups.groupname')
    ->leftjoin('addgroups','dailyattendancegroups.groupid','=','addgroups.id');
      if($request->has('group')){
         $allattendancegroups=$allattendancegroups->where('groupid',$request->group);
      }
    $allattendancegroups=$allattendancegroups->get();
    //return $allattendancegroups;
    $addgroups=Addgroup::all();
    //return $addgroups;
    //return $addgroups;
    return view('hr.viewallattendancegroup',compact('allattendancegroups','addgroups'));
  }
  public function labourviewallattendance(Request $request){

    $allattendancegroups=Dailyattendancegroup::select('dailyattendancegroups.*','addgroups.groupname')
    ->leftjoin('addgroups','dailyattendancegroups.groupid','=','addgroups.id');
      if($request->has('group')){
         $allattendancegroups=$allattendancegroups->where('groupid',$request->group);
      }
    $allattendancegroups=$allattendancegroups->get();
    //return $allattendancegroups;
    $addgroups=Addgroup::all();
    //return $addgroups;
    //return $addgroups;
    return view('labour.viewallattendancegroup',compact('allattendancegroups','addgroups'));
  }
 public function saveattendancereportgrp(Request $request){
 //return $request->all();
$attendancegroup=new Dailyattendancegroup();
$attendancegroup->groupid=$request->groupid;
$attendancegroup->entrytime=$request->entrytime;
$attendancegroup->workassignment=$request->workassignment;
$attendancegroup->departuretime=$request->departuretime;
$attendancegroup->noofworkerspresent=$request->noofworkerspresent;
$attendancegroup->twages=$request->twages;
$attendancegroup->tothour=$request->tothour;
$attendancegroup->tot=$request->tot;
$attendancegroup->tamt=$request->tamt;
$attendancegroup->nof=$request->nof;
$attendancegroup->remarks=$request->remarks;
$attendancegroup->itemdescription=$request->itemdescription;
$attendancegroup->unit=$request->unit;
$attendancegroup->quantity=$request->quantity;
$attendancegroup->amount=$request->amount;
// $rarefile = $request->file('photo');
//         if($rarefile!='')
//         {
//         $u=time().uniqid(rand());
//         $raupload ="image/dailyattendancegroup";
//         $uplogoimg=$u.$rarefile->getClientOriginalName();
//         $success=$rarefile->move($raupload,$uplogoimg);
//         $attendancegroup->photo = $uplogoimg;
//         }
$attendancegroup->save();
Session::flash('message','Document Uploaded Successfully');
$attendanceid=$attendancegroup->id;

    $galleryimage=$request['photo'];
    if($galleryimage)
    {
        foreach($galleryimage as $gi){
        $attendanceimage = new Dailyattendanceimage();
        if($gi!=''){
          $raupload1 ="image/dailyattendancegroup";
        $rarefilename1=time().'.'.$gi->getClientOriginalName();
        $success1=$gi->move($raupload1,$rarefilename1);
        $attendanceimage->photo  = $rarefilename1;
        } 
      $attendanceimage->attendance_id  =$attendanceid;
      $attendanceimage->save();
       
    }

    }
    $count=count($request->id);
    for ($i=0; $i < $count ; $i++) { 
          
           $attendancedetail=new Dailyattendancegroupdetail();
           $attendancedetail->dailyattendanceid=$attendanceid;
           $attendancedetail->employee_id=$request->id[$i];
           $attendancedetail->totnoofday=$request->totnoofday[$i];
           $attendancedetail->othours=$request->othours[$i];
           $attendancedetail->wages=$request->wages[$i];
           $attendancedetail->otamount=$request->otamount[$i];
           $attendancedetail->totamt=$request->totamt[$i];
           $attendancedetail->save();
           Session::flash('msg','Save successfully');
        }
    

return redirect('/attendance/viewallattendance');
}
public function saveattendancereportempgrp(Request $request){
 //return $request->all();
$attendancegroup=new Dailyattendancegroup();
$attendancegroup->groupid=$request->groupid;
$attendancegroup->entrytime=$request->entrytime;
$attendancegroup->workassignment=$request->workassignment;
$attendancegroup->departuretime=$request->departuretime;
$attendancegroup->noofworkerspresent=$request->noofworkerspresent;
$attendancegroup->twages=$request->twages;
$attendancegroup->tothour=$request->tothour;
$attendancegroup->tot=$request->tot;
$attendancegroup->tamt=$request->tamt;
$attendancegroup->nof=$request->nof;
$attendancegroup->remarks=$request->remarks;
$attendancegroup->itemdescription=$request->itemdescription;
$attendancegroup->unit=$request->unit;
$attendancegroup->quantity=$request->quantity;
$attendancegroup->amount=$request->amount;
// $rarefile = $request->file('photo');
//         if($rarefile!='')
//         {
//         $u=time().uniqid(rand());
//         $raupload ="image/dailyattendancegroup";
//         $uplogoimg=$u.$rarefile->getClientOriginalName();
//         $success=$rarefile->move($raupload,$uplogoimg);
//         $attendancegroup->photo = $uplogoimg;
//         }
$attendancegroup->save();
Session::flash('message','Document Uploaded Successfully');
$attendanceid=$attendancegroup->id;

    $galleryimage=$request['photo'];
    if($galleryimage)
    {
        foreach($galleryimage as $gi){
        $attendanceimage = new Dailyattendanceimage();
        if($gi!=''){
          $raupload1 ="image/dailyattendancegroup";
        $rarefilename1=time().'.'.$gi->getClientOriginalName();
        $success1=$gi->move($raupload1,$rarefilename1);
        $attendanceimage->photo  = $rarefilename1;
        } 
      $attendanceimage->attendance_id  =$attendanceid;
      $attendanceimage->save();
       
    }

    }
    $count=count($request->id);
    for ($i=0; $i < $count ; $i++) { 
          
           $attendancedetail=new Dailyattendancegroupdetail();
           $attendancedetail->dailyattendanceid=$attendanceid;
           $attendancedetail->employee_id=$request->id[$i];
           $attendancedetail->totnoofday=$request->totnoofday[$i];
           $attendancedetail->othours=$request->othours[$i];
           $attendancedetail->wages=$request->wages[$i];
           $attendancedetail->otamount=$request->otamount[$i];
           $attendancedetail->totamt=$request->totamt[$i];
           $attendancedetail->save();
           Session::flash('msg','Save successfully');
        }
    

return redirect('/attendance/viewallattendance');
}
public function saveattendanceemployee(Request $request){
  //return $request->all();
  $date=$request->date;
  $attendancedate=$request->attendancedate;
  $empgroupid=$request->empgroupid;
  $chk=Empdailyattendancegroup::where('date',$date)
      ->where('empgroupid',$empgroupid)
      ->count(); 
  //return $chk;
      
      if($chk == 0)
      {
        $attendanceempgroup=new Empdailyattendancegroup();
        $attendanceempgroup->empgroupid=$request->empgroupid;
        $attendanceempgroup->date=$request->date;
        $attendanceempgroup->type=$request->type;
        $attendanceempgroup->entryby=Auth::id();
        $attendanceempgroup->save();
        $attendanceid=$attendanceempgroup->id;
   $count=count($request->id);
    for ($i=0; $i < $count ; $i++) { 
          $chk=Empdailyattendancegroupdetail::where('attendancedate',$attendancedate)
          ->where('dailyattendanceid',$empgroupid)
          ->count();
          //return $chk;
          if($chk == 0){
           $attendancedetail=new Empdailyattendancegroupdetail();
           $attendancedetail->dailyattendanceid=$attendanceid;
           $attendancedetail->employee_id=$request->id[$i];
           $attendancedetail->employeename=$request->employeename[$i];
           $attendancedetail->attendancedate=$request->attendancedate[$i];
           $attendancedetail->present=$request->present[$i];
           $attendancedetail->halffull=$request->halffull[$i];
           $attendancedetail->save();

          }
           
           
        }
      Session::flash('msg','Save successfully');
      return back();

      }else{
        Session::flash('error','Duplicate entry');
        return back();
      }



}
public function saverecattendanceemployee(Request $request){
  //return $request->all();
  $date=$request->date;
  $attendancedate=$request->attendancedate;
  $empgroupid=$request->empgroupid;
  $chk=Empdailyattendancegroup::where('date',$date)
      ->where('empgroupid',$empgroupid)
      ->count(); 
  //return $chk;
      
      if($chk == 0)
      {
        $attendanceempgroup=new Empdailyattendancegroup();
        $attendanceempgroup->empgroupid=$request->empgroupid;
        $attendanceempgroup->date=$request->date;
        $attendanceempgroup->type=$request->type;
        $attendanceempgroup->entryby=Auth::id();
        $attendanceempgroup->save();
        $attendanceid=$attendanceempgroup->id;
   $count=count($request->id);
    for ($i=0; $i < $count ; $i++) { 
          $chk=Empdailyattendancegroupdetail::where('attendancedate',$attendancedate)
          ->where('dailyattendanceid',$empgroupid)
          ->count();
          //return $chk;
          if($chk == 0){
           $attendancedetail=new Empdailyattendancegroupdetail();
           $attendancedetail->dailyattendanceid=$attendanceid;
           $attendancedetail->employee_id=$request->id[$i];
           $attendancedetail->employeename=$request->employeename[$i];
           $attendancedetail->attendancedate=$request->attendancedate[$i];
           $attendancedetail->present=$request->present[$i];
           $attendancedetail->halffull=$request->halffull[$i];
           $attendancedetail->save();

          }
           
           
        }
      Session::flash('msg','Save successfully');
      return back();

      }else{
        Session::flash('error','Duplicate entry');
        return back();
      }



}
  public function adddailyattendance(){
    $groups=Addgroup::all();
    return view('hr.dailyattendance',compact('groups'));
  }
  public function adddailyempattendance(Request $request){
    $empgroups=Addempgroup::all();
    return view('hr.employeedailyattendance',compact('empgroups'));
  }
  public function recadddailyempattendance(Request $request){
    $empgroups=Addempgroup::all();
    return view('recadddailyempattendance',compact('empgroups'));
  }
  public function labouradddailyattendance(){
    $groups=Addgroup::all();
    return view('labour.dailyattendance',compact('groups'));
  }
   public function laboursaveattendancereportgrp(Request $request){
 //return $request->all();
$attendancegroup=new Dailyattendancegroup();
$attendancegroup->groupid=$request->groupid;
$attendancegroup->entrytime=$request->entrytime;
$attendancegroup->workassignment=$request->workassignment;
$attendancegroup->departuretime=$request->departuretime;
$attendancegroup->noofworkerspresent=$request->noofworkerspresent;
$attendancegroup->twages=$request->twages;
$attendancegroup->tothour=$request->tothour;
$attendancegroup->tot=$request->tot;
$attendancegroup->tamt=$request->tamt;
$attendancegroup->nof=$request->nof;
$attendancegroup->remarks=$request->remarks;
$attendancegroup->itemdescription=$request->itemdescription;
$attendancegroup->unit=$request->unit;
$attendancegroup->quantity=$request->quantity;
$attendancegroup->amount=$request->amount;
// $rarefile = $request->file('photo');
//         if($rarefile!='')
//         {
//         $u=time().uniqid(rand());
//         $raupload ="image/dailyattendancegroup";
//         $uplogoimg=$u.$rarefile->getClientOriginalName();
//         $success=$rarefile->move($raupload,$uplogoimg);
//         $attendancegroup->photo = $uplogoimg;
//         }
$attendancegroup->save();
Session::flash('message','Document Uploaded Successfully');
$attendanceid=$attendancegroup->id;

    $galleryimage=$request['photo'];
    if($galleryimage)
    {
        foreach($galleryimage as $gi){
        $attendanceimage = new Dailyattendanceimage();
        if($gi!=''){
          $raupload1 ="image/dailyattendancegroup";
        $rarefilename1=time().'.'.$gi->getClientOriginalName();
        $success1=$gi->move($raupload1,$rarefilename1);
        $attendanceimage->photo  = $rarefilename1;
        } 
      $attendanceimage->attendance_id  =$attendanceid;
      $attendanceimage->save();
       
    }

    }
    $count=count($request->id);
    for ($i=0; $i < $count ; $i++) { 
          
           $attendancedetail=new Dailyattendancegroupdetail();
           $attendancedetail->dailyattendanceid=$attendanceid;
           $attendancedetail->employee_id=$request->id[$i];
           $attendancedetail->totnoofday=$request->totnoofday[$i];
           $attendancedetail->othours=$request->othours[$i];
           $attendancedetail->wages=$request->wages[$i];
           $attendancedetail->otamount=$request->otamount[$i];
           $attendancedetail->totamt=$request->totamt[$i];
           $attendancedetail->save();
           Session::flash('msg','Save successfully');
        }
    

return redirect('/attendance/labourviewallattendance');
}
  public function updategroup(Request $request)
   {
       $updategroup=Addgroup::find($request->did);
       $updategroup->groupname=$request->groupname;
       $updategroup->save();
       Session::flash('msg','Group Updated Successfully');
       return back();
   }
   public function updateempgroup(Request $request)
   {
       $updategroup=Addempgroup::find($request->did);
       $updategroup->groupname=$request->groupname;
       $updategroup->save();
       Session::flash('msg','Group Updated Successfully');
       return back();
   }
  public function saveaddgroup(Request $request){
      $addgroup=new Addgroup();
       $addgroup->groupname=$request->groupname;
       $addgroup->save();
       Session::flash('msg','Group Saved Successfully');
       return back();
  }
  public function saveaddempgroup(Request $request){
      $addgroup=new Addempgroup();
       $addgroup->groupname=$request->groupname;
       $addgroup->save();
       Session::flash('msg','Group Saved Successfully');
       return back();
  }
  public function saverecaddempgroup(Request $request){
      $addgroup=new Addempgroup();
       $addgroup->groupname=$request->groupname;
       $addgroup->save();
       Session::flash('msg','Group Saved Successfully');
       return back();
  }
public function addgroup(){
  $addgroups=Addgroup::all();
  return view('hr.addgroup',compact('addgroups'));
}
public function recaddempgroup(){
  $addempgroups=Addempgroup::all();
  return view('recaddempgroup',compact('addempgroups'));
}
public function addempgroup(){
  $addempgroups=Addempgroup::all();
  return view('hr.addempgroup',compact('addempgroups'));
}
public function labouraddgroup(){
  $addgroups=Addgroup::all();
  return view('labour.addgroup',compact('addgroups'));
}
public function deleteempotherdoc(Request $request,$id){
 employeeotherdocument::find($id)->delete();

       Session::flash('error','Document Deleted Successfully');
  return back();
}
    public function getalluserlocation(Request $request)
    {
       
$sub = attendance::select('attendances.*','users.id as user_id','users.name')
    
    ->leftJoin('users','attendances.userid','=','users.id')
    
    ->orderBy('attendances.time', 'desc');
    
    
    $userlocations = DB::table(DB::raw("({$sub->toSql()}) as sub"))
    ->where('sub.created_at', '>=',$request->date.' 00:00:00')
    ->where('sub.created_at', '<=',$request->date.' 23:59:00')
    ->get()
    ->unique('user_id')
    ->toArray();
    
    
    $userlocations=array_values($userlocations);
    
  //  ->unique('users.id');

    return response()->json($userlocations);
    }


public function allemployeemapview($date)
{
    return view('hr.allempmapview',compact('date'));
}
public function showallempmapview(Request $request)
{
      $date=$request->date;
      return redirect('/attendance/mapview/'.$date);
     
}
public function mapview()
{
       return view('hr.mapview');
}
public function showdetaillocations($uid,$date)
    {
         $addressarr=array();
         $p=attendance::where('userid',$uid)
                 ->where('created_at', '>=',$date.' 00:00:00')
                 ->where('created_at', '<=',$date.' 23:59:59')
                 ->get();

       //return $p;
          foreach ($p as $key => $value) {
try{
$url = 'https://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($value->latitude).','.trim($value->longitude).'&key=AIzaSyAPpd5bBWsGyPvEBgmB_3-QjTQ8bP5yIW0';
     $json = @file_get_contents($url);
     $data=json_decode($json);
     $status = $data->status;
     if($status=="OK")
     {
       $fulladdress=$data->results[0]->formatted_address;
     }
     else
     {
       $fulladress="NOT FOUND";
     }
     $arr=array('userid'=>$value->userid,'latitude'=>$value->latitude,'longitude'=>$value->longitude,'deviceid'=>$value->deviceid,'battery'=>$value->battery,'address'=>$fulladdress,'created_at'=>$value->created_at,'time'=>$value->time,'mode'=>$value->mode,'status'=>$value->status,'version'=>$value->version);
     $addressarr[]=$arr;
     
    }
      catch (\Exception $e){
                 $arr=array('userid'=>$value->userid,'latitude'=>$value->latitude,'longitude'=>$value->longitude,'deviceid'=>$value->deviceid,'battery'=>$value->battery,'address'=>'','created_at'=>$value->created_at,'time'=>$value->time,'mode'=>$value->mode,'status'=>$value->status,'version'=>$value->version);
          $addressarr[]=$arr; 
    }
    }
  
     
     $user=User::find($uid);
     $name=$user->name;

     return view('hr.showdetaillocationuser',compact('addressarr','name','date'));
    }
public function showattendance(Request $request)
    {
         if (Auth::user()->usertype=='MASTER ADMIN') {
             $users=User::all();
         }
         else
         {
             $auth=Auth::id();
                 $myusers=userunderhod::select('userunderhods.userid')->where('hodid',$auth)->get();
             $users=User::whereIn('id',$myusers)->get();
         }
          
           $all=array();
          foreach ($users as $key => $user) {
              $uid=$user->id;
              $uname=$user->name;
             
                $p=attendance::where('userid',$uid)
                 ->where('created_at', '>=',$request->date.' 00:00:00')
                 ->where('created_at', '<=',$request->date.' 23:59:59')
                 ->get();
                 
                 
              
             
              
              if(count($p)>0)
              {
                $present='PRESENT';
              }
              else
              {
                 $present='ABSENT';
              }
              $a=array('uid'=>$uid,'uname'=>$uname,'present'=>$present);
              $all[]=$a;
          }

          return response()->json($all);
    }
      public function getuserlocation(Request $request)
    {
         $userlocations=attendance::select('attendances.*','users.name')
                        ->leftJoin('users','attendances.userid','=','users.id')
                        ->where('attendances.userid',$request->uid)
                        ->where('attendances.created_at', '>=',$request->date.' 00:00:00')
                        ->where('attendances.created_at', '<=',$request->date.' 23:59:00')

                        ->get();
         
         return response()->json($userlocations);
    }
   public function userlocation($uid,$date)
    {

        $user=User::find($uid);
        $uname=$user->name;
        return view('hr.userlocations',compact('uid','date','uname'));
    }
     public function attendancereport(Request $request)
     {
         $users=User::where('active','1')->get();
         if ($request->has('user') && $request->has('fromdate') && $request->has('todate')) {
        $name=User::FindOrFail($request->user)->name;

        $datefrom = Carbon::parse($request->fromdate);
        $dateto = Carbon::parse($request->todate);
        $totalDuration =$datefrom->diffInDays($dateto);
        $all=array();
        
        for ($x = 0; $x <= $totalDuration; $x++) {
             if ($x==0) {
                $date=$datefrom;
                
             }
             else
             {
               $date = $datefrom->addDays(1);
               
             }

             
             $p=attendance::where('userid',$request->user)
                 ->where('created_at', '>=',$date)
                 ->where('created_at', '<=',$date->format('Y-m-d').' 23:59:59')
                 ->get();
            //dd($p);

              if(count($p)>0)
              {
                $present='PRESENT';
              }
              else
              {
                 $present='ABSENT';
              }  

           $a=array('date'=>$date->format('Y-m-d'),'status'=>$present,'total'=>count($p),'locations'=>$p,'userid'=>$request->user);

             $all[]=$a;
             
             } 

             $count = 0;
foreach ($all as $type) {
    if($type['status']=='PRESENT'){
      ++$count;
    }
}
return view('hr.attendancereport',compact('users','all','totalDuration','count','name'));
           
         }

return view('hr.attendancereport',compact('users'));
         
     }
    public function viewattendance(Request $request)
    {

         $all=array();
         if ($request->has('date')) {
             if (Auth::user()->usertype=='MASTER ADMIN' || Auth::user()->usertype=='HR'  ) {
             $users=User::where('active','1')->get();
         }
         
          
           
          foreach ($users as $key => $user) {
              $uid=$user->id;
              $uname=$user->name;
             
                $p=attendance::where('userid',$uid)
                 ->where('created_at', '>=',$request->date.' 00:00:00')
                 ->where('created_at', '<=',$request->date.' 23:59:59')
                 ->get();
                 
                 
              
             
              
              if(count($p)>0)
              {
                $present='PRESENT';
              }
              else
              {
                 $present='ABSENT';
              }
              $a=array('uid'=>$uid,'uname'=>$uname,'present'=>$present);
              $all[]=$a;
          }
           
         }
         $dt=$request->date;
         return view('hr.viewattendance',compact('all','dt'));
    }

public function updatedepartment(Request $request){
$id=$request->depid;
$departments=department::find($id);
$departments->departmentname=$request->departmentname;
$departments->save();
designation::where('deptartment_id',$id)->delete();
  $count=count($request->designationname);
  if($count>0){
    for($i=0;$i<$count;$i++){
      if($request->designationname[$i]!=''){
        $designation=new designation();
        $designation->deptartment_id=$id;
        $designation->designationname=$request->designationname[$i];
        $designation->save();
      }
    }
  }
  return back();
}
public function ajaxgetdept(Request $request){
 $departments=department::find($request->depid);
 $designations=designation::select('designationname')
                ->where('deptartment_id',$request->depid)
                ->get();

 return response()->json(compact('departments','designations'));
}
public function saveemployeedetails(Request $request){
  //return $request->all();
$request->validate([

    //'empcodeno' => 'required|unique:employeedetails|max:20',
]);
      $check=employeedetail::where('empcodeno',$request->empcodeno)
            ->count();

  if($check == 0)
  {

        $employee=new employeedetail();
        $employee->employeename=$request->employeename;
        $employee->empcodeno=$request->empcodeno;
        $employee->qualification=$request->qualification;
        $employee->experencecomp=$request->experencecomp;
        $employee->dob=$request->dob;
        $employee->email=$request->email;
        $employee->gender=$request->gender;
        $employee->phone=$request->phone;
        $employee->adharno=$request->adharno;
        $employee->bloodgroup=$request->bloodgroup;
        $employee->alternativephonenumber=$request->alternativephonenumber;
        $employee->presentaddress=$request->presentaddress;
        $employee->permanentaddress=$request->permanentaddress;
        $employee->fathername=$request->fathername;
        $employee->maritalstatus=$request->maritalstatus;
        $employee->emptype=$request->emptype;
        $employee->wagescode=$request->wagescode;
        $employee->wages=$request->wages;
        $employee->wagesperhour=$request->wagesperhour;
        $employee->groupid=$request->groupid;
        $employee->empgroupid=$request->empgroupid;
        $employee->emptotalwages=$request->emptotalwages;
        $employee->empwagescode=$request->empwagescode;
        $employee->basicsalary=$request->basicsalary;
        $employee->conveyanceall=$request->conveyanceall;
        $employee->dearnessall=$request->dearnessall;
        $employee->medicalall=$request->medicalall;
        $employee->houserentall=$request->houserentall;
        $employee->professionaltax=$request->professionaltax;
        $employee->incometax=$request->incometax;
        $employee->welfarefund=$request->welfarefund;
        $employee->noofhour=$request->noofhour;
        // $employee->pf=$request->pf;
        // $employee->esic=$request->esic;
        // $employee->advance=$request->advance;
        // $employee->salaryadvance=$request->salaryadvance;
        // $employee->misc=$request->misc;
        // $employee->wages=$request->empwages;
        
        // $employee->wagesperhour=$request->empwagesperhour;
        //return $employee;
        $employee->save();

        $eid=$employee->id;
   
        $employeecompany=new employeecompanydetail();
        $employeecompany->employee_id=$eid;
        $employeecompany->department=$request->department;
        $employeecompany->designation=$request->designation;
        $employeecompany->dateofjoining=$request->dateofjoining;
        $employeecompany->dateofconfirmation=$request->dateofconfirmation;
        $employeecompany->joinsalary=$request->joinsalary;
        $employeecompany->totalyrexprnc=$request->totalyrexprnc;
        $employeecompany->ofcemail=$request->ofcemail;
        $employeecompany->cugmob=$request->cugmob;
        $employeecompany->skillsets=$request->skillsets;
        $employeecompany->location=$request->location;
        $employeecompany->reportingto=$request->reportingto;
        $employeecompany->save();

        $employeebankaccount=new employeebankaccountsdetail();
        $employeebankaccount->employee_id=$eid;
        $employeebankaccount->accountholdername=$request->accountholdername;
        $employeebankaccount->accountnumber=$request->accountnumber;
        $employeebankaccount->bankname=$request->bankname;
        $employeebankaccount->ifsc=$request->ifsc;
        $employeebankaccount->pan=$request->pan;
        $employeebankaccount->branch=$request->branch;
        $employeebankaccount->pfaccount=$request->pfaccount;
        $employeebankaccount->save();

        $employeedocument=new employeedocument();
        $employeedocument->employee_id=$eid;
        $rarefile = $request->file('resume');
        if($rarefile!='')
        {
        $u=time().uniqid(rand());
        $raupload ="image/resume";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $employeedocument->resume = $uplogoimg;
        }
        $rarefile = $request->file('offerletter');
        if($rarefile!='')
        {
        $u=time().uniqid(rand());
        $raupload ="image/offerletter";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $employeedocument->offerletter = $uplogoimg;
        }
        $rarefile = $request->file('joiningletter');
        if($rarefile!='')
        {
        $u=time().uniqid(rand());
        $raupload ="image/joiningletter";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $employeedocument->joiningletter = $uplogoimg;
        }
        $rarefile = $request->file('agreementpaper');
        if($rarefile!='')
        {
        $u=time().uniqid(rand());
        $raupload ="image/agreementpaper";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $employeedocument->agreementpaper = $uplogoimg;
        }
        $rarefile = $request->file('idproof');
        if($rarefile!='')
        {
        $u=time().uniqid(rand());
        $raupload ="image/idproof";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $employeedocument->idproof = $uplogoimg;
        }
        $rarefile = $request->file('aadhaarcard');
        if($rarefile!='')
        {
        $u=time().uniqid(rand());
        $raupload ="image/aadhaarcard";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $employeedocument->aadhaarcard = $uplogoimg;
        }
        $rarefile = $request->file('pancard');
        if($rarefile!='')
        {
        $u=time().uniqid(rand());
        $raupload ="image/pancard";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $employeedocument->pancard = $uplogoimg;
        }
        $rarefile = $request->file('photo');
        if($rarefile!='')
        {
        $u=time().uniqid(rand());
        $raupload ="image/photo";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $employeedocument->photo = $uplogoimg;
        }


        $employeedocument->save();

         $user=new User();
          $user->employee_id=$eid;
          $user->name=$employee->employeename;
          $user->username=$employee->empcodeno;
          $user->email=$employee->email;
          $user->password=bcrypt(123456);
          $user->pass=123456;
          $user->mobile=$employee->phone;
          $user->usertype='USER';
          $user->save();

  }
   Session::flash('message','Employee save successfully');
      return redirect('/hrmain/employeelist');       
}
public function laboursaveemployeedetails(Request $request){
  //return $request->all();
$request->validate([

    //'empcodeno' => 'required|unique:employeedetails|max:20',
]);
      $check=employeedetail::where('empcodeno',$request->empcodeno)
            ->count();

  if($check == 0)
  {

        $employee=new employeedetail();
        $employee->employeename=$request->employeename;
        $employee->empcodeno=$request->empcodeno;
        $employee->qualification=$request->qualification;
        $employee->experencecomp=$request->experencecomp;
        $employee->dob=$request->dob;
        $employee->email=$request->email;
        $employee->gender=$request->gender;
        $employee->phone=$request->phone;
        $employee->adharno=$request->adharno;
        $employee->bloodgroup=$request->bloodgroup;
        $employee->alternativephonenumber=$request->alternativephonenumber;
        $employee->presentaddress=$request->presentaddress;
        $employee->permanentaddress=$request->permanentaddress;
        $employee->fathername=$request->fathername;
        $employee->maritalstatus=$request->maritalstatus;
        $employee->emptype=$request->emptype;
        $employee->wagescode=$request->wagescode;
        $employee->wages=$request->wages;
        $employee->wagesperhour=$request->wagesperhour;
        $employee->groupid=$request->groupid;
        $employee->empgroupid=$request->empgroupid;
        $employee->emptotalwages=$request->emptotalwages;
        $employee->empwagescode=$request->empwagescode;
        $employee->basicsalary=$request->basicsalary;
        $employee->conveyanceall=$request->conveyanceall;
        $employee->dearnessall=$request->dearnessall;
        $employee->medicalall=$request->medicalall;
        $employee->houserentall=$request->houserentall;
        $employee->professionaltax=$request->professionaltax;
        $employee->incometax=$request->incometax;
        $employee->welfarefund=$request->welfarefund;
        $employee->noofhour=$request->noofhour;
        //return $employee;
        $employee->save();

        $eid=$employee->id;
   
        $employeecompany=new employeecompanydetail();
        $employeecompany->employee_id=$eid;
        $employeecompany->department=$request->department;
        $employeecompany->designation=$request->designation;
        $employeecompany->dateofjoining=$request->dateofjoining;
        $employeecompany->dateofconfirmation=$request->dateofconfirmation;
        $employeecompany->joinsalary=$request->joinsalary;
        $employeecompany->totalyrexprnc=$request->totalyrexprnc;
        $employeecompany->ofcemail=$request->ofcemail;
        $employeecompany->cugmob=$request->cugmob;
        $employeecompany->skillsets=$request->skillsets;
        $employeecompany->location=$request->location;
        $employeecompany->reportingto=$request->reportingto;
        $employeecompany->save();

        $employeebankaccount=new employeebankaccountsdetail();
        $employeebankaccount->employee_id=$eid;
        $employeebankaccount->accountholdername=$request->accountholdername;
        $employeebankaccount->accountnumber=$request->accountnumber;
        $employeebankaccount->bankname=$request->bankname;
        $employeebankaccount->ifsc=$request->ifsc;
        $employeebankaccount->pan=$request->pan;
        $employeebankaccount->branch=$request->branch;
        $employeebankaccount->pfaccount=$request->pfaccount;
        $employeebankaccount->save();

        $employeedocument=new employeedocument();
        $employeedocument->employee_id=$eid;
        $rarefile = $request->file('resume');
        if($rarefile!='')
        {
        $u=time().uniqid(rand());
        $raupload ="image/resume";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $employeedocument->resume = $uplogoimg;
        }
        $rarefile = $request->file('offerletter');
        if($rarefile!='')
        {
        $u=time().uniqid(rand());
        $raupload ="image/offerletter";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $employeedocument->offerletter = $uplogoimg;
        }
        $rarefile = $request->file('joiningletter');
        if($rarefile!='')
        {
        $u=time().uniqid(rand());
        $raupload ="image/joiningletter";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $employeedocument->joiningletter = $uplogoimg;
        }
        $rarefile = $request->file('agreementpaper');
        if($rarefile!='')
        {
        $u=time().uniqid(rand());
        $raupload ="image/agreementpaper";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $employeedocument->agreementpaper = $uplogoimg;
        }
        $rarefile = $request->file('idproof');
        if($rarefile!='')
        {
        $u=time().uniqid(rand());
        $raupload ="image/idproof";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $employeedocument->idproof = $uplogoimg;
        }
        $rarefile = $request->file('aadhaarcard');
        if($rarefile!='')
        {
        $u=time().uniqid(rand());
        $raupload ="image/aadhaarcard";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $employeedocument->aadhaarcard = $uplogoimg;
        }
        $rarefile = $request->file('pancard');
        if($rarefile!='')
        {
        $u=time().uniqid(rand());
        $raupload ="image/pancard";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $employeedocument->pancard = $uplogoimg;
        }
        $rarefile = $request->file('photo');
        if($rarefile!='')
        {
        $u=time().uniqid(rand());
        $raupload ="image/photo";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $employeedocument->photo = $uplogoimg;
        }


        $employeedocument->save();

         $user=new User();
          $user->employee_id=$eid;
          $user->name=$employee->employeename;
          $user->username=$employee->empcodeno;
          $user->email=$employee->email;
          $user->password=bcrypt(123456);
          $user->pass=123456;
          $user->mobile=$employee->phone;
          $user->usertype='USER';
          $user->save();

  }
   Session::flash('message','Employee save successfully');
      return back();       
}
public function recsaveemployeedetails(Request $request){
  //return $request->all();
$request->validate([

    //'empcodeno' => 'required|unique:employeedetails|max:20',
]);
      $check=employeedetail::where('empcodeno',$request->empcodeno)
            ->count();

  if($check == 0)
  {

        $employee=new employeedetail();
        $employee->employeename=$request->employeename;
        $employee->empcodeno=$request->empcodeno;
        $employee->qualification=$request->qualification;
        $employee->experencecomp=$request->experencecomp;
        $employee->dob=$request->dob;
        $employee->email=$request->email;
        $employee->gender=$request->gender;
        $employee->phone=$request->phone;
        $employee->adharno=$request->adharno;
        $employee->bloodgroup=$request->bloodgroup;
        $employee->alternativephonenumber=$request->alternativephonenumber;
        $employee->presentaddress=$request->presentaddress;
        $employee->permanentaddress=$request->permanentaddress;
        $employee->fathername=$request->fathername;
        $employee->maritalstatus=$request->maritalstatus;
        $employee->emptype=$request->emptype;
        $employee->wagescode=$request->wagescode;
        $employee->wages=$request->wages;
        $employee->wagesperhour=$request->wagesperhour;
        $employee->groupid=$request->groupid;
        $employee->empgroupid=$request->empgroupid;
        $employee->emptotalwages=$request->emptotalwages;
        $employee->empwagescode=$request->empwagescode;
        $employee->basicsalary=$request->basicsalary;
        $employee->conveyanceall=$request->conveyanceall;
        $employee->dearnessall=$request->dearnessall;
        $employee->medicalall=$request->medicalall;
        $employee->houserentall=$request->houserentall;
        $employee->professionaltax=$request->professionaltax;
        $employee->incometax=$request->incometax;
        $employee->welfarefund=$request->welfarefund;
        $employee->noofhour=$request->noofhour;
        //return $employee;
        $employee->save();

        $eid=$employee->id;
   
        $employeecompany=new employeecompanydetail();
        $employeecompany->employee_id=$eid;
        $employeecompany->department=$request->department;
        $employeecompany->designation=$request->designation;
        $employeecompany->dateofjoining=$request->dateofjoining;
        $employeecompany->dateofconfirmation=$request->dateofconfirmation;
        $employeecompany->joinsalary=$request->joinsalary;
        $employeecompany->totalyrexprnc=$request->totalyrexprnc;
        $employeecompany->ofcemail=$request->ofcemail;
        $employeecompany->cugmob=$request->cugmob;
        $employeecompany->skillsets=$request->skillsets;
        $employeecompany->location=$request->location;
        $employeecompany->reportingto=$request->reportingto;
        $employeecompany->save();

        $employeebankaccount=new employeebankaccountsdetail();
        $employeebankaccount->employee_id=$eid;
        $employeebankaccount->accountholdername=$request->accountholdername;
        $employeebankaccount->accountnumber=$request->accountnumber;
        $employeebankaccount->bankname=$request->bankname;
        $employeebankaccount->ifsc=$request->ifsc;
        $employeebankaccount->pan=$request->pan;
        $employeebankaccount->branch=$request->branch;
        $employeebankaccount->pfaccount=$request->pfaccount;
        $employeebankaccount->save();

        $employeedocument=new employeedocument();
        $employeedocument->employee_id=$eid;
        $rarefile = $request->file('resume');
        if($rarefile!='')
        {
        $u=time().uniqid(rand());
        $raupload ="image/resume";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $employeedocument->resume = $uplogoimg;
        }
        $rarefile = $request->file('offerletter');
        if($rarefile!='')
        {
        $u=time().uniqid(rand());
        $raupload ="image/offerletter";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $employeedocument->offerletter = $uplogoimg;
        }
        $rarefile = $request->file('joiningletter');
        if($rarefile!='')
        {
        $u=time().uniqid(rand());
        $raupload ="image/joiningletter";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $employeedocument->joiningletter = $uplogoimg;
        }
        $rarefile = $request->file('agreementpaper');
        if($rarefile!='')
        {
        $u=time().uniqid(rand());
        $raupload ="image/agreementpaper";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $employeedocument->agreementpaper = $uplogoimg;
        }
        $rarefile = $request->file('idproof');
        if($rarefile!='')
        {
        $u=time().uniqid(rand());
        $raupload ="image/idproof";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $employeedocument->idproof = $uplogoimg;
        }
        $rarefile = $request->file('aadhaarcard');
        if($rarefile!='')
        {
        $u=time().uniqid(rand());
        $raupload ="image/aadhaarcard";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $employeedocument->aadhaarcard = $uplogoimg;
        }
        $rarefile = $request->file('pancard');
        if($rarefile!='')
        {
        $u=time().uniqid(rand());
        $raupload ="image/pancard";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $employeedocument->pancard = $uplogoimg;
        }
        $rarefile = $request->file('photo');
        if($rarefile!='')
        {
        $u=time().uniqid(rand());
        $raupload ="image/photo";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $employeedocument->photo = $uplogoimg;
        }


        $employeedocument->save();

         $user=new User();
          $user->employee_id=$eid;
          $user->name=$employee->employeename;
          $user->username=$employee->empcodeno;
          $user->email=$employee->email;
          $user->password=bcrypt(123456);
          $user->pass=123456;
          $user->mobile=$employee->phone;
          $user->usertype='USER';
          $user->save();

  }
   Session::flash('message','Employee save successfully');
      return back();       
}
public function editemployeedetails($id){
/*      $departments=department::all();*/
      //$designations=designation::all();
      $groups=Addgroup::all();
      $empgroups=Addempgroup::all();
      $editemployeedetail=employeedetail::find($id);
      $editcompanydetail=employeecompanydetail::find($id);
      //return $editemployeedetail;
      $editemployeebankaccount=employeebankaccountsdetail::find($id);
      $editemployeedocument=employeedocument::find($id);
      $employeeotherdocuments=employeeotherdocument::where('employee_id',$id)
                          ->get();
       //return $employeeotherdocuments;
        return view('hr.editemployeedetails',compact('editemployeedetail','editcompanydetail','editemployeebankaccount','editemployeedocument','employeeotherdocuments','groups','empgroups'));
    }
    public function laboureditemployeedetails($id){
/*      $departments=department::all();*/
      //$designations=designation::all();
      $groups=Addgroup::all();
      $empgroups=Addempgroup::all();
      $editemployeedetail=employeedetail::find($id);
      $editcompanydetail=employeecompanydetail::find($id);
      $editemployeebankaccount=employeebankaccountsdetail::find($id);
      $editemployeedocument=employeedocument::find($id);
      $employeeotherdocuments=employeeotherdocument::where('employee_id',$id)
                          ->get();
       //return $editemployeedetail;
        return view('labour.editemployeedetails',compact('editemployeedetail','empgroups','editcompanydetail','editemployeebankaccount','editemployeedocument','employeeotherdocuments','groups'));
    }
    public function receditemployeedetails($id){
/*      $departments=department::all();*/
      //$designations=designation::all();
      $groups=Addgroup::all();
      $empgroups=Addempgroup::all();
      $editemployeedetail=employeedetail::find($id);
      $editcompanydetail=employeecompanydetail::find($id);
      $editemployeebankaccount=employeebankaccountsdetail::find($id);
      $editemployeedocument=employeedocument::find($id);
      $employeeotherdocuments=employeeotherdocument::where('employee_id',$id)
                          ->get();
       //return $editemployeedetail;
        return view('editemployeedetails',compact('editemployeedetail','empgroups','editcompanydetail','editemployeebankaccount','editemployeedocument','employeeotherdocuments','groups'));
    }
public function saveempotherdoc(Request $request,$id){
  //return $request->all();
$empotherdoc=new employeeotherdocument();
$empotherdoc->employee_id=$request->id;
$empotherdoc->documentname=$request->documentname;
$rarefile = $request->file('document');
        if($rarefile!='')
        {
        $u=time().uniqid(rand());
        $raupload ="image/otherdocument";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $empotherdoc->document = $uplogoimg;
        }
$empotherdoc->save();
Session::flash('message','Document Uploaded Successfully');
return back();
}
public function updateemployeedetails(Request $request,$id)
    {
       //return $request->all();
        $updateemployee=employeedetail::find($id);
        $updateemployee->employeename=$request->employeename;
        $updateemployee->empcodeno=$request->empcodeno;
        $updateemployee->employeename=$request->employeename;
        $updateemployee->qualification=$request->qualification;
        $updateemployee->experencecomp=$request->experencecomp;
        $updateemployee->dob=$request->dob;
        $updateemployee->email=$request->email;
        $updateemployee->gender=$request->gender;
        $updateemployee->phone=$request->phone;
        $updateemployee->adharno=$request->adharno;
        $updateemployee->bloodgroup=$request->bloodgroup;
        $updateemployee->alternativephonenumber=$request->alternativephonenumber;
        $updateemployee->presentaddress=$request->presentaddress;
        $updateemployee->permanentaddress=$request->permanentaddress;
        $updateemployee->fathername=$request->fathername;
        $updateemployee->maritalstatus=$request->maritalstatus;
        $updateemployee->emptype=$request->emptype;
        $updateemployee->wagescode=$request->wagescode;
        $updateemployee->empwagescode=$request->empwagescode;
        $updateemployee->groupid=$request->groupid;
        $updateemployee->empgroupid=$request->empgroupid;
        $updateemployee->noofhour=$request->noofhour;
        $updateemployee->wages=$request->wages;
        $updateemployee->emptotalwages=$request->emptotalwages;
        $updateemployee->basicsalary=$request->basicsalary;
        $updateemployee->conveyanceall=$request->conveyanceall;
        $updateemployee->dearnessall=$request->dearnessall;
        $updateemployee->medicalall=$request->medicalall;
        $updateemployee->houserentall=$request->houserentall;
        $updateemployee->professionaltax=$request->professionaltax;
        $updateemployee->incometax=$request->incometax;
        $updateemployee->welfarefund=$request->welfarefund;
        // $updateemployee->wages=$request->empwages;
        // $updateemployee->wagesperhour=$request->wagesperhour;
        // $updateemployee->wagesperhour=$request->empwagesperhour;
        // $updateemployee->pf=$request->pf;
        // $updateemployee->esic=$request->esic;
        // $updateemployee->advance=$request->advance;
        // $updateemployee->salaryadvance=$request->salaryadvance;
        // $updateemployee->misc=$request->misc;
        $updateemployee->save();

        $eid=$updateemployee->id;

        $employeecompany=employeecompanydetail::where('employee_id',$eid)->first();
        $employeecompany->employee_id=$eid;
        $employeecompany->department=$request->department;
        $employeecompany->designation=$request->designation;
        $employeecompany->dateofjoining=$request->dateofjoining;
        $employeecompany->dateofconfirmation=$request->dateofconfirmation;
        $employeecompany->joinsalary=$request->joinsalary;
        $employeecompany->totalyrexprnc=$request->totalyrexprnc;
        $employeecompany->ofcemail=$request->ofcemail;
        $employeecompany->cugmob=$request->cugmob;
        $employeecompany->skillsets=$request->skillsets;
        $employeecompany->location=$request->location;
        $employeecompany->reportingto=$request->reportingto;
        $employeecompany->save();

        $employeebankaccount=employeebankaccountsdetail::where('employee_id',$eid)->first();
        $employeebankaccount->employee_id=$eid;
        $employeebankaccount->accountholdername=$request->accountholdername;
        $employeebankaccount->accountnumber=$request->accountnumber;
        $employeebankaccount->bankname=$request->bankname;
        $employeebankaccount->ifsc=$request->ifsc;
        $employeebankaccount->pan=$request->pan;
        $employeebankaccount->branch=$request->branch;
        $employeebankaccount->pfaccount=$request->pfaccount;
        $employeebankaccount->save();

        $employeedocument=employeedocument::where('employee_id',$eid)->first();
        $employeedocument->employee_id=$eid;
        $rarefile = $request->file('resume');
        if($rarefile!='')
        {
        $u=time().uniqid(rand());
        $raupload ="image/resume";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $employeedocument->resume = $uplogoimg;
        }
        $rarefile = $request->file('offerletter');
        if($rarefile!='')
        {
        $u=time().uniqid(rand());
        $raupload ="image/offerletter";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $employeedocument->offerletter = $uplogoimg;
        }
        $rarefile = $request->file('joiningletter');
        if($rarefile!='')
        {
        $u=time().uniqid(rand());
        $raupload ="image/joiningletter";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $employeedocument->joiningletter = $uplogoimg;
        }
        $rarefile = $request->file('agreementpaper');
        if($rarefile!='')
        {
        $u=time().uniqid(rand());
        $raupload ="image/agreementpaper";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $employeedocument->agreementpaper = $uplogoimg;
        }
        $rarefile = $request->file('idproof');
        if($rarefile!='')
        {
        $u=time().uniqid(rand());
        $raupload ="image/idproof";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $employeedocument->idproof = $uplogoimg;
        }
        $rarefile = $request->file('resignation');
        if($rarefile!='')
        {
        $u=time().uniqid(rand());
        $raupload ="image/resignation";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $employeedocument->resignation = $uplogoimg;
        }
        $rarefile = $request->file('aadhaarcard');
        if($rarefile!='')
        {
        $u=time().uniqid(rand());
        $raupload ="image/aadhaarcard";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $employeedocument->aadhaarcard = $uplogoimg;
        }
        $rarefile = $request->file('pancard');
        if($rarefile!='')
        {
        $u=time().uniqid(rand());
        $raupload ="image/pancard";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $employeedocument->pancard = $uplogoimg;
        }
        $rarefile = $request->file('photo');
        if($rarefile!='')
        {
        $u=time().uniqid(rand());
        $raupload ="image/photo";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $employeedocument->photo = $uplogoimg;
        }
        $employeedocument->save();
        Session::flash('message','Updated Employee successfully');
        return redirect('hrmain/employeelist');
      }
      public function labourupdateemployeedetails(Request $request,$id)
    {
     //return $request->all();
        $updateemployee=employeedetail::find($id);
        $updateemployee->employeename=$request->employeename;
        $updateemployee->empcodeno=$request->empcodeno;
        $updateemployee->employeename=$request->employeename;
        $updateemployee->qualification=$request->qualification;
        $updateemployee->experencecomp=$request->experencecomp;
        $updateemployee->dob=$request->dob;
        $updateemployee->email=$request->email;
        $updateemployee->gender=$request->gender;
        $updateemployee->phone=$request->phone;
        $updateemployee->adharno=$request->adharno;
        $updateemployee->bloodgroup=$request->bloodgroup;
        $updateemployee->alternativephonenumber=$request->alternativephonenumber;
        $updateemployee->presentaddress=$request->presentaddress;
        $updateemployee->permanentaddress=$request->permanentaddress;
        $updateemployee->fathername=$request->fathername;
        $updateemployee->maritalstatus=$request->maritalstatus;
        $updateemployee->emptype=$request->emptype;
        $updateemployee->wagescode=$request->wagescode;
        $updateemployee->empwagescode=$request->empwagescode;
        $updateemployee->groupid=$request->groupid;
        $updateemployee->empgroupid=$request->empgroupid;
        $updateemployee->noofhour=$request->noofhour;
        $updateemployee->wages=$request->wages;
        $updateemployee->emptotalwages=$request->emptotalwages;
        $updateemployee->basicsalary=$request->basicsalary;
        $updateemployee->conveyanceall=$request->conveyanceall;
        $updateemployee->dearnessall=$request->dearnessall;
        $updateemployee->medicalall=$request->medicalall;
        $updateemployee->houserentall=$request->houserentall;
        $updateemployee->professionaltax=$request->professionaltax;
        $updateemployee->incometax=$request->incometax;
        $updateemployee->welfarefund=$request->welfarefund;
        $updateemployee->save();

        $eid=$updateemployee->id;

        $employeecompany=employeecompanydetail::where('employee_id',$eid)->first();
        $employeecompany->employee_id=$eid;
        $employeecompany->department=$request->department;
        $employeecompany->designation=$request->designation;
        $employeecompany->dateofjoining=$request->dateofjoining;
        $employeecompany->dateofconfirmation=$request->dateofconfirmation;
        $employeecompany->joinsalary=$request->joinsalary;
        $employeecompany->totalyrexprnc=$request->totalyrexprnc;
        $employeecompany->ofcemail=$request->ofcemail;
        $employeecompany->cugmob=$request->cugmob;
        $employeecompany->skillsets=$request->skillsets;
        $employeecompany->location=$request->location;
        $employeecompany->reportingto=$request->reportingto;
        $employeecompany->save();

        $employeebankaccount=employeebankaccountsdetail::where('employee_id',$eid)->first();
        $employeebankaccount->employee_id=$eid;
        $employeebankaccount->accountholdername=$request->accountholdername;
        $employeebankaccount->accountnumber=$request->accountnumber;
        $employeebankaccount->bankname=$request->bankname;
        $employeebankaccount->ifsc=$request->ifsc;
        $employeebankaccount->pan=$request->pan;
        $employeebankaccount->branch=$request->branch;
        $employeebankaccount->pfaccount=$request->pfaccount;
        $employeebankaccount->save();

        $employeedocument=employeedocument::where('employee_id',$eid)->first();
        $employeedocument->employee_id=$eid;
        $rarefile = $request->file('resume');
        if($rarefile!='')
        {
        $u=time().uniqid(rand());
        $raupload ="image/resume";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $employeedocument->resume = $uplogoimg;
        }
        $rarefile = $request->file('offerletter');
        if($rarefile!='')
        {
        $u=time().uniqid(rand());
        $raupload ="image/offerletter";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $employeedocument->offerletter = $uplogoimg;
        }
        $rarefile = $request->file('joiningletter');
        if($rarefile!='')
        {
        $u=time().uniqid(rand());
        $raupload ="image/joiningletter";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $employeedocument->joiningletter = $uplogoimg;
        }
        $rarefile = $request->file('agreementpaper');
        if($rarefile!='')
        {
        $u=time().uniqid(rand());
        $raupload ="image/agreementpaper";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $employeedocument->agreementpaper = $uplogoimg;
        }
        $rarefile = $request->file('idproof');
        if($rarefile!='')
        {
        $u=time().uniqid(rand());
        $raupload ="image/idproof";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $employeedocument->idproof = $uplogoimg;
        }
        $rarefile = $request->file('resignation');
        if($rarefile!='')
        {
        $u=time().uniqid(rand());
        $raupload ="image/resignation";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $employeedocument->resignation = $uplogoimg;
        }
        $rarefile = $request->file('aadhaarcard');
        if($rarefile!='')
        {
        $u=time().uniqid(rand());
        $raupload ="image/aadhaarcard";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $employeedocument->aadhaarcard = $uplogoimg;
        }
        $rarefile = $request->file('pancard');
        if($rarefile!='')
        {
        $u=time().uniqid(rand());
        $raupload ="image/pancard";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $employeedocument->pancard = $uplogoimg;
        }
        $rarefile = $request->file('photo');
        if($rarefile!='')
        {
        $u=time().uniqid(rand());
        $raupload ="image/photo";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $employeedocument->photo = $uplogoimg;
        }
        $employeedocument->save();
        Session::flash('message','Updated Employee successfully');
        return back();
      }
      public function recupdateemployeedetails(Request $request,$id)
    {
     //return $request->all();
        $updateemployee=employeedetail::find($id);
        $updateemployee->employeename=$request->employeename;
        $updateemployee->empcodeno=$request->empcodeno;
        $updateemployee->employeename=$request->employeename;
        $updateemployee->qualification=$request->qualification;
        $updateemployee->experencecomp=$request->experencecomp;
        $updateemployee->dob=$request->dob;
        $updateemployee->email=$request->email;
        $updateemployee->gender=$request->gender;
        $updateemployee->phone=$request->phone;
        $updateemployee->adharno=$request->adharno;
        $updateemployee->bloodgroup=$request->bloodgroup;
        $updateemployee->alternativephonenumber=$request->alternativephonenumber;
        $updateemployee->presentaddress=$request->presentaddress;
        $updateemployee->permanentaddress=$request->permanentaddress;
        $updateemployee->fathername=$request->fathername;
        $updateemployee->maritalstatus=$request->maritalstatus;
        $updateemployee->emptype=$request->emptype;
        $updateemployee->wagescode=$request->wagescode;
        $updateemployee->empwagescode=$request->empwagescode;
        $updateemployee->groupid=$request->groupid;
        $updateemployee->empgroupid=$request->empgroupid;
        $updateemployee->noofhour=$request->noofhour;
        $updateemployee->wages=$request->wages;
        $updateemployee->emptotalwages=$request->emptotalwages;
        $updateemployee->basicsalary=$request->basicsalary;
        $updateemployee->conveyanceall=$request->conveyanceall;
        $updateemployee->dearnessall=$request->dearnessall;
        $updateemployee->medicalall=$request->medicalall;
        $updateemployee->houserentall=$request->houserentall;
        $updateemployee->professionaltax=$request->professionaltax;
        $updateemployee->incometax=$request->incometax;
        $updateemployee->welfarefund=$request->welfarefund;
        $updateemployee->save();

        $eid=$updateemployee->id;

        $employeecompany=employeecompanydetail::where('employee_id',$eid)->first();
        $employeecompany->employee_id=$eid;
        $employeecompany->department=$request->department;
        $employeecompany->designation=$request->designation;
        $employeecompany->dateofjoining=$request->dateofjoining;
        $employeecompany->dateofconfirmation=$request->dateofconfirmation;
        $employeecompany->joinsalary=$request->joinsalary;
        $employeecompany->totalyrexprnc=$request->totalyrexprnc;
        $employeecompany->ofcemail=$request->ofcemail;
        $employeecompany->cugmob=$request->cugmob;
        $employeecompany->skillsets=$request->skillsets;
        $employeecompany->location=$request->location;
        $employeecompany->reportingto=$request->reportingto;
        $employeecompany->save();

        $employeebankaccount=employeebankaccountsdetail::where('employee_id',$eid)->first();
        $employeebankaccount->employee_id=$eid;
        $employeebankaccount->accountholdername=$request->accountholdername;
        $employeebankaccount->accountnumber=$request->accountnumber;
        $employeebankaccount->bankname=$request->bankname;
        $employeebankaccount->ifsc=$request->ifsc;
        $employeebankaccount->pan=$request->pan;
        $employeebankaccount->branch=$request->branch;
        $employeebankaccount->pfaccount=$request->pfaccount;
        $employeebankaccount->save();

        $employeedocument=employeedocument::where('employee_id',$eid)->first();
        $employeedocument->employee_id=$eid;
        $rarefile = $request->file('resume');
        if($rarefile!='')
        {
        $u=time().uniqid(rand());
        $raupload ="image/resume";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $employeedocument->resume = $uplogoimg;
        }
        $rarefile = $request->file('offerletter');
        if($rarefile!='')
        {
        $u=time().uniqid(rand());
        $raupload ="image/offerletter";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $employeedocument->offerletter = $uplogoimg;
        }
        $rarefile = $request->file('joiningletter');
        if($rarefile!='')
        {
        $u=time().uniqid(rand());
        $raupload ="image/joiningletter";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $employeedocument->joiningletter = $uplogoimg;
        }
        $rarefile = $request->file('agreementpaper');
        if($rarefile!='')
        {
        $u=time().uniqid(rand());
        $raupload ="image/agreementpaper";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $employeedocument->agreementpaper = $uplogoimg;
        }
        $rarefile = $request->file('idproof');
        if($rarefile!='')
        {
        $u=time().uniqid(rand());
        $raupload ="image/idproof";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $employeedocument->idproof = $uplogoimg;
        }
        $rarefile = $request->file('resignation');
        if($rarefile!='')
        {
        $u=time().uniqid(rand());
        $raupload ="image/resignation";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $employeedocument->resignation = $uplogoimg;
        }
        $rarefile = $request->file('aadhaarcard');
        if($rarefile!='')
        {
        $u=time().uniqid(rand());
        $raupload ="image/aadhaarcard";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $employeedocument->aadhaarcard = $uplogoimg;
        }
        $rarefile = $request->file('pancard');
        if($rarefile!='')
        {
        $u=time().uniqid(rand());
        $raupload ="image/pancard";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $employeedocument->pancard = $uplogoimg;
        }
        $rarefile = $request->file('photo');
        if($rarefile!='')
        {
        $u=time().uniqid(rand());
        $raupload ="image/photo";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $employeedocument->photo = $uplogoimg;
        }
        $employeedocument->save();
        Session::flash('message','Updated Employee successfully');
        return back();
      }

public function employeestatus(Request $request){
  //return $request->all();
  $status=employeedetail::find($request->id);
  $status->status=$request->status;
  $status->save();
  $active=User::select('users.*')->where('employee_id',$request->id)->first();
  if($request->status != "PRESENT"){
      $active->active=0;
  }
  else{
      $active->active=1;
  }
  $active->save();
  return back();
}
public function registeremployee(){
  $departments=department::all();
  $designations=designation::all();
  $groups=Addgroup::all();
  $empgroups=Addempgroup::all();
  return view('hr.registeremployee',compact('departments','designations','groups','empgroups'));
}
public function labourregisteremployee(){
  $departments=department::all();
  $designations=designation::all();
  $groups=Addgroup::all();
  $empgroups=Addempgroup::all();
  return view('labour.registeremployee',compact('departments','designations','groups','empgroups'));
}
public function recregisteremployee(){
  $departments=department::all();
  $designations=designation::all();
  $groups=Addgroup::all();
  $empgroups=Addempgroup::all();
  //return $empgroups;
  return view('registeremployee',compact('departments','designations','groups','empgroups'));
}
public function importemployee(Request $request)
{
  $this->validate($request, [
      'select_file'  => 'required|mimes:xls,xlsx'
     ]);
      $path = $request->file('select_file')->getRealPath();
      $data = Excel::selectSheetsByIndex(0)->load($path)->get();
      //return $data;
      if($data->count()>0){
        foreach($data as $kay=>$value){
          if($value['emp_code_no']!= ''){
            
          $check=employeedetail::where('empcodeno',$value['emp_code_no'])
          ->count();
          //return $check;
          if($check==0){
          $employee=new employeedetail();
          $employee->employeename=$value['emp_name'];
          $employee->empcodeno=$value['emp_code_no'];
          $employee->dob=$value['date_of_birth'];
          $employee->email=$value['personal_mail_id'];
          $employee->phone=$value['personal_mobile_number'];
          $employee->alternativephonenumber=$value['contact_number'];
          $employee->bloodgroup=$value['blood_grp'];
          $employee->qualification=$value['qualification'];
          $employee->experencecomp=$value['experience_in_company_name'];
          $employee->totalyearexperience=$value['total_experience_in_years'];
          $employee->fathername=$value['fathers_name'];
          $employee->maritalstatus=$value['marital_status'];
          $employee->presentaddress=$value['present_address'];
          $employee->permanentaddress=$value['permanent_address'];
          if($value['remarks']!=''){
            $employee->status=$value['remarks'];
          }
          else{
            $employee->status='PRESENT';
          }

          $employee->save();
          $empid=$employee->id;
          $compemployee=new employeecompanydetail();
          $compemployee->employee_id=$empid;
          $compemployee->remarks=$value['remarks'];
          $compemployee->dateofjoining=$value['date_of_joining'];
          $compemployee->designation=$value['designation'];
          $compemployee->department=$value['department'];
          $compemployee->skillsets=$value['skill_sets'];
          $compemployee->reportingto=$value['reporting_to'];
          $compemployee->ofcemail=$value['official_mail_id'];
          $compemployee->cugmob=$value['cug_mobile_number'];
          $compemployee->dateofconfirmation=$value['date_of_confirmation'];
          $compemployee->completionyear=$value['one_year_completion'];
          $compemployee->location=$value['location'];
          $compemployee->save();
          $empbank=new employeebankaccountsdetail();
          $empbank->employee_id=$empid;
          $empbank->accountholdername=$value['emp_name'];
          $empbank->accountnumber=$value['salary_account_no'];
          $empbank->bankname=$value['bank_name'];
          //$empbank->ifsc=$value['ifsc'];
          //$empbank->pan=$value['pan'];
          //$empbank->branch=$value['branch'];
          //$empbank->pfaccount=$value['pfaccount'];
          $empbank->save();
          $empdoc=new employeedocument();
          $empdoc->employee_id=$empid;
          $empdoc->save();
          $checkuser=User::where('username',$value['emp_code_no'])
                    ->count();
          if ($checkuser==0) {
          $user=new User();
          $user->employee_id=$empid;
          $user->name=$value['emp_name'];
          $user->username=$value['emp_code_no'];
          $user->email=$value['personal_mail_id'];
          $user->password=bcrypt(123456);
          $user->pass=123456;
          $user->mobile=$value['personal_mobile_number'];
          $user->usertype='USER';
          if($employee->status=$value['remarks'] != ""){
              $user->active=0;
          }else{
            $user->active=1;
          }
          $user->save();
          }
          
     
          Session::flash('message', 'Employee was successfuly uploaded');
        }
        else{
      Session::flash('error', 'Duplicate Entery');
    }
  }
      }
      
      }
    
    return back();
}
public function employeelist(Request $request){
  $employeedetails=employeedetail::select('employeedetails.*','employeedocuments.*','employeebankaccountsdetails.*','employeecompanydetails.*')
              ->where('employeedetails.emptype','Employee')
              ->leftJoin('employeedocuments','employeedetails.id','=','employeedocuments.employee_id')
              ->leftJoin('employeebankaccountsdetails','employeedetails.id','=','employeebankaccountsdetails.employee_id')
              ->leftJoin('employeecompanydetails','employeedetails.id','=','employeecompanydetails.employee_id');
              if($request->has('status')){
                $employeedetails=$employeedetails->where('status',$request->status);
              }
              $employeedetails=$employeedetails->get();
    //return $employeedetails;

  return view('hr.employeelist',compact('employeedetails'));
}


public function labouremployeelist(Request $request){
  $employeedetails=employeedetail::select('employeedetails.*','employeedocuments.*','employeebankaccountsdetails.*','employeecompanydetails.*')
              ->leftJoin('employeedocuments','employeedetails.id','=','employeedocuments.employee_id')
              ->leftJoin('employeebankaccountsdetails','employeedetails.id','=','employeebankaccountsdetails.employee_id')
              ->leftJoin('employeecompanydetails','employeedetails.id','=','employeecompanydetails.employee_id');
              if($request->has('status')){
                $employeedetails=$employeedetails->where('status',$request->status);
              }
              $employeedetails=$employeedetails->where('emptype','=','Labour')->get();
  //return $employeedetails;

  return view('labour.employeelist',compact('employeedetails'));
}
public function recemplist(Request $request){
  $employeedetails=employeedetail::select('employeedetails.*','employeedocuments.*','employeebankaccountsdetails.*','employeecompanydetails.*')
              ->leftJoin('employeedocuments','employeedetails.id','=','employeedocuments.employee_id')
              ->leftJoin('employeebankaccountsdetails','employeedetails.id','=','employeebankaccountsdetails.employee_id')
              ->leftJoin('employeecompanydetails','employeedetails.id','=','employeecompanydetails.employee_id');
              if($request->has('status')){
                $employeedetails=$employeedetails->where('status',$request->status);
              }
              $employeedetails=$employeedetails->where('emptype','=','Employee')->get();
  //return $employeedetails;
  return view('labouremployeelist',compact('employeedetails'));
}
public function department(){
  $all=array();
  $departments=department::all();
  foreach ($departments as $key => $department) {
   $designations=designation::select('designationname')
                ->where('deptartment_id',$department->id)
                ->get();
   $all[]=array('department'=>$department,'designation'=>$designations);
  }

  return view('hr.department',compact('all'));
}
public function adddepartment(Request $request){
  $department=new department();
  $department->departmentname=$request->departmentname;
  $department->save();
  $did=$department->id;
  $count=count($request->designationname);
  if($count>0){
    for($i=0;$i<$count;$i++){
      if($request->designationname[$i]!=''){
        $designation=new designation();
        $designation->deptartment_id=$did;
        $designation->designationname=$request->designationname[$i];
        $designation->save();
      }
    }
  }
  return back();
  
}
 //-------------END PMS HR ------------//

  public function deletedocument($id)
  {
       document::find($id)->delete();

       Session::flash('error','Document Deleted Successfully');
       return back();
  }

   public function savedocument(Request $request)
   {
        $document=new document();
        $document->docname=$request->docname;

        $rarefile = $request->file('attachment');    
        if($rarefile!=''){
        $raupload = public_path() .'/img/doc/';
        $rarefilename=time().'.'.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$rarefilename);
        $document->attachment = $rarefilename;
        }
        $document->save();
        Session::flash('msg','Document saved Successfully');
        return back();

   }

   public function adddocuments()
   {
      $documents=document::all();
      return view('hr.adddocuments',compact('documents'));
   }

    public function viewnotice($id)
    {
        $notice=notice::find($id);

        return view('viewnotice',compact('notice'));
    }

    public function activenotice($id)
    {
        $notice=notice::find($id);
       $notice->status="ACTIVE";
       $notice->save();
       return back();
    }

     public function deactivenotice($id)
     {
       $notice=notice::find($id);
       $notice->status="DEACTIVE";
       $notice->save();

       return back();
     }  

     public function updatenotice(Request $request,$id)
     {
        $notice=notice::find($id);
        $notice->subject=$request->subject;
        $notice->description=$request->description;

        $rarefile = $request->file('attachment');    
        if($rarefile!=''){
        $raupload = public_path() .'/img/notice/';
        $rarefilename=time().'.'.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$rarefilename);
        $notice->attachment = $rarefilename;
        }
        $notice->save();
       
        return redirect('/notices/viewallnotice');
     }
     public function editnotice($id)
     {
        $notice=notice::find($id);

        return view('editnotice',compact('notice'));
     }

     public function viewallnotice()
     {

          $notices=notice::all();
          return view('viewallnotice',compact('notices'));

     }
    
     public function savenotice(Request $request)
     {
        $notice=new notice();
        $notice->subject=$request->subject;
        $notice->description=$request->description;

        $rarefile = $request->file('attachment');    
        if($rarefile!=''){
        $raupload = public_path() .'/img/notice/';
        $rarefilename=time().'.'.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$rarefilename);
        $notice->attachment = $rarefilename;
        }
        $notice->save();
        Session::flash('msg','Notice Saved Successfully');
        return back();
       
     }
     public function createnotice()
    {
        return view('createnotice');
    }
    public function userviewallmytodo()
      {
           $todos=todo::where('userid',Auth::id())->get();

           return view('hr.userviewallmytodo',compact('todos'));
      }
     public function mymessages()
    {
        $users=User::all();
          $uid=Auth::id();
          
      /*    $messages =  chat::whereRaw("(sender, `reciver`, `created_at`) IN (
          SELECT   sender, `reciver`, MAX(`created_at`)
          FROM     chats
          WHERE     `reciver`=$uid
            or    `sender`=$uid
          GROUP BY convertationid)")
          ->orderBy('created_at','desc')
          ->get();
*/


            $messages=DB::table('chats')
                ->where(function($query) use ($uid){
                      $query->where('sender',$uid);
                      $query->orWhere('reciver',$uid);
                        })
                     ->orderBy('created_at', 'desc')
                     ->get()
                     ->unique('convertationid');

  /*$sub = chat::orderBy('created_at','DESC');

    $messages = DB::table(DB::raw("({$sub->toSql()}) as sub"))
   ->where(function($query) use ($uid){
                      $query->where('sender',$uid);
                      $query->orWhere('reciver',$uid);
                  })
    ->groupBy('convertationid')
    ->get();
     */ 

        /* $messages=chat::select('chats.*','u1.name as sendername','u2.name as recivername')
             
             ->leftJoin('users as u1','chats.sender','=','u1.id')
             ->leftJoin('users as u2','chats.reciver','=','u2.id')
             ->where(function($query) use ($uid){
                      $query->where('chats.sender',$uid);
                      $query->orWhere('chats.reciver',$uid);
                  })
               ->groupBy('chats.sender','chats.reciver')
               
                ->get();*/

         
         return view('hr.mymessages',compact('messages','users'));
    }

       public function complainttoresolve(Request $request)
   {
     $statuses=complaint::groupBy('status')->get();
      complaint::where('active','1')->update(['active'=>'0']);

     if($request->has('type'))
      {

          $filterreq=$request->type;
          $uid=Auth::id();
          $complaints=complaint::select('complaints.*','u1.name as to','u2.name as from','u3.name as ccname')
                 ->leftJoin('users as u1','complaints.touserid','=','u1.id')
                 ->leftJoin('users as u2','complaints.fromuserid','=','u2.id')
                  ->leftJoin('users as u3','complaints.cc','=','u3.id')
                  ->where('complaints.status',$request->type)
                 ->where(function($query) use ($uid){
                      $query->where('complaints.touserid',$uid);
                      $query->orWhere('complaints.cc',$uid);
                  })
                 ->orderBy('complaints.updated_at','DESC')
                 ->get();
      }
      else
      {
        $filterreq="";
         $complaints=complaint::select('complaints.*','u1.name as to','u2.name as from','u3.name as ccname')
                 ->leftJoin('users as u1','complaints.touserid','=','u1.id')
                 ->leftJoin('users as u2','complaints.fromuserid','=','u2.id')
                  ->leftJoin('users as u3','complaints.cc','=','u3.id')
                 ->where('complaints.touserid',Auth::id())
                 ->orWhere('complaints.cc',Auth::id())
                 ->orderBy('complaints.updated_at','DESC')
                 ->get();
      }

    
                
  
                
    return view('hr.complainttoresolve',compact('complaints','statuses','filterreq'));
   }
      public function viewcomplaintdetails($id)
  {
       $complaint=complaint::select('complaints.*','u1.name as to','u2.name as from','u3.name as ccname')
                 ->leftJoin('users as u1','complaints.touserid','=','u1.id')
                 ->leftJoin('users as u2','complaints.fromuserid','=','u2.id')
                 ->leftJoin('users as u3','complaints.cc','=','u3.id')
                 ->where('complaints.id',$id)
                 ->first();

       $complaintlogs=complaintlog::select('complaintlogs.*','users.name')
                      ->leftJoin('users','complaintlogs.writerid','=','users.id')
                      ->where('complaintid',$id)
                      ->orderBy('complaintlogs.created_at','DESC')
                      ->get();
      return view('hr.viewcomplaintdetails',compact('complaint','complaintlogs'));
  }
     public function complaint(Request $request)
   {  
     if($request->has('type'))
      {
          $filterreq=$request->type;
         $complaints=complaint::select('complaints.*','u1.name as to','u2.name as from','u3.name as ccname')
                 ->leftJoin('users as u1','complaints.touserid','=','u1.id')
                 ->leftJoin('users as u2','complaints.fromuserid','=','u2.id')
                 ->leftJoin('users as u3','complaints.cc','=','u3.id')
                 ->where('complaints.status',$request->type)
                 ->where('complaints.fromuserid',Auth::id())
                 ->orderBy('complaints.updated_at','DESC')
                 ->get();
      }

      else
      {
         $filterreq="";
         $complaints=complaint::select('complaints.*','u1.name as to','u2.name as from','u3.name as ccname')
                 ->leftJoin('users as u1','complaints.touserid','=','u1.id')
                 ->leftJoin('users as u2','complaints.fromuserid','=','u2.id')
                 ->leftJoin('users as u3','complaints.cc','=','u3.id')
                 ->where('complaints.fromuserid',Auth::id())
                 ->orderBy('complaints.updated_at','DESC')
                 ->get();

      }
     
      $statuses=complaint::groupBy('status')->get();
      $users=User::all();

      return view('hr.complaint',compact('users','complaints','filterreq','statuses'));

     
   }
    public function hrapproverequest(Request $request)
    {
       $user=new User();

    	  $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'username'=>'required|string|max:255|unique:users',
            'mobile'=>'required|string|max:10|min:10|unique:users',
       ]);
       $user->name=$request->name;
       $user->email=$request->email;
       $user->mobile=$request->mobile;
       $user->usertype=$request->usertype;
       $user->username=$request->username;
       $user->password= bcrypt($request->userpassword);
       $user->designation=$request->designation;
       $user->pass=$request->userpassword;
        
       $user->save();
       $u=userrequest::find($request->uid);
       $u->status='0';
       $u->save();
        $email=$user->email;
        $uname=$request->username;
        $password=$user->pass;
        $name=$user->name;

        $mail= Mail::send('mail.mail', compact('email','uname','password','name'), function($message) use($email) {
     $message->to($email, 'Primary Client');
     $message->cc("info@stepltest.com",'Primary Client');
     $message->subject('Registration Confirmation');
         $message->from('subudhitechnoengineers@gmail.com','Subudhi Technoengineers');
        
      });
       return back();
    Session::flash('msg','User Updated Successfully');
    }
	public function registerrequest()
	{
		$userrequests=userrequest::where('status','1')->get();
		return view('hr.registerrequest',compact('userrequests'));
	}
    public function home()
    {
        $todos=todo::where('userid',Auth::id())->whereDate('datetime', Carbon::today())->paginate(10);

    	return view('hr.home',compact('todos'));
    }
       public function adduser()
   {
     
      $users=User::select('users.*','activities.activityname')
             ->leftJoin('assignedactivities','assignedactivities.userid','=','users.id')
             ->leftJoin('activities','assignedactivities.activityassigned','=','activities.id')
             ->groupBy('users.id')
             ->get();
      $activities=activity::all();

      return view('hr.adduser',compact('users','activities'));
   }

    public function saveuser(Request $request)
   {
      
     $user=new User();
       $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'userpassword' => 'required|min:6',
            'usertype'=>'required|string',
            'username'=>'required|string|max:255|unique:users',
            'mobile'=>'required|string|max:10|min:10|unique:users',



       ]);
       $user->name=$request->name;
       $user->email=$request->email;
       $user->mobile=$request->mobile;
       $user->usertype=$request->usertype;
       $user->username=$request->username;
       $user->password= bcrypt($request->userpassword);
       $user->pass=$request->userpassword;
       $user->designation=$request->designation;
       $user->save();

        $email=$user->email;
        $uname=$user->username;
        $password=$user->pass;
        $name=$user->name;

        $mail= Mail::send('mail.mail', compact('email','uname','password','name'), function($message) use($email) {
     $message->to($email, 'Primary Client');
     $message->cc("info@stepltest.com",'Primary Client');
     $message->subject('Registration Confirmation');
         $message->from('subudhitechnoengineers@gmail.com','Subudhi Technoengineers');
        
      });
      
    Session::flash('msg','User Added Successfully');
         return back();
   }

       public function updateuser(Request $request)
       {
      $user=User::find($request->uid);
      $user->name=$request->name;
       $user->email=$request->email;
       $user->mobile=$request->mobile;
       $user->usertype=$request->usertype;
       $user->username=$request->username;
       $user->password= bcrypt($request->userpassword);
       $user->designation=$request->designation;
       $user->pass=$request->userpassword;
      
       $user->save();
    Session::flash('msg','User Updated Successfully');
    return back();
   }
   public function getviewallattendancelist(Request $request)
       {
           $allattendancegroups=Dailyattendancegroup::select('dailyattendancegroups.*','addgroups.groupname')
          ->leftjoin('addgroups','dailyattendancegroups.groupid','=','addgroups.id');
            //$allattendancegroups=$allattendancegroups->get();
            //return $allattendancegroups;
            if($request->has('group') && $request->get('group')!=''){
               $allattendancegroups=$allattendancegroups->where('groupid',$request->group);

            }
            if($request->has('fromdate') && $request->has('todate')){
               if($request->get('fromdate')!='' && $request->get('todate')!=''){ 
               $allattendancegroups=$allattendancegroups
                                ->where('entrytime','>=',$request->fromdate.' 00:00:00')
                                ->where('entrytime','<=',$request->todate.' 23:59:59');
              }

            }
            $totalotamt=Money::moneyFormatIndia($allattendancegroups->sum('tot'));
            $totalamt=Money::moneyFormatIndia($allattendancegroups->sum('tamt'));
            $totalwages=Money::moneyFormatIndia($allattendancegroups->sum('twages'));
            $noofworker=$allattendancegroups->sum('noofworkerspresent');
            $tothour=$allattendancegroups->sum('tothour');

          
          
          
          return DataTables::of($allattendancegroups)
                 ->setRowClass(function ($allattendancegroups) {
                        $date = \Carbon\Carbon::parse($allattendancegroups->lastdateofsubmisssion);
                        $now = \Carbon\Carbon::now();
                        $diff = $now->diffInDays($date);
                        if($date<$now){
                            $day=-($diff);
                         }
                        else
                        {
                          $day=$diff;
                        }
                        if($day>=0 && $day<=5)
                          {
                              return 'blink';
                          }
                      
                              
                   
                })
                 
                 
                 ->addColumn('idbtn', function($allattendancegroups){
                         return '<a target="_blank" href="/attendance/viewattendancegroup/'.$allattendancegroups->id.'" class="btn btn-info">'.$allattendancegroups->id.'</a>';
                    })
                 ->addColumn('technicalscoreupload', function($allattendancegroups) {
                    if ($allattendancegroups->participantlistupload !='')
                     return '<a href="/img/posttenderdoc/'.$allattendancegroups->technicalscoreupload.'" target="_blank"><i style="color: green;font-size: 30px;" class="fa fa-check-circle-o"></i></a>';
                    else
                      return '<i style="color: red;font-size: 30px;" class="fa fa-times-circle-o"> </i>';
                    
                    
                    })
                  ->addColumn('financialscoreupload', function($allattendancegroups) {
                    if ($allattendancegroups->participantlistupload !='')
                     return '<a href="/img/posttenderdoc/'.$allattendancegroups->financialscoreupload.'" target="_blank"><i style="color: green;font-size: 30px;" class="fa fa-check-circle-o"></i></a>';
                    else
                      return '<i style="color: red;font-size: 30px;" class="fa fa-times-circle-o"> </i>';
                    
                    
                    })
                  ->addColumn('technicalproposal', function($allattendancegroups) {
                    if ($allattendancegroups->participantlistupload !='')
                     return '<a href="/img/posttenderdoc/'.$allattendancegroups->technicalproposal.'" target="_blank"><i style="color: green;font-size: 30px;" class="fa fa-check-circle-o"></i></a>';
                    else
                      return '<i style="color: red;font-size: 30px;" class="fa fa-times-circle-o"> </i>';
                    
                    
                    })
                  ->addColumn('financialproposal', function($allattendancegroups) {
                    if ($allattendancegroups->participantlistupload !='')
                     return '<a href="/img/posttenderdoc/'.$allattendancegroups->financialproposal.'" target="_blank"><i style="color: green;font-size: 30px;" class="fa fa-check-circle-o"></i></a>';
                    else
                      return '<i style="color: red;font-size: 30px;" class="fa fa-times-circle-o"> </i>';
                    
                    
                    })
                  ->addColumn('participantlistupload', function($allattendancegroups) {
                    if ($allattendancegroups->participantlistupload !='')
                     return '<a href="/img/posttenderdoc/'.$allattendancegroups->participantlistupload.'" target="_blank"><i style="color: green;font-size: 30px;" class="fa fa-check-circle-o"></i></a>';
                    else
                      return '<i style="color: red;font-size: 30px;" class="fa fa-times-circle-o"> </i>';
                    
                    
                    })


                 // <td> <a href="/img/posttenderdoc/{{$tender->technicalscoreupload}}" target="_blank"><i style="color: green;font-size: 20px;" class='fa fa-check-circle-o'></i></a></td>


                  ->addColumn('sta', function($allattendancegroups) {
                    /*if ($allattendancegroups->status=='PENDING') return '<span class="label label-default">'.$allattendancegroups->status.'</span>';*/
                      if ($allattendancegroups->status=='ELLIGIBLE') return '<span class="label label-success" ondblclick="revokestatus('.$allattendancegroups->id.')">'.$allattendancegroups->status.'</span>';
                    if ($allattendancegroups->status=='NOT ELLIGIBLE') return '<span class="label label-warning" ondblclick="revokestatus('.$allattendancegroups->id.')">'.$allattendancegroups->status.'</span>';
                    if ($allattendancegroups->status=='PENDING')
                      return '<select id="status" onchange="changestatus(this.value,'.$allattendancegroups->id.')">'.
                               '<option value="PENDING">PENDING</option>'.
                               '<option value="ELLIGIBLE">ELLIGIBLE</option>'.
                               '<option value="NOT ELLIGIBLE">NOT ELLIGIBLE</option>'.
                               '<option value="NOT INTERESTED">NOT INTERESTED</option>'.
                               '</select>';



                    if ($allattendancegroups->status=='COMMITEE APPROVED') return '<span class="label label-success" ondblclick="revokestatus('.$allattendancegroups->id.')">'.$allattendancegroups->status.'</span>';
                    if ($allattendancegroups->status=='ADMIN APPROVED') return '<span class="label label-primary" ondblclick="revokestatus('.$allattendancegroups->id.')">'.$allattendancegroups->status.'</span>';
                    if ($allattendancegroups->status=='ADMIN REJECTED') return '<span class="label label-danger" ondblclick="revokestatus('.$allattendancegroups->id.')">'.$allattendancegroups->status.'</span>';
                    else
                      return '<span class="label label-success" ondblclick="revokestatus('.$allattendancegroups->id.')">'.$allattendancegroups->status.'</span>';
                    
                    
                    })
                  
                 ->addColumn('edit', function($allattendancegroups){
                  return '<button type="button" class="btn btn-primary" onclick="edit('.$allattendancegroups->id.',\''. $allattendancegroups->itemdescription . '\',\''. $allattendancegroups->unit . '\',\''. $allattendancegroups->quantity . '\',\''. $allattendancegroups->amount . '\',\''. $allattendancegroups->workassignment . '\',\''. $allattendancegroups->remarks . '\')">EDIT</button>';
                    })
                  ->addColumn('view', function($allattendancegroups){
                         return '<a target="_blank" href="/attendance/viewattendancegroup/'.$allattendancegroups->id.'" class="btn btn-info">VIEW</a>';
                    })
                  
                  ->addColumn('delete', function($allattendancegroups){
                         return '<a target="_blank" href="/viewappliedallattendancegroups/'.$allattendancegroups->id.'" class="btn btn-danger">DELETE</a>';
                    })
                  ->addColumn('now', function($allattendancegroups){
                         return '<p class="b" title="'.$allattendancegroups->nameofthework.'">'.$allattendancegroups->nameofthework.'</p>';
                    })
                    ->addColumn('ldos', function($allattendancegroups) {
                    return '<strong><span class="label label-danger" style="font-size:13px;">'.$this->changedateformat($allattendancegroups->lastdateofsubmisssion).'</strong></span>';
                     })
                  ->editColumn('nitpublicationdate', function($allattendancegroups) {
                    return $this->changedateformat($allattendancegroups->nitpublicationdate);
                     })
                   ->editColumn('emdamount', function($allattendancegroups) {
                    return app('App\Http\Controllers\AccountController')->moneyFormatIndia($allattendancegroups->emdamount);
                     })
                   ->editColumn('location', function($allattendancegroups) {
                    return $allattendancegroups->location;
                     })
                ->editColumn('lastdateofsubmisssion', function($allattendancegroups) {
                    return $this->changedateformat($allattendancegroups->lastdateofsubmisssion);
                     })
                 
                  ->editColumn('rfpavailabledate', function($allattendancegroups) {
                    return $this->changedateformat($allattendancegroups->rfpavailabledate);
                     })
                  ->editColumn('created_at', function($allattendancegroups) {
                        return $this->changedatetimeformat($allattendancegroups->created_at);
                     })
                  
                  ->rawColumns(['idbtn','view','edit','delete','now','sta','status','ldos','technicalscoreupload','financialscoreupload','technicalproposal','financialproposal','participantlistupload'])
                  ->with(compact('totalotamt','totalamt','noofworker','totalwages','tothour'))
                 ->make(true);
       }
       public function labourattendanceexport(Request $request){
        $allattendancegroups=Dailyattendancegroup::select('dailyattendancegroups.*','addgroups.groupname')
          ->leftjoin('addgroups','dailyattendancegroups.groupid','=','addgroups.id');
            if($request->has('group') && $request->get('group')!=''){
               $allattendancegroups=$allattendancegroups->where('groupid',$request->group);

            }
            if($request->has('fromdate') && $request->has('todate')){
               if($request->get('fromdate')!='' && $request->get('todate')!=''){ 
               $allattendancegroups=$allattendancegroups
                                ->where('entrytime','>=',$request->fromdate.' 00:00:00')
                                ->where('entrytime','<=',$request->todate.' 23:59:59');
              }

            }
        $allattendancegroups=$allattendancegroups->get();
        $totaltamt=$allattendancegroups->sum('tamt');
        $noofworkerspresent=$allattendancegroups->sum('noofworkerspresent');
        $twages=$allattendancegroups->sum('twages');
        $tothour=$allattendancegroups->sum('tothour');
        $tot=$allattendancegroups->sum('tot');
      $customer_array[] = array('Id', 'GROUP NAME', 'ENTRY TIME','DEPARTURE TIME','NUMBER OF WORKERS','WAGES','OT HOUR','OT','TOTAL AMOUNT','REMARKS','WORK ASSIGNMENT','ITEM DESCRIPTION','UNIT','QUANTITY','AMOUNT','CREATED AT');

       foreach($allattendancegroups as $allattendancegroup)
     {
      $customer_array[] = array(
       'Id'  => $allattendancegroup->id,
       'GROUP NAME'   => $allattendancegroup->groupname,
       'ENTRY TIME'  => $allattendancegroup->entrytime,
       'DEPARTURE TIME'    => $allattendancegroup->departuretime,
       'NUMBER OF WORKERS'    => $allattendancegroup->noofworkerspresent,
       'WAGES'    => $allattendancegroup->twages,
       'OT HOUR'    => $allattendancegroup->tothour,
       'OT'    => $allattendancegroup->tot,
       'TOTAL AMOUNT'    => $allattendancegroup->tamt,
       'REMARKS'    => $allattendancegroup->remarks,
       'WORK ASSIGNMENT'    => $allattendancegroup->workassignment,
       'ITEM DESCRIPTION'    => $allattendancegroup->itemdescription,
       'UNIT,'   => $allattendancegroup->unit,
       'QUANTITY,'   => $allattendancegroup->quantity,
       'AMOUNT,'   => $allattendancegroup->amount,
       'CREATED AT,'   => $allattendancegroup->created_at
      );
     }
     $customer_array[] = array(
       'id'  => '',
       'groupname'   => 'TOTAL',
       'entrytime'  => '',
       'departuretime'    => '',
       'noofworkerspresent'    => $noofworkerspresent,
       'twages'    => $twages,
       'tothour'    => $tothour,
       'tot'    => $tot,
       'tamt'    => $totaltamt,
       'remarks'    => '',
       'workassignment'    => '',
       'itemdescription'    => '',
       'unit,'   => '',
       'quantity,'   => '',
       'amount,'   => '',
       'created_at,'   => ''
      );
     Excel::create('Attendance Report', function($excel) use ($customer_array){
      $excel->setTitle('Attendance Report');
      $excel->sheet('Attendance Report', function($sheet) use ($customer_array){
       $sheet->fromArray($customer_array, null, 'A1', false, false);
      });
     })->download('xlsx');

       }
}

