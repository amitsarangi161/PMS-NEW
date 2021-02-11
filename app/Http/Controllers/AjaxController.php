<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\activity;
use Auth;
use App\User;
use App\project;
use App\assignedactivity;
use App\projectactivity;
use App\particular;
use App\otp;
use Carbon\Carbon;
use App\chat;
use DB;
use Session;
use DateInterval;
use DateTime;
use DatePeriod;
use App\todo;
use App\expenseentry;
use App\complaintlog;
use App\wallet;
use App\userunderhod;
use App\dailylabour;
use App\engagedlabour;
use App\dailyvehicle;
use App\suggestion;
use App\tender;
use App\employeedetail;
use App\Applyleave;
use App\Empdailyattendancegroup;
use App\Empdailyattendancegroupdetail;
use App\Approvedleave;
class AjaxController extends Controller
{ 
  public function ajaxchangestatus(Request $request){
    $changestaus=Empdailyattendancegroupdetail::find($request->id);
    $changestaus->present=$request->status;
    $changestaus->save();
  }
  public function ajaxholidayemployee(Request $request){
    //return $request->all();
    $date=$request->attendancedate;
    $empgroupid=$request->empgroupid;


    $chk=Empdailyattendancegroup::where('date',$date)
      ->where('empgroupid',$empgroupid)
      ->count(); 
    //return $chk;
      
      if($chk == 0)
      {
        $holiday=new Empdailyattendancegroup();
        $holiday->date=$request->attendancedate;
        $holiday->empgroupid=$request->empgroupid;
        $holiday->type=$request->type;
        $holiday->entryby=Auth::id();
        $holiday->save();
        $employees=employeedetail::select('id','employeename')
                 ->where('emptype','Employee')
                 ->where('empgroupid',$empgroupid)
                 ->get();
        $attendanceid=$holiday->id;
        foreach ($employees as $key => $employee) {
          $attendancedetail=new Empdailyattendancegroupdetail();
           $attendancedetail->dailyattendanceid=$attendanceid;
           $attendancedetail->employee_id=$employee->id;
           $attendancedetail->employeename=$employee->employeename;
           $attendancedetail->attendancedate=$request->attendancedate;
           $attendancedetail->present="H";
           $attendancedetail->save();
        }
        return 1;
      }else{
       
        return 0;
      }
    
  }
  public function ajaxfetchattendanceemp(Request $request){
    $customarray=array();
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
          $totleavetaken=Approvedleave::where('employee_id',$employee->id)->count();
          $totalleave=15;
          $totalbalanceleave=$totalleave-$totleavetaken;
          $customarray[]=array('employee'=>$employee,'empttotpresent'=>$empttotpresent,'empttotabsent'=>$empttotabsent,'thismonthleave'=>$thismonthleave,'totleavetaken'=>$totleavetaken,'totalleave'=>$totalleave,'totalbalanceleave'=>$totalbalanceleave);

        
    }
    return $customarray;

  }
  public function ajaxchangeleavestatus(request $request){
    //return $request->all();
    $fromdate=$request->fromdate;
    $todate=$request->todate;

    $changestaus=Applyleave::find($request->id);
    $changestaus->status=$request->status;
    $changestaus->fromdate=$request->fromdate;
    $changestaus->todate=$request->todate;
    $changestaus->save();
    if($changestaus->status == "ACCEPTED"){
      //return 2;
        $begin = strtotime($fromdate);
        $end = strtotime($todate);
        for ( $i = $begin; $i <= $end; $i = $i + 86400 ) {
          $thisDate = date( 'Y-m-d', $i ); // 2010-05-01, 2010-05-02, etc
          $chk=Approvedleave::where('date',$thisDate)
                    ->where('employee_id',$changestaus->employeeid)
                    ->count();
          if($chk == 0){
         $approvedleave=new Approvedleave();
         $approvedleave->applyleaveid=$changestaus->id;
         $approvedleave->date=$thisDate;
         $approvedleave->employee_id=$changestaus->employeeid;
         $approvedleave->save();

          }
      }

    }
    //return 1;

  }
  public function ajaxfetchlabour(Request $request){

    $labours=employeedetail::where('groupid',$request->groupid)->get();
    return response()->json($labours);


  }
  public function ajaxfetchemployee(Request $request){

    $labours=employeedetail::where('empgroupid',$request->empgroupid)->get();
    return response()->json($labours);


  }
  public function ajaxfetchlabourfromgrp(Request $request){
    $entrytime=Carbon::parse($request->entrytime);
    $departuretime=Carbon::parse($request->departuretime);
    $labour=$request->labour;
    $groupid=$request->groupid;
    $numberofhour=$request->nof;
    $not=$request->nofot;
    $employeedetails=employeedetail::whereIn('id',$labour)->get();
    $difference=$numberofhour*60;
    $otmin=$not*60;
    if ($numberofhour==8) {
      $day=1;
    }
    else{
      $day=0.5;
    }
    //$difference=$entrytime->diffInMinutes($departuretime,false);
    $customarray=array();
    foreach ($employeedetails as $key => $employeedetail) {
      $noofhour=$employeedetail->noofhour;
      $minutes=$noofhour*60;
      $wages=$employeedetail->wages;
      $wagesperminute=$wages/$minutes;
      $totamt=$difference*$wagesperminute;
      if($otmin>0)
      {
        $otminutes=$otmin;
        $othours = $not;
        $otamount= $otminutes*$wagesperminute;
      }
      else{
        $otminutes=0;
        $othours = 0;
        $otamount= 0;
      }
      $arr=array(
        'id'=>$employeedetail->id,
        'employeename'=>$employeedetail->employeename,
        'totamt'=>number_format((float)$totamt, 2, '.', ''),
        'otamount'=>number_format((float)$otamount, 2, '.', ''),
        'othours'=>$othours,
        'wages'=>number_format((float)$wages, 2, '.', ''),
        'otminutes'=>$otminutes,
        'day'=>$day,
        'totnoofhour'=>intdiv($difference, 60).':'. ($difference % 60),
        'totnoofminutes'=>$difference,
        'entrytime'=>$request->entrytime,
        'departuretime'=>$request->departuretime

    );
      $customarray[]=$arr;
   }
    return $customarray;

  }
  public function ajaxfetchemployeefromgrp(Request $request){
    $entrytime=Carbon::parse($request->entrytime);
    $departuretime=Carbon::parse($request->departuretime);
    $labour=$request->labour;
    $empgroupid=$request->empgroupid;
    $numberofhour=$request->nof;
    $not=$request->nofot;
    $employeedetails=employeedetail::whereIn('id',$labour)->get();
    $difference=$numberofhour*60;
    $otmin=$not*60;
    if ($numberofhour==8) {
      $day=1;
    }
    else{
      $day=0.5;
    }
    //$difference=$entrytime->diffInMinutes($departuretime,false);
    $customarray=array();
    foreach ($employeedetails as $key => $employeedetail) {
      $noofhour=$employeedetail->noofhour;
      $minutes=$noofhour*60;
      $wages=$employeedetail->wages;
      $wagesperminute=$wages/$minutes;
      $totamt=$difference*$wagesperminute;
      if($otmin>0)
      {
        $otminutes=$otmin;
        $othours = $not;
        $otamount= $otminutes*$wagesperminute;
      }
      else{
        $otminutes=0;
        $othours = 0;
        $otamount= 0;
      }
      $arr=array(
        'id'=>$employeedetail->id,
        'employeename'=>$employeedetail->employeename,
        'totamt'=>number_format((float)$totamt, 2, '.', ''),
        'otamount'=>number_format((float)$otamount, 2, '.', ''),
        'othours'=>$othours,
        'wages'=>number_format((float)$wages, 2, '.', ''),
        'otminutes'=>$otminutes,
        'day'=>$day,
        'totnoofhour'=>intdiv($difference, 60).':'. ($difference % 60),
        'totnoofminutes'=>$difference,
        'entrytime'=>$request->entrytime,
        'departuretime'=>$request->departuretime

    );
      $customarray[]=$arr;
   }
    return $customarray;

  }
  public function ajaxfetchemployeeattngrp(Request $request){
    $empgroupid=$request->empgroupid;
    $attendancedate=$request->attendancedate;
    $employees=employeedetail::select('id','employeename')
                 ->where('emptype','Employee')
                 ->where('empgroupid',$empgroupid)
                 ->get();
    $res=array('employees'=>$employees,'attendancedate'=>$attendancedate);
    return response()->json($res);

  }
  public function ajaxexpchangedate(Request $request)
  {
        $expense=expenseentry::find($request->id);
        $expense->date=$request->date;
        $expense->save();

        return $expense->date;
  }


  public function ajaxsearchtenderno(Request $request){
    if($request->value!='')
    {
        $lists=tender::select('tenderrefno')
             ->where('tenderrefno', $request->value)
            ->orWhere('tenderrefno', 'like', '%' . $request->value . '%')
            ->get();

    $tender=tender::where('tenderrefno',$request->value)->count();
    if($tender>0)
    {
       $found=true;
    }
    else
    {
      $found=false;
    }
    $data=array('lists'=>$lists,'found'=>$found);  
    }

    else
    {
      $data=array('lists'=>[],'found'=>false);
    }
    

    return  response()->json($data);
  }

   public function savesuggestion(Request $request)
   {
       $suggestion=new suggestion();
       $suggestion->description=$request->description;
       $suggestion->save();

       return response()->json(1);
   }
    

    public function ajaxchangesuggestionstatus(Request $request)
    {
       $suggestion=suggestion::find($request->sid);
       $suggestion->status=$request->status;
       $suggestion->save();
       return response()->json($suggestion);
    }

    public function ajaxgetvehiclesforexpenseentry(Request $request)
    {
      $dailyvehicles=dailyvehicle::select('dailyvehicles.*','vehicles.vehiclename','vehicles.vehicleno')
                      ->leftJoin('vehicles','dailyvehicles.vehicleid','=','vehicles.id')
                      ->where('dailyvehicles.userid',Auth::id())
                      ->where('dailyvehicles.projectid',$request->projectid);
                     
      $dailyvehicles->whereRaw("dailyvehicles.date >= ? AND dailyvehicles.date <= ?",array($request->fromdate, $request->todate));
       $dailyvehicles=$dailyvehicles->get();

       return response()->json($dailyvehicles);
                      
    }

    public function ajaxgetlaboursforexpenseentry(Request $request)
    {
         $engagedlaboursarr=array();
        $dailylabours=dailylabour::select('dailylabours.*')
                      ->where('dailylabours.userid',Auth::id())
                      ->where('dailylabours.projectid',$request->projectid);
      $dailylabours->whereRaw("dailylabours.date >= ? AND dailylabours.date <= ?",array($request->fromdate, $request->todate));
       $dailylabours=$dailylabours->get();
       $totalno=0;
      foreach ($dailylabours as $key => $dailylabour) {
           $nooflabour=engagedlabour::where('dailylabourid',$dailylabour->id)->count();
            $engagedlaboursarr[]=[
              'id'=>$dailylabour->id,
              'date'=>$dailylabour->date,
              'nooflabour'=>$nooflabour,
            ];
            $totalno=$totalno+$nooflabour;
      }


      $response=array('totalno'=>$totalno,'data'=>$engagedlaboursarr);
       return response()->json($response);

    }
    public function ajaxrefreshusers()
    {
       $userids=userunderhod::select('userid')
                    ->get();
         $users=User::where('usertype','USER')->whereNotIn('id',$userids)->get();

        return response()->json($users);
    }
    public function ajaxremoveuserfromhod(Request $request)
    {
        userunderhod::find($request->id)->delete();
        return response()->json($request->id);
    }

    public function ajaxnewuseraddunderhod(Request $request)
    {
      $userunderhod=new userunderhod();
      $userunderhod->hodid=$request->hodid;
      $userunderhod->userid=$request->userid;
      $userunderhod->save();

      return response()->json($userunderhod);
    }
    public function ajaxgetusersunderhod(Request $request)
    {
          $users=userunderhod::select('userunderhods.*','users.name')
                ->leftJoin('users','userunderhods.userid','=','users.id')
                ->where('hodid',$request->hodid)
                ->get();
          return response()->json($users);
    }

    public function ajaxcheckwalletbalance(Request $request)
    {
         $wallet=wallet::where('employeeid',Auth::id())
                ->get();
         $walletcr=$wallet->sum('credit');
         $walletdr=$wallet->sum('debit');
         $walletbalance=$walletcr-$walletdr;

         return $walletbalance;
    }
    public function ajaxcountrequestdifferdate(Request $request)
    {
      $countdifferdate=complaint::where('status','REQ DIFFER DATE')
                                 ->count();


      return $countdifferdate;
    }
    public function ajaxapprove(Request $request)
    {

        $expenseentry=expenseentry::find($request->id);
         $expenseentry->status=$request->type;
         $expenseentry->approvalamount=$request->amt;
         if($request->type!='CANCELLED')
         {
            
             $expenseentry->approvedby=Auth::id();
         }
         else
         {
              $expenseentry->remarks=$request->remarks;
         }
         
         $expenseentry->save();
         $towalletchk=$expenseentry->towallet;
         $employeeid=$expenseentry->employeeid;
         if($towalletchk=='YES')
         {
             $wallet=new wallet();
             $wallet->employeeid=$employeeid;
             $wallet->credit=$request->amt;
             $wallet->debit='0';
             $wallet->rid=$request->id;
             $wallet->addedby=Auth::id();
             $wallet->save();
         }
         

        return response()->json($expenseentry);
    }public function ajaxapproveadmin(Request $request)
    {
        
         $expenseentry=expenseentry::find($request->id);
         $expenseentry->status=$request->type;
         $expenseentry->approvalamount=$expenseentry->amount;
         if($request->type!='CANCELLED')
         {
            
             $expenseentry->approvedby=Auth::id();
         }
         else
         {
              $expenseentry->remarks=$request->remarks;
              $expenseentry->approvalamount=$request->amt;
         }
         
         $expenseentry->save();
         $towalletchk=$expenseentry->towallet;
         $employeeid=$expenseentry->employeeid;
         if($towalletchk=='YES')
         {
             $wallet=new wallet();
             $wallet->employeeid=$employeeid;
             $wallet->credit=$expenseentry->amount;
             $wallet->debit='0';
             $wallet->rid=$request->id;
             $wallet->addedby=Auth::id();
             $wallet->save();
         }
         

         return response()->json($expenseentry);
    }
    public function ajaxapprovehod(Request $request)
    {
        //return $request->remarks;
         $expenseentry=expenseentry::find($request->id);
         $expenseentry->status=$request->type;
         $expenseentry->approvalamount=$expenseentry->amount;
         
         if($request->type!='CANCELLED')
         {
            $expenseentry->hodremarks=$request->remarks;
            $expenseentry->approvedby=Auth::id();
         }
         else
         {
              $expenseentry->remarks=$request->remarks;
              $expenseentry->approvalamount=$request->amt;
         }
         $expenseentry->save();
         $towalletchk=$expenseentry->towallet;
         $employeeid=$expenseentry->employeeid;
         if($towalletchk=='YES')
         {
             $wallet=new wallet();
             $wallet->employeeid=$employeeid;
             $wallet->credit=$expenseentry->amount;
             $wallet->debit='0';
             $wallet->rid=$request->id;
             $wallet->addedby=Auth::id();
             $wallet->save();
         }
         

         return response()->json($expenseentry);
    }
    public function accountkitverify(Request $request){
     
        // Initialize variables
       /* $app_id ='347046322758957';
        $secret ='ac0036a107ff01e42fe35302d78ffca7';
        $version ='v1.1'; // 'v1.1' for example*/

        // Method to send Get request to url
   function doCurl($url) {
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, $url);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          $data = json_decode(curl_exec($ch), true);
          curl_close($ch);
          return $data;
        }

        // Exchange authorization code for access token
        $token_exchange_url = 'https://graph.accountkit.com/v1.1/access_token?'.
          'grant_type=authorization_code'.
          '&code='.$request->code.
          "&access_token=AA|347046322758957|ac0036a107ff01e42fe35302d78ffca7";

        $data = doCurl($token_exchange_url);
        $user_id = $data['id'];
        $user_access_token = $data['access_token'];
        $refresh_interval = $data['token_refresh_interval_sec'];

        // Get Account Kit information
        $me_endpoint_url = 'https://graph.accountkit.com/v1.1/me?'.
          'access_token='.$user_access_token;
        $data = doCurl($me_endpoint_url);

        return $data;

    }

    public function ajaxchangetodostatus(Request $request)
    {
          $todo=todo::find($request->tid);
          $todo->status=$request->status;
          $todo->save();

          return $todo;
    }
   

    public function ajaxcountunreadmessage()
    {    

        $uid=Auth::id();
        $count=DB::table('chatjoins')
                    ->where('reciver',$uid)
                    ->where('seen','1')
                     ->count();
                      

        return response()->json($count);  
    }

  public function ajaxcomposemessage(Request $request)
  {
       $chat=new chat();
          $chat->sender=Auth::id();
          $chat->reciver=$request->reciver;
          $chat->message=$request->message;
          $rarefile = $request->file('attachment');
          if($rarefile!='')
        {
             $u=time().uniqid(rand());
        $raupload ="img/chatattachment";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $chat->attachment = $uplogoimg;
        $chat->attachmentrealname = $rarefile->getClientOriginalName();
        }

        $s1=Auth::id();//15
        $r1=$request->reciver;//13
        if($s1<$r1)
        {
            $cvid=$s1.'_'.$r1;
        }
        else
         {
            $cvid=$r1.'_'.$s1;
         } 
        $chat->convertationid=$cvid;
        $chat->save();
        $chatid=$chat->id;

        

                 if($chat->sender==Auth::id())
                    {
                      $name=$chat->reciver;
                    }
                    else
                    {
                      $name=$chat->sender;
                    }

                    $u=User::find($name);
                    $otherpartyname=$u->name;
                    $otherpartyid=$name;
                    $authid=Auth::id();
                    $convertationid=$chat->convertationid;
                   $arr=array('otherpartyname'=>$otherpartyname,'otherpartyid'=>$otherpartyid,'authid'=>$authid,'convertationid'=>$convertationid);
        return response()->json($arr);
  }
  public function ajaxchangeseenstatus(Request $request)
  {
      
             $chat=chat::where('convertationid',$request->convertationid)
             ->where('reciver',Auth::id())
             ->update(['seen'=>'0']);
       

       
          $chat=chat::where('convertationid',$request->convertationid)
                ->where('reciver',Auth::id())
                ->where('sender',Auth::id())
               ->update(['seen'=>'0']);
       

       return '1';
  }
   public function ajaxloadconvertation()
   {

     $uid=Auth::id();
    
     $sub=DB::table('chatjoins')->orderBy('created_at','DESC');

/*    $messages = DB::table(DB::raw("({$sub->toSql()}) as sub"))
   ->where(function($query) use ($uid){
                      $query->where('sender',$uid);
                      $query->orWhere('reciver',$uid);
                  })

    ->groupBy('convertationid')
    ->get();
*/
    $messages=DB::table('chatjoins')
                ->where(function($query) use ($uid){
                      $query->where('sender',$uid);
                      $query->orWhere('reciver',$uid);
                        })
                     ->orderBy('created_at', 'desc')
                     ->get()
                     ->unique('convertationid');
   

        $arr=array('messages'=>$messages,'authid'=>$uid);
      return response()->json($arr);
   }
   public function ajaxsendmessage(Request $request)
   {

           $chat=new chat();
          $chat->sender=Auth::id();
          $chat->reciver=$request->otherpartyid;
          $chat->message=$request->message;
          $rarefile = $request->file('attachment');
          if($rarefile!='')
        {
             $u=time().uniqid(rand());
        $raupload ="img/chatattachment";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $chat->attachment = $uplogoimg;
        $chat->attachmentrealname = $rarefile->getClientOriginalName();
        }

        $s1=Auth::id();//15
        $r1=$request->otherpartyid;//13
        if($s1<$r1)
        {
            $cvid=$s1.'_'.$r1;
        }
        else
         {
            $cvid=$r1.'_'.$s1;
         } 
        $chat->convertationid=$cvid;
        $chat->save();
        $chatid=$chat->id;

        

                 if($chat->sender==Auth::id())
                    {
                      $name=$chat->reciver;
                    }
                    else
                    {
                      $name=$chat->sender;
                    }

                    $u=User::find($name);
                    $otherpartyname=$u->name;
                    $otherpartyid=$name;
                    $authid=Auth::id();
                    $convertationid=$chat->convertationid;
                   $arr=array('otherpartyname'=>$otherpartyname,'otherpartyid'=>$otherpartyid,'authid'=>$authid,'convertationid'=>$convertationid);
        return response()->json($arr);
   }

   public function ajaxgetchathistory(Request $request)
   {
        $oldmessages=chat::where('convertationid',$request->convertationid)->orderBy('created_at','DESC')->get();

         return response()->json($oldmessages);
   }
  public function verifyOtp(Request $request)
  {
    $current_time = Carbon::now();
      $mob=$request->mob;
      $otp=$request->otp;

      $otps=otp::where('mobile',$mob)->orderBy('id','desc')->first();
      $created_at=$otps->created_at;
      $votp=$otps->otp;
      $totalDuration = $current_time->diffInSeconds($created_at);
      if($otp==$votp){
         if($totalDuration<601)
         {
            return "Otp Matched";
         }
         else
         {
           return"Otp EXPIRED";
         }
      }
      else
      {
        return "Invalid Otp";
      }
  }



 public function sendOtp(Request $request)
    {
      $mob=$request->mob;
        
           $otpvalue=rand(100000,999999);

          $otp=new otp();
          $otp->mobile=$mob;
          $otp->otp=$otpvalue;
          $otp->save();

   return "Otp sent to your mobile no Your Otp is".$otp->otp;
    }


 public function ajaxgetparticulars(Request $request)
 {
      $particulars=particular::where('expenseheadid',$request->expenseheadid)->get();


      return response()->json($particulars);
 }

  public function ajaxgetactivitiesall(Request $request)
  {
       $projectactivity=projectactivity::select('projectactivities.*','activities.activityname')
                       ->leftJoin('activities','projectactivities.activityid','=','activities.id')
                       ->where('projectactivities.projectid',$request->projectid)
                       ->get();

       return response()->json($projectactivity);
  }

   public function ajaxgetprojects(Request $request)
   {
       $projects=project::where('clientid',$request->clientid)->get();

       return response()->json($projects);
   }

	  public function ajaxmemberaddtoactivity(Request $request)
	  {
	  	

         $assignedactivity=new assignedactivity();
         $assignedactivity->userid=$request->member;
         $assignedactivity->activityassigned=$request->activityid;
         $assignedactivity->save();

         $user=User::find($request->member);
         $user->usertype=$request->usertype;
         $user->save();

	  	   return "1";
	  }
	  public function ajaxallusers(Request $request)
	  {
       
        
          $userids=assignedactivity::select('userid')

                    ->where('activityassigned',$request->activityid)
                    ->get();

           $users=User::where('usertype','!=','MASTER ADMIN')->whereNotIn('id',$userids)->get();


            
	  	  return response()->json($users);
	  }
      public function ajaxaddactivity(Request $request)
      {
        $activity=new activity();
        $activity->activityname=$request->activityname;
        $activity->description=$request->description;
        $activity->userid=Auth::id();
        $activity->save();

        return response()->json($activity);
      }

      public function ajaxgetdetails(Request $request)
      {
      	   $users=User::select('assignedactivities.*','users.name','users.usertype','activities.activityname')
                   ->leftJoin('assignedactivities','assignedactivities.userid','=','users.id')
      	          ->leftJoin('activities','assignedactivities.activityassigned','=','activities.id')
      	          ->where('assignedactivities.activityassigned',$request->activityid)
      	          ->get();


      	    return response()->json($users);
      }

      public function ajaxremovemeberfromactivity(Request $request)
      {
           
           $assignedactivity=assignedactivity::find($request->id)->delete();

           return "1";
      }
}
