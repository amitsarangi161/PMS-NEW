<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\expensehead;
use Auth;
use Carbon\Carbon;
use App\wallet;
use Session;
use App\particular;
use App\bank;
use App\deductiondefination;
use App\vendor;
use App\User;

use App\project;
use App\expenseentry;
use App\requisition;
use App\requisitionheader;
use App\requisitionpayment;
use App\useraccount;
use App\payment;
use App\complaint;
use App\complaintlog;
use App\unit;
use DataTables;
use DB;
use App\debitvoucher;
use App\debitvoucherheader;
use App\debitvoucherpayment;
use App\labour;
use App\vehicle;
use App\crsetup;
use App\crvoucherheader;
use App\crvoucheritem;
use App\hsncode;
use App\discount;
use App\billheader;
use App\billitem;
use App\invoiceno;
use App\creditvoucherdeduction;
use App\userunderhod;
use App\client;
use App\expenseentrydailylabour;
use App\engagedlabour;
use App\expenseentrydailyvehicle;
use App\voucher;
use Excel;
use App\tempsalary;
use App\Openingbalance;
use App\Bankledger;



class AccountController extends Controller
{  

public function viewdetailledgerbank($id){
  $ob=Openingbalance::where('bankid',$id)->pluck('amount')->first();
  $bankledgers=Bankledger::where('bankid',$id)
              ->orderBy('date','asc')
              ->selectRaw('*, sum(cr) as sumcr,sum(dr) as sumdr')
              ->groupBy('date')
              ->get();

  $details=Openingbalance::select('openingbalances.*','banks.bankname','useraccounts.acno','useraccounts.accountholdername','useraccounts.ifsccode')
                        ->leftJoin('useraccounts','openingbalances.bankid','=','useraccounts.id')
                        ->leftJoin('banks','useraccounts.bankid','=','banks.id')
                        ->where('openingbalances.id',$id)
                        ->first();
  
  //return compact('ob','bankledgers','details');
  return view('accounts.viewdetailledgerbank',compact('ob','bankledgers','details'));

}
public function viewdetailsadminexpenseentrybydate($empid,$dt)
       {
        //return $dt;
          $expenseentry=expenseentry::select('expenseentries.*','u1.name as for','u2.name as by','projects.projectname','clients.clientname','expenseheads.expenseheadname','particulars.particularname','vendors.vendorname','u3.name as approvedbyname','u4.name as hodname')
                      ->leftJoin('users as u1','expenseentries.employeeid','=','u1.id')
                      ->leftJoin('users as u2','expenseentries.userid','=','u2.id')
                      ->leftJoin('users as u3','expenseentries.approvedby','=','u3.id')
                      ->leftJoin('projects','expenseentries.projectid','=','projects.id')
                      ->leftJoin('clients','projects.clientid','=','clients.id')
                      ->leftJoin('expenseheads','expenseentries.expenseheadid','=','expenseheads.id')
                      ->leftJoin('particulars','expenseentries.particularid','=','particulars.id')
                       ->leftJoin('vendors','expenseentries.vendorid','=','vendors.id')
                       ->leftJoin('userunderhods','expenseentries.employeeid','=','userunderhods.userid')
                       ->leftJoin('users as u4','userunderhods.hodid','=','u4.id')
                       ->where('expenseentries.employeeid',$empid)
                      ->where('expenseentries.date',$dt)
                      ->where('expenseentries.status','PENDING')
                      ->get();
  //return $expenseentry;
  //return $empid;
           $requisition=requisitionheader::select('requisitions.*','requisitionheaders.employeeid','requisitionpayments.amount as paidamt')
                      ->leftJoin('requisitionpayments','requisitionpayments.rid','=','requisitionheaders.id')
                       ->leftJoin('requisitions','requisitions.requisitionheaderid','=','requisitionheaders.id')
                       ->where('requisitionpayments.paymentstatus','PAID')
                       ->where('requisitionpayments.paymenttype','!=','WALLET')
                      ->where('requisitionheaders.employeeid',$empid)
                      ->groupBy('requisitionpayments.id')
                      ->get();
          //return $requisition;
          $totalamt=$requisition->sum('paidamt');
        
        $entries=expenseentry::where('employeeid',$empid)
                ->where('towallet','!=','YES')
                ->get();
          $totalamtentry=$entries->sum('approvalamount');
          $wallet=wallet::where('employeeid',$empid)
                ->get();
         $walletcr=$wallet->sum('credit');
         $walletdr=$wallet->sum('debit');
         $walletbalance=$walletcr-$walletdr;

          $bal=($totalamt-$totalamtentry)-$walletbalance;

          $all=array('totalamt'=>$totalamt,'totalexpense'=>$totalamtentry,'balance'=>$bal);
 
           //return $empid;;
           return view('accounts.viewdetailsadminexpenseentrybydate',compact('expenseentry','totalamt','totalamtentry','bal','walletbalance','empid'));
       }
      public function adminpendingexpenseentryview($empid)
    {
       
         $expenseentries=expenseentry::select('expenseentries.*','u1.name as for')
                      ->leftJoin('users as u1','expenseentries.employeeid','=','u1.id')
                      ->where('expenseentries.status','PENDING')
                      ->where('expenseentries.employeeid',$empid)
                      ->groupBy('expenseentries.date')
                      ->get();
//return $expenseentries;
          return view('accounts.adminpendingexpenseentryview',compact('expenseentries'));
    } 

  public function viewdetailshodexpenseentrybydate($empid,$dt)
       {
        //return $dt;
          $expenseentry=expenseentry::select('expenseentries.*','u1.name as for','u2.name as by','projects.projectname','clients.clientname','expenseheads.expenseheadname','particulars.particularname','vendors.vendorname','u3.name as approvedbyname','u4.name as hodname')
                      ->leftJoin('users as u1','expenseentries.employeeid','=','u1.id')
                      ->leftJoin('users as u2','expenseentries.userid','=','u2.id')
                      ->leftJoin('users as u3','expenseentries.approvedby','=','u3.id')
                      ->leftJoin('projects','expenseentries.projectid','=','projects.id')
                      ->leftJoin('clients','projects.clientid','=','clients.id')
                      ->leftJoin('expenseheads','expenseentries.expenseheadid','=','expenseheads.id')
                      ->leftJoin('particulars','expenseentries.particularid','=','particulars.id')
                       ->leftJoin('vendors','expenseentries.vendorid','=','vendors.id')
                       ->leftJoin('userunderhods','expenseentries.employeeid','=','userunderhods.userid')
                       ->leftJoin('users as u4','userunderhods.hodid','=','u4.id')
                       ->where('expenseentries.employeeid',$empid)
                      ->where('expenseentries.date',$dt)
                      ->where('expenseentries.status','HOD PENDING')
                      ->get();
  //return $expenseentry;
  //return $empid;
           $requisition=requisitionheader::select('requisitions.*','requisitionheaders.employeeid','requisitionpayments.amount as paidamt')
                      ->leftJoin('requisitionpayments','requisitionpayments.rid','=','requisitionheaders.id')
                       ->leftJoin('requisitions','requisitions.requisitionheaderid','=','requisitionheaders.id')
                       ->where('requisitionpayments.paymentstatus','PAID')
                       ->where('requisitionpayments.paymenttype','!=','WALLET')
                      ->where('requisitionheaders.employeeid',$empid)
                      ->groupBy('requisitionpayments.id')
                      ->get();
          //return $requisition;
          $totalamt=$requisition->sum('paidamt');
        
        $entries=expenseentry::where('employeeid',$empid)
                ->where('towallet','!=','YES')
                ->get();
          $totalamtentry=$entries->sum('approvalamount');
          $wallet=wallet::where('employeeid',$empid)
                ->get();
         $walletcr=$wallet->sum('credit');
         $walletdr=$wallet->sum('debit');
         $walletbalance=$walletcr-$walletdr;

          $bal=($totalamt-$totalamtentry)-$walletbalance;

          $all=array('totalamt'=>$totalamt,'totalexpense'=>$totalamtentry,'balance'=>$bal);
 
           //return $empid;;
           return view('accounts.viewdetailshodexpenseentrybydate',compact('expenseentry','totalamt','totalamtentry','bal','walletbalance','empid'));
       }
  public function drpaymentschedule(Request $request){

    $drscheduledate=debitvoucherpayment::find($request->paymentid);
    $drscheduledate->scheduledate=$request->scheduledate;
    $drscheduledate->save();
    return back();
  }
  public function requisitionpaymentschedule(Request $request){

    $reqscheduledate=requisitionpayment::find($request->paymentid);
    $reqscheduledate->scheduledate=$request->scheduledate;
    $reqscheduledate->save();
    return back();
  }

   public function edittempsalary($id)
   {
       $salary=tempsalary::find($id);
            $employees=user::where('employee_id','<>','')
                         ->where('active','1')
                         ->get();
           $banks=useraccount::select('useraccounts.*','banks.bankname')
              ->where('useraccounts.type','COMPANY')
              ->leftJoin('banks','useraccounts.bankid','=','banks.id')
              ->get();

           return view('accounts.edittempsalary',compact('salary','employees','banks'));
   }

   public function viewsalary()
   {
         $salaries=tempsalary::select('tempsalaries.*','banks.bankname','useraccounts.acno','useraccounts.branchname','users.name')
            ->leftJoin('users','tempsalaries.userid','=','users.id')
            ->leftJoin('useraccounts','tempsalaries.frombank','=','useraccounts.id')
            ->leftJoin('banks','useraccounts.bankid','=','banks.id')
            ->groupBy('tempsalaries.id')
            ->get();

           
           return view('accounts.viewsalary',compact('salaries'));
   }
    public function savetempsalary(Request $request)
    {
            
           $tempsalary=new tempsalary();
           $tempsalary->userid=$request->userid;
           $tempsalary->salarytype=$request->salarytype;
           $tempsalary->year=$request->foryear;
           $tempsalary->month=$request->formonth;
           $tempsalary->amount=$request->amount;
           $tempsalary->frombank=$request->frombank;
           $tempsalary->purpose=$request->description;
           $tempsalary->dateofpayment=$request->dateofpayment;
           $tempsalary->trnid=$request->trnid;
           $tempsalary->save();

         Session::flash('msg','Salary Added Successfully');
          return back();
    } 
    public function updatetempsalary(Request $request,$id)
    {
            
           $tempsalary=tempsalary::find($id);
           $tempsalary->userid=$request->userid;
           $tempsalary->salarytype=$request->salarytype;
           $tempsalary->year=$request->foryear;
           $tempsalary->month=$request->formonth;
           $tempsalary->amount=$request->amount;
           $tempsalary->frombank=$request->frombank;
           $tempsalary->purpose=$request->description;
           $tempsalary->dateofpayment=$request->dateofpayment;
           $tempsalary->trnid=$request->trnid;
           $tempsalary->save();

         Session::flash('msg','Salary Added Successfully');
          return redirect('/tempsalary/viewsalary');
    }

     public function cretetempsalary()
     {
           $employees=user::where('employee_id','<>','')
                         ->where('active','1')
                         ->get();
           $banks=useraccount::select('useraccounts.*','banks.bankname')
              ->where('useraccounts.type','COMPANY')
              ->leftJoin('banks','useraccounts.bankid','=','banks.id')
              ->get();

           return view('accounts.cretetempsalary',compact('employees','banks'));
     }

      public function payvoucher(Request $request,$id)
      {

          $voucher=voucher::find($id);
          $voucher->status='PAID';
          $voucher->paymenttype=$request->paymenttype;
          $voucher->frombankid=$request->frombankid;
          $voucher->trnid=$request->trnid;
          $voucher->paymentremarks=$request->remarks;
          $voucher->save();

          return redirect('/acc-vouchers/approvedvouchers');

      }
      public function viewvoucher($id)
      {
          $voucher=voucher::select('vouchers.*','projects.projectname','expenseheads.expenseheadname','particulars.particularname','users.name as author','u1.name as approvedbyname','banks.bankname')
                    ->leftJoin('projects','vouchers.projectid','=','projects.id')
                    ->leftJoin('expenseheads','vouchers.expenseheadid','=','expenseheads.id')
                    ->leftJoin('particulars','vouchers.particularid','=','particulars.id')
                    ->leftJoin('banks','vouchers.bankid','=','banks.id')
                    ->leftJoin('users','vouchers.author','=','users.id')
                    ->leftJoin('users as u1','vouchers.author','=','u1.id')
                    ->where('vouchers.id',$id)
                    ->first();   
          $fromacc=useraccount::select('useraccounts.*','banks.bankname')
              ->where('useraccounts.id',$voucher->frombankid)
              ->leftJoin('banks','useraccounts.bankid','=','banks.id')
              ->first();
         
          return view('accounts.viewvoucher',compact('voucher','fromacc'));
      } 
     public function viewapprovedvoucher($id)
      {
          $voucher=voucher::select('vouchers.*','projects.projectname','expenseheads.expenseheadname','particulars.particularname','users.name as author','u1.name as approvedbyname')
                    ->leftJoin('projects','vouchers.projectid','=','projects.id')
                    ->leftJoin('expenseheads','vouchers.expenseheadid','=','expenseheads.id')
                    ->leftJoin('particulars','vouchers.particularid','=','particulars.id')
                    ->leftJoin('users','vouchers.author','=','users.id')
                    ->leftJoin('users as u1','vouchers.author','=','u1.id')
                    ->where('vouchers.id',$id)
                    ->first();  
            $banks=useraccount::select('useraccounts.*','banks.bankname')
              ->where('useraccounts.type','COMPANY')
              ->leftJoin('banks','useraccounts.bankid','=','banks.id')
              ->get();

          return view('accounts.viewapprovedvoucher',compact('voucher','banks'));
      }
      public function approvevoucher(Request $request,$id)
      {

          $voucher=voucher::find($id);
          $voucher->status="APPROVED";
          $voucher->approvedby=Auth::id();
          $voucher->save();

          return back();

      }  
       public function approvevouchermgr(Request $request,$id)
      {

          $voucher=voucher::find($id);
          $voucher->status="PENDING";
          $voucher->approvedby=Auth::id();
          $voucher->save();

          return back();

      }
      public function cancelthisvoucher(Request $request,$id)
      {
          $voucher=voucher::find($id);
          $voucher->status="CANCELLED";
          $voucher->cancelledby=Auth::id();
          $voucher->save();
          return back();
      }

       public function viewallvouchers()
       {
            $vouchers=voucher::select('vouchers.*','projects.projectname','expenseheads.expenseheadname','particulars.particularname','users.name as author','banks.bankname')
                    ->leftJoin('projects','vouchers.projectid','=','projects.id')
                    ->leftJoin('expenseheads','vouchers.expenseheadid','=','expenseheads.id')
                    ->leftJoin('particulars','vouchers.particularid','=','particulars.id')
                    ->leftJoin('banks','vouchers.bankid','=','banks.id')
                    ->leftJoin('users','vouchers.author','=','users.id')
                    ->get();

          return view('accounts.viewallvouchers',compact('vouchers'));

       }
       public function pendingvouchers()
       {
            $vouchers=voucher::select('vouchers.*','projects.projectname','expenseheads.expenseheadname','particulars.particularname','users.name as author','banks.bankname')
                    ->leftJoin('projects','vouchers.projectid','=','projects.id')
                    ->leftJoin('expenseheads','vouchers.expenseheadid','=','expenseheads.id')
                    ->leftJoin('particulars','vouchers.particularid','=','particulars.id')
                    ->leftJoin('banks','vouchers.bankid','=','banks.id')
                    ->leftJoin('users','vouchers.author','=','users.id')
                    ->where('vouchers.status','PENDING')
                    ->get();

          return view('accounts.pendingvouchers',compact('vouchers'));

       } 
       public function pendingvouchersmgr()
       {
            $vouchers=voucher::select('vouchers.*','projects.projectname','expenseheads.expenseheadname','particulars.particularname','users.name as author','banks.bankname')
                    ->leftJoin('projects','vouchers.projectid','=','projects.id')
                    ->leftJoin('expenseheads','vouchers.expenseheadid','=','expenseheads.id')
                    ->leftJoin('particulars','vouchers.particularid','=','particulars.id')
                    ->leftJoin('banks','vouchers.bankid','=','banks.id')
                    ->leftJoin('users','vouchers.author','=','users.id')
                    ->where('vouchers.status','PENDING MGR')
                    ->get();

          return view('accounts.pendingvouchersmgr',compact('vouchers'));

       } 

        public function paidvouchers()
       {
            $vouchers=voucher::select('vouchers.*','projects.projectname','expenseheads.expenseheadname','particulars.particularname','users.name as author','banks.bankname')
                    ->leftJoin('projects','vouchers.projectid','=','projects.id')
                    ->leftJoin('expenseheads','vouchers.expenseheadid','=','expenseheads.id')
                    ->leftJoin('particulars','vouchers.particularid','=','particulars.id')
                    ->leftJoin('banks','vouchers.bankid','=','banks.id')
                    ->leftJoin('users','vouchers.author','=','users.id')
                    ->where('vouchers.status','PAID')
                    ->get();

          return view('accounts.paidvouchers',compact('vouchers'));

       } 
       public function approvedvouchers()
       {
            $vouchers=voucher::select('vouchers.*','projects.projectname','expenseheads.expenseheadname','particulars.particularname','users.name as author','banks.bankname')
                    ->leftJoin('projects','vouchers.projectid','=','projects.id')
                    ->leftJoin('expenseheads','vouchers.expenseheadid','=','expenseheads.id')
                    ->leftJoin('particulars','vouchers.particularid','=','particulars.id')
                    ->leftJoin('users','vouchers.author','=','users.id')
                    ->leftJoin('banks','vouchers.bankid','=','banks.id')
                    ->where('vouchers.status','APPROVED')
                    ->get();

          return view('accounts.approvedvouchers',compact('vouchers'));

       } 
       public function cancelledvouchers()
       {
            $vouchers=voucher::select('vouchers.*','projects.projectname','expenseheads.expenseheadname','particulars.particularname','users.name as author','banks.bankname')
                    ->leftJoin('projects','vouchers.projectid','=','projects.id')
                    ->leftJoin('expenseheads','vouchers.expenseheadid','=','expenseheads.id')
                    ->leftJoin('particulars','vouchers.particularid','=','particulars.id')
                    ->leftJoin('users','vouchers.author','=','users.id')
                    ->leftJoin('banks','vouchers.bankid','=','banks.id')
                    ->where('vouchers.status','CANCELLED')
                    ->get();

          return view('accounts.cancelledvouchers',compact('vouchers'));

       }
       public function savevoucher(Request $request)
       {
            if($request->amounttopay>0)
            {
                $voucher=new voucher();
            $voucher->payeename=$request->payeename;
            $voucher->bankid=$request->bankid;
            $voucher->acno=$request->acno;
            $voucher->ifsccode=$request->ifsccode;
            $voucher->chequedetails=$request->chequedetails;
            $voucher->projectid=$request->projectid;
            $voucher->expenseheadid=$request->expenseheadid;
            $voucher->particularid=$request->particularid;
       
            $voucher->amount=$request->amount;
            $voucher->tds=$request->tds;
            $voucher->tdsamt=$request->tdsamt;
            $voucher->amounttopay=$request->amounttopay;
            $voucher->description=$request->description;
            $voucher->author=Auth::id();
            $voucher->status="PENDING MGR";
               $rarefile = $request->file('uploadedfile'); 
           
                   if($rarefile!=''){
                    $raupload = public_path() .'/img/vouchers/';
                    $rarefilename=time().'.'.$rarefile->getClientOriginalName();
                    $success=$rarefile->move($raupload,$rarefilename);
                    $voucher->uploadedfile = $rarefilename;
                     }

            $voucher->save();
             Session::flash('msg','Voucher Saved Successfully');
            }
            else
            {
                  Session::flash('err','Error in Voucher Upload please try Again');
            }

           

            return back();
       }
       public function createvoucher()
       {
            $expenseheads=expensehead::all();
            $projects=project::all();
            $banks=bank::all();

            return view('accounts.createvoucher',compact('expenseheads','projects','banks'));
       }
      public function updatecompanybankaccount(Request $request)
      {

        $useraccount=useraccount::find($request->uid);

        $useraccount->bankid=$request->bankid;
        $useraccount->acno=$request->acno;
        $useraccount->accountholdername=$request->accountholdername;
        $useraccount->ifsccode=$request->ifsccode;
        $useraccount->branchname=$request->branchname;
        //$useraccount->forcompany=$request->forcompany;
        $useraccount->userid=Auth::id();
        $useraccount->type="COMPANY";
          $rarefile = $request->file('scancopy');    
        if($rarefile!=''){
        $raupload = public_path() .'/img/bankacscancopy/';
        $rarefilename=time().'.'.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$rarefilename);
        $useraccount->scancopy = $rarefilename;
        }
        $useraccount->save();
           Session::flash('msg','Account Data Updated Successfully');
       return back();

      }
      public function savecompanybankaccount(Request $request)
      {
           $count=useraccount::where('bankid',$request->bankid)->where('acno',$request->acno)->count();

         if ($count>0) {
              Session::flash('msg','Account Data Already Exists');
         }
         else
         {
        $useraccount=new useraccount();
        $useraccount->user=$request->user;
        $useraccount->bankid=$request->bankid;
        $useraccount->acno=$request->acno;
        $useraccount->accountholdername=$request->accountholdername;
        $useraccount->ifsccode=$request->ifsccode;
        $useraccount->branchname=$request->branchname;
        //$useraccount->forcompany=$request->forcompany;
        $useraccount->userid=Auth::id();
        $useraccount->type="COMPANY";
         $rarefile = $request->file('scancopy');    
        if($rarefile!=''){
        $raupload = public_path() .'/img/bankacscancopy/';
        $rarefilename=time().'.'.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$rarefilename);
        $useraccount->scancopy = $rarefilename;
        }

        $useraccount->save();
           Session::flash('msg','Account Data Saved Successfully');
         }
      
        return back();
      }

       public function companybankaccount()
       {
         $users=User::all();
          $banks=bank::all();

          $useraccounts=useraccount::select('useraccounts.*','users.name','banks.bankname')
                       ->leftJoin('users','useraccounts.user','=','users.id')
                       ->leftJoin('banks','useraccounts.bankid','=','banks.id')
                       ->where('useraccounts.type','COMPANY')
                       ->get();
        return view('accounts.companybankaccount',compact('users','banks','useraccounts'));

       }
    public function updatebanks(Request $request)
  {
      $bank=bank::find($request->bid);
      $bank->bankname=$request->bankname;
    
     $bank->userid=Auth::id();
     $bank->save();
     Session::flash('msg','Bank Details Updated Successfully');
     return back();

  }
  public function savebanks(Request $request)
  {
     $bank=new bank();
     $bank->bankname=$request->bankname;
   
     $bank->userid=Auth::id();
     $bank->save();
    Session::flash('msg','Bank Details Saved Successfully');
     return back();
  } 
  public function openingbalance(){

          $banks=useraccount::select('useraccounts.*','banks.bankname')
                    
                       ->leftJoin('banks','useraccounts.bankid','=','banks.id')
                       ->where('useraccounts.type','COMPANY')
                       ->get();
          $openingbalances=Openingbalance::select('openingbalances.*','banks.bankname','useraccounts.acno','useraccounts.accountholdername','useraccounts.ifsccode')
                        ->leftJoin('useraccounts','openingbalances.bankid','=','useraccounts.id')
                        ->leftJoin('banks','useraccounts.bankid','=','banks.id')
                        ->get();
          //return $openingbalances;
        return view('accounts.openingbalance',compact('users','banks','useraccounts','openingbalances'));

       }
  public function saveopeningbalance(Request $request){

    $chk=Openingbalance::where('bankid','=',$request->bankid)->count();
    if($chk == 0){
      $this->validate($request,[
            'amount' => "required|regex:/^\d+(\.\d{1,2})?$/",
       ]);
    $openingbalance= new Openingbalance();
    $openingbalance->bankid=$request->bankid;
    $openingbalance->date=$request->date;
    $openingbalance->amount=$request->amount;
    $openingbalance->save();
    Session::flash('msg','Account Data Updated Successfully');
    }else{
      Session::flash('err','Duplicate Entry please try Again');
    }
    return back();
    
  }
  public function addledger(){
   $banks=Openingbalance::select('openingbalances.*','banks.bankname','useraccounts.acno','useraccounts.accountholdername','useraccounts.ifsccode')
            ->leftJoin('useraccounts','openingbalances.bankid','=','useraccounts.id')
            ->leftJoin('banks','useraccounts.bankid','=','banks.id')
            ->get();
    $ledgers=Bankledger::select('bankledgers.*','useraccounts.accountholdername','banks.bankname','useraccounts.acno')
            ->leftJoin('openingbalances','bankledgers.bankid','=','openingbalances.id')
            ->leftJoin('useraccounts','openingbalances.bankid','=','useraccounts.id')
            ->leftJoin('banks','useraccounts.bankid','=','banks.id')
            ->get();
    //return $ledgers;
    //return date('Y-m-d');
    return view('accounts.addledger',compact('banks','ledgers'));


  }
  public function saveaddledger(Request $request){

    $date=Openingbalance::where('bankid',$request->bankid)->pluck('date')->first();
    $chk=Bankledger::where('date',date('Y-m-d'))->count();
    if($chk > 0){
       Session::flash('err','Failed!! Record Already Exist for date'.date('Y-m-d'));
       return back();
    }
   if(date('Y-m-d') >=$date && $chk == 0)
   {
    $this->validate($request,[
            'cr' => "required|regex:/^\d+(\.\d{1,2})?$/",
            'dr' => "required|regex:/^\d+(\.\d{1,2})?$/",
       ]);
    $ledger= new Bankledger();
    $ledger->bankid=$request->bankid;
    $ledger->cr=$request->cr;
    $ledger->dr=$request->dr;
    $ledger->date=date('Y-m-d');
    $ledger->save();
    Session::flash('msg','Account Data Updated Successfully');
   }
   else
   {
      Session::flash('err','Failed to Insert');
   }
    return back();
  }
  public function viewallledger(){
    
    $banks=Openingbalance::select('openingbalances.*','banks.bankname','useraccounts.acno','useraccounts.accountholdername','useraccounts.ifsccode')
            ->leftJoin('useraccounts','openingbalances.bankid','=','useraccounts.id')
            ->leftJoin('banks','useraccounts.bankid','=','banks.id')
            ->get();
    $custarr=array();

    if($banks)
    {
        foreach ($banks as $key => $bank) {
           $ob=$bank->amount;
           $bal=Bankledger::where('bankid',$bank->bankid)->get();

           $sumcr=$bal->sum('cr');
           $sumdr=$bal->sum('dr');



           $balance=($ob+$sumcr)-$sumdr;
          
           $custarr[]=array('id'=>$bank->id,'bank'=>$bank->bankname,'acholdername'=>$bank->accountholdername,'acno'=>$bank->acno,'ifsc'=>$bank->ifsccode,'balance'=>$balance);


        }
    }
    //return $custarr;
    return view('accounts.viewallledger',compact('custarr'));
  }


  //---------End New Account Controller-----------//
  public function banks()
  {
     $banks=bank::all();
     return view('accounts.banks',compact('banks'));
  }
  public function creditorledger(Request $request)
  {
       $allarray=array();
      $clients=billheader::select('clientname')->where('status','!=','REJECTED')->groupBy('clientname')->get();
      if($request->has('client') && $request->get('client')=='ALL')
       {
      $bills=billheader::where('status','APPROVED')->get();

      foreach ($bills as $key => $value) {
          $crvoucher=crvoucherheader::where('billid',$value->id)->first();
          $custarr=array('bill'=>$value,'crvoucher'=>$crvoucher);

          $allarray[]=$custarr;
      }
      //return $allarray;

    }

      
      return view('accounts.creditorledger',compact('clients','allarray'));
  }

   public function debitorledger(Request $request)
   {
       $debitvouchers=array();
       $alldebitvoucherarr=array();
       $vendors=vendor::all();

        if ($request->has('vendor')) {

          if ($request->get('vendor')=='ALL') {

                $vendors=vendor::all();

                foreach ($vendors as $key => $vendor) {
                   $allvouchers=debitvoucherheader::where('status','!=','CANCELLED')
                   ->where('vendorid',$vendor->id)
                   ->get();
                   $tobepaidamt=$allvouchers->sum('approvalamount');
                   $ids=debitvoucherheader::select('id')
                   ->where('status','!=','CANCELLED')
                   ->where('vendorid',$vendor->id)
                   ->get();
                   $paid=debitvoucherpayment::where('paymentstatus','PAID')
                        ->whereIn('did',$ids)
                        ->get();
                   $paidamt=$paid->sum('amount');
                   $bal=$tobepaidamt-$paidamt;

                   $custarr=array('vendorname'=>$vendor->vendorname,'cr'=>$tobepaidamt,'dr'=>$paidamt,'bal'=>$bal);
                 $alldebitvoucherarr[]=$custarr;
                }
                
           
          }
          else
          {

          $debitvoucherheaders=debitvoucherheader::where('vendorid',$request->vendor)
          ->where('status','!=','CANCELLED')
          ->get();
          foreach ($debitvoucherheaders as $key => $value) {
             $drvoucherpayments=debitvoucherpayment::where('did',$value->id)
                               ->where('paymentstatus','PAID')
                               ->get();
             $customarray=array('header'=>$value,'payments'=>$drvoucherpayments);

             $debitvouchers[]=$customarray;
          }

            }

          
        }

        //return $debitvouchers;
       return view('accounts.debitorledger',compact('vendors','debitvouchers','alldebitvoucherarr'));
   }
  public function ledger(Request $request)
  {
        $users=User::all();
        $projects=project::all();
        $customarr=array();
        if ($request->has('user') && $request->has('project')) {

              $requisitionpayments=requisitionpayment::select('requisitionpayments.*','users.name','projects.projectname')
             ->leftJoin('requisitionheaders','requisitionpayments.rid','=','requisitionheaders.id')
             ->leftJoin('users','requisitionheaders.employeeid','=','users.id')
             ->leftJoin('projects','requisitionheaders.projectid','=','projects.id')
             ->where('requisitionpayments.paymenttype','!=','WALLET');
               if ($request->get('user')!='') {
              $requisitionpayments=$requisitionpayments
                    ->where('requisitionheaders.employeeid',$request->get('user'));
                 }
              if ($request->get('project')!='') {
                $requisitionpayments=$requisitionpayments->where('requisitionheaders.projectid',$request->get('project'));
                
              }

             $requisitionpayments=$requisitionpayments->orderBy('requisitionpayments.dateofpayment')
             ->get();
            
           
            for ($i=0; $i < count($requisitionpayments); $i++) { 
                $stdt=$requisitionpayments[$i]->dateofpayment;
                $c=$i+1;
                if ($c==count($requisitionpayments)) {
                    $endt=$requisitionpayments[$i]->dateofpayment;

                }
                else
                {
                   $endt=$requisitionpayments[$c]->dateofpayment;

                }

                if ($stdt==$endt && $c!=count($requisitionpayments)) {
                    $expenseentries=array();
                }
                else
                {
                            $expenseentries=expenseentry::select('expenseentries.*','expenseheads.expenseheadname','particulars.particularname','projects.projectname','users.name')
                         ->leftJoin('users','expenseentries.employeeid','=','users.id')
                         ->leftJoin('projects','expenseentries.projectid','=','projects.id')
                         ->leftJoin('expenseheads','expenseentries.expenseheadid','=','expenseheads.id')
                         ->leftJoin('particulars','expenseentries.particularid','=','particulars.id')
                         ->where('expenseentries.towallet','=','NO')
                         ->where('expenseentries.status','!=','CANCELLED');
                         if ($request->get('project')!='') {
                             $expenseentries=$expenseentries
                        ->where('expenseentries.projectid',$request->get('project'));
                         } 
                         if ($request->get('user')!='') {
                             $expenseentries=$expenseentries
                        ->where('expenseentries.employeeid',$request->get('user'));
                         }


                        if ($c==count($requisitionpayments)) {
                            $expenseentries=$expenseentries
                        ->where('expenseentries.created_at','>=',$stdt.' 00:00:00');
                         
                          }
                          else
                          {
                           $expenseentries=$expenseentries
                        ->where('expenseentries.created_at','>=',$stdt.' 00:00:00')
                         ->where('expenseentries.created_at','<',$endt.' 00:00:00');
                          }
                         $expenseentries=$expenseentries

                         
                         ->orderBy('expenseentries.created_at')
                         ->get(); 
                }
                
                 
                 
                  $creatarr=array('payment'=>$requisitionpayments[$i],'expenses'=>$expenseentries,'stdt'=>$stdt,'endt'=>$endt);

                    $customarr[]=$creatarr;
                
            }
            
            
        }
        else
        {
             $requisitionpayments='';
        }
        $bal=0;
        //return compact('customarr','users','requisitionpayments','bal');
        
        return view('accounts.ledger',compact('customarr','users','requisitionpayments','bal','projects'));
  }

  public function pendinghodexpenseentry()
  {
            /*$expenseentries=expenseentry::select('expenseentries.*','u1.name as for','u2.name as by','projects.projectname','clients.clientname','expenseheads.expenseheadname','particulars.particularname','vendors.vendorname','u3.name as approvedbyname','u4.name as hodname')
                      ->leftJoin('users as u1','expenseentries.employeeid','=','u1.id')
                      ->leftJoin('users as u2','expenseentries.userid','=','u2.id')
                       ->leftJoin('users as u3','expenseentries.approvedby','=','u3.id')
                      ->leftJoin('projects','expenseentries.projectid','=','projects.id')
                      ->leftJoin('clients','projects.clientid','=','clients.id')
                      ->leftJoin('expenseheads','expenseentries.expenseheadid','=','expenseheads.id')
                      ->leftJoin('particulars','expenseentries.particularid','=','particulars.id')
                       ->leftJoin('vendors','expenseentries.vendorid','=','vendors.id')
                       ->leftJoin('userunderhods','expenseentries.employeeid','=','userunderhods.userid')
                       ->leftJoin('users as u4','userunderhods.hodid','=','u4.id')

                       ->where('expenseentries.status','HOD PENDING')
                      ->groupBy('expenseentries.employeeid')
                      ->get();*/
        $expenseentries=expenseentry::select('expenseentries.*','u1.name as for')
                      ->leftJoin('users as u1','expenseentries.employeeid','=','u1.id')
                      ->where('expenseentries.status','HOD PENDING')
                      ->groupBy('expenseentries.employeeid')
                      ->get();
//return $expenseentries;
          return view('accounts.pendinghodexpenseentry',compact('expenseentries'));
  }

   public function updatedebitvoucher(Request $request,$id)
   {

     
         if(count($request->itemname)==0)
         {
              Session::flash('msg',"Failed to Save Debit Voucher Blank Item List");

              return back();

         }

         $debitvoucherheader=debitvoucherheader::find($id);
         $debitvoucherheader->vendorid=$request->vendorid;
          $debitvoucherheader->projectid=$request->projectid;
         $debitvoucherheader->expenseheadid=$request->expenseheadid;
         $debitvoucherheader->billdate=$request->billdate;
         $debitvoucherheader->billno=$request->billno;
         $debitvoucherheader->tmrp=$request->tmrp;
         $debitvoucherheader->tdiscount=$request->tdiscount;
         $debitvoucherheader->tprice=$request->tprice;
         $debitvoucherheader->tqty=$request->tqty;
         $debitvoucherheader->tsgst=$request->tsgst;
         $debitvoucherheader->tcgst=$request->tcgst;
         $debitvoucherheader->tigst=$request->tigst;
         $debitvoucherheader->totalamt=$request->totalamt;
         $debitvoucherheader->itdeduction=$request->itdeduction;
         $debitvoucherheader->otherdeduction=$request->otherdeduction;
         $debitvoucherheader->finalamount=$request->finalamount;
         $rarefile = $request->file('invoicecopy');    
        if($rarefile!=''){
        $raupload = public_path() .'/img/debitvoucher/';
        $rarefilename=time().'.'.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$rarefilename);
        $debitvoucherheader->invoicecopy = $rarefilename;
        }
         $debitvoucherheader->save();
         $headerid=$debitvoucherheader->id;
         debitvoucher::where('headerid',$headerid)->delete();

         $count=count($request->itemname);

         for ($i=0; $i < $count; $i++) { 

          $debitvoucher=new debitvoucher();
          $debitvoucher->headerid=$headerid;
          $debitvoucher->itemname=$request->itemname[$i];
          $debitvoucher->unit=$request->unit[$i];
          $debitvoucher->qty=$request->qty[$i];
          $debitvoucher->mrp=$request->mrp[$i];
          $debitvoucher->discount=$request->discount[$i];
          $debitvoucher->price=$request->price[$i];
          $debitvoucher->sgstrate=$request->sgstrate[$i];
          $debitvoucher->sgstcost=$request->sgstcost[$i];
          $debitvoucher->cgstrate=$request->cgstrate[$i];
          $debitvoucher->cgstcost=$request->cgstcost[$i];
          $debitvoucher->igstrate=$request->igstrate[$i];
          $debitvoucher->igstcost=$request->igstcost[$i];
          $debitvoucher->igstcost=$request->igstcost[$i];
          $debitvoucher->grossamt=$request->grossamt[$i];
          $debitvoucher->save();

       }

         Session::flash('msg',"Debit Voucher Updated Successfully");
         return back();
   }


    public function viewpendingrequisitionhod(Request $request,$id)
    {
        $rq=requisitionheader::find($id);
           $empid=$rq->employeeid;
           $requisition=requisitionheader::select('requisitions.*','requisitionheaders.employeeid','requisitionpayments.amount as paidamt','vendors.id as vendorid','vendors.vendorname','vendors.mobile','vendors.details','vendors.bankname','vendors.acno','vendors.branchname','vendors.ifsccode','vendors.photo','vendors.vendoridproof')
                      ->leftJoin('requisitionpayments','requisitionpayments.rid','=','requisitionheaders.id')
                       ->leftJoin('requisitions','requisitions.requisitionheaderid','=','requisitionheaders.id')
                       ->leftJoin('vendors','requisitions.vendorid','=','vendors.id')
                       ->where('requisitionpayments.paymentstatus','PAID')
                       ->where('requisitionpayments.paymenttype','!=','WALLET')
                      ->where('requisitionheaders.employeeid',$empid)
                      ->groupBy('requisitionpayments.id')
                      ->get();
        
          $totalamt=$requisition->sum('paidamt');
        
        $entries=expenseentry::where('employeeid',$empid)
                ->where('towallet','!=','YES')
                ->get();
          $totalamtentry=$entries->sum('approvalamount');
         $wallet=wallet::where('employeeid',$empid)
                ->get();
         $walletcr=$wallet->sum('credit');
         $walletdr=$wallet->sum('debit');
         $walletbalance=$walletcr-$walletdr;
          $bal=($totalamt-$totalamtentry)-$walletbalance;

          $all=array('totalamt'=>$totalamt,'totalexpense'=>$totalamtentry,'balance'=>$bal);



          

            $users=User::all();
        $expenseheads=expensehead::all();
        $particulars=particular::all();

        $projects=project::select('projects.*','clients.orgname')
                ->leftJoin('clients','projects.clientid','=','clients.id')
                ->get();

          $requisitionheader=requisitionheader::find($id);
          $requisitions=requisition::select('requisitions.*','expenseheads.expenseheadname','particulars.particularname','vendors.id as vendorid','vendors.vendorname','vendors.mobile','vendors.details','vendors.bankname','vendors.acno','vendors.branchname','vendors.ifsccode','vendors.photo','vendors.vendoridproof')
                       ->leftJoin('expenseheads','requisitions.expenseheadid','=','expenseheads.id')
                       ->leftJoin('particulars','requisitions.particularid','=','particulars.id')
                       ->leftJoin('vendors','requisitions.vendorid','=','vendors.id')
                       ->where('requisitions.requisitionheaderid',$id)
                       ->get();
         //return $requisitions;
         return view('viewpendingrequisitionhod',compact('users','expenseheads','particulars','projects','requisitionheader','requisitions','totalamt','totalamtentry','bal','walletbalance'));
    }


    public function ajaxcheckbill(Request $request)
    {
         $chk=debitvoucherheader::where('vendorid',$request->vendorid)
              ->where('billno',$request->billno)
              ->where('billno','!=','NA')
              ->where('status','!=','CANCELLED')
              ->count();

          if ($chk>0) {
            $res="success";
          }
          else
          {
            $res="failed";
          }

          return response()->json($res);
    }


   /*05-09-2019*/


   public function cancelleddebitvoucher()
   {
       $debitvouchers=debitvoucherheader::select('debitvoucherheaders.*','vendors.vendorname','projects.projectname','expenseheads.expenseheadname','users.name')
                     ->leftJoin('vendors','debitvoucherheaders.vendorid','=','vendors.id')
                      ->leftJoin('projects','debitvoucherheaders.projectid','=','projects.id')
                     ->leftJoin('expenseheads','debitvoucherheaders.expenseheadid','=','expenseheads.id')
                     ->leftJoin('users','debitvoucherheaders.cancelledby','=','users.id')
                     ->where('debitvoucherheaders.status','CANCELLED')
                     ->get();
      return view('accounts.cancelleddebitvoucher',compact('debitvouchers'));
   } 

     public function completeddebitvoucher()
   {
       $debitvouchers=debitvoucherheader::select('debitvoucherheaders.*','vendors.vendorname','projects.projectname','expenseheads.expenseheadname')
                     ->leftJoin('vendors','debitvoucherheaders.vendorid','=','vendors.id')
                      ->leftJoin('projects','debitvoucherheaders.projectid','=','projects.id')
                     ->leftJoin('expenseheads','debitvoucherheaders.expenseheadid','=','expenseheads.id')
                     ->where('debitvoucherheaders.status','COMPLETED')
                     ->get();

      return view('accounts.completeddebitvoucher',compact('debitvouchers'));
   }
   public function changedrvoucherstatus(Request $request,$id)
   {
       $debitvoucherheader=debitvoucherheader::find($id);
       $debitvoucherheader->status=$request->status;
       $debitvoucherheader->save();

       return redirect('/vouchers/approveddebitvoucher');
   }   

   public function canceldrvoucher(Request $request,$id)
   {
       $debitvoucherheader=debitvoucherheader::find($id);
       $debitvoucherheader->status='CANCELLED';
       $debitvoucherheader->author=Auth::id();
       $debitvoucherheader->save();
       return back();
       /*return redirect('/vouchers/approveddebitvoucher');*/
   }  

    public function drvouchermarkcompleted(Request $request,$id)
   {
       $debitvoucherheader=debitvoucherheader::find($id);
       $debitvoucherheader->status='COMPLETED';
       $debitvoucherheader->save();

       return redirect('/vouchers/approveddebitvoucher');
   }


   /**/

      public function dailylabourdetailsshow($id)
    {
            $labours=engagedlabour::select('labours.*')
                 ->leftJoin('labours','engagedlabours.labourid','=','labours.id')
                 ->where('dailylabourid',$id)
                 ->get();

            //return $labours;

          return view('accounts.dailylabourdetailsshow',compact('labours'));
    }

    public function vehicledetailsshow($id)
    {
       $vehicle=vehicle::find($id);

        return view('accounts.vehicledetailsshow',compact('vehicle'));
    }
  public function hodapproveexpenseentry()
  {
      $expenseentries=expenseentry::select('expenseentries.*','u1.name as for')
                      ->leftJoin('users as u1','expenseentries.employeeid','=','u1.id')
                       ->leftJoin('userunderhods','expenseentries.employeeid','=','userunderhods.userid')
                      ->where('userunderhods.hodid',Auth::id())
                       ->where('expenseentries.status','HOD PENDING')
                      ->groupBy('expenseentries.employeeid')
                      ->get();
      return view('pendingadminexpenseentry',compact('expenseentries'));
  }
  public function hodpendingrequisition()
  {
     $requisitions=requisitionheader::select('requisitionheaders.*','u1.name as employee','u2.name as author','u3.name as approver','projects.projectname','userunderhods.hodid')
                      ->leftJoin('users as u1','requisitionheaders.employeeid','=','u1.id')
                      ->leftJoin('users as u2','requisitionheaders.userid','=','u2.id')
                      ->leftJoin('users as u3','requisitionheaders.approvedby','=','u3.id')
                      ->leftJoin('projects','requisitionheaders.projectid','=','projects.id')
                      ->leftJoin('userunderhods','requisitionheaders.employeeid','=','userunderhods.userid')
                      ->where('requisitionheaders.status','PENDING HOD')
                      ->where('userunderhods.hodid',Auth::id())
                      ->get();
      return view('hodpendingrequisition',compact('requisitions'));
  }  

  public function pendingrequisitionshod()
  {
     $requisitions=requisitionheader::select('requisitionheaders.*','u1.name as employee','u2.name as author','u3.name as approver','projects.projectname','userunderhods.hodid','u4.name as hodname')
                      ->leftJoin('users as u1','requisitionheaders.employeeid','=','u1.id')
                      ->leftJoin('users as u2','requisitionheaders.userid','=','u2.id')
                      ->leftJoin('users as u3','requisitionheaders.approvedby','=','u3.id')
                      ->leftJoin('projects','requisitionheaders.projectid','=','projects.id')
                      ->leftJoin('userunderhods','requisitionheaders.employeeid','=','userunderhods.userid')
                       ->leftJoin('users as u4','userunderhods.hodid','=','u4.id')
                      ->where('requisitionheaders.status','PENDING HOD')
                      ->get();
      return view('accounts.pendingrequisitionshod',compact('requisitions'));
  }

 public function saveascreditvoucher(Request $request,$id)
 {

  //return $request->all();

      //return $request->all();
      /*     $invoicedate=date("Y-m-d");
       
      $invdate=$invoicedate." 00:00:00";
      $year =Carbon::createFromFormat('Y-m-d H:i:s', $invdate)->year;
      $month =Carbon::createFromFormat('Y-m-d H:i:s', $invdate)->month;

      if($month<4)
      {
           $invyear=$year-1;

           $year1 = substr( $year, -2);

           $billyear=$invyear."-".$year1;
            $billyear1=substr( $invyear, -2).$year1;
      }
      else
      {
            $invyear=$year+1;
            $year1=substr( $invyear, -2);
            $billyear=$year.'-'.$year1;
            $billyear1=substr( $year, -2).$year1;

      }
       // return $billyear;
      $chk=invoiceno::where('invyear',$billyear)->where('company',$request->company)->orderBy('id','DESC')->first();
      
      
      if($chk)
      {
         $invnoget=$chk->invno;
         $invno=$invnoget+1;
      }
      else
      {
          $invno=1;
      }
       $num = $invno;
      $numlength = strlen((string)$num);
      if($numlength==1)
       {
          $fullinvno=$request->company.$billyear1."000".$invno;
       }
       elseif ($numlength==2) {
            $fullinvno=$request->company.$billyear1."00".$invno;
       }
       elseif ($numlength==3) {
           $fullinvno=$request->company.$billyear1."0".$invno;
       }
       else
       {
           $fullinvno=$request->company.$billyear1.$invno;
       }*/
      $chk=crvoucherheader::where('billid',$id)->count();

      if($chk>0)
      {
          return back();
      }

      $billheader=billheader::find($id);
      $crvoucherheader=new crvoucherheader();
      $crvoucherheader->billid=$id;
      $crvoucherheader->projectid=$request->projectid;
      $crvoucherheader->fullinvno=$billheader->fullinvno;
      $crvoucherheader->clientname=$request->clientname;
      $crvoucherheader->email=$request->email;
      $crvoucherheader->gstno=$request->gstno;
      $crvoucherheader->panno=$request->panno;
      $crvoucherheader->contactno=$request->contactno;
      $crvoucherheader->fax=$request->fax;
      $crvoucherheader->nameofthework=$request->nameofthework;
      $crvoucherheader->address=$request->address;
      $crvoucherheader->invoicedate=$billheader->invoicedate;
      $crvoucherheader->cgstrate=$request->cgstrate;
      $crvoucherheader->cgstvalue=$request->cgstvalue;
      $crvoucherheader->sgstrate=$request->sgstrate;
      $crvoucherheader->sgstvalue=$request->sgstvalue;
      $crvoucherheader->igstrate=$request->igstrate;
      $crvoucherheader->igstvalue=$request->igstvalue;
      $crvoucherheader->total=$request->total;
      $crvoucherheader->totalpayable=$request->totalpayable;
      $crvoucherheader->advancepayment=$request->advancepayment;
      $crvoucherheader->netpayable=$request->netpayable;
      $crvoucherheader->invyear=$billheader->billyear;
      $crvoucherheader->invno=$billheader->invno;
      $crvoucherheader->company=$request->company;
      $crvoucherheader->claimedrate=$request->claimedrate;
      $crvoucherheader->claimedvalue=$request->claimedvalue;
      $crvoucherheader->discounttype=$request->discounttype;
      $crvoucherheader->discount=$request->discount;
      $crvoucherheader->discountvalue=$request->discountvalue;
      $crvoucherheader->totaldeduction=$request->totdeduct;

     
      $crvoucherheader->creditedamt=$request->creditedamt;
      $crvoucherheader->deductioncrg=$request->deductioncrg;
      $crvoucherheader->notes=$request->notes;
      $crvoucherheader->crediteddate=$request->crediteddate;
      if ($request->creditedinacc=='CASH') {
         $crvoucherheader->typeofpayment='CASH';
         $crvoucherheader->creditedinacc='';
        
      }
      else
      {
        $crvoucherheader->creditedinacc=$request->creditedinacc;
      }

      $crvoucherheader->save();


      


      $crvoucherid=$crvoucherheader->id;

if ($request->deductionname) {
  $countdeduct=count($request->deductionname);

      for ($i=0; $i < $countdeduct; $i++) { 
      $creditvoucherdeduction=new creditvoucherdeduction();
      $creditvoucherdeduction->headerid=$crvoucherid;
      $creditvoucherdeduction->deductionid=$request->deductionname[$i];
      $creditvoucherdeduction->deductionrate=$request->deductionrate[$i];
      $creditvoucherdeduction->deductionvalue=$request->deductionvalue[$i];

      $creditvoucherdeduction->save();
      }
}
      

     

      /*$invoiceno=new invoiceno();
      $invoiceno->crvoucherid=$crvoucherid;
      $invoiceno->invyear=$billyear;
      $invoiceno->invno=$invno;
      $invoiceno->company=$request->company;
      $invoiceno->save();
      */
      $count=count($request->workdetails);


      for ($i=0; $i <$count ; $i++) { 
        $crvoucheritem=new crvoucheritem();
        $crvoucheritem->headerid=$crvoucherid;
        $crvoucheritem->slno=$request->slno[$i];
        $crvoucheritem->workdetails=$request->workdetails[$i];
        $crvoucheritem->hsn=$request->hsn[$i];
        $crvoucheritem->unit=$request->unit[$i];
        $crvoucheritem->rate=$request->rate[$i];
        $crvoucheritem->quantity=$request->qty[$i];
        $crvoucheritem->amount=$request->amount[$i];
        $crvoucheritem->save();

      }

      
      return redirect('/printinvoice/'.$crvoucherid);
 }

public function makethisbillascrvoucher($id)
{

     $deductiondefinations=deductiondefination::all();
     $billheader=billheader::find($id);
     $billitems=billitem::select('billitems.*','units.unitname')
                    ->leftJoin('units','billitems.unit','=','units.id')
                    ->where('headerid',$id)
                    ->get();
       $discounts=discount::all();
       $projects=project::select('clients.clientname','projects.*','clients.officeaddress','clients.gstn','clients.panno','clients.contact1 as contactno','clients.email')

                ->leftJoin('clients','projects.clientid','=','clients.id')
                 ->get();
       $hsncodes=hsncode::all();
       $bankaccounts=useraccount::select('useraccounts.*','banks.bankname')
                    ->leftJoin('banks','useraccounts.bankid','banks.id')
                    ->where('type','COMPANY')
                    ->get();
       $units=unit::all();
     return view('accounts.makethisbillascrvoucher',compact('billheader','billitems','discounts','projects','hsncodes','units','deductiondefinations','bankaccounts'));
}

public function viewallinvoicenos()
{
     $invoicenos=invoiceno::orderBy('company')->get();

     return view('accounts.viewallinvoicenos',compact('invoicenos'));
}

  public function createfrombill()
  {
      $bills=billheader::where('status','APPROVED')->get();
      return view('accounts.createfrombill',compact('bills'));
  }

  public function stecscrsetup()
  {
      $crsetup=crsetup::where('for','STECS')->first();
       
       return view('accounts.stecscrsetup',compact('crsetup')); 
  }

  public function savestecscrsetup(Request $request)
  {
         $count=crsetup::where('for','STECS')->count();
      if($count>0)
      {
          $crsetup=crsetup::where('for','STECS')->first();
            $crsetup->companyname=$request->companyname;
           $crsetup->contactno=$request->contactno;
           $crsetup->email=$request->email;
           $crsetup->gstno=$request->gstno;
           $crsetup->panno=$request->panno;
           $crsetup->address=$request->address;
           $crsetup->acno=$request->acno;
           $crsetup->bankname=$request->bankname;
           $crsetup->branchname=$request->branchname;
           $crsetup->ifsccode=$request->ifsccode;
           $crsetup->draftdetails=$request->draftdetails;
           $crsetup->rtgsdetails=$request->rtgsdetails;
           $crsetup->for='STECS';
             $rarefile = $request->file('companylogo');    
        if($rarefile!=''){
        $raupload = public_path() .'/img/crsetup/';
        $rarefilename=time().'.'.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$rarefilename);
        $crsetup->companylogo = $rarefilename;
        }
         $crsetup->save();
          Session::flash('msg','STECS CR VOUCHER SETUP UPDATED SUCCESSFULLY');
        return back();

      }
      else
      {
           $crsetup=new crsetup();
           $crsetup->companyname=$request->companyname;
           $crsetup->contactno=$request->contactno;
           $crsetup->email=$request->email;
           $crsetup->gstno=$request->gstno;
           $crsetup->panno=$request->panno;
           $crsetup->address=$request->address;
           $crsetup->acno=$request->acno;
           $crsetup->bankname=$request->bankname;
           $crsetup->branchname=$request->branchname;
           $crsetup->ifsccode=$request->ifsccode;
           $crsetup->draftdetails=$request->draftdetails;
           $crsetup->rtgsdetails=$request->rtgsdetails;
           $crsetup->for='STECS';
             $rarefile = $request->file('companylogo');    
        if($rarefile!=''){
        $raupload = public_path() .'/img/crsetup/';
        $rarefilename=time().'.'.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$rarefilename);
        $crsetup->companylogo = $rarefilename;
        }
        $crsetup->save();
        Session::flash('msg','STECS CR VOUCHER SETUP SAVED SUCCESSFULLY');
        return back();
      }
  }

   
   public function createbill()
   {
       $banks=useraccount::select('useraccounts.*','banks.bankname')
              ->where('useraccounts.type','COMPANY')
              ->leftJoin('banks','useraccounts.bankid','=','banks.id')
              ->get();
  
       $clients=client::all();
       $discounts=discount::all();
       $projects=project::select('clients.clientname','projects.*','clients.officeaddress','clients.gstn','clients.panno','clients.contact1 as contactno','clients.email')

                ->leftJoin('clients','projects.clientid','=','clients.id')
                 ->get();
       $hsncodes=hsncode::all();
       $units=unit::all();
          return view('createbill',compact('units','hsncodes','projects','discounts','clients','banks'));
   }
    public function createbillacc()
   {
     $banks=useraccount::select('useraccounts.*','banks.bankname')
              ->where('useraccounts.type','COMPANY')
              ->leftJoin('banks','useraccounts.bankid','=','banks.id')
              ->get();

    
       $clients=client::all();
       $discounts=discount::all();
       $projects=project::select('clients.clientname','projects.*','clients.officeaddress','clients.gstn','clients.panno','clients.contact1 as contactno','clients.email')

                ->leftJoin('clients','projects.clientid','=','clients.id')
                 ->get();
       $hsncodes=hsncode::all();
       $units=unit::all();
          return view('accounts.createbill',compact('units','hsncodes','projects','discounts','clients','banks'));
   }
   public function updatecreditvoucher(Request $request,$id)
   {
     /* $invoicedate=date("Y-m-d");
       
      $invdate=$invoicedate." 00:00:00";
      $year =Carbon::createFromFormat('Y-m-d H:i:s', $invdate)->year;
      $month =Carbon::createFromFormat('Y-m-d H:i:s', $invdate)->month;

      if($month<4)
      {
           $invyear=$year-1;

           $year1 = substr( $year, -2);

           $billyear=$invyear."-".$year1;
           
      }
      else
      {
            $invyear=$year+1;
            $year1=substr( $invyear, -2);
            $billyear=$year.'-'.$year1;

      }
       // return $billyear;
      $chk=invoiceno::where('invyear',$billyear)->where('company',$request->company)->orderBy('id','DESC')->first();
      
      
      if($chk)
      {
         $invnoget=$chk->invno;
         $invno=$invnoget+1;
      }
      else
      {
          $invno=1;
      }*/
      $crvoucherheader=crvoucherheader::find($id);
      $crvoucherheader->projectid=$request->projectid;
      $crvoucherheader->clientname=$request->clientname;
      $crvoucherheader->email=$request->email;
      $crvoucherheader->gstno=$request->gstno;
      $crvoucherheader->panno=$request->panno;
      $crvoucherheader->contactno=$request->contactno;
      $crvoucherheader->fax=$request->fax;
      $crvoucherheader->nameofthework=$request->nameofthework;
      $crvoucherheader->address=$request->address;
      //$crvoucherheader->invoicedate=$invoicedate;
      $crvoucherheader->cgstrate=$request->cgstrate;
      $crvoucherheader->cgstvalue=$request->cgstvalue;
      $crvoucherheader->sgstrate=$request->sgstrate;
      $crvoucherheader->sgstvalue=$request->sgstvalue;
      $crvoucherheader->igstrate=$request->igstrate;
      $crvoucherheader->igstvalue=$request->igstvalue;
      $crvoucherheader->total=$request->total;
      $crvoucherheader->totalpayable=$request->totalpayable;
      $crvoucherheader->advancepayment=$request->advancepayment;
      $crvoucherheader->netpayable=$request->netpayable;
      //$crvoucherheader->invyear=$billyear;
      //$crvoucherheader->invno=$invno;
      //$crvoucherheader->company=$request->company;
      $crvoucherheader->claimedrate=$request->claimedrate;
      $crvoucherheader->claimedvalue=$request->claimedvalue;
      $crvoucherheader->discounttype=$request->discounttype;
      $crvoucherheader->discount=$request->discount;
      $crvoucherheader->discountvalue=$request->discountvalue;
      $crvoucherheader->totaldeduction=$request->totdeduct;

      $crvoucherheader->creditedamt=$request->creditedamt;
      $crvoucherheader->deductioncrg=$request->deductioncrg;
      $crvoucherheader->notes=$request->notes;
      $crvoucherheader->crediteddate=$request->crediteddate;
      if ($request->creditedinacc=='CASH') {
         $crvoucherheader->typeofpayment='CASH';
         $crvoucherheader->creditedinacc='';
        
      }
      else
      {
        $crvoucherheader->creditedinacc=$request->creditedinacc;
      }

      $crvoucherheader->save();

      $crvoucherid=$crvoucherheader->id;

      creditvoucherdeduction::where('headerid',$id)->delete();
      $countdeduct=count($request->deductionname);

      for ($i=0; $i < $countdeduct; $i++) { 
      $creditvoucherdeduction=new creditvoucherdeduction();
      $creditvoucherdeduction->headerid=$crvoucherid;
      $creditvoucherdeduction->deductionid=$request->deductionname[$i];
      $creditvoucherdeduction->deductionrate=$request->deductionrate[$i];
      $creditvoucherdeduction->deductionvalue=$request->deductionvalue[$i];

      $creditvoucherdeduction->save();
      }
      $count=count($request->workdetails);
      crvoucheritem::where('headerid',$id)->delete();



      for ($i=0; $i <$count ; $i++) { 
        $crvoucheritem=new crvoucheritem();
        $crvoucheritem->headerid=$crvoucherid;
        $crvoucheritem->slno=$request->slno[$i];
        $crvoucheritem->workdetails=$request->workdetails[$i];
        $crvoucheritem->hsn=$request->hsn[$i];
        $crvoucheritem->unit=$request->unit[$i];
        $crvoucheritem->rate=$request->rate[$i];
        $crvoucheritem->quantity=$request->qty[$i];
        $crvoucheritem->amount=$request->amount[$i];
        $crvoucheritem->save();

      }
      return back();
   }
  public function editcrvouchers($id)
  {

     $bankaccounts=useraccount::select('useraccounts.*','banks.bankname')
                    ->leftJoin('banks','useraccounts.bankid','banks.id')
                    ->where('type','COMPANY')
                    ->get();
     $crvoucherheader=crvoucherheader::find($id);
     $deductiondefinations=deductiondefination::all();
     $crvoucheritems=crvoucheritem::select('crvoucheritems.*','units.unitname')
                    ->leftJoin('units','crvoucheritems.unit','=','units.id')
                    ->where('headerid',$id)
                    ->get();
       $discounts=discount::all();
       $projects=project::select('clients.clientname','projects.*','clients.officeaddress','clients.gstn','clients.panno','clients.contact1 as contactno','clients.email')

                ->leftJoin('clients','projects.clientid','=','clients.id')
                 ->get();
       $hsncodes=hsncode::all();
       $units=unit::all();

       $deductions=creditvoucherdeduction::select('creditvoucherdeductions.*','deductiondefinations.deductionname')
                  ->leftJoin('deductiondefinations','creditvoucherdeductions.deductionid','=','deductiondefinations.id')
                  ->where('headerid',$id)
                  ->get();

      return view('accounts.editcrvouchers',compact('crvoucherheader','deductiondefinations','crvoucheritems','deductions','discounts','projects','hsncodes','units','bankaccounts'));



  }


  public function updatediscount(Request $request)
  {
       $discount=discount::find($request->did);
       $discount->discountname=$request->discountname;
       $discount->save();
       Session::flash('msg','Discount setup Updated Successfully');
       return back();
  }


   public function savediscount(Request $request)
   {
       $discount=new discount();
       $discount->discountname=$request->discountname;
       $discount->save();
       Session::flash('msg','Discount setup Saved Successfully');
       return back();
   }

   public function discount()
   {
      $discounts=discount::paginate(10);
       return view('accounts.discount',compact('discounts'));
   }

    public function updatehsncodes(Request $request)
    {
        $hsncode=hsncode::find($request->hsnid);
        $hsncode->hsncode=$request->hsncode;
        $hsncode->description=$request->description;
        $hsncode->save();

         Session::flash('msg','HSN code Updated Successfully');
        return back(); 
    }
   public function savehsncode(Request $request)
   {
        $hsncode=new hsncode();
        $hsncode->hsncode=$request->hsncode;
        $hsncode->description=$request->description;
        $hsncode->save();

         Session::flash('msg','HSN code Saved Successfully');
        return back();
   }

  public function hsn()
  {
       $hsncodes=hsncode::paginate(10);
       return view('accounts.hsn',compact('hsncodes'));
  }

  public function printinvoice($id)
  {


        $crvoucherheader=crvoucherheader::select('crvoucherheaders.*','discounts.discountname')
                        ->leftJoin('discounts','crvoucherheaders.discounttype','=','discounts.id')
                        ->where('crvoucherheaders.id',$id)
                        ->first();
        $deductions=creditvoucherdeduction::select('creditvoucherdeductions.*','deductiondefinations.deductionname')
                  ->leftJoin('deductiondefinations','creditvoucherdeductions.deductionid','=','deductiondefinations.id')
                  ->where('headerid',$id)
                  ->get();
        $crvoucheritems=crvoucheritem::select('units.unitname','crvoucheritems.*')
                       ->leftJoin('units','crvoucheritems.unit','=','units.id')
                       ->where('headerid',$id)
                       ->get();
      //$this->no_to_words($crvoucherheader->netpayable);
        $amountinword=$this->getIndianCurrency($crvoucherheader->netpayable);
        $recivedamountinword=$this->getIndianCurrency($crvoucherheader->creditedamt);
        $crvouchersetup=crsetup::where('for',$crvoucherheader->company)->first();
       // return AccountController::moneyFormatIndia($crvoucherheader->netpayable);
        return view('invoice',compact('crvoucherheader','deductions','crvoucheritems','crvouchersetup','amountinword','recivedamountinword'));
  } 

   public function printbill($id){

        $billheader=billheader::select('billheaders.*','discounts.discountname')
                        ->leftJoin('discounts','billheaders.discounttype','=','discounts.id')
                        ->where('billheaders.id',$id)
                        ->first();
        $billitems=billitem::select('units.unitname','billitems.*')
                       ->leftJoin('units','billitems.unit','=','units.id')
                       ->where('headerid',$id)
                       ->get();
        $bankdetails=useraccount::select('useraccounts.*','banks.bankname')
                    ->leftJoin('banks','useraccounts.bankid','=','banks.id')
                    ->where('useraccounts.id',$billheader->bankid)
                    ->first();
      //$this->no_to_words($billheader->netpayable);
        $amountinword=$this->getIndianCurrency($billheader->netpayable);
        $crvouchersetup=crsetup::where('for',$billheader->company)->first();
       // return AccountController::moneyFormatIndia($billheader->netpayable);\
        
        return view('bill',compact('billheader','billitems','crvouchersetup','amountinword','bankdetails'));
    }



public static function moneyFormatIndia($amount)
    {

        $amount = round($amount,2);

        $amountArray =  explode('.', $amount);
        if(count($amountArray)==1)
        {
            $int = $amountArray[0];
            $des=00;
        }
        else {
            $int = $amountArray[0];
            $des=$amountArray[1];
        }
        if(strlen($des)==1)
        {
            $des=$des."0";
        }
        if($int>=0)
        {
            $int =AccountController::numFormatIndia( $int );
            $themoney = $int.".".$des;
        }

        else
        {
            $int=abs($int);
            $int = AccountController::numFormatIndia( $int );
            $themoney= "-".$int.".".$des;
        }   
        return $themoney;
    }

public static function numFormatIndia($num)
    {

        $explrestunits = "";
        if(strlen($num)>3)
        {
            $lastthree = substr($num, strlen($num)-3, strlen($num));
            $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
            $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
            $expunit = str_split($restunits, 2);
            for($i=0; $i<sizeof($expunit); $i++) {
                // creates each of the 2's group and adds a comma to the end
                if($i==0) {
                    $explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
                } else {
                    $explrestunits .= $expunit[$i].",";
                }
            }
            $thecash = $explrestunits.$lastthree;
        } else {
            $thecash = $num;
        }
        return $thecash; // writes the final format where $currency is the currency symbol.
    }

  function getIndianCurrency(float $number)
{
    $decimal = round($number - ($no = floor($number)), 2) * 100;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(0 => '', 1 => 'one', 2 => 'two',
        3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
        7 => 'seven', 8 => 'eight', 9 => 'nine',
        10 => 'ten', 11 => 'eleven', 12 => 'twelve',
        13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
        16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
        19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
        40 => 'forty', 50 => 'fifty', 60 => 'sixty',
        70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
    $digits = array('', 'hundred','thousand','lakh', 'crore');

    while( $i < $digits_length ) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str[] = null;
    }

    $rupees = implode('', array_reverse($str));
    $paise = '';

    if ($decimal) {
        $paise = 'and ';
        $decimal_length = strlen($decimal);

        if ($decimal_length == 2) {
            if ($decimal >= 20) {
                $dc = $decimal % 10;
                $td = $decimal - $dc;
                $ps = ($dc == 0) ? '' : '-' . $words[$dc];

                $paise .= $words[$td] . $ps;
            } else {
                $paise .= $words[$decimal];
            }
        } else {
            $paise .= $words[$decimal % 10];
        }

        $paise .= ' paise';
    }

    return ($rupees ? $rupees . 'rupees ' : '') . $paise ;
}

public function no_to_words($no)
{   
 $words = array('0'=> '' ,'1'=> 'one' ,'2'=> 'two' ,'3' => 'three','4' => 'four','5' => 'five','6' => 'six','7' => 'seven','8' => 'eight','9' => 'nine','10' => 'ten','11' => 'eleven','12' => 'twelve','13' => 'thirteen','14' => 'fouteen','15' => 'fifteen','16' => 'sixteen','17' => 'seventeen','18' => 'eighteen','19' => 'nineteen','20' => 'twenty','30' => 'thirty','40' => 'fourty','50' => 'fifty','60' => 'sixty','70' => 'seventy','80' => 'eighty','90' => 'ninty','100' => 'hundred &','1000' => 'thousand','100000' => 'lakh','10000000' => 'crore');
    if($no == 0)
        return ' ';
    else {
  $novalue='';
  $highno=$no;
  $remainno=0;
  $value=100;
  $value1=1000;       
            while($no>=100)    {
                if(($value <= $no) &&($no  < $value1))    {
                $novalue=$words["$value"];
                $highno = (int)($no/$value);
                $remainno = $no % $value;
                break;
                }
                $value= $value1;
                $value1 = $value * 100;
            }       
          if(array_key_exists("$highno",$words))
              return $words["$highno"]." ".$novalue." ".$this->no_to_words($remainno);
          else {
             $unit=$highno%10;
             $ten =(int)($highno/10)*10;            
             return $words["$ten"]." ".$words["$unit"]." ".$novalue." ".$this->no_to_words($remainno);
           }
    }
}
  public function viewallcrvoucher()
  {
       $crvouchers=crvoucherheader::all();
       //return $crvouchers;
       return view('accounts.viewallcrvouchers',compact('crvouchers'));
  }
  public function savecreditvoucher(Request $request)
  {

     //return $request->all();
     
       $invoicedate=date("Y-m-d");
       
      $invdate=$invoicedate." 00:00:00";
      $year =Carbon::createFromFormat('Y-m-d H:i:s', $invdate)->year;
      $month =Carbon::createFromFormat('Y-m-d H:i:s', $invdate)->month;

      if($month<4)
      {
           $invyear=$year-1;

           $year1 = substr( $year, -2);

           $billyear=$invyear."-".$year1;
            $billyear1=substr( $invyear, -2).$year1;
      }
      else
      {
            $invyear=$year+1;
            $year1=substr( $invyear, -2);
            $billyear=$year.'-'.$year1;
            $billyear1=substr( $year, -2).$year1;

      }
       // return $billyear;
      $chk=invoiceno::where('invyear',$billyear)->where('company',$request->company)->orderBy('id','DESC')->first();
      
      
      if($chk)
      {
         $invnoget=$chk->invno;
         $invno=$invnoget+1;
      }
      else
      {
          $invno=1;
      }
       $num = $invno;
      $numlength = strlen((string)$num);
      if($numlength==1)
       {
          $fullinvno=$request->company.$billyear1."000".$invno;
       }
       elseif ($numlength==2) {
            $fullinvno=$request->company.$billyear1."00".$invno;
       }
       elseif ($numlength==3) {
           $fullinvno=$request->company.$billyear1."0".$invno;
       }
       else
       {
           $fullinvno=$request->company.$billyear1.$invno;
       }
      $crvoucherheader=new crvoucherheader();
      $crvoucherheader->projectid=$request->projectid;
      $crvoucherheader->fullinvno=$fullinvno;
      $crvoucherheader->clientname=$request->clientname;
      $crvoucherheader->email=$request->email;
      $crvoucherheader->gstno=$request->gstno;
      $crvoucherheader->panno=$request->panno;
      $crvoucherheader->contactno=$request->contactno;
      $crvoucherheader->fax=$request->fax;
      $crvoucherheader->nameofthework=$request->nameofthework;
      $crvoucherheader->address=$request->address;
      $crvoucherheader->invoicedate=$invoicedate;
      $crvoucherheader->cgstrate=$request->cgstrate;
      $crvoucherheader->cgstvalue=$request->cgstvalue;
      $crvoucherheader->sgstrate=$request->sgstrate;
      $crvoucherheader->sgstvalue=$request->sgstvalue;
      $crvoucherheader->igstrate=$request->igstrate;
      $crvoucherheader->igstvalue=$request->igstvalue;
      $crvoucherheader->total=$request->total;
      $crvoucherheader->totalpayable=$request->totalpayable;
      $crvoucherheader->advancepayment=$request->advancepayment;
      $crvoucherheader->netpayable=$request->netpayable;
      $crvoucherheader->invyear=$billyear;
      $crvoucherheader->invno=$invno;
      $crvoucherheader->company=$request->company;
      $crvoucherheader->claimedrate=$request->claimedrate;
      $crvoucherheader->claimedvalue=$request->claimedvalue;
      $crvoucherheader->discounttype=$request->discounttype;
      $crvoucherheader->discount=$request->discount;
      $crvoucherheader->discountvalue=$request->discountvalue;
      $crvoucherheader->totaldeduction=$request->totdeduct;

      $crvoucherheader->save();


      


      $crvoucherid=$crvoucherheader->id;


      $countdeduct=count($request->deductionname);

      for ($i=0; $i < $countdeduct; $i++) { 
      $creditvoucherdeduction=new creditvoucherdeduction();
      $creditvoucherdeduction->headerid=$crvoucherid;
      $creditvoucherdeduction->deductionid=$request->deductionname[$i];
      $creditvoucherdeduction->deductionrate=$request->deductionrate[$i];
      $creditvoucherdeduction->deductionvalue=$request->deductionvalue[$i];

      $creditvoucherdeduction->save();
      }

     

      $invoiceno=new invoiceno();
      $invoiceno->crvoucherid=$crvoucherid;
      $invoiceno->invyear=$billyear;
      $invoiceno->invno=$invno;
      $invoiceno->company=$request->company;
      $invoiceno->save();
      $count=count($request->workdetails);


      for ($i=0; $i <$count ; $i++) { 
        $crvoucheritem=new crvoucheritem();
        $crvoucheritem->headerid=$crvoucherid;
        $crvoucheritem->slno=$request->slno[$i];
        $crvoucheritem->workdetails=$request->workdetails[$i];
        $crvoucheritem->hsn=$request->hsn[$i];
        $crvoucheritem->unit=$request->unit[$i];
        $crvoucheritem->rate=$request->rate[$i];
        $crvoucheritem->quantity=$request->qty[$i];
        $crvoucheritem->amount=$request->amount[$i];
        $crvoucheritem->save();

      }

      
      return redirect('/printinvoice/'.$crvoucherid);
      
  }

  public function createcrvouchernew()
  {

       $deductiondefinations=deductiondefination::all();
       $discounts=discount::all();
       $projects=project::select('clients.clientname','projects.*','clients.officeaddress','clients.gstn','clients.panno','clients.contact1 as contactno','clients.email')

                ->leftJoin('clients','projects.clientid','=','clients.id')
                 ->get();
       $hsncodes=hsncode::all();
       $units=unit::all();
       
       return view('accounts.createcrvoucher',compact('units','deductiondefinations','hsncodes','projects','discounts'));
  }

  public function invoice()
  {
      return view('invoice');
  }
  public function savesteplcrsetup(Request $request)
  {
      //return $request->all();

       $count=crsetup::where('for','STEPL')->count();
      if($count>0)
      {
          $crsetup=crsetup::where('for','STEPL')->first();
            $crsetup->companyname=$request->companyname;
           $crsetup->contactno=$request->contactno;
           $crsetup->email=$request->email;
           $crsetup->gstno=$request->gstno;
           $crsetup->panno=$request->panno;
           $crsetup->address=$request->address;
           $crsetup->acno=$request->acno;
           $crsetup->bankname=$request->bankname;
           $crsetup->branchname=$request->branchname;
           $crsetup->ifsccode=$request->ifsccode;
           $crsetup->draftdetails=$request->draftdetails;
           $crsetup->rtgsdetails=$request->rtgsdetails;
           $crsetup->for='STEPL';
             $rarefile = $request->file('companylogo');    
        if($rarefile!=''){
        $raupload = public_path() .'/img/crsetup/';
        $rarefilename=time().'.'.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$rarefilename);
        $crsetup->companylogo = $rarefilename;
        }
         $crsetup->save();
          Session::flash('msg','STEPL CR VOUCHER SETUP UPDATED SUCCESSFULLY');
        return back();

      }
      else
      {
           $crsetup=new crsetup();
           $crsetup->companyname=$request->companyname;
           $crsetup->contactno=$request->contactno;
           $crsetup->email=$request->email;
           $crsetup->gstno=$request->gstno;
           $crsetup->panno=$request->panno;
           $crsetup->address=$request->address;
           $crsetup->acno=$request->acno;
           $crsetup->bankname=$request->bankname;
           $crsetup->branchname=$request->branchname;
           $crsetup->ifsccode=$request->ifsccode;
           $crsetup->draftdetails=$request->draftdetails;
           $crsetup->rtgsdetails=$request->rtgsdetails;
           $crsetup->for='STEPL';
             $rarefile = $request->file('companylogo');    
        if($rarefile!=''){
        $raupload = public_path() .'/img/crsetup/';
        $rarefilename=time().'.'.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$rarefilename);
        $crsetup->companylogo = $rarefilename;
        }
        $crsetup->save();
        Session::flash('msg','STEPL CR VOUCHER SETUP SAVED SUCCESSFULLY');
        return back();
      }
  }
  public function savesacrsetup(Request $request)
  {
      $count=crsetup::where('for','SA')->count();
      if($count>0)
      {
          $crsetup=crsetup::where('for','SA')->first();
            $crsetup->companyname=$request->companyname;
           $crsetup->contactno=$request->contactno;
           $crsetup->email=$request->email;
           $crsetup->gstno=$request->gstno;
           $crsetup->panno=$request->panno;
           $crsetup->address=$request->address;
           $crsetup->acno=$request->acno;
           $crsetup->bankname=$request->bankname;
           $crsetup->branchname=$request->branchname;
           $crsetup->ifsccode=$request->ifsccode;
              $crsetup->draftdetails=$request->draftdetails;
           $crsetup->rtgsdetails=$request->rtgsdetails;
           $crsetup->for='SA';
             $rarefile = $request->file('companylogo');    
        if($rarefile!=''){
        $raupload = public_path() .'/img/crsetup/';
        $rarefilename=time().'.'.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$rarefilename);
        $crsetup->companylogo = $rarefilename;
        }
         $crsetup->save();
          Session::flash('msg','STEPL CR VOUCHER SETUP UPDATED SUCCESSFULLY');
        return back();

      }
      else
      {
           $crsetup=new crsetup();
           $crsetup->companyname=$request->companyname;
           $crsetup->contactno=$request->contactno;
           $crsetup->email=$request->email;
           $crsetup->gstno=$request->gstno;
           $crsetup->panno=$request->panno;
           $crsetup->address=$request->address;
           $crsetup->acno=$request->acno;
           $crsetup->bankname=$request->bankname;
           $crsetup->branchname=$request->branchname;
           $crsetup->ifsccode=$request->ifsccode;
              $crsetup->draftdetails=$request->draftdetails;
           $crsetup->rtgsdetails=$request->rtgsdetails;
           $crsetup->for='SA';
             $rarefile = $request->file('companylogo');    
        if($rarefile!=''){
        $raupload = public_path() .'/img/crsetup/';
        $rarefilename=time().'.'.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$rarefilename);
        $crsetup->companylogo = $rarefilename;
        }
        $crsetup->save();
        Session::flash('msg','STEPL CR VOUCHER SETUP SAVED SUCCESSFULLY');
        return back();
      }
  }
  public function sacrsetup()
  {

      $crsetup=crsetup::where('for','SA')->first();
      return view('accounts.sacrsetup',compact('crsetup'));
  }

  public function steplcrsetup()
  {
      $crsetup=crsetup::where('for','STEPL')->first();
       
       return view('accounts.steplcrsetup',compact('crsetup'));
  }

  public function requisitionpaytovendor(Request $request,$id)
  {
         // return $request->all();
          $requisitionpayment=new requisitionpayment();
          $requisitionpayment->amount=$request->amount;
          $requisitionpayment->rid=$id;
          $requisitionpayment->vendorid=$request->vendorid;
          $requisitionpayment->bankid=$request->bankid;
          $requisitionpayment->paymenttype=$request->paymenttype;
          $requisitionpayment->remarks=$request->remarks;
          $requisitionpayment->save();

          $requisitionheader=requisitionheader::find($id);
          $empid=$requisitionheader->employeeid;
          $projectid=$requisitionheader->projectid;

          $expenseentry=new expenseentry();
          $expenseentry->employeeid=$empid;
          $expenseentry->projectid=$projectid;
          $expenseentry->expenseheadid=$request->expenseheadid;
          $expenseentry->particularid=$request->particularid;
          $expenseentry->amount=$request->amount;
          $expenseentry->status='APPROVED';
          $expenseentry->approvalamount=$request->amount;
          $expenseentry->remarks=$request->remarks;
          $expenseentry->approvedby=Auth::id();
          $expenseentry->type="OTHERS";
          $expenseentry->towallet="NO";
          $expenseentry->description="DIRECTLY PAID TO VENDOR FROM OFFICE";
          $expenseentry->save();
          return back();
  }

  public function viewdebitvoucher($id)
  {


         $bankpayments=debitvoucherpayment::select('debitvoucherpayments.*','banks.bankname')
                          ->leftJoin('banks','debitvoucherpayments.bankid','=','banks.id')
                          ->where('debitvoucherpayments.did',$id)
                          ->get();

          $debitvoucherheader=debitvoucherheader::select('debitvoucherheaders.*','vendors.vendorname','projects.projectname','expenseheads.expenseheadname')
                     ->leftJoin('vendors','debitvoucherheaders.vendorid','=','vendors.id')
                     ->leftJoin('projects','debitvoucherheaders.projectid','=','projects.id')
                     ->leftJoin('expenseheads','debitvoucherheaders.expenseheadid','=','expenseheads.id')
                     ->where('debitvoucherheaders.id',$id)
                     ->first();
                      $vid=$debitvoucherheader->vendorid;
          $vendor=vendor::find($vid);

          $debitvouchers=debitvoucher::select('debitvouchers.*','units.unitname')
                        ->leftJoin('units','debitvouchers.unit','=','units.id')
                        ->where('headerid',$id)
                        ->get();

     return view('accounts.viewdebitvoucher',compact('debitvoucherheader','debitvouchers','vendor','bankpayments'));
  }
   function editdebitvoucher($id)
   {
       $vendors=vendor::all();
       $units=unit::all();
       $projects=project::all();
       $expenseheads=expensehead::all();

       $debitvoucherheader=debitvoucherheader::find($id);
       $debitvouchers=debitvoucher::select('debitvouchers.*','units.unitname')
                     ->leftJoin('units','debitvouchers.unit','=','units.id')
                     ->where('headerid',$id)
                     ->get();

       return view('accounts.editdebitvoucher',compact('vendors','units','debitvoucherheader','debitvouchers','projects','expenseheads'));
   }
   
   function changerequisitionstatus(Request $request,$id)
   {
       $requisitionheader=requisitionheader::find($id);
       $requisitionheader->status=$request->status;
       $requisitionheader->save();

       return redirect('/viewrequisitions/approvedrequisitions');
   } 
   function changerequisitionstatusfromcancelled(Request $request,$id)
   {
       $requisitionheader=requisitionheader::find($id);
       $requisitionheader->status=$request->status;
       $requisitionheader->cancelledby='';
       $requisitionheader->cancelreason='';
       $requisitionheader->save();

       return redirect('/viewrequisitions/cancelledrequisitions');
   }

    public function ajaxgetamountexpensehead(Request $request)
    {
         
          $expenseheads=expensehead::all();
          $expenseheadamount=array();
          foreach ($expenseheads as $key => $expensehead) {
                $requisition=requisitionheader::select('requisitions.*')
                      ->leftJoin('requisitionpayments','requisitionpayments.rid','=','requisitionheaders.id')
                       ->leftJoin('requisitions','requisitions.requisitionheaderid','=','requisitionheaders.id')
                       ->where('requisitionpayments.paymentstatus','PAID')
                      ->where('requisitionheaders.projectid',$request->projectid)
                      ->where('requisitionheaders.employeeid',Auth::id())
                      ->where('requisitions.expenseheadid',$expensehead->id)
                      ->groupBy('requisitions.id')
                      ->get();
          $totalamt=$requisition->sum('approvedamount');
        
        $entries=expenseentry::where('employeeid',Auth::id())
                ->where('projectid',$request->projectid)
                ->where('expenseheadid',$expensehead->id)
                ->get();
          $totalamtentry=$entries->sum('approvalamount');
          $bal=$totalamt-$totalamtentry;

          $all=array('expenseheadname'=>$expensehead->expenseheadname,'totalamt'=>$totalamt,'totalexpense'=>$totalamtentry,'balance'=>$bal);

          $expenseheadamount[]=$all;
          }
         return $expenseheadamount;
          return response()->json($expenseheadamount);

    }
    public function pendingexpenseentrydetailviewadmin($empid)
    {
        $expenseentries=expenseentry::select('expenseentries.*','u1.name as for','u2.name as by','projects.projectname','clients.clientname','expenseheads.expenseheadname','particulars.particularname','vendors.vendorname','u3.name as approvedbyname')
                      ->leftJoin('users as u1','expenseentries.employeeid','=','u1.id')
                      ->leftJoin('users as u2','expenseentries.userid','=','u2.id')
                       ->leftJoin('users as u3','expenseentries.approvedby','=','u3.id')
                      ->leftJoin('projects','expenseentries.projectid','=','projects.id')
                      ->leftJoin('clients','projects.clientid','=','clients.id')
                      ->leftJoin('expenseheads','expenseentries.expenseheadid','=','expenseheads.id')
                      ->leftJoin('particulars','expenseentries.particularid','=','particulars.id')
                       ->leftJoin('vendors','expenseentries.vendorid','=','vendors.id')
                       ->where('expenseentries.status','HOD PENDING')
                       ->where('expenseentries.employeeid',$empid)
                      ->groupBy('expenseentries.id')
                      ->get();

          return view('pendingexpenseentrydetailviewadmin',compact('expenseentries'));
    }
    public function pendingexpenseentrydetailview($empid)
    {
        /*$expenseentries=expenseentry::select('expenseentries.*','u1.name as for','u2.name as by','projects.projectname','clients.clientname','expenseheads.expenseheadname','particulars.particularname','vendors.vendorname','u3.name as approvedbyname')
                      ->leftJoin('users as u1','expenseentries.employeeid','=','u1.id')
                      ->leftJoin('users as u2','expenseentries.userid','=','u2.id')
                       ->leftJoin('users as u3','expenseentries.approvedby','=','u3.id')
                      ->leftJoin('projects','expenseentries.projectid','=','projects.id')
                      ->leftJoin('clients','projects.clientid','=','clients.id')
                      ->leftJoin('expenseheads','expenseentries.expenseheadid','=','expenseheads.id')
                      ->leftJoin('particulars','expenseentries.particularid','=','particulars.id')
                       ->leftJoin('vendors','expenseentries.vendorid','=','vendors.id')
                       ->where('expenseentries.status','HOD PENDING')
                       ->where('expenseentries.employeeid',$empid)
                      ->groupBy('expenseentries.created_at')
                      ->get();*/
         $expenseentries=expenseentry::select('expenseentries.*','u1.name as for')
                      ->leftJoin('users as u1','expenseentries.employeeid','=','u1.id')
                      ->where('expenseentries.status','HOD PENDING')
                      ->where('expenseentries.employeeid',$empid)
                      ->groupBy('expenseentries.date')
                      ->get();
//return $expenseentries;
          return view('accounts.pendinghodexpenseentrybydates',compact('expenseentries'));
    } 
    public function walletpaidexpenseentrydetailview($empid)
    {
        $expenseentries=expenseentry::select('expenseentries.*','u1.name as for','u2.name as by','projects.projectname','clients.clientname','expenseheads.expenseheadname','particulars.particularname','vendors.vendorname','u3.name as approvedbyname')
                      ->leftJoin('users as u1','expenseentries.employeeid','=','u1.id')
                      ->leftJoin('users as u2','expenseentries.userid','=','u2.id')
                       ->leftJoin('users as u3','expenseentries.approvedby','=','u3.id')
                      ->leftJoin('projects','expenseentries.projectid','=','projects.id')
                      ->leftJoin('clients','projects.clientid','=','clients.id')
                      ->leftJoin('expenseheads','expenseentries.expenseheadid','=','expenseheads.id')
                      ->leftJoin('particulars','expenseentries.particularid','=','particulars.id')
                       ->leftJoin('vendors','expenseentries.vendorid','=','vendors.id')
                       ->where('expenseentries.status','WALLET PAID')
                       ->where('expenseentries.employeeid',$empid)
                      ->groupBy('expenseentries.id')
                      ->get();

          return view('accounts.walletpaidexpenseentrydetailview',compact('expenseentries'));
    }
     
    public function viewexpenseentryuser($rid)
    {


       $requisitionheader=requisitionheader::find($rid);
       $empid=$requisitionheader->employeeid;

       $projectid=$requisitionheader->projectid;
       $project=project::find($projectid);
       $user=User::find($empid);

        $requisition=requisitionheader::select('requisitions.*','requisitionheaders.employeeid','requisitionpayments.amount as paidamt')
                      ->leftJoin('requisitionpayments','requisitionpayments.rid','=','requisitionheaders.id')
                       ->leftJoin('requisitions','requisitions.requisitionheaderid','=','requisitionheaders.id')
                       ->where('requisitionpayments.paymentstatus','PAID')
                      ->where('requisitionheaders.employeeid',$empid)
                      ->groupBy('requisitionpayments.id')
                      ->get();
         
          $totalamt=$requisition->sum('paidamt');
        
        $entries=expenseentry::where('employeeid',$empid)
                ->get();
          $totalamtentry=$entries->sum('approvalamount');
          $bal=$totalamt-$totalamtentry;

          $expenseentries=expenseentry::select('expenseentries.*','u1.name as for','u2.name as by','projects.projectname','clients.clientname','expenseheads.expenseheadname','particulars.particularname','vendors.vendorname','u3.name as approvedbyname')
                      ->leftJoin('users as u1','expenseentries.employeeid','=','u1.id')
                      ->leftJoin('users as u2','expenseentries.userid','=','u2.id')
                      ->leftJoin('users as u3','expenseentries.approvedby','=','u3.id')
                      ->leftJoin('projects','expenseentries.projectid','=','projects.id')
                      ->leftJoin('clients','projects.clientid','=','clients.id')
                      ->leftJoin('expenseheads','expenseentries.expenseheadid','=','expenseheads.id')
                      ->leftJoin('particulars','expenseentries.particularid','=','particulars.id')
                       ->leftJoin('vendors','expenseentries.vendorid','=','vendors.id')
                       ->where('expenseentries.employeeid',$empid)
                       
                      ->groupBy('expenseentries.id')
                      ->get();




       return view('accounts.viewexpenseentryuser',compact('expenseentries','user','totalamt','totalamtentry','bal','project','requisitionheader'));

    }

          public function vehicles()
          {
              $vehicles=vehicle::select('vehicles.*','users.name as addedby')
                        ->leftJoin('users','vehicles.userid','=','users.id')
                        ->get();
              return view('accounts.vehicles',compact('vehicles'));
           }

           
          public function labours()
             {
                  $labours=labour::all();
                  return view('accounts.labours',compact('labours'));
             }
       public function updaterequisitionsmgrapprove(Request $request,$id)
       {

        //return Auth::user()->usertype;
        $requisitionheader=requisitionheader::find($id);
        $requisitionheader->employeeid=$request->employeeid;
        $requisitionheader->description=$request->description1;
        $requisitionheader->projectid=$request->projectid;
        $requisitionheader->totalamount=$request->totalamt;
        $requisitionheader->datefrom=$request->datefrom;
        $requisitionheader->dateto=$request->dateto;
      
       
        $requisitionheader->save();
        $rid=$requisitionheader->id;

        requisition::where('requisitionheaderid',$id)->delete();
        $count=count($request->expenseheadid);

        for ($i=0; $i < $count ; $i++) { 
           $requisition=new requisition();
           $requisition->expenseheadid=$request->expenseheadid[$i];
           $requisition->particularid=$request->particularid[$i];
           $requisition->description=$request->description[$i];
           $requisition->payto=$request->payto[$i];
           $requisition->vendorid=$request->vendorid[$i];
           $requisition->amount=$request->amount[$i];
           $requisition->requisitionheaderid=$rid;
           $requisition->approvedamount=$request->amount[$i];
           $requisition->approvestatus="FULLY APPROVED";
           $requisition->save();
        }

        

        
          $r=requisitionheader::find($id);
          $r->status="PENDING";
          $r->approvedby=Auth::id();
          $r->save();
        
        return redirect('/viewrequisitions/pendingrequisitionsmgr');
       } 
        public function updaterequisitionhodapprove(Request $request,$id)
       {
        $requisitionheader=requisitionheader::find($id);
        $requisitionheader->employeeid=$request->employeeid;
        $requisitionheader->description=$request->description1;
        $requisitionheader->projectid=$request->projectid;
        $requisitionheader->totalamount=$request->totalamt;
        $requisitionheader->datefrom=$request->datefrom;
        $requisitionheader->dateto=$request->dateto;

         
        $requisitionheader->save();
        $rid=$requisitionheader->id;

        requisition::where('requisitionheaderid',$id)->delete();
        $count=count($request->expenseheadid);

        for ($i=0; $i < $count ; $i++) { 
           $requisition=new requisition();
           $requisition->expenseheadid=$request->expenseheadid[$i];
           $requisition->particularid=$request->particularid[$i];
           $requisition->description=$request->description[$i];
           $requisition->payto=$request->payto[$i];
           $requisition->vendorid=$request->vendorid[$i];
           $requisition->amount=$request->amount[$i];
           $requisition->requisitionheaderid=$rid;
           $requisition->approvedamount=$request->amount[$i];
           $requisition->approvestatus="FULLY APPROVED";
           $requisition->save();
        }

        


      $r=requisitionheader::find($id);
        
       if(Auth::user()->usertype=='MASTER ADMIN')
        {
           $r->status="APPROVED";
           $r->approvalamount=$request->totalamt;
           $r->approvedby=Auth::id();
        }
        else
        { 
          $r->status="PENDING MGR";
          $r->approvedby=Auth::id();
        }
         $r->save();
        return redirect('/hodrequisition/pendingrequisition');
       }
   public function hodupdaterequisitionapprove(Request $request,$id)
       {

       
        $requisitionheader=requisitionheader::find($id);
        $requisitionheader->employeeid=$request->employeeid;
        $requisitionheader->description=$request->description1;
        $requisitionheader->projectid=$request->projectid;
        $requisitionheader->totalamount=$request->totalamt;
        $requisitionheader->datefrom=$request->datefrom;
        $requisitionheader->dateto=$request->dateto;
         if(Auth::user()->usertype=='MASTER ADMIN')
        {
           $requisitionheader->status="APPROVED";
        }
       
      
        $requisitionheader->save();
        $rid=$requisitionheader->id;

        requisition::where('requisitionheaderid',$id)->delete();
        $count=count($request->expenseheadid);

        for ($i=0; $i < $count ; $i++) { 
           $requisition=new requisition();
           $requisition->expenseheadid=$request->expenseheadid[$i];
           $requisition->particularid=$request->particularid[$i];
           $requisition->description=$request->description[$i];
           $requisition->payto=$request->payto[$i];
           $requisition->vendorid=$request->vendorid[$i];
           $requisition->amount=$request->amount[$i];
           $requisition->requisitionheaderid=$rid;
           $requisition->approvedamount=$request->amount[$i];
           $requisition->approvestatus="FULLY APPROVED";
           $requisition->save();
        }

        

        
         $r=requisitionheader::find($id);
        
          if(Auth::user()->usertype=='MASTER ADMIN')
          {
            $r->status="APPROVED";
            $r->approvalamount=$request->totalamt;
            $r->approvedby=Auth::id();
          }
          else
          { 
            $r->status="PENDING MGR";
            $r->approvalamount=$request->totalamt;
            $r->approvedby=Auth::id();
          }
         $r->save();
        return redirect('/viewrequisitions/pendingrequisitionshod');
       }

      public function viewpendingrequisitionmgr(Request $request,$id)
      { 

           $rq=requisitionheader::find($id);
           $empid=$rq->employeeid;
           $requisition=requisitionheader::select('requisitions.*','requisitionheaders.employeeid','requisitionpayments.amount as paidamt','vendors.id as vendorid','vendors.vendorname','vendors.mobile','vendors.details','vendors.bankname','vendors.acno','vendors.branchname','vendors.ifsccode','vendors.photo','vendors.vendoridproof')
                      ->leftJoin('requisitionpayments','requisitionpayments.rid','=','requisitionheaders.id')
                      ->leftJoin('projects','requisitionpayments.rid','=','requisitionheaders.id')
                       ->leftJoin('requisitions','requisitions.requisitionheaderid','=','requisitionheaders.id')
                       ->leftJoin('vendors','requisitions.vendorid','=','vendors.id')
                       ->where('requisitionpayments.paymentstatus','PAID')
                       ->where('requisitionpayments.paymenttype','!=','WALLET')
                      ->where('requisitionheaders.employeeid',$empid)
                      ->groupBy('requisitionpayments.id')
                      ->get();
        
          $totalamt=$requisition->sum('paidamt');
        
        $entries=expenseentry::where('employeeid',$empid)
                ->where('towallet','!=','YES')
                ->get();
          $totalamtentry=$entries->sum('approvalamount');
         $wallet=wallet::where('employeeid',$empid)
                ->get();
         $walletcr=$wallet->sum('credit');
         $walletdr=$wallet->sum('debit');
         $walletbalance=$walletcr-$walletdr;
          $bal=($totalamt-$totalamtentry)-$walletbalance;

          $all=array('totalamt'=>$totalamt,'totalexpense'=>$totalamtentry,'balance'=>$bal);



          

            $users=User::all();
        $expenseheads=expensehead::all();
        $particulars=particular::all();

        $projects=project::select('projects.*','clients.orgname')
                ->leftJoin('clients','projects.clientid','=','clients.id')
                ->get();

          $requisitionheader=requisitionheader::select('requisitionheaders.*','projects.projectname','u1.name as employee','u2.name as author')
                ->leftJoin('projects','requisitionheaders.projectid','=','projects.id')
                ->leftJoin('users as u1','requisitionheaders.employeeid','=','u1.id')
                ->leftJoin('users as u2','requisitionheaders.userid','=','u2.id')
                ->where('requisitionheaders.id',$id)->first();

          $requisitions=requisition::select('requisitions.*','expenseheads.expenseheadname','particulars.particularname','vendors.id as vendorid','vendors.vendorname','vendors.mobile','vendors.details','vendors.bankname','vendors.acno','vendors.branchname','vendors.ifsccode','vendors.photo','vendors.vendoridproof')
                       ->leftJoin('expenseheads','requisitions.expenseheadid','=','expenseheads.id')
                       ->leftJoin('particulars','requisitions.particularid','=','particulars.id')
                       ->leftJoin('vendors','requisitions.vendorid','=','vendors.id')
                       ->where('requisitions.requisitionheaderid',$id)
                       ->get();
         //return $requisitions;
         return view('accounts.viewpendingrequisitionmgr',compact('users','expenseheads','particulars','projects','requisitionheader','requisitions','totalamt','totalamtentry','bal','walletbalance'));
      }

 public function hodviewpendingrequisition(Request $request,$id)
      { 

           $rq=requisitionheader::find($id);
           $empid=$rq->employeeid;
           $requisition=requisitionheader::select('requisitions.*','requisitionheaders.employeeid','requisitionpayments.amount as paidamt','vendors.id as vendorid','vendors.vendorname','vendors.mobile','vendors.details','vendors.bankname','vendors.acno','vendors.branchname','vendors.ifsccode','vendors.photo','vendors.vendoridproof')
                      ->leftJoin('requisitionpayments','requisitionpayments.rid','=','requisitionheaders.id')
                       ->leftJoin('requisitions','requisitions.requisitionheaderid','=','requisitionheaders.id')
                       ->leftJoin('vendors','requisitions.vendorid','=','vendors.id')
                       ->where('requisitionpayments.paymentstatus','PAID')
                       ->where('requisitionpayments.paymenttype','!=','WALLET')
                      ->where('requisitionheaders.employeeid',$empid)
                      ->groupBy('requisitionpayments.id')
                      ->get();
        
          $totalamt=$requisition->sum('paidamt');
        
        $entries=expenseentry::where('employeeid',$empid)
                ->where('towallet','!=','YES')
                ->get();
          $totalamtentry=$entries->sum('approvalamount');
         $wallet=wallet::where('employeeid',$empid)
                ->get();
         $walletcr=$wallet->sum('credit');
         $walletdr=$wallet->sum('debit');
         $walletbalance=$walletcr-$walletdr;
          $bal=($totalamt-$totalamtentry)-$walletbalance;

          $all=array('totalamt'=>$totalamt,'totalexpense'=>$totalamtentry,'balance'=>$bal);



          

            $users=User::all();
        $expenseheads=expensehead::all();
        $particulars=particular::all();

        $projects=project::select('projects.*','clients.orgname')
                ->leftJoin('clients','projects.clientid','=','clients.id')
                ->get();

          $requisitionheader=requisitionheader::find($id);
          $requisitions=requisition::select('requisitions.*','expenseheads.expenseheadname','particulars.particularname','vendors.id as vendorid','vendors.vendorname','vendors.mobile','vendors.details','vendors.bankname','vendors.acno','vendors.branchname','vendors.ifsccode','vendors.photo','vendors.vendoridproof')
                       ->leftJoin('expenseheads','requisitions.expenseheadid','=','expenseheads.id')
                       ->leftJoin('particulars','requisitions.particularid','=','particulars.id')
                       ->leftJoin('vendors','requisitions.vendorid','=','vendors.id')
                       ->where('requisitions.requisitionheaderid',$id)
                       ->get();
         //return $requisitions;
         return view('accounts.hodviewpendingrequisition',compact('users','expenseheads','particulars','projects','requisitionheader','requisitions','totalamt','totalamtentry','bal','walletbalance'));
      }

      
       public function cashierupdatepaydrvoucher(Request $request,$id)
       {
            $debitvoucherpayment=debitvoucherpayment::find($id);
          $debitvoucherpayment->transactionid=$request->transactionid;
          $debitvoucherpayment->dateofpayment=$request->dateofpayment;
          $debitvoucherpayment->save();

          return back();
       }
      public function viewpaiddr($id)
      {
             $debitvoucherpayment=debitvoucherpayment::select('debitvoucherpayments.*','banks.bankname','vendors.vendorname','debitvoucherheaders.vendorid','debitvoucherheaders.invoicecopy','users.name as paidbyname')
                                ->where('debitvoucherpayments.paymentstatus','PAID')
                                ->where('debitvoucherpayments.id',$id)
                               ->leftJoin('banks','debitvoucherpayments.bankid','=','banks.id')
                               ->leftJoin('debitvoucherheaders','debitvoucherpayments.did','=','debitvoucherheaders.id')
                               ->leftJoin('vendors','debitvoucherheaders.vendorid','=','vendors.id')
                                 ->leftJoin('users','debitvoucherpayments.paidby','=','users.id')
                                ->first();
            
             $vid=$debitvoucherpayment->vendorid;

             $vendor=vendor::find($vid);

            return view('accounts.viewpaiddr',compact('debitvoucherpayment','vendor'));


      }
      
      public function cashierpaydrvoucher(Request $request,$id)
      {
          $debitvoucherpayment=debitvoucherpayment::find($id);
          $debitvoucherpayment->transactionid=$request->transactionid;
          $debitvoucherpayment->dateofpayment=$request->dateofpayment;
          $debitvoucherpayment->paymentstatus="PAID";
          $debitvoucherpayment->paidby=Auth::id();
          $debitvoucherpayment->save();

       $payment=new payment();
       $payment->amount=$debitvoucherpayment->amount;
       $payment->type='DR';
       $payment->bank=$debitvoucherpayment->bankid;
       $payment->userid=Auth::id();
       $payment->purpose='DEBIT VOUCHER PAYMENTS';
       $payment->paythrough=$debitvoucherpayment->paymenttype;
       $payment->save();



          return redirect('/dvpay/pendingdrpayment');

      }

     public function viewpendingdr($id)
     {
             $debitvoucherpayment=debitvoucherpayment::select('debitvoucherpayments.*','banks.bankname','vendors.vendorname','debitvoucherheaders.vendorid','debitvoucherheaders.invoicecopy')
                                ->where('debitvoucherpayments.paymentstatus','PENDING')
                                ->where('debitvoucherpayments.id',$id)
                               ->leftJoin('banks','debitvoucherpayments.bankid','=','banks.id')
                               ->leftJoin('debitvoucherheaders','debitvoucherpayments.did','=','debitvoucherheaders.id')
                               ->leftJoin('vendors','debitvoucherheaders.vendorid','=','vendors.id')
                                ->first();
             
             $vid=$debitvoucherpayment->vendorid;

             $vendor=vendor::find($vid);
            return view('accounts.viewpendingdr',compact('debitvoucherpayment','vendor'));


     }
     public function paiddramount()
     {
           $debitvoucherpayments=debitvoucherpayment::select('debitvoucherpayments.*','banks.bankname','useraccounts.acno','useraccounts.branchname','vendors.vendorname','users.name as paidbyname')
                                ->where('paymentstatus','PAID')
                                ->leftJoin('useraccounts','debitvoucherpayments.bankid','=','useraccounts.id')
                               ->leftJoin('banks','useraccounts.bankid','=','banks.id')
                               ->leftJoin('debitvoucherheaders','debitvoucherpayments.did','=','debitvoucherheaders.id')
                               ->leftJoin('vendors','debitvoucherheaders.vendorid','=','vendors.id')
                               ->leftJoin('users','debitvoucherpayments.paidby','=','users.id')
                                ->get();
           
          return view('accounts.paiddramount',compact('debitvoucherpayments'));       
     }

     public function pendingdrpayment()
     {
          $debitvoucherpayments=debitvoucherpayment::select('debitvoucherpayments.*','banks.bankname','vendors.vendorname','useraccounts.acno','useraccounts.branchname')
                                ->where('paymentstatus','PENDING')
                               ->leftJoin('useraccounts','debitvoucherpayments.bankid','=','useraccounts.id')
                               ->leftJoin('banks','useraccounts.bankid','=','banks.id')
                               ->leftJoin('debitvoucherheaders','debitvoucherpayments.did','=','debitvoucherheaders.id')
                               ->leftJoin('vendors','debitvoucherheaders.vendorid','=','vendors.id')
                                ->get();

            


             return view('accounts.pendingdrpayment',compact('debitvoucherpayments'));
     }
     public function payapproveddebitvoucher(Request $request,$id)
      {
               $debitvoucherpayment=new debitvoucherpayment();
               $debitvoucherpayment->did=$id;
               $debitvoucherpayment->amount=$request->amount;
               $debitvoucherpayment->paymenttype=$request->paymenttype;
               $debitvoucherpayment->remarks=$request->remarks;
               $debitvoucherpayment->bankid=$request->bankid;
               $debitvoucherpayment->save();

               return back();
      }
    public function viewapproveddebitvoucher($id)
    {

             $bankpayments=debitvoucherpayment::select('debitvoucherpayments.*','banks.bankname','useraccounts.acno','useraccounts.ifsccode')
                          ->leftJoin('useraccounts','debitvoucherpayments.bankid','=','useraccounts.id')
                          ->leftJoin('banks','useraccounts.bankid','=','banks.id')

                          ->where('debitvoucherpayments.did',$id)
                          ->get();
        
             $paid=debitvoucherpayment::where('did',$id)->sum('amount');
              $bankpaid=debitvoucherpayment::where('did',$id)->where('paymentstatus','PAID')->sum('amount');
             $banks=useraccount::select('useraccounts.*','banks.bankname')
                        ->where('useraccounts.type','COMPANY')
                        ->leftJoin('banks','useraccounts.bankid','=','banks.id')
                        ->get();
          $debitvoucherheader=debitvoucherheader::select('debitvoucherheaders.*','vendors.vendorname','projects.projectname','expenseheads.expenseheadname')
                     ->leftJoin('vendors','debitvoucherheaders.vendorid','=','vendors.id')
                       ->leftJoin('projects','debitvoucherheaders.projectid','=','projects.id')
                     ->leftJoin('expenseheads','debitvoucherheaders.expenseheadid','=','expenseheads.id')
                     ->where('debitvoucherheaders.id',$id)
                     ->first();
            $vid=$debitvoucherheader->vendorid;
          $vendor=vendor::find($vid);

        
          $debitvouchers=debitvoucher::select('debitvouchers.*','units.unitname')
                        ->leftJoin('units','debitvouchers.unit','=','units.id')
                        ->where('headerid',$id)
                        ->get();

        return view('accounts.viewapproveddebitvoucher',compact('debitvoucherheader','debitvouchers','banks','paid','bankpaid','bankpayments','vendor'));
    }
    public function ajaxgetuserprojects(Request $request)
    {
           $projects=requisitionpayment::select('requisitionpayments.*','projects.projectname','clients.orgname','projects.id as proid')
                          ->where('requisitionpayments.paymentstatus','PAID')
                          ->leftJoin('requisitionheaders','requisitionpayments.rid','=','requisitionheaders.id')
                          ->leftJoin('projects','requisitionheaders.projectid','=','projects.id')
                          ->leftJoin('clients','projects.clientid','=','clients.id')
                          ->where('requisitionheaders.employeeid',$request->userid)
                          ->groupBy('requisitionheaders.projectid')
                          ->get();
          
          return response()->json($projects);
    }
   public function ajaxgetamountuser1(Request $request)
   {
       
          $requisition=requisitionheader::select('requisitions.*','requisitionpayments.id as reqid')
                      ->leftJoin('requisitionpayments','requisitionpayments.rid','=','requisitionheaders.id')
                       ->leftJoin('requisitions','requisitions.requisitionheaderid','=','requisitionheaders.id')
                       ->where('requisitionpayments.paymentstatus','PAID')
                      ->where('requisitionheaders.projectid',$request->projectid)
                      ->where('requisitionheaders.employeeid',$request->employeeid)
                      ->where('requisitions.expenseheadid',$request->expenseheadid)
                      ->groupBy('requisitions.id')
                      ->get();
          
          $totalamt=$requisition->sum('approvedamount');
        
        $entries=expenseentry::where('employeeid',$request->employeeid)
                ->where('projectid',$request->projectid)
                ->where('expenseheadid',$request->expenseheadid)
                
                ->get();
          $totalamtentry=$entries->sum('approvalamount');
          $bal=$totalamt-$totalamtentry;

          $all=array('totalamt'=>$totalamt,'totalexpense'=>$totalamtentry,'balance'=>$bal);
           return $all;
   }public function ajaxgetamountuser(Request $request)
   {
       
          $requisition=requisitionheader::select('requisitions.*')
                      ->leftJoin('requisitionpayments','requisitionpayments.rid','=','requisitionheaders.id')
                       ->leftJoin('requisitions','requisitions.requisitionheaderid','=','requisitionheaders.id')
                       ->where('requisitionpayments.paymentstatus','PAID')
                      ->where('requisitionheaders.projectid',$request->projectid)
                      ->where('requisitionheaders.employeeid',Auth::id())
                      ->where('requisitions.expenseheadid',$request->expenseheadid)
                      ->groupBy('requisitions.id')
                      ->get();
          $totalamt=$requisition->sum('approvedamount');
        
        $entries=expenseentry::where('employeeid',Auth::id())
                ->where('projectid',$request->projectid)
                ->where('expenseheadid',$request->expenseheadid)
                ->get();
          $totalamtentry=$entries->sum('approvalamount');
          $bal=$totalamt-$totalamtentry;

          $all=array('totalamt'=>$totalamt,'totalexpense'=>$totalamtentry,'balance'=>$bal);
           return $all;
   }

    public function cashierpaidrequsitiononlineupdate(Request $request,$id)
    {
        $requisitionpayment=requisitionpayment::find($id);
        $requisitionpayment->transactionid=$request->transactionid;
        $requisitionpayment->dateofpayment=$request->dateofpayment;
        $requisitionpayment->save();

        return back();
    }

    public function pendingdebitvoucheradmin()
    {
           $debitvouchers=debitvoucherheader::select('debitvoucherheaders.*','vendors.vendorname','projects.projectname','expenseheads.expenseheadname')
                     ->leftJoin('vendors','debitvoucherheaders.vendorid','=','vendors.id')
                     ->where('debitvoucherheaders.status','=','MGR APPROVED')
                      ->leftJoin('projects','debitvoucherheaders.projectid','=','projects.id')
                     ->leftJoin('expenseheads','debitvoucherheaders.expenseheadid','=','expenseheads.id')
                     ->get();

          return view('accounts.pendingdebitvoucheradmin',compact('debitvouchers'));
    }

    public function approvedebitvouchermgr(Request $request,$id)
    {
         $debitvoucherheader=debitvoucherheader::find($id);
         $debitvoucherheader->status="MGR APPROVED";
         $debitvoucherheader->itdeduction=$request->itdeduction;
         $debitvoucherheader->otherdeduction=$request->otherdeduction;
         $debitvoucherheader->finalamount=$request->finalamount;
         $debitvoucherheader->approvalamount=$request->approvalamount;
         $debitvoucherheader->save();

         return redirect('/vouchers/pendingdebitvouchermgr');
    }
public function approvedebitvoucheradmin(Request $request,$id)
    {
         $debitvoucherheader=debitvoucherheader::find($id);
         $debitvoucherheader->status="ADMIN APPROVED";
         $debitvoucherheader->save();

         return redirect('/vouchers/pendingdebitvoucheradmin');
    }


     public function viewpendinfdebitvouchermgr($id)
     {
          $debitvoucherheader=debitvoucherheader::select('debitvoucherheaders.*','vendors.vendorname','projects.projectname','expenseheads.expenseheadname')
                     ->leftJoin('vendors','debitvoucherheaders.vendorid','=','vendors.id')
                       ->leftJoin('projects','debitvoucherheaders.projectid','=','projects.id')
                     ->leftJoin('expenseheads','debitvoucherheaders.expenseheadid','=','expenseheads.id')
                     ->where('debitvoucherheaders.id',$id)
                     ->first();
          $vid=$debitvoucherheader->vendorid;

          $vendor=vendor::find($vid);
          $debitvouchers=debitvoucher::select('debitvouchers.*','units.unitname')
                        ->leftJoin('units','debitvouchers.unit','=','units.id')
                        ->where('headerid',$id)
                        ->get();

          return view('accounts.viewpendinfdebitvouchermgr',compact('debitvoucherheader','debitvouchers','vendor'));
     }

      public function viewpendinfdebitvoucheradmin($id)
     {
          $debitvoucherheader=debitvoucherheader::select('debitvoucherheaders.*','vendors.vendorname','projects.projectname','expenseheads.expenseheadname')
                     ->leftJoin('vendors','debitvoucherheaders.vendorid','=','vendors.id')
                        ->leftJoin('projects','debitvoucherheaders.projectid','=','projects.id')
                     ->leftJoin('expenseheads','debitvoucherheaders.expenseheadid','=','expenseheads.id')
                     ->where('debitvoucherheaders.id',$id)
                     ->first();
          $vid=$debitvoucherheader->vendorid;
          $vendor=vendor::find($vid);

           $debitvouchers=debitvoucher::select('debitvouchers.*','units.unitname')
                        ->leftJoin('units','debitvouchers.unit','=','units.id')
                        ->where('headerid',$id)
                        ->get();


          return view('accounts.viewpendinfdebitvoucheradmin',compact('debitvoucherheader','debitvouchers','vendor'));
     }

      public function approveddebitvoucher()
    {

          $debitvoucherarr=array();
            $debitvouchers=debitvoucherheader::select('debitvoucherheaders.*','vendors.vendorname','projects.projectname','expenseheads.expenseheadname')
                     ->leftJoin('vendors','debitvoucherheaders.vendorid','=','vendors.id')
                      ->leftJoin('projects','debitvoucherheaders.projectid','=','projects.id')
                     ->leftJoin('expenseheads','debitvoucherheaders.expenseheadid','=','expenseheads.id')
                     ->where('debitvoucherheaders.status','=','ADMIN APPROVED')
                     ->get();

            foreach ($debitvouchers as $key => $debitvoucher) {
              $paid=debitvoucherpayment::where('did',$debitvoucher->id)->sum('amount');
               $debitvoucherarr[]=array(
                 'data'=>$debitvoucher,
                 'paid'=>$paid
               );
            }

            //return $debitvoucherarr;
          return view('accounts.approveddebitvoucher',compact('debitvouchers','debitvoucherarr'));
    }
     public function pendingdebitvouchermgr()
     {
             $debitvouchers=debitvoucherheader::select('debitvoucherheaders.*','vendors.vendorname','projects.projectname','expenseheads.expenseheadname')
                     ->leftJoin('vendors','debitvoucherheaders.vendorid','=','vendors.id')
                     ->leftJoin('projects','debitvoucherheaders.projectid','=','projects.id')
                     ->leftJoin('expenseheads','debitvoucherheaders.expenseheadid','=','expenseheads.id')
                     ->where('debitvoucherheaders.status','=','PENDING')
                     ->get();
         

          return view('accounts.pendingdebitvouchermgr',compact('debitvouchers'));
     }


          public function cancelledexpenseentry()
     {

          $expenseentries=expenseentry::select('expenseentries.*','u1.name as for','u2.name as by','projects.projectname','clients.clientname','expenseheads.expenseheadname','particulars.particularname','vendors.vendorname','u3.name as approvedbyname')
                      ->leftJoin('users as u1','expenseentries.employeeid','=','u1.id')
                      ->leftJoin('users as u2','expenseentries.userid','=','u2.id')
                       ->leftJoin('users as u3','expenseentries.approvedby','=','u3.id')
                      ->leftJoin('projects','expenseentries.projectid','=','projects.id')
                      ->leftJoin('clients','projects.clientid','=','clients.id')
                      ->leftJoin('expenseheads','expenseentries.expenseheadid','=','expenseheads.id')
                      ->leftJoin('particulars','expenseentries.particularid','=','particulars.id')
                       ->leftJoin('vendors','expenseentries.vendorid','=','vendors.id')
                       ->where('expenseentries.status','=','CANCELLED')
                      ->groupBy('expenseentries.id')
                      ->get();

         return view('accounts.cancelledexpenseentry',compact('expenseentries'));

         

     }
     public function getaccountcancelledexpenseentry()
     {
                 $expenseentries=DB::table('expenseentries')->select('expenseentries.*','u1.name as for','u2.name as by','projects.projectname','clients.clientname','expenseheads.expenseheadname','particulars.particularname','vendors.vendorname','u3.name as approvedbyname')
                      ->leftJoin('users as u1','expenseentries.employeeid','=','u1.id')
                      ->leftJoin('users as u2','expenseentries.userid','=','u2.id')
                       ->leftJoin('users as u3','expenseentries.approvedby','=','u3.id')
                      ->leftJoin('projects','expenseentries.projectid','=','projects.id')
                      ->leftJoin('clients','projects.clientid','=','clients.id')
                      ->leftJoin('expenseheads','expenseentries.expenseheadid','=','expenseheads.id')
                      ->leftJoin('particulars','expenseentries.particularid','=','particulars.id')
                       ->leftJoin('vendors','expenseentries.vendorid','=','vendors.id')
                       ->where('expenseentries.status','=','CANCELLED')
                      ->groupBy('expenseentries.id');
           $sumamt=$this->moneyFormatIndia($expenseentries->sum('amount'));
              $sumapproveamt=$this->moneyFormatIndia($expenseentries->sum('approvalamount'));
                    return DataTables::of($expenseentries)
                ->addColumn('idbtn', function($expenseentries){
                         return '<a href="/viewpendingexpenseentrydetails/'.$expenseentries->id.'" class="btn btn-info">'.$expenseentries->id.'</a>';
                    })

                ->editColumn('projectname', function($expenseentries) {
                    if($expenseentries->projectname=='') return 'OTHERS';
                    else
                      return $expenseentries->projectname;
                  })
                 ->editColumn('amount', function($expenseentries) {
                      return $this->moneyFormatIndia($expenseentries->amount);
                  })
                  ->editColumn('approvalamount', function($expenseentries) {
                      return $this->moneyFormatIndia($expenseentries->approvalamount);
                  })
                ->addColumn('dates',function($expenseentries){
                   if($expenseentries->fromdate!='')
                      return $expenseentries->fromdate.')-('.$expenseentries->todate;

                  })
                ->addColumn('images',function($expenseentries){
                  return '<a href="'.asset('/img/expenseuploadedfile/'.$expenseentries->uploadedfile ).'" target="_blank">'.

                  '<img style="height:70px;width:95px;" alt="click to view" src="'.asset('/img/expenseuploadedfile/'.$expenseentries->uploadedfile ).'"></a>';

          
                })

                ->addColumn('sta',function($expenseentries){
                
                    return '<span class="label label-danger">'.$expenseentries->status.'</span>';
                })
                ->addColumn('view', function($expenseentries){
                         return '<a href="/viewpendingexpenseentrydetails/'.$expenseentries->id.'" class="btn btn-warning">VIEW</a>';
                    })
                  ->addColumn('pro', function($expenseentries){
                         return '<p class="b" title="'.$expenseentries->projectname.'">'.$expenseentries->projectname.'</p>';
                    })

                ->rawColumns(['idbtn','sta','dates','images','view','pro'])
                ->with(compact('sumamt','sumapproveamt'))
                ->make(true);

     }


     public function approvedexpenseentry()
     {

          $expenseentries=expenseentry::select('expenseentries.*','u1.name as for','u2.name as by','projects.projectname','clients.clientname','expenseheads.expenseheadname','particulars.particularname','vendors.vendorname','u3.name as approvedbyname')
                      ->leftJoin('users as u1','expenseentries.employeeid','=','u1.id')
                      ->leftJoin('users as u2','expenseentries.userid','=','u2.id')
                       ->leftJoin('users as u3','expenseentries.approvedby','=','u3.id')
                      ->leftJoin('projects','expenseentries.projectid','=','projects.id')
                      ->leftJoin('clients','projects.clientid','=','clients.id')
                      ->leftJoin('expenseheads','expenseentries.expenseheadid','=','expenseheads.id')
                      ->leftJoin('particulars','expenseentries.particularid','=','particulars.id')
                       ->leftJoin('vendors','expenseentries.vendorid','=','vendors.id')
                       ->where('expenseentries.status','=','APPROVED')
                       ->orWhere('expenseentries.status','=','PARTIALLY APPROVED')
                      ->groupBy('expenseentries.id')
                      ->get();
         return view('accounts.approvedexpenseentry',compact('expenseentries'));

       
     }

     public function getaccountapprovedexpenseentry()
     {


             $expenseentries=DB::table('expenseentries')->select('expenseentries.*','u1.name as for','u2.name as by','projects.projectname','clients.clientname','expenseheads.expenseheadname','particulars.particularname','vendors.vendorname','u3.name as approvedbyname')
                      ->leftJoin('users as u1','expenseentries.employeeid','=','u1.id')
                      ->leftJoin('users as u2','expenseentries.userid','=','u2.id')
                       ->leftJoin('users as u3','expenseentries.approvedby','=','u3.id')
                      ->leftJoin('projects','expenseentries.projectid','=','projects.id')
                      ->leftJoin('clients','projects.clientid','=','clients.id')
                      ->leftJoin('expenseheads','expenseentries.expenseheadid','=','expenseheads.id')
                      ->leftJoin('particulars','expenseentries.particularid','=','particulars.id')
                       ->leftJoin('vendors','expenseentries.vendorid','=','vendors.id')
                       
                       ->where(function ($query) {
                               $query->where('expenseentries.status', '=','APPROVED')
                               ->orWhere('expenseentries.status', '=','PARTIALLY APPROVED');
                         })
                      ->groupBy('expenseentries.id');
              $sumamt=$this->moneyFormatIndia($expenseentries->sum('amount'));
              $sumapproveamt=$this->moneyFormatIndia($expenseentries->sum('approvalamount'));
               return DataTables::of($expenseentries)
                ->addColumn('idbtn', function($expenseentries){
                         return '<a href="/viewpendingexpenseentrydetails/'.$expenseentries->id.'" class="btn btn-info">'.$expenseentries->id.'</a>';
                    })


                ->editColumn('projectname', function($expenseentries) {
                    if($expenseentries->projectname=='') return 'OTHERS';
                    else
                      return $expenseentries->projectname;
                  })
                 ->editColumn('amount', function($expenseentries) {
                      return $this->moneyFormatIndia($expenseentries->amount);
                  })
                  ->editColumn('approvalamount', function($expenseentries) {
                      return $this->moneyFormatIndia($expenseentries->approvalamount);
                  })
                ->addColumn('dates',function($expenseentries){
                   if($expenseentries->fromdate!='')
                      return $expenseentries->fromdate.')-('.$expenseentries->todate;

                  })
                ->addColumn('images',function($expenseentries){
                  return '<a href="'.asset('/img/expenseuploadedfile/'.$expenseentries->uploadedfile ).'" target="_blank">'.

                  '<img style="height:70px;width:95px;" alt="click to view" src="'.asset('/img/expenseuploadedfile/'.$expenseentries->uploadedfile ).'"></a>';

          
                })

                ->addColumn('sta',function($expenseentries){
                  if($expenseentries->status=='PENDING')
                    return '<span class="label label-danger">'.$expenseentries->status.'</span>';
                  else
                    return '<span class="label label-success">'.$expenseentries->status.'</span>';
                })
                ->addColumn('view', function($expenseentries){
                         return '<a href="/viewpendingexpenseentrydetails/'.$expenseentries->id.'" class="btn btn-warning">VIEW</a>';
                    })
                  ->addColumn('pro', function($expenseentries){
                         return '<p class="b" title="'.$expenseentries->projectname.'">'.$expenseentries->projectname.'</p>';
                    })

                ->rawColumns(['idbtn','sta','dates','images','view','pro'])
                ->with(compact('sumamt','sumapproveamt'))
                ->make(true);


     }


     public function changepartiallyapprovedexpense(Request $request)
     {
          $expenseentry=expenseentry::find($request->pid);
          $expenseentry->status="PARTIALLY APPROVED";
          $expenseentry->approvalamount=$request->amount;
          $expenseentry->remarks=$request->remarks;
          $expenseentry->approvedby=Auth::id();
          $expenseentry->save();

        $expid=$expenseentry->id;

         $towalletchk=$expenseentry->towallet;
         $employeeid=$expenseentry->employeeid;
         if($towalletchk=='YES')
         {
             $wallet=new wallet();
             $wallet->employeeid=$employeeid;
             $wallet->credit=$request->amount;
             $wallet->debit='0';
             $wallet->rid=$expid;
             $wallet->addedby=Auth::id();
             $wallet->save();

             $expenseentry1=expenseentry::find($expid);
             $expenseentry1->status="WALLET PAID";
             $expenseentry1->save();
         }
         

          return back();
     }

    public function viewalldebitvoucher()
    {

       $debitvouchers=debitvoucherheader::select('debitvoucherheaders.*','vendors.vendorname','projects.projectname','expenseheads.expenseheadname')
                     ->leftJoin('vendors','debitvoucherheaders.vendorid','=','vendors.id')
                       ->leftJoin('projects','debitvoucherheaders.projectid','=','projects.id')
                     ->leftJoin('expenseheads','debitvoucherheaders.expenseheadid','=','expenseheads.id')
                     ->get();
        return view('accounts.viewalldebitvoucher',compact('debitvouchers'));
    }

    public function savedebitvouchers(Request $request)
    {

           if(count($request->itemname)==0)
         {
              Session::flash('msg',"Failed to Save Debit Voucher Blank Item List");

              return back();

         }


         $chk=debitvoucherheader::where('vendorid',$request->vendorid)
              ->where('billno',$request->billno)
              ->where('billno','!=','NA')
              ->where('status','!=','CANCELLED')
              ->count();


         if($chk==0)
         {
         $debitvoucherheader=new debitvoucherheader();
         $debitvoucherheader->vendorid=$request->vendorid;
         $debitvoucherheader->projectid=$request->projectid;
         $debitvoucherheader->expenseheadid=$request->expenseheadid;
         $debitvoucherheader->billdate=$request->billdate;
         $debitvoucherheader->billno=$request->billno;
         $debitvoucherheader->tmrp=$request->tmrp;
         $debitvoucherheader->tdiscount=$request->tdiscount;
         $debitvoucherheader->tprice=$request->tprice;
         $debitvoucherheader->tqty=$request->tqty;
         $debitvoucherheader->tsgst=$request->tsgst;
         $debitvoucherheader->tcgst=$request->tcgst;
         $debitvoucherheader->tigst=$request->tigst;
         $debitvoucherheader->totalamt=$request->totalamt;
         $debitvoucherheader->itdeduction=$request->itdeduction;
         $debitvoucherheader->otherdeduction=$request->otherdeduction;
         $debitvoucherheader->finalamount=$request->finalamount;
         $rarefile = $request->file('invoicecopy');    
        if($rarefile!=''){
        $raupload = public_path() .'/img/debitvoucher/';
        $rarefilename=time().'.'.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$rarefilename);
        $debitvoucherheader->invoicecopy = $rarefilename;
        }
         $debitvoucherheader->save();
         $headerid=$debitvoucherheader->id;

         $count=count($request->itemname);

         for ($i=0; $i < $count; $i++) { 

          $debitvoucher=new debitvoucher();
          $debitvoucher->headerid=$headerid;
          $debitvoucher->itemname=$request->itemname[$i];
          $debitvoucher->unit=$request->unit[$i];
          $debitvoucher->qty=$request->qty[$i];
          $debitvoucher->mrp=$request->mrp[$i];
          $debitvoucher->discount=$request->discount[$i];
          $debitvoucher->price=$request->price[$i];
          $debitvoucher->sgstrate=$request->sgstrate[$i];
          $debitvoucher->sgstcost=$request->sgstcost[$i];
          $debitvoucher->cgstrate=$request->cgstrate[$i];
          $debitvoucher->cgstcost=$request->cgstcost[$i];
          $debitvoucher->igstrate=$request->igstrate[$i];
          $debitvoucher->igstcost=$request->igstcost[$i];
          $debitvoucher->igstcost=$request->igstcost[$i];
          $debitvoucher->grossamt=$request->grossamt[$i];
          $debitvoucher->save();

           }

          Session::flash('msg','Debit Voucher Save Successfully');

         }

      
         else
         {
               Session::flash('msg',"Bill is already Exist");
         }
         
        

           
        

         return back();

    }
   public function updateunits(Request $request)
   {
        $unit=unit::find($request->uid);
        $unit->unitname=$request->unitname;
        $unit->userid=Auth::id();
        $unit->save();
        Session::flash('msg','Unit Updated successfully');
        return back(); 
   }

  public function deleteunit(Request $request,$id)
  {
    $unit=unit::find($id);
    $unit->delete();

    return back();
  }


  public function saveunits(Request $request)
  {
        $unit=new unit();
        $unit->unitname=$request->unitname;
        $unit->userid=Auth::id();
        $unit->save();

        Session::flash('msg','Unit Saved successfully');
        return back();
  }

   public function units()
    {
          $units=unit::all();

          return view('accounts.units',compact('units'));
    }

  public function debitvoucher()
  {
       $projects=project::all();
       $expenseheads=expensehead::all();
       $vendors=vendor::all();
       $units=unit::all();
       return view('accounts.debitvoucher',compact('vendors','units','projects','expenseheads'));
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
             ->where(function($query) use ($uid){viewcomplaintdetails
                      $query->where('chats.sender',$uid);
                      $query->orWhere('chats.reciver',$uid);
                  })
               ->groupBy('chats.sender','chats.reciver')
               
                ->get();*/

         
         return view('accounts.mymessages',compact('messages','users'));
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
      return view('accounts.viewcomplaintdetails',compact('complaint','complaintlogs'));
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

    
                
    return view('accounts.complainttoresolve',compact('complaints','statuses','filterreq'));
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

      return view('accounts.complaint',compact('users','complaints','filterreq','statuses'));

     
   }
    /*CAHSIER SECTION*/


      public function cashierpaidrequsitionamt()
      {
           $requisitionpayments=requisitionpayment::select('requisitionpayments.*','users.name')
             ->leftJoin('requisitionheaders','requisitionpayments.rid','=','requisitionheaders.id')
             ->leftJoin('users','requisitionheaders.employeeid','=','users.id')
             ->where('requisitionpayments.paymentstatus','PAID')
             ->where(function ($query) {
                 $query->where('requisitionpayments.paymenttype', '=','ONLINE PAYMENT')
                 ->orWhere('requisitionpayments.paymenttype', '=', 'CHEQUE');
              })
             ->get();
             //return $requisitionpayments;
           return view('accounts.cashierpaidrequsitionamt',compact('requisitionpayments'));
      }

       public function cashierviewdetailsonlinepayment($id)
       {
            $requisitionpayments=requisitionpayment::select('requisitionpayments.*','users.name','users.id as uid','banks.bankname','useraccounts.acno','useraccounts.ifsccode')
             ->leftJoin('requisitionheaders','requisitionpayments.rid','=','requisitionheaders.id')
             ->leftJoin('users','requisitionheaders.employeeid','=','users.id')
             ->leftJoin('useraccounts','requisitionpayments.bankid','=','useraccounts.id')
             ->leftJoin('banks','useraccounts.bankid','=','banks.id')
             ->where('requisitionpayments.id',$id)
             ->first();
             $uid=$requisitionpayments->uid;
             $rid=$requisitionpayments->rid;

             $banks=useraccount::select('useraccounts.*','banks.bankname')
                        ->where('useraccounts.type','COMPANY')
                        ->leftJoin('banks','useraccounts.bankid','=','banks.id')
                        ->get();

        //return $requisitionpayments;

           $userbankaccount=useraccount::select('useraccounts.*','banks.bankname','users.name')
           ->leftJoin('banks','useraccounts.bankid','=','banks.id')
           ->leftJoin('users','useraccounts.user','=','users.id')
           ->where('useraccounts.user',$uid)
           ->first();
            return view('accounts.cashierviewdetailsonlinepayment',compact('requisitionpayments','userbankaccount','banks'));
       }
       public function viewpaidrequisitioncash()
       {
             $requisitionpayments=requisitionpayment::select('requisitionpayments.*','users.name')
             ->leftJoin('requisitionheaders','requisitionpayments.rid','=','requisitionheaders.id')
             ->leftJoin('users','requisitionheaders.employeeid','=','users.id')
             ->where('requisitionpayments.paymentstatus','PAID')
             ->where('requisitionpayments.paymenttype', '=','CASH')
             ->get();
           return view('accounts.viewpaidrequisitioncash',compact('requisitionpayments'));
       }

       public function cashierpaidrequsitioncash(Request $request)
       {
        $requisitionpayment=requisitionpayment::find($request->pid);
        $requisitionpayment->dateofpayment=$request->dateofpayment;
        $requisitionpayment->transactionid=$request->transactionid;
        $requisitionpayment->paymentstatus="PAID";
        $requisitionpayment->save();

          $payment=new payment();
       $payment->amount=$requisitionpayment->amount;
       $payment->type='DR';
       $payment->userid=Auth::id();
       $payment->purpose='REQUISITION PAYMENTS';
       $payment->paythrough='CASH';
       $payment->save();

       return back();
       }
      public function requisitioncashrequest(Request $request)
      {   

            $requisitionpayments=requisitionpayment::select('requisitionpayments.*','users.name')
             ->leftJoin('requisitionheaders','requisitionpayments.rid','=','requisitionheaders.id')
             ->leftJoin('users','requisitionheaders.employeeid','=','users.id')
              ->where('requisitionpayments.paymentstatus','PENDING')
              ->where('requisitionpayments.paymenttype', '=','CASH')
              ->get();
             //return $requisitionpayments;
          return view('accounts.requisitioncashrequest',compact('requisitionpayments'));
      }
    public function cashierpaidrequsitiononline(Request $request,$id)
    {
        $requisitionpayment=requisitionpayment::find($id);
        $requisitionpayment->paymentstatus="PAID";
        $requisitionpayment->bankid=$request->bank;
        $requisitionpayment->transactionid=$request->transactionid;
        $requisitionpayment->chequeno=$request->chequeno;
        $requisitionpayment->dateofpayment=$request->dateofpayment;
        $requisitionpayment->save();



       $payment=new payment();
       $payment->amount=$requisitionpayment->amount;
       $payment->type='DR';
       $payment->userid=Auth::id();
       $payment->purpose='REQUISITION PAYMENTS';
       $payment->bank=$requisitionpayment->bankid;
       $payment->paythrough='ONLINE';
       $payment->save();




        return redirect('/prb/requisitiononlinepending');
    }
     public function viewallbankrequisitionpayment()
     {
           

             $requisitionpayments=requisitionpayment::select('requisitionpayments.*','users.name')
             ->leftJoin('requisitionheaders','requisitionpayments.rid','=','requisitionheaders.id')
             ->leftJoin('users','requisitionheaders.employeeid','=','users.id')
             ->where('requisitionpayments.paymentstatus','PENDING')
              ->where(function ($query) {
                 $query->where('requisitionpayments.paymenttype', '=','ONLINE PAYMENT')
                 ->orWhere('requisitionpayments.paymenttype', '=', 'CHEQUE');
              })
             ->get();

            return view('accounts.viewallbankrequisitionpayment',compact('requisitionpayments'));
     }

     /*ACCOUNT SECTON*/

       public function viewpendingexpenseentrydetails($id)
       {

            $expenseentry=expenseentry::select('expenseentries.*','u1.name as for','u2.name as by','projects.projectname','clients.clientname','expenseheads.expenseheadname','particulars.particularname','vendors.vendorname','u3.name as approvedbyname')
                      ->leftJoin('users as u1','expenseentries.employeeid','=','u1.id')
                      ->leftJoin('users as u2','expenseentries.userid','=','u2.id')
                      ->leftJoin('users as u3','expenseentries.approvedby','=','u3.id')
                      ->leftJoin('projects','expenseentries.projectid','=','projects.id')
                      ->leftJoin('clients','projects.clientid','=','clients.id')
                      ->leftJoin('expenseheads','expenseentries.expenseheadid','=','expenseheads.id')
                      ->leftJoin('particulars','expenseentries.particularid','=','particulars.id')
                       ->leftJoin('vendors','expenseentries.vendorid','=','vendors.id')
                       ->where('expenseentries.id',$id)
                      ->groupBy('expenseentries.id')
                      ->first();
        //return $expenseentry;
            $empid=$expenseentry->employeeid;
           $requisition=requisitionheader::select('requisitions.*','requisitionheaders.employeeid','requisitionpayments.amount as paidamt')
                      ->leftJoin('requisitionpayments','requisitionpayments.rid','=','requisitionheaders.id')
                       ->leftJoin('requisitions','requisitions.requisitionheaderid','=','requisitionheaders.id')
                       ->where('requisitionpayments.paymentstatus','PAID')
                       ->where('requisitionpayments.paymenttype','!=','WALLET')
                      ->where('requisitionheaders.employeeid',$empid)
                      ->groupBy('requisitionpayments.id')
                      ->get();
         
          $totalamt=$requisition->sum('paidamt');
        
        $entries=expenseentry::where('employeeid',$empid)
                ->where('towallet','!=','YES')
                ->get();
          $totalamtentry=$entries->sum('approvalamount');
          $wallet=wallet::where('employeeid',$empid)
                ->get();
         $walletcr=$wallet->sum('credit');
         $walletdr=$wallet->sum('debit');
         $walletbalance=$walletcr-$walletdr;

          $bal=($totalamt-$totalamtentry)-$walletbalance;

          $all=array('totalamt'=>$totalamt,'totalexpense'=>$totalamtentry,'balance'=>$bal);
           

         
   
          $paidamounts=requisitionpayment::where('rid',$id)->get();

          if($expenseentry->vehicleid!='')
          {
              $vehicledetail=vehicle::find($expenseentry->vehicleid);
          }
          else
          {
               $vehicledetail='';
          }
        
          $vendor=vendor::select('vendors.*','users.name')
            ->leftJoin('users','vendors.userid','=','users.id')
            ->where('vendors.id',$expenseentry->vendorid)
            ->first();
             
            $engagedlaboursarr=array();
           if($expenseentry->type=='LABOUR PAYMENT' && $expenseentry->version=='NEW')
           {
                $expenseentrydailylabour=expenseentrydailylabour::select('dailylabours.*')
                                 ->leftJoin('dailylabours','expenseentrydailylabours.dailylabourid','=','dailylabours.id')
                                 ->where('expenseid',$expenseentry->id)
                                 ->get();
                     foreach ($expenseentrydailylabour as $key => $dailylabour) {
            $nooflabour=engagedlabour::where('dailylabourid',$dailylabour->id)->count();
            $engagedlaboursarr[]=[
              'id'=>$dailylabour->id,
              'date'=>$dailylabour->date,
              'description'=>$dailylabour->description,
              'labourimage'=>$dailylabour->workingimage,
              'nooflabour'=>$nooflabour,
            ];
        }

           }
           elseif ($expenseentry->type=='VEHICLE PAYMENT' && $expenseentry->version=='NEW') {

                  $expenseentrydailyvehicle=expenseentrydailyvehicle::select('dailyvehicles.*','vehicles.vehiclename','vehicles.vehicleno')
                                   ->leftJoin('dailyvehicles','expenseentrydailyvehicles.dailyvehicleid','=','dailyvehicles.id')
                                   ->leftJoin('vehicles','dailyvehicles.vehicleid','=','vehicles.id')
                                   ->where('expenseid',$expenseentry->id)
                                   ->get();
           }
           else
           {
               $expenseentrydailylabour=array();
               $expenseentrydailyvehicle=array();

           }
           
          return view('accounts.viewpendingexpenseentrydetails',compact('vehicledetail','expenseentry','vendor','expenseentrydailylabour','expenseentrydailyvehicle','engagedlaboursarr','paidamounts','totalamt','totalamtentry','bal','walletbalance'));
       }

       public function viewdetailshodexpenseentry($id)
       {
          $expenseentry=expenseentry::select('expenseentries.*','u1.name as for','u2.name as by','projects.projectname','clients.clientname','expenseheads.expenseheadname','particulars.particularname','vendors.vendorname','u3.name as approvedbyname','u4.name as hodname')
                      ->leftJoin('users as u1','expenseentries.employeeid','=','u1.id')
                      ->leftJoin('users as u2','expenseentries.userid','=','u2.id')
                      ->leftJoin('users as u3','expenseentries.approvedby','=','u3.id')
                      ->leftJoin('projects','expenseentries.projectid','=','projects.id')
                      ->leftJoin('clients','projects.clientid','=','clients.id')
                      ->leftJoin('expenseheads','expenseentries.expenseheadid','=','expenseheads.id')
                      ->leftJoin('particulars','expenseentries.particularid','=','particulars.id')
                       ->leftJoin('vendors','expenseentries.vendorid','=','vendors.id')
                       ->leftJoin('userunderhods','expenseentries.employeeid','=','userunderhods.userid')
                       ->leftJoin('users as u4','userunderhods.hodid','=','u4.id')
                       ->where('expenseentries.id',$id)
                      ->groupBy('expenseentries.id')
                      ->first();
  $empid=$expenseentry->employeeid;
           $requisition=requisitionheader::select('requisitions.*','requisitionheaders.employeeid','requisitionpayments.amount as paidamt')
                      ->leftJoin('requisitionpayments','requisitionpayments.rid','=','requisitionheaders.id')
                       ->leftJoin('requisitions','requisitions.requisitionheaderid','=','requisitionheaders.id')
                       ->where('requisitionpayments.paymentstatus','PAID')
                       ->where('requisitionpayments.paymenttype','!=','WALLET')
                      ->where('requisitionheaders.employeeid',$empid)
                      ->groupBy('requisitionpayments.id')
                      ->get();
         
          $totalamt=$requisition->sum('paidamt');
        
        $entries=expenseentry::where('employeeid',$empid)
                ->where('towallet','!=','YES')
                ->get();
          $totalamtentry=$entries->sum('approvalamount');
          $wallet=wallet::where('employeeid',$empid)
                ->get();
         $walletcr=$wallet->sum('credit');
         $walletdr=$wallet->sum('debit');
         $walletbalance=$walletcr-$walletdr;

          $bal=($totalamt-$totalamtentry)-$walletbalance;

          $all=array('totalamt'=>$totalamt,'totalexpense'=>$totalamtentry,'balance'=>$bal);
           

         
   
          $paidamounts=requisitionpayment::where('rid',$id)->get();
          if($expenseentry->vehicleid!='')
          {
              $vehicledetail=vehicle::find($expenseentry->vehicleid);
          }
          else
          {
               $vehicledetail='';
          }
        
          $vendor=vendor::select('vendors.*','users.name')
            ->leftJoin('users','vendors.userid','=','users.id')
            ->where('vendors.id',$expenseentry->vendorid)
            ->first();
             
            $engagedlaboursarr=array();
           if($expenseentry->type=='LABOUR PAYMENT' && $expenseentry->version=='NEW')
           {
                $expenseentrydailylabour=expenseentrydailylabour::select('dailylabours.*')
                                 ->leftJoin('dailylabours','expenseentrydailylabours.dailylabourid','=','dailylabours.id')
                                 ->where('expenseid',$expenseentry->id)
                                 ->get();
                     foreach ($expenseentrydailylabour as $key => $dailylabour) {
            $nooflabour=engagedlabour::where('dailylabourid',$dailylabour->id)->count();
            $engagedlaboursarr[]=[
              'id'=>$dailylabour->id,
              'date'=>$dailylabour->date,
              'description'=>$dailylabour->description,
              'labourimage'=>$dailylabour->workingimage,
              'nooflabour'=>$nooflabour,
            ];
        }

           }
           elseif ($expenseentry->type=='VEHICLE PAYMENT' && $expenseentry->version=='NEW') {

                  $expenseentrydailyvehicle=expenseentrydailyvehicle::select('dailyvehicles.*','vehicles.vehiclename','vehicles.vehicleno')
                                   ->leftJoin('dailyvehicles','expenseentrydailyvehicles.dailyvehicleid','=','dailyvehicles.id')
                                   ->leftJoin('vehicles','dailyvehicles.vehicleid','=','vehicles.id')
                                   ->where('expenseid',$expenseentry->id)
                                   ->get();
           }
           else
           {
               $expenseentrydailylabour=array();
               $expenseentrydailyvehicle=array();

           }
           //return $expenseentry;
          return view('accounts.viewdetailshodexpenseentry',compact('vehicledetail','expenseentry','vendor','expenseentrydailylabour','expenseentrydailyvehicle','engagedlaboursarr','paidamounts','totalamt','totalamtentry','bal','walletbalance'));
       }


       public function viewpendingexpenseentrydetailsadmin($id)
       {
            $expenseentry=expenseentry::select('expenseentries.*','u1.name as for','u2.name as by','projects.projectname','clients.clientname','expenseheads.expenseheadname','particulars.particularname','vendors.vendorname','u3.name as approvedbyname')
                      ->leftJoin('users as u1','expenseentries.employeeid','=','u1.id')
                      ->leftJoin('users as u2','expenseentries.userid','=','u2.id')
                      ->leftJoin('users as u3','expenseentries.approvedby','=','u3.id')
                      ->leftJoin('projects','expenseentries.projectid','=','projects.id')
                      ->leftJoin('clients','projects.clientid','=','clients.id')
                      ->leftJoin('expenseheads','expenseentries.expenseheadid','=','expenseheads.id')
                      ->leftJoin('particulars','expenseentries.particularid','=','particulars.id')
                       ->leftJoin('vendors','expenseentries.vendorid','=','vendors.id')
                       ->where('expenseentries.id',$id)
                      ->groupBy('expenseentries.id')
                      ->first();

          if($expenseentry->vehicleid!='')
          {
              $vehicledetail=vehicle::find($expenseentry->vehicleid);
          }
          else
          {
               $vehicledetail='';
          }
        
          $vendor=vendor::select('vendors.*','users.name')
            ->leftJoin('users','vendors.userid','=','users.id')
            ->where('vendors.id',$expenseentry->vendorid)
            ->first();
             
            $engagedlaboursarr=array();
           if($expenseentry->type=='LABOUR PAYMENT' && $expenseentry->version=='NEW')
           {
                $expenseentrydailylabour=expenseentrydailylabour::select('dailylabours.*')
                                 ->leftJoin('dailylabours','expenseentrydailylabours.dailylabourid','=','dailylabours.id')
                                 ->where('expenseid',$expenseentry->id)
                                 ->get();
                     foreach ($expenseentrydailylabour as $key => $dailylabour) {
            $nooflabour=engagedlabour::where('dailylabourid',$dailylabour->id)->count();
            $engagedlaboursarr[]=[
              'id'=>$dailylabour->id,
              'date'=>$dailylabour->date,
              'description'=>$dailylabour->description,
              'labourimage'=>$dailylabour->workingimage,
              'nooflabour'=>$nooflabour,
            ];
        }

           }
           elseif ($expenseentry->type=='VEHICLE PAYMENT' && $expenseentry->version=='NEW') {

                  $expenseentrydailyvehicle=expenseentrydailyvehicle::select('dailyvehicles.*','vehicles.vehiclename','vehicles.vehicleno')
                                   ->leftJoin('dailyvehicles','expenseentrydailyvehicles.dailyvehicleid','=','dailyvehicles.id')
                                   ->leftJoin('vehicles','dailyvehicles.vehicleid','=','vehicles.id')
                                   ->where('expenseid',$expenseentry->id)
                                   ->get();
           }
           else
           {
               $expenseentrydailylabour=array();
               $expenseentrydailyvehicle=array();

           }
           
          return view('viewpendingexpenseentrydetailsadmin',compact('vehicledetail','expenseentry','vendor','expenseentrydailylabour','expenseentrydailyvehicle','engagedlaboursarr'));
       }    

       public function viewwalletpaidexpenseentrydetails($id)
       {
            $expenseentry=expenseentry::select('expenseentries.*','u1.name as for','u2.name as by','projects.projectname','clients.clientname','expenseheads.expenseheadname','particulars.particularname','vendors.vendorname','u3.name as approvedbyname')
                      ->leftJoin('users as u1','expenseentries.employeeid','=','u1.id')
                      ->leftJoin('users as u2','expenseentries.userid','=','u2.id')
                      ->leftJoin('users as u3','expenseentries.approvedby','=','u3.id')
                      ->leftJoin('projects','expenseentries.projectid','=','projects.id')
                      ->leftJoin('clients','projects.clientid','=','clients.id')
                      ->leftJoin('expenseheads','expenseentries.expenseheadid','=','expenseheads.id')
                      ->leftJoin('particulars','expenseentries.particularid','=','particulars.id')
                       ->leftJoin('vendors','expenseentries.vendorid','=','vendors.id')
                       ->where('expenseentries.id',$id)
                      ->groupBy('expenseentries.id')
                      ->first();
          $empid=$expenseentry->employeeid;
           $requisition=requisitionheader::select('requisitions.*','requisitionheaders.employeeid','requisitionpayments.amount as paidamt')
                      ->leftJoin('requisitionpayments','requisitionpayments.rid','=','requisitionheaders.id')
                       ->leftJoin('requisitions','requisitions.requisitionheaderid','=','requisitionheaders.id')
                       ->where('requisitionpayments.paymentstatus','PAID')
                       ->where('requisitionpayments.paymenttype','!=','WALLET')
                      ->where('requisitionheaders.employeeid',$empid)
                      ->groupBy('requisitionpayments.id')
                      ->get();
         
          $totalamt=$requisition->sum('paidamt');
        
        $entries=expenseentry::where('employeeid',$empid)
                ->where('towallet','!=','YES')
                ->get();
          $totalamtentry=$entries->sum('approvalamount');
          $wallet=wallet::where('employeeid',$empid)
                ->get();
         $walletcr=$wallet->sum('credit');
         $walletdr=$wallet->sum('debit');
         $walletbalance=$walletcr-$walletdr;

          $bal=($totalamt-$totalamtentry)-$walletbalance;

          $all=array('totalamt'=>$totalamt,'totalexpense'=>$totalamtentry,'balance'=>$bal);
           

         
   
          $paidamounts=requisitionpayment::where('rid',$id)->get();
          $vendor=vendor::select('vendors.*','users.name')
            ->leftJoin('users','vendors.userid','=','users.id')
            ->where('vendors.id',$expenseentry->vendorid)
            ->first();

          return view('accounts.viewwalletpaidexpenseentrydetails',compact('expenseentry','vendor','paidamounts','totalamt','totalamtentry','bal','walletbalance'));
       }

      public function viewexpenseentrydetails($id)
      {   
           

          $expenseentry=expenseentry::select('expenseentries.*','u1.name as for','u2.name as by','projects.projectname','clients.clientname','expenseheads.expenseheadname','particulars.particularname','vendors.vendorname','u3.name as approvedbyname')
                      ->leftJoin('users as u1','expenseentries.employeeid','=','u1.id')
                      ->leftJoin('users as u2','expenseentries.userid','=','u2.id')
                      ->leftJoin('users as u3','expenseentries.approvedby','=','u3.id')
                      ->leftJoin('projects','expenseentries.projectid','=','projects.id')
                      ->leftJoin('clients','projects.clientid','=','clients.id')
                      ->leftJoin('expenseheads','expenseentries.expenseheadid','=','expenseheads.id')
                      ->leftJoin('particulars','expenseentries.particularid','=','particulars.id')
                       ->leftJoin('vendors','expenseentries.vendorid','=','vendors.id')
                       ->where('expenseentries.id',$id)
                      ->groupBy('expenseentries.id')
                      ->first();
           $empid=$expenseentry->employeeid;
           $requisition=requisitionheader::select('requisitions.*','requisitionheaders.employeeid','requisitionpayments.amount as paidamt')
                      ->leftJoin('requisitionpayments','requisitionpayments.rid','=','requisitionheaders.id')
                       ->leftJoin('requisitions','requisitions.requisitionheaderid','=','requisitionheaders.id')
                       ->where('requisitionpayments.paymentstatus','PAID')
                       ->where('requisitionpayments.paymenttype','!=','WALLET')
                      ->where('requisitionheaders.employeeid',$empid)
                      ->groupBy('requisitionpayments.id')
                      ->get();
         
          $totalamt=$requisition->sum('paidamt');
        
        $entries=expenseentry::where('employeeid',$empid)
                ->where('towallet','!=','YES')
                ->get();
          $totalamtentry=$entries->sum('approvalamount');
          $wallet=wallet::where('employeeid',$empid)
                ->get();
         $walletcr=$wallet->sum('credit');
         $walletdr=$wallet->sum('debit');
         $walletbalance=$walletcr-$walletdr;

          $bal=($totalamt-$totalamtentry)-$walletbalance;

          $all=array('totalamt'=>$totalamt,'totalexpense'=>$totalamtentry,'balance'=>$bal);   
          $paidamounts=requisitionpayment::where('rid',$id)->get();

          $vendor=vendor::select('vendors.*','users.name')
            ->leftJoin('users','vendors.userid','=','users.id')
            ->where('vendors.id',$expenseentry->vendorid)
            ->first();

           $engagedlaboursarr=array();
           if($expenseentry->type=='LABOUR PAYMENT' && $expenseentry->version=='NEW')
           {
                $expenseentrydailylabour=expenseentrydailylabour::select('dailylabours.*')
                                 ->leftJoin('dailylabours','expenseentrydailylabours.dailylabourid','=','dailylabours.id')
                                 ->where('expenseid',$expenseentry->id)
                                 ->get();
                     foreach ($expenseentrydailylabour as $key => $dailylabour) {
            $nooflabour=engagedlabour::where('dailylabourid',$dailylabour->id)->count();
            $engagedlaboursarr[]=[
              'id'=>$dailylabour->id,
              'date'=>$dailylabour->date,
              'description'=>$dailylabour->description,
              'labourimage'=>$dailylabour->workingimage,
              'nooflabour'=>$nooflabour,
            ];
        }

           }
           elseif ($expenseentry->type=='VEHICLE PAYMENT' && $expenseentry->version=='NEW') {

                  $expenseentrydailyvehicle=expenseentrydailyvehicle::select('dailyvehicles.*','vehicles.vehiclename','vehicles.vehicleno')
                                   ->leftJoin('dailyvehicles','expenseentrydailyvehicles.dailyvehicleid','=','dailyvehicles.id')
                                   ->leftJoin('vehicles','dailyvehicles.vehicleid','=','vehicles.id')
                                   ->where('expenseid',$expenseentry->id)
                                   ->get();
           }
           else
           {
               $expenseentrydailylabour=array();
               $expenseentrydailyvehicle=array();

           }
       



          return view('accounts.viewexpenseentrydetails',compact('expenseentry','vendor','expenseentrydailylabour','expenseentrydailyvehicle','engagedlaboursarr','paidamounts','totalamt','totalamtentry','bal','walletbalance'));
      }

       public function updateuserbankaccount(Request $request)
       {
           

        $useraccount=useraccount::find($request->uid);
        $useraccount->user=$request->user;
        $useraccount->bankid=$request->bankid;
        $useraccount->acno=$request->acno;
        $useraccount->ifsccode=$request->ifsccode;
        $useraccount->branchname=$request->branchname;
        $useraccount->userid=Auth::id();
        $useraccount->type="USER";
         $rarefile = $request->file('scancopy');    
        if($rarefile!=''){
        $raupload = public_path() .'/img/bankacscancopy/';
        $rarefilename=time().'.'.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$rarefilename);
        $useraccount->scancopy = $rarefilename;
        }
        $useraccount->save();
           Session::flash('msg','Account Data Updated Successfully');
       return back();
       }
       public function viewalluserbankaccount()
       {

            $users=User::all();
          $banks=bank::all();

          $useraccounts=useraccount::select('useraccounts.*','users.name','banks.bankname')
                       ->leftJoin('users','useraccounts.user','=','users.id')
                       ->leftJoin('banks','useraccounts.bankid','=','banks.id')
                       ->where('useraccounts.type','USER')
                       ->get();
     
           return view('accounts.viewalluserbankaccount',compact('users','banks','useraccounts'));
       }
      public function saveuesrbankaccount(Request $request)
      {
         $count=useraccount::where('user',$request->user)->where('bankid',$request->bankid)->where('acno',$request->acno)->count();

         if ($count>0) {
              Session::flash('msg','Account Data Already Exists');
         }
         else
         {
            $useraccount=new useraccount();
        $useraccount->user=$request->user;
        $useraccount->bankid=$request->bankid;
        $useraccount->acno=$request->acno;
        $useraccount->ifsccode=$request->ifsccode;
        $useraccount->branchname=$request->branchname;
        $useraccount->userid=Auth::id();
        $useraccount->type="USER";
         $rarefile = $request->file('scancopy');    
        if($rarefile!=''){
        $raupload = public_path() .'/img/bankacscancopy/';
        $rarefilename=time().'.'.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$rarefilename);
        $useraccount->scancopy = $rarefilename;
        }
        $useraccount->save();
           Session::flash('msg','Account Data Saved Successfully');
         }
      
        return back();
      }
     public function userbankaccount()
     {
          $users=User::all();
          $banks=bank::all();

          $useraccounts=useraccount::select('useraccounts.*','users.name','banks.bankname')
                       ->leftJoin('users','useraccounts.user','=','users.id')
                       ->leftJoin('banks','useraccounts.bankid','=','banks.id')
                       ->where('useraccounts.type','USER')
                       ->get();
     
         return view('accounts.userbankaccount',compact('banks','users','useraccounts'));
     }

     public function changependingstatustocanceled(Request $request,$id)
     {
       $requisitionheader=requisitionheader::find($id);
       $requisitionheader->cancelreason=$request->cancelreason;
       $requisitionheader->cancelledby=Auth::id();
       $requisitionheader->status="CANCELLED";
        $requisitionheader->save();

        return redirect('/viewrequisitions/pendingrequisitions');

     } 
     public function changependingstatustocanceledmgr(Request $request,$id)
     {
       $requisitionheader=requisitionheader::find($id);
       $requisitionheader->cancelreason=$request->cancelreason;
       $requisitionheader->cancelledby=Auth::id();
       $requisitionheader->status="CANCELLED";
        $requisitionheader->save();

        return redirect('/viewrequisitions/pendingrequisitionsmgr');

     } 
     public function changependingstatustocanceledhod(Request $request,$id)
     {
       $requisitionheader=requisitionheader::find($id);
       $requisitionheader->cancelreason=$request->cancelreason;
       $requisitionheader->cancelledby=Auth::id();
       $requisitionheader->status="CANCELLED";
        $requisitionheader->save();

        return redirect('/hodrequisition/pendingrequisition');

     } 
     public function hodchangependingstatustocanceled(Request $request,$id)
     {
       $requisitionheader=requisitionheader::find($id);
       $requisitionheader->cancelreason=$request->cancelreason;
       $requisitionheader->cancelledby=Auth::id();
       $requisitionheader->status="CANCELLED";
        $requisitionheader->save();

        return redirect('/viewrequisitions/pendingrequisitionshod');

     }
    public function cancelrequisation(Request $request)
    {
       $requisition=requisition::find($request->cid);
        $requisition->approvestatus='CANCELLED';
        $requisition->cancelationreason=$request->cancelreason;
        $requisition->approvedamount=0;
        $requisition->save();

        return back();

    }
    public function changepartiallyapproved(Request $request)
    {
    
       $requisition=requisition::find($request->pid);
       $requisition->approvedamount=$request->amount;
       $requisition->approvestatus='PARTIALLY APPROVED';
       $requisition->remarks=$request->remarks;
        $requisition->save();
       return back();

    }
    public function ajaxrequitionfullyapproved(Request $request)
    {
     
            $requisition=requisition::find($request->id);
            $requisition->approvedamount=$request->amount;
            $requisition->approvestatus=$request->action;
            $requisition->save();

            return '1';

    }

    public function markascompleterequisition(Request $request,$id)
    {
          $requisitionheader=requisitionheader::find($id);
          $requisitionheader->status='COMPLETED';
          $requisitionheader->save();

           return redirect('/viewrequisitions/approvedrequisitions');
    }

    public function payrequisition(Request $request,$id)
    {

          $date = Carbon::now();
          if($request->paymenttype!='WALLET')
          {

          $requisitionpayment=new requisitionpayment();
          $requisitionpayment->amount=$request->amount;
          $requisitionpayment->rid=$id;
          $requisitionpayment->bankid=$request->bankid;
          $requisitionpayment->paymenttype=$request->paymenttype;
          $requisitionpayment->remarks=$request->remarks;
          $requisitionpayment->save();

          }

   


          else
          {
          $requisitionpayment=new requisitionpayment();
          $requisitionpayment->amount=$request->amount;
          $requisitionpayment->rid=$id;
          $requisitionpayment->bankid='';
          $requisitionpayment->paymentstatus='PAID';
          $requisitionpayment->dateofpayment=date('Y-m-d');
          $requisitionpayment->paymenttype=$request->paymenttype;
          $requisitionpayment->remarks=$request->amount.' amount debited from your wallet';
          $requisitionpayment->save();

          $reqhead=requisitionheader::find($id);
          $empid=$reqhead->employeeid;

             $wallet=new wallet();
             $wallet->employeeid=$empid;
             $wallet->credit='0';
             $wallet->debit=$request->amount;
             $wallet->rid=$id;
             $wallet->addedby=Auth::id();
             $wallet->save();


          }
         


           return back();
    }
    public function changeapprovalamt(Request $request)
    {
        $requisition=requisition::find($request->rid);
        $requisition->approvestatus=$request->status;
        $requisition->approvedamount=$request->approvalamount;
        $requisition->approvedamount=$request->approvalamount;
        if($request->status=='CANCELLED')
        {
           $requisition->cancelationreason=$request->cancelreason;
        }
        else
        {
            $requisition->remarks=$request->remarks;
        }
        $requisition->save();

        return back();
    }

     public function changependingstatustocancel(Request $request,$id)
     {
          $requisitionheader=requisitionheader::find($id);
          $requisitionheader->status=$request->status;
          $requisitionheader->remarks=$request->remarks;
          $requisitionheader->cancelledby=Auth::id();
          $requisitionheader->save();

          return redirect('/viewrequisitions/approvedrequisitions');
     }

     public function approvedrequisitions()
     {
      $requisitions=requisitionheader::select('requisitionheaders.*','u1.name as employee','u2.name as author','u3.name as approver','projects.projectname')
                      ->leftJoin('users as u1','requisitionheaders.employeeid','=','u1.id')
                      ->leftJoin('users as u2','requisitionheaders.userid','=','u2.id')
                      ->leftJoin('users as u3','requisitionheaders.approvedby','=','u3.id')
                      ->leftJoin('projects','requisitionheaders.projectid','=','projects.id')
                      ->where('requisitionheaders.status','APPROVED')
                      ->get();

         return view('accounts.approvedrequisitions',compact('requisitions'));
     }
     public function completedrequisitions()
     {
         $requisitions=requisitionheader::select('requisitionheaders.*','u1.name as employee','u2.name as author','u3.name as approver','projects.projectname')
                      ->leftJoin('users as u1','requisitionheaders.employeeid','=','u1.id')
                      ->leftJoin('users as u2','requisitionheaders.userid','=','u2.id')
                      ->leftJoin('users as u3','requisitionheaders.approvedby','=','u3.id')
                      ->leftJoin('projects','requisitionheaders.projectid','=','projects.id')
                      ->where('requisitionheaders.status','COMPLETED')
                      ->get();

         return view('accounts.completedrequisitions',compact('requisitions'));
     }
    public function cancelledrequisitions()
    {
          $requisitions=requisitionheader::select('requisitionheaders.*','u1.name as employee','u2.name as author','u3.name as approver','projects.projectname')
                      ->leftJoin('users as u1','requisitionheaders.employeeid','=','u1.id')
                      ->leftJoin('users as u2','requisitionheaders.userid','=','u2.id')
                      ->leftJoin('users as u3','requisitionheaders.cancelledby','=','u3.id')
                      ->leftJoin('projects','requisitionheaders.projectid','=','projects.id')
                      ->where('requisitionheaders.status','CANCELLED')
                      ->get();

        return view('accounts.cancelledrequisitions',compact('requisitions'));
    }
     public function changependingstatus(Request $request,$id)
     {
          $requisitionheader=requisitionheader::find($id);
          $requisitionheader->status=$request->status;
          $requisitionheader->approvalamount=$request->approvalamount;
          $requisitionheader->remarks=$request->remarks;
          if($request->status=='CANCELLED')
          {
             $requisitionheader->cancelledby=Auth::id();
          }
          else
          {
            $requisitionheader->approvedby=Auth::id();
          }
         
          $requisitionheader->save();
          
          return redirect('/viewrequisitions/pendingrequisitions');
     }
public function changependingstatusmgr(Request $request,$id)
     {
          
          $requisitionheader=requisitionheader::find($id);
          $requisitionheader->status=$request->status;
          $requisitionheader->approvalamount=$request->approvalamount;
          $requisitionheader->remarks=$request->remarks;
          if($request->status=='CANCELLED')
          {
             $requisitionheader->cancelledby=Auth::id();
          }
          else
          {
            $requisitionheader->approvedby=Auth::id();
          }
         
          $requisitionheader->save();
          
          return redirect('/viewrequisitions/pendingrequisitionsmgr');
     }

     
     public function viewapprovedrequisition($id)
     {

          $rq=requisitionheader::find($id);
            $empid=$rq->employeeid;
           $requisition=requisitionheader::select('requisitions.*','requisitionpayments.amount as paidamt')
                      ->leftJoin('requisitionpayments','requisitionpayments.rid','=','requisitionheaders.id')
                       ->leftJoin('requisitions','requisitions.requisitionheaderid','=','requisitionheaders.id')
                       ->where('requisitionpayments.paymentstatus','PAID')
                       ->where('requisitionpayments.paymenttype','!=','WALLET')
                      ->where('requisitionheaders.employeeid',$empid)
                      ->groupBy('requisitionpayments.id')
                      ->get();

          $totalamt=$requisition->sum('paidamt');
        
        $entries=expenseentry::where('employeeid',$empid)
                 ->where('towallet','!=','YES')
                ->get();
          $totalamtentry=$entries->sum('approvalamount');

           $wallet=wallet::where('employeeid',$empid)
                ->get();
         $walletcr=$wallet->sum('credit');
         $walletdr=$wallet->sum('debit');
         $walletbalance=$walletcr-$walletdr;

          
          $bal1=($totalamt-$totalamtentry)-$walletbalance;
            
               $banks=useraccount::select('useraccounts.*','banks.bankname')
                        ->where('useraccounts.type','COMPANY')
                        ->leftJoin('banks','useraccounts.bankid','=','banks.id')
                        ->get();
                  
               $paidamounts=requisitionpayment::select('requisitionpayments.*','banks.bankname','useraccounts.forcompany','useraccounts.acno')
                             ->where('rid',$id)
                             ->leftJoin('useraccounts','requisitionpayments.bankid','=','useraccounts.id')
                             ->leftJoin('banks','useraccounts.bankid','=','banks.id')
                             ->get();

                   $requisitionheader=requisitionheader::select('requisitionheaders.*','u1.name as employee','u2.name as author','u3.name as approver','projects.projectname')
                      ->leftJoin('users as u1','requisitionheaders.employeeid','=','u1.id')
                      ->leftJoin('users as u2','requisitionheaders.userid','=','u2.id')
                      ->leftJoin('users as u3','requisitionheaders.approvedby','=','u3.id')
                      ->leftJoin('projects','requisitionheaders.projectid','=','projects.id')
                      ->where('requisitionheaders.status','APPROVED')
                      ->where('requisitionheaders.id',$id)
                      ->first();
           
           $requisitions=requisition::select('requisitions.*','expenseheads.expenseheadname','particulars.particularname','vendors.id as vendorid','vendors.vendorname','vendors.mobile','vendors.details','vendors.bankname','vendors.acno','vendors.branchname','vendors.ifsccode','vendors.photo','vendors.vendoridproof')
                       ->leftJoin('expenseheads','requisitions.expenseheadid','=','expenseheads.id')
                       ->leftJoin('particulars','requisitions.particularid','=','particulars.id')
                        ->leftJoin('vendors','requisitions.vendorid','=','vendors.id')

                       ->where('requisitions.requisitionheaderid',$id)
                       ->get();

           //return $requisitions;
          return view('accounts.viewapprovedrequisition',compact('paidamounts','requisitionheader','requisitions','banks','totalamt','totalamtentry','bal1','walletbalance'));        
     } 
      public function viewcompletedrequisition($id)
      {
         $rq=requisitionheader::find($id);
            $empid=$rq->employeeid;
           $requisition=requisitionheader::select('requisitions.*','requisitionheaders.employeeid','requisitionpayments.amount as paidamt')
                      ->leftJoin('requisitionpayments','requisitionpayments.rid','=','requisitionheaders.id')
                       ->leftJoin('requisitions','requisitions.requisitionheaderid','=','requisitionheaders.id')
                       ->where('requisitionpayments.paymentstatus','PAID')
                       ->where('requisitionpayments.paymenttype','!=','WALLET')
                      ->where('requisitionheaders.employeeid',$empid)
                      ->groupBy('requisitionpayments.id')
                      ->get();
         
          $totalamt=$requisition->sum('paidamt');
        
        $entries=expenseentry::where('employeeid',$empid)
                ->where('towallet','!=','YES')
                ->get();
          $totalamtentry=$entries->sum('approvalamount');
          $wallet=wallet::where('employeeid',$empid)
                ->get();
         $walletcr=$wallet->sum('credit');
         $walletdr=$wallet->sum('debit');
         $walletbalance=$walletcr-$walletdr;

          $bal=($totalamt-$totalamtentry)-$walletbalance;

          $all=array('totalamt'=>$totalamt,'totalexpense'=>$totalamtentry,'balance'=>$bal);
           
              $paidamounts=requisitionpayment::select('requisitionpayments.*','banks.bankname','useraccounts.forcompany','useraccounts.acno')
                             ->where('rid',$id)
                             ->leftJoin('useraccounts','requisitionpayments.bankid','=','useraccounts.id')
                             ->leftJoin('banks','useraccounts.bankid','=','banks.id')
                             ->get();
             $requisitionheader=requisitionheader::select('requisitionheaders.*','u1.name as employee','u2.name as author','u3.name as approver','projects.projectname')
                      ->leftJoin('users as u1','requisitionheaders.employeeid','=','u1.id')
                      ->leftJoin('users as u2','requisitionheaders.userid','=','u2.id')
                      ->leftJoin('users as u3','requisitionheaders.approvedby','=','u3.id')
                      ->leftJoin('projects','requisitionheaders.projectid','=','projects.id')
                      ->where('requisitionheaders.status','COMPLETED')
                      ->where('requisitionheaders.id',$id)
                      ->first();
           
           $requisitions=requisition::select('requisitions.*','expenseheads.expenseheadname','particulars.particularname')
                       ->leftJoin('expenseheads','requisitions.expenseheadid','=','expenseheads.id')
                       ->leftJoin('particulars','requisitions.particularid','=','particulars.id')
                       ->where('requisitions.requisitionheaderid',$id)
                       ->get();


          return view('accounts.viewcompletedrequisition',compact('requisitionheader','requisitions','paidamounts','totalamt','totalamtentry','bal','walletbalance'));        
           
      }
     public function viewcanceledrequisition($id)
     {
       $rq=requisitionheader::find($id);
            $empid=$rq->employeeid;
           $requisition=requisitionheader::select('requisitions.*','requisitionheaders.employeeid','requisitionpayments.amount as paidamt')
                      ->leftJoin('requisitionpayments','requisitionpayments.rid','=','requisitionheaders.id')
                       ->leftJoin('requisitions','requisitions.requisitionheaderid','=','requisitionheaders.id')
                       ->where('requisitionpayments.paymentstatus','PAID')
                       ->where('requisitionpayments.paymenttype','!=','WALLET')
                      ->where('requisitionheaders.employeeid',$empid)
                      ->groupBy('requisitionpayments.id')
                      ->get();
         
          $totalamt=$requisition->sum('paidamt');
        
        $entries=expenseentry::where('employeeid',$empid)
                ->where('towallet','!=','YES')
                ->get();
          $totalamtentry=$entries->sum('approvalamount');
          $wallet=wallet::where('employeeid',$empid)
                ->get();
         $walletcr=$wallet->sum('credit');
         $walletdr=$wallet->sum('debit');
         $walletbalance=$walletcr-$walletdr;

          $bal=($totalamt-$totalamtentry)-$walletbalance;

          $all=array('totalamt'=>$totalamt,'totalexpense'=>$totalamtentry,'balance'=>$bal);
           $paidamounts=requisitionpayment::where('rid',$id)->get();
          $requisitionheader=requisitionheader::select('requisitionheaders.*','u4.name as cancelledbyname','u1.name as employee','u2.name as author','u3.name as approver','projects.projectname')
                      ->leftJoin('users as u1','requisitionheaders.employeeid','=','u1.id')
                      ->leftJoin('users as u2','requisitionheaders.userid','=','u2.id')
                      ->leftJoin('users as u3','requisitionheaders.approvedby','=','u3.id')
                      ->leftJoin('users as u4','requisitionheaders.cancelledby','=','u4.id')
                      ->leftJoin('projects','requisitionheaders.projectid','=','projects.id')
                      ->where('requisitionheaders.status','CANCELLED')
                      ->where('requisitionheaders.id',$id)
                      ->first();
           
           $requisitions=requisition::select('requisitions.*','expenseheads.expenseheadname','particulars.particularname')
                       ->leftJoin('expenseheads','requisitions.expenseheadid','=','expenseheads.id')
                       ->leftJoin('particulars','requisitions.particularid','=','particulars.id')
                       ->where('requisitions.requisitionheaderid',$id)
                       ->get();
           
         
          return view('accounts.viewcanceledrequisition',compact('requisitionheader','requisitions','paidamounts','totalamt','totalamtentry','bal','walletbalance'));
     }
     public function viewpendingrequisition($id)
     {

            $rq=requisitionheader::find($id);
            $empid=$rq->employeeid;
           $requisition=requisitionheader::select('requisitions.*','requisitionheaders.employeeid','requisitionpayments.amount as paidamt')
                      ->leftJoin('requisitionpayments','requisitionpayments.rid','=','requisitionheaders.id')
                       ->leftJoin('requisitions','requisitions.requisitionheaderid','=','requisitionheaders.id')
                       ->where('requisitionpayments.paymentstatus','PAID')
                       ->where('requisitionpayments.paymenttype','!=','WALLET')
                      ->where('requisitionheaders.employeeid',$empid)
                      ->groupBy('requisitionpayments.id')
                      ->get();
         //return $requisition;
          $totalamt=$requisition->sum('paidamt');
        
        $entries=expenseentry::where('employeeid',$empid)
                ->where('towallet','!=','YES')
                ->get();
          $totalamtentry=$entries->sum('approvalamount');
          $wallet=wallet::where('employeeid',$empid)
                ->get();
         $walletcr=$wallet->sum('credit');
         $walletdr=$wallet->sum('debit');
         $walletbalance=$walletcr-$walletdr;

          $bal=($totalamt-$totalamtentry)-$walletbalance;

          $all=array('totalamt'=>$totalamt,'totalexpense'=>$totalamtentry,'balance'=>$bal);
           

         
   
          $paidamounts=requisitionpayment::where('rid',$id)->get();

          $requisitionheader=requisitionheader::select('requisitionheaders.*','u1.name as employee','u2.name as author','u3.name as approver','projects.projectname')
                      ->leftJoin('users as u1','requisitionheaders.employeeid','=','u1.id')
                      ->leftJoin('users as u2','requisitionheaders.userid','=','u2.id')
                      ->leftJoin('users as u3','requisitionheaders.approvedby','=','u3.id')
                      ->leftJoin('projects','requisitionheaders.projectid','=','projects.id')
                      ->where('requisitionheaders.status','PENDING')
                      ->where('requisitionheaders.id',$id)
                      ->first();
           
           $requisitions=requisition::select('requisitions.*','expenseheads.expenseheadname','particulars.particularname','vendors.id as vendorid','vendors.vendorname','vendors.mobile','vendors.details','vendors.bankname','vendors.acno','vendors.branchname','vendors.ifsccode','vendors.photo','vendors.vendoridproof')
                       ->leftJoin('expenseheads','requisitions.expenseheadid','=','expenseheads.id')
                      ->leftJoin('vendors','requisitions.vendorid','=','vendors.id')
                       ->leftJoin('particulars','requisitions.particularid','=','particulars.id')
                       ->where('requisitions.requisitionheaderid',$id)
                       ->get();
           
          //return $requisitions;
          return view('accounts.viewpendingrequisition',compact('requisitionheader','requisitions','paidamounts','totalamt','totalamtentry','bal','walletbalance'));
     }
     public function pendingrequisitionsmgr()
     {

         $requisitions=requisitionheader::select('requisitionheaders.*','u1.name as employee','u2.name as author','u3.name as approver','projects.projectname')
                      ->leftJoin('users as u1','requisitionheaders.employeeid','=','u1.id')
                      ->leftJoin('users as u2','requisitionheaders.userid','=','u2.id')
                      ->leftJoin('users as u3','requisitionheaders.approvedby','=','u3.id')
                      ->leftJoin('projects','requisitionheaders.projectid','=','projects.id')
                      ->where('requisitionheaders.status','PENDING MGR')
                      ->get();
                      //return $requisitions;
        return view('accounts.pendingrequisitionsmgr',compact('requisitions'));
     } 
     public function pendingrequisitions()
     {

         $requisitions=requisitionheader::select('requisitionheaders.*','u1.name as employee','u2.name as author','u3.name as approver','projects.projectname')
                      ->leftJoin('users as u1','requisitionheaders.employeeid','=','u1.id')
                      ->leftJoin('users as u2','requisitionheaders.userid','=','u2.id')
                      ->leftJoin('users as u3','requisitionheaders.approvedby','=','u3.id')
                      ->leftJoin('projects','requisitionheaders.projectid','=','projects.id')
                      ->where('requisitionheaders.status','PENDING')
                      ->get();
        return view('accounts.pendingrequisitions',compact('requisitions'));
     }
    public function updaterequisitions(Request $request,$id)
    {

        $requisitionheader=requisitionheader::find($id);
        $requisitionheader->employeeid=$request->employeeid;
        $requisitionheader->description=$request->description1;
        $requisitionheader->projectid=$request->projectid;
        $requisitionheader->totalamount=$request->totalamt;
          $requisitionheader->datefrom=$request->datefrom;
        $requisitionheader->dateto=$request->dateto;
      
        $requisitionheader->save();
        $rid=$requisitionheader->id;

        requisition::where('requisitionheaderid',$id)->delete();
        $count=count($request->expenseheadid);

        for ($i=0; $i < $count ; $i++) { 
           $requisition=new requisition();
           $requisition->expenseheadid=$request->expenseheadid[$i];
           $requisition->particularid=$request->particularid[$i];
           $requisition->description=$request->description[$i];
           $requisition->amount=$request->amount[$i];
           $requisition->payto=$request->payto[$i];
           $requisition->requisitionheaderid=$rid;
           $requisition->save();
        }

        Session::flash('msg','Requisition Updated Successfully');

        return redirect('/requisitions/viewapplicationform');

    }

    public function deleterequisitionedit($id)
    {
         $requisition=requisition::find($id)->delete();
         return back();
    }

   public function editrequisition($id)
   {
          $users=User::all();
        $expenseheads=expensehead::all();
        $particulars=particular::all();

        $projects=project::select('projects.*','clients.orgname')
                ->leftJoin('clients','projects.clientid','=','clients.id')
                ->get();

          $requisitionheader=requisitionheader::find($id);
          $requisitions=requisition::select('requisitions.*','expenseheads.expenseheadname','particulars.particularname')
                       ->leftJoin('expenseheads','requisitions.expenseheadid','=','expenseheads.id')
                       ->leftJoin('particulars','requisitions.particularid','=','particulars.id')
                       ->where('requisitions.requisitionheaderid',$id)
                       ->get();

         return view('accounts.editrequisition',compact('users','expenseheads','particulars','projects','requisitionheader','requisitions'));
   }
  public function deleterequisition(Request $request,$id)
  {
    requisitionheader::find($id)->delete();
    requisition::where('requisitionheaderid',$id)->delete();

    return back();
  }

     public function viewapplicationdetails($id){
      $rq=requisitionheader::find($id);
            $empid=$rq->employeeid;
           $requisition=requisitionheader::select('requisitions.*','requisitionheaders.employeeid','requisitionpayments.amount as paidamt')
                      ->leftJoin('requisitionpayments','requisitionpayments.rid','=','requisitionheaders.id')
                       ->leftJoin('requisitions','requisitions.requisitionheaderid','=','requisitionheaders.id')
                       ->where('requisitionpayments.paymentstatus','PAID')
                       ->where('requisitionpayments.paymenttype','!=','WALLET')
                      ->where('requisitionheaders.employeeid',$empid)
                      ->groupBy('requisitionpayments.id')
                      ->get();
         
          $totalamt=$requisition->sum('paidamt');
        
        $entries=expenseentry::where('employeeid',$empid)
                ->where('towallet','!=','YES')
                ->get();
          $totalamtentry=$entries->sum('approvalamount');
          $wallet=wallet::where('employeeid',$empid)
                ->get();
         $walletcr=$wallet->sum('credit');
         $walletdr=$wallet->sum('debit');
         $walletbalance=$walletcr-$walletdr;

          $bal=($totalamt-$totalamtentry)-$walletbalance;

          $all=array('totalamt'=>$totalamt,'totalexpense'=>$totalamtentry,'balance'=>$bal);
           $paidamounts=requisitionpayment::where('rid',$id)->get();
             $requisitionheader=requisitionheader::select('requisitionheaders.*','u1.name as employee','u2.name as author','u3.name as approver','projects.projectname')
                      ->leftJoin('users as u1','requisitionheaders.employeeid','=','u1.id')
                      ->leftJoin('users as u2','requisitionheaders.userid','=','u2.id')
                      ->leftJoin('users as u3','requisitionheaders.approvedby','=','u3.id')
                      ->leftJoin('projects','requisitionheaders.projectid','=','projects.id')
                      ->where('requisitionheaders.id',$id)
                      ->first();
           
           $requisitions=requisition::select('requisitions.*','expenseheads.expenseheadname','particulars.particularname')
                       ->leftJoin('expenseheads','requisitions.expenseheadid','=','expenseheads.id')
                       ->leftJoin('particulars','requisitions.particularid','=','particulars.id')
                       ->where('requisitions.requisitionheaderid',$id)
                       ->get();


          return view('accounts.viewapplicationdetails',compact('requisitionheader','requisitions','paidamounts','totalamt','totalamtentry','bal','walletbalance'));  
     }
    public function viewapplicationform(Request $request)
    {

        $requisitions=requisitionheader::select('requisitionheaders.*','u1.name as employee','u2.name as author','u3.name as approver','projects.projectname')
                      ->leftJoin('users as u1','requisitionheaders.employeeid','=','u1.id')
                      ->leftJoin('users as u2','requisitionheaders.userid','=','u2.id')
                      ->leftJoin('users as u3','requisitionheaders.approvedby','=','u3.id')
                      ->leftJoin('projects','requisitionheaders.projectid','=','projects.id')
                     
                      ->get();

        return view('accounts.viewapplicationform',compact('requisitions'));
    }
    public function saverequisitions(Request $request)
    {
         //return $request->all();
        
        $requisitionheader=new requisitionheader();
        $requisitionheader->employeeid=$request->employeeid;
        $requisitionheader->description=$request->description1;
        $requisitionheader->projectid=$request->projectid;
        $requisitionheader->totalamount=$request->totalamt;
        $requisitionheader->datefrom=$request->datefrom;
        $requisitionheader->dateto=$request->dateto;
       
        $requisitionheader->userid=Auth::id();
        $requisitionheader->save();
        $rid=$requisitionheader->id;
        $count=count($request->expenseheadid);

        for ($i=0; $i < $count ; $i++) { 
          
           $requisition=new requisition();
           $requisition->expenseheadid=$request->expenseheadid[$i];
           $requisition->particularid=$request->particularid[$i];
           $requisition->description=$request->description[$i];
           $requisition->payto=$request->payto[$i];
           $requisition->amount=$request->amount[$i];
           $requisition->requisitionheaderid=$rid;
           $requisition->save();
        }

        Session::flash('msg','Requisition Saved Successfully');

        return back();

    }

    public function applicationform()
    {
        $vendors=vendor::all();
        $users=User::all();
        $expenseheads=expensehead::all();
        $particulars=particular::all();

        $projects=project::select('projects.*','clients.orgname')
                ->leftJoin('clients','projects.clientid','=','clients.id')
                ->get();

        return view('accounts.applicationform',compact('users','projects','vendors','expenseheads'));
    }
    public function deletevendor(Request $request,$id)
    {
        $vendor=vendor::find($id);

        $vendor->delete();

        return back();
    }
      public function updateexpenseentry(Request $request,$id)
       {
       $expenseentry=expenseentry::find($id);
       $expenseentry->employeeid=$request->employeeid;
       $expenseentry->projectid=$request->projectid;
       $expenseentry->expenseheadid=$request->expenseheadid;
       $expenseentry->particularid=$request->particularid;
       $expenseentry->vendorid=$request->vendorid;
       $expenseentry->amount=$request->amount;
       $expenseentry->approvalamount=$request->amount;
       $expenseentry->remarks=$request->remarks;
       $expenseentry->description=$request->description;
       $expenseentry->userid=Auth::id();
        $rarefile = $request->file('uploadedfile');    
        if($rarefile!=''){
        $raupload = public_path() .'/img/expenseuploadedfile/';
        $rarefilename=time().'.'.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$rarefilename);
        $expenseentry->uploadedfile = $rarefilename;
        }
       $expenseentry->save();
       Session::flash('msg','Expense Entry Updated Successfully');

       return redirect('/expense/viewallexpenseentry');
       }

      public function editexpenseentry($id)
       {  
         $expenseentry=expenseentry::find($id);
            $projects=project::select('projects.*','clients.orgname')
                ->leftJoin('clients','projects.clientid','=','clients.id')
                ->get();
        $users=User::all();
        $expenseheads=expensehead::all();
        $particulars=particular::all();
         $vendors=vendor::all();

          return view('accounts.editexpenseentry',compact('projects','users','expenseheads','expenseentry','particulars','vendors'));
       }
      public function deleteexpenseentry(Request $request,$id)
      {
           $expenseentry=expenseentry::find($id);
           $expenseentry->delete();


           return back();
      }
     public function pendingexpenseentry()
     {
          $expenseentries=expenseentry::select('expenseentries.*','u1.name as for')
                      ->leftJoin('users as u1','expenseentries.employeeid','=','u1.id')
                       ->where('expenseentries.status','PENDING')
                      ->groupBy('expenseentries.employeeid')
                      ->get();
          

         /* $expenseentries=expenseentry::select('expenseentries.*','u1.name as for','u2.name as by','projects.projectname','clients.clientname','expenseheads.expenseheadname','particulars.particularname','vendors.vendorname','u3.name as approvedbyname')
                      ->leftJoin('users as u1','expenseentries.employeeid','=','u1.id')
                      ->leftJoin('users as u2','expenseentries.userid','=','u2.id')
                       ->leftJoin('users as u3','expenseentries.approvedby','=','u3.id')
                      ->leftJoin('projects','expenseentries.projectid','=','projects.id')
                      ->leftJoin('clients','projects.clientid','=','clients.id')
                      ->leftJoin('expenseheads','expenseentries.expenseheadid','=','expenseheads.id')
                      ->leftJoin('particulars','expenseentries.particularid','=','particulars.id')
                       ->leftJoin('vendors','expenseentries.vendorid','=','vendors.id')
                       ->where('expenseentries.status','PENDING')
                      ->groupBy('expenseentries.id')
                      ->get();*/
      return view('accounts.pendingexpenseentry',compact('expenseentries'));
     }  public function walletpaidexpenseentry()
     {
          $expenseentries=expenseentry::select('expenseentries.*','u1.name as for')
                      ->leftJoin('users as u1','expenseentries.employeeid','=','u1.id')
                       ->where('expenseentries.status','WALLET PAID')
                      ->groupBy('expenseentries.employeeid')
                      ->get();
          

          
      return view('accounts.walletpaidexpenseentry',compact('expenseentries'));
     }
  public function getaccountexpenseentrylist(Request $request)
     {

        $expenseentries=DB::table('expenseentries')->select('expenseentries.*','u1.name as for','u2.name as by','projects.projectname','clients.clientname','expenseheads.expenseheadname','particulars.particularname','vendors.vendorname','u3.name as approvedbyname')
                      ->leftJoin('users as u1','expenseentries.employeeid','=','u1.id')
                      ->leftJoin('users as u2','expenseentries.userid','=','u2.id')
                       ->leftJoin('users as u3','expenseentries.approvedby','=','u3.id')
                      ->leftJoin('projects','expenseentries.projectid','=','projects.id')
                      ->leftJoin('clients','projects.clientid','=','clients.id')
                      ->leftJoin('expenseheads','expenseentries.expenseheadid','=','expenseheads.id')
                      ->leftJoin('particulars','expenseentries.particularid','=','particulars.id')
                       ->leftJoin('vendors','expenseentries.vendorid','=','vendors.id')
                      ->groupBy('expenseentries.id');


         $sumamt=$this->moneyFormatIndia($expenseentries->sum('amount'));
              $sumapproveamt=$this->moneyFormatIndia($expenseentries->sum('approvalamount'));
          return DataTables::of($expenseentries)
               ->filter(function ($expenseentries) use ($request) {
                if ($request->has('name') && $request->get('name')!='') 
                {
                    $expenseentries->where('employeeid', $request->get('name'));
                }
                if ($request->has('expensehead') && $request->get('expensehead')!='') 
                {
                    $expenseentries->where('expenseentries.expenseheadid', $request->get('expensehead'));
                }

            })

                ->addColumn('idbtn', function($expenseentries){
                         return '<a href="/viewexpenseentrydetails/'.$expenseentries->id.'" class="btn btn-info">'.$expenseentries->id.'</a>';
                    })

                ->editColumn('projectname', function($expenseentries) {
                    if($expenseentries->projectname=='') return 'OTHERS';
                    else
                      return $expenseentries->projectname;
                  })
                 ->editColumn('amount', function($expenseentries) {
                      return $this->moneyFormatIndia($expenseentries->amount);
                  })
                  ->editColumn('approvalamount', function($expenseentries) {
                      return $this->moneyFormatIndia($expenseentries->approvalamount);
                  })
                ->addColumn('dates',function($expenseentries){
                   if($expenseentries->fromdate!='')
                      return $expenseentries->fromdate.')-('.$expenseentries->todate;

                  })
                ->addColumn('images',function($expenseentries){
                  return '<a href="'.asset('/img/expenseuploadedfile/'.$expenseentries->uploadedfile ).'" target="_blank">'.

                  '<img style="height:70px;width:95px;" alt="click to view" src="'.asset('/img/expenseuploadedfile/'.$expenseentries->uploadedfile ).'"></a>';

          
                })

                ->addColumn('sta',function($expenseentries){
                  if($expenseentries->status=='PENDING')
                    return '<span class="label label-danger">'.$expenseentries->status.'</span>';
                  else
                    return '<span class="label label-success">'.$expenseentries->status.'</span>';
                })
                ->addColumn('view', function($expenseentries){
                         return '<a href="/viewexpenseentrydetails/'.$expenseentries->id.'" class="btn btn-warning">VIEW</a>';
                    })
                 ->addColumn('delete', function($expenseentries){
                        if ($expenseentries->status=='PENDING') 
                    return view('yajra.deleteviewexpenseentry', compact('expenseentries'))->render();
                    else
                      return '<button class="btn btn-danger" type="button" disabled="">DELETE</button>';
                    })
                  ->addColumn('pro', function($expenseentries){
                         return '<p class="b" title="'.$expenseentries->projectname.'">'.$expenseentries->projectname.'</p>';
                    })
                ->rawColumns(['idbtn','sta','dates','images','view','delete','pro'])
                ->with(compact('sumamt','sumapproveamt'))
                ->make(true);
     }
     public function viewallexpenseentry()
     {
       $expenseentries=expenseentry::select('expenseentries.*','u1.name as for','u2.name as by','projects.projectname','clients.clientname','expenseheads.expenseheadname','particulars.particularname','vendors.vendorname','u3.name as approvedbyname')
                      ->leftJoin('users as u1','expenseentries.employeeid','=','u1.id')
                      ->leftJoin('users as u2','expenseentries.userid','=','u2.id')
                       ->leftJoin('users as u3','expenseentries.approvedby','=','u3.id')
                      ->leftJoin('projects','expenseentries.projectid','=','projects.id')
                      ->leftJoin('clients','projects.clientid','=','clients.id')
                      ->leftJoin('expenseheads','expenseentries.expenseheadid','=','expenseheads.id')
                      ->leftJoin('particulars','expenseentries.particularid','=','particulars.id')
                       ->leftJoin('vendors','expenseentries.vendorid','=','vendors.id')
                      ->groupBy('expenseentries.id')
                      ->get();
      $users=User::all();
      $expenseheads=expensehead::all();
      return view('accounts.viewallexpenseentry',compact('expenseentries','users','expenseheads'));
     }
     public function saveexpenseentry(Request $request)
     {
       $expenseentry=new expenseentry();
       $expenseentry->employeeid=$request->employeeid;
       $expenseentry->projectid=$request->projectid;
       $expenseentry->expenseheadid=$request->expenseheadid;
       $expenseentry->particularid=$request->particularid;
       $expenseentry->vendorid=$request->vendorid;
       $expenseentry->amount=$request->amount;
       $expenseentry->approvalamount=$request->amount;
       $expenseentry->description=$request->description;
       $expenseentry->userid=Auth::id();
        $rarefile = $request->file('uploadedfile');    
        if($rarefile!=''){
        $raupload = public_path() .'/img/expenseuploadedfile/';
        $rarefilename=time().'.'.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$rarefilename);
        $expenseentry->uploadedfile = $rarefilename;
        }
       $expenseentry->save();
       Session::flash('msg','Expense Entry Saved Successfully');

       return back();

     }
     public function expenseentry()
     {
        
      
        $users=User::all();
        $expenseheads=expensehead::all();
        $vendors=vendor::all();
        $expenseentries=expenseentry::select('expenseentries.*','u1.name as for','u2.name as by','projects.projectname','clients.clientname','expenseheads.expenseheadname','particulars.particularname','vendors.vendorname','u3.name as approvedbyname')
                      ->leftJoin('users as u1','expenseentries.employeeid','=','u1.id')
                      ->leftJoin('users as u2','expenseentries.userid','=','u2.id')
                      ->leftJoin('users as u3','expenseentries.approvedby','=','u3.id')
                      ->leftJoin('projects','expenseentries.projectid','=','projects.id')
                      ->leftJoin('clients','projects.clientid','=','clients.id')
                      ->leftJoin('expenseheads','expenseentries.expenseheadid','=','expenseheads.id')
                      ->leftJoin('particulars','expenseentries.particularid','=','particulars.id')
                      ->leftJoin('vendors','expenseentries.vendorid','=','vendors.id')
                      ->groupBy('expenseentries.id')
                      ->get();
        return view('accounts.expenseentry',compact('users','projects','expenseheads','expenseentries','vendors'));
     }
   public function updatevendor(Request $request,$id)
   {

       $vendor=vendor::find($id);
       $vendor->vendorname=$request->vendorname;
       $vendor->mobile=$request->mobile;
       $vendor->email=$request->email;
       $vendor->details=$request->details;
       $vendor->tinno=$request->tinno;
       $vendor->tanno=$request->tanno;
       $vendor->servicetaxno=$request->servicetaxno;
       $vendor->gstno=$request->gstno;
       $vendor->panno=$request->panno;
       $vendor->bankname=$request->bankname;
       $vendor->acno=$request->acno;
       $vendor->branchname=$request->branchname;
       $vendor->ifsccode=$request->ifsccode;
     
     
     
      $rarefile = $request->file('aadhaarcard');    
        if($rarefile!=''){
        $raupload = public_path() .'/img/vendordocument/aadhaarcard/';
        $rarefilename=time().'.'.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$rarefilename);
        $vendor->aadhaarcard = $rarefilename;
        }

         $rarefile1 = $request->file('pancard');    
        if($rarefile1!=''){
        $raupload1 = public_path() .'/img/vendordocument/pancard';
        $rarefilename1=time().'.'.$rarefile1->getClientOriginalName();
        $success1=$rarefile1->move($raupload1,$rarefilename1);
        $vendor->pancard = $rarefilename1;
        }
         $rarefile1 = $request->file('gstin');    
        if($rarefile1!=''){
        $raupload1 = public_path() .'/img/vendordocument/gstin';
        $rarefilename1=time().'.'.$rarefile1->getClientOriginalName();
        $success1=$rarefile1->move($raupload1,$rarefilename1);
        $vendor->gstin = $rarefilename1;
        }
        $rarefile1 = $request->file('bankpassbook');    
        if($rarefile1!=''){
        $raupload1 = public_path() .'/img/vendordocument/bankpassbook';
        $rarefilename1=time().'.'.$rarefile1->getClientOriginalName();
        $success1=$rarefile1->move($raupload1,$rarefilename1);
        $vendor->bankpassbook = $rarefilename1;
        }
        $rarefile1 = $request->file('cancelcheque');    
        if($rarefile1!=''){
        $raupload1 = public_path() .'/img/vendordocument/cancelcheque';
        $rarefilename1=time().'.'.$rarefile1->getClientOriginalName();
        $success1=$rarefile1->move($raupload1,$rarefilename1);
        $vendor->cancelcheque = $rarefilename1;
        }

        $vendor->save();
        Session::flash('msg','vendor Updated successfully');

        return redirect('/defination/managevendors');

   }

   public function editvendor($id)
   {
      $vendor=vendor::find($id);
      return view('accounts.editvendor',compact('vendor'));
   }
  public function savevendor(Request $request)
  {
     $vendor=new vendor();
     $vendor->vendorname=$request->vendorname;
     $vendor->mobile=$request->mobile;
     $vendor->email=$request->email;
     $vendor->details=$request->details;
     $vendor->tinno=$request->tinno;
     $vendor->tanno=$request->tanno;
     $vendor->servicetaxno=$request->servicetaxno;
     $vendor->gstno=$request->gstno;
     $vendor->panno=$request->panno;
     $vendor->bankname=$request->bankname;
     $vendor->acno=$request->acno;
     $vendor->branchname=$request->branchname;
     $vendor->ifsccode=$request->ifsccode;
     $vendor->userid=Auth::id();
     
     
    $rarefile = $request->file('aadhaarcard');    
        if($rarefile!=''){
        $raupload = public_path() .'/img/vendordocument/aadhaarcard/';
        $rarefilename=time().'.'.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$rarefilename);
        $vendor->aadhaarcard = $rarefilename;
        }

         $rarefile1 = $request->file('pancard');    
        if($rarefile1!=''){
        $raupload1 = public_path() .'/img/vendordocument/pancard';
        $rarefilename1=time().'.'.$rarefile1->getClientOriginalName();
        $success1=$rarefile1->move($raupload1,$rarefilename1);
        $vendor->pancard = $rarefilename1;
        }
         $rarefile1 = $request->file('gstin');    
        if($rarefile1!=''){
        $raupload1 = public_path() .'/img/vendordocument/gstin';
        $rarefilename1=time().'.'.$rarefile1->getClientOriginalName();
        $success1=$rarefile1->move($raupload1,$rarefilename1);
        $vendor->gstin = $rarefilename1;
        }
        $rarefile1 = $request->file('bankpassbook');    
        if($rarefile1!=''){
        $raupload1 = public_path() .'/img/vendordocument/bankpassbook';
        $rarefilename1=time().'.'.$rarefile1->getClientOriginalName();
        $success1=$rarefile1->move($raupload1,$rarefilename1);
        $vendor->bankpassbook = $rarefilename1;
        }
        $rarefile1 = $request->file('cancelcheque');    
        if($rarefile1!=''){
        $raupload1 = public_path() .'/img/vendordocument/cancelcheque';
        $rarefilename1=time().'.'.$rarefile1->getClientOriginalName();
        $success1=$rarefile1->move($raupload1,$rarefilename1);
        $vendor->cancelcheque = $rarefilename1;
        }

        $vendor->save();
        Session::flash('msg','vendor added successfully');
        return back();

  }
   public function vendors()
   {  
      $vendors=vendor::all();
      return view('accounts.vendors',compact('vendors'));
   }
   public function importvendor(Request $request){
    $this->validate($request, [
        'select_file'  => 'required|mimes:xls,xlsx'

       ]);
      $path = $request->file('select_file')->getRealPath();
      $data = Excel::selectSheetsByIndex(0)->load($path)->get();
      //return $data;
      $custerr=array();
        foreach($data as $kay=>$value){
        if($value['party_name']!=''){
         $vendor=new vendor();
         $vendor->vendorname=$value['party_name'];
         $vendor->mobile=$value['mob'];
         $vendor->email=$value['email'];
         $vendor->details=$value['address'];
         $vendor->tinno=$value['tin'];
         //$vendor->tanno=$value['tan'];
         //$vendor->servicetaxno=$value['servicetax'];
         $vendor->panno=$value['pan_no'];
         $vendor->gstno=$value['gstin'];
         $vendor->bankname=$value['bank_name'];
         $vendor->acno=$value['account_no'];
         $vendor->branchname=$value['branch_name'];
         $vendor->ifsccode=$value['ifsc_code'];
         $vendor->save();
         Session::flash('status', 'Upload successful!');

        }
         
        
        }
    //return $custerr;
    return back();
}
  public function deletedeductiondefination(Request $request,$id)
   {
     $deductiondefination=deductiondefination::find($id);
     $deductiondefination->delete();

       Session::flash('msg','Deductiondefination Deleted Successfully');

       return back();
   }
   public function updatedeductiondefination(Request $request)
   {
       $deductiondefination=deductiondefination::find($request->did);

       $deductiondefination->deductionname=$request->deductionname;
       $deductiondefination->deductionpercentage=$request->deductionpercentage;
       $deductiondefination->deductionpercentage=$request->deductionpercentage;
       $deductiondefination->userid=Auth::id();
       $deductiondefination->save();
       Session::flash('msg','Deductiondefination Updated Successfully');
       return back();
   }
  public function savediductiondefination(Request $request)
  {
       $deductiondefination=new deductiondefination();
       $deductiondefination->deductionname=$request->deductionname;
       $deductiondefination->deductionpercentage=$request->deductionpercentage;
       $deductiondefination->deductionpercentage=$request->deductionpercentage;
       $deductiondefination->userid=Auth::id();
       $deductiondefination->save();
       Session::flash('msg','Deductiondefination Saved Successfully');
       return back();
  }

  public function deductiondefination()
  {
      $deductiondefinations=deductiondefination::all();
      return view('accounts.deductiondefination',compact('deductiondefinations'));
  }
  public function deletebanks(Request $request,$id)
  {
       $bank=bank::find($id);
       $bank->delete();
       Session::flash('msg','Bank Details Deleted Successfully');

       return back();
  }

  public function adminaccounts()
  {
       return view('accounts.home');
  }
  public function deleteparticulars(Request $request,$id)
  {
    particular::find($id)->delete();

     Session::flash('msg','Particular Deleted Successfully');

     return back();
  }

  public function updateparticulars(Request $request)
  {
    $particular=particular::find($request->pid);
    $particular->expenseheadid=$request->expenseheadid;
      $particular->particularname=$request->particularname;
      $particular->save();
          Session::flash('msg','Particular Updated Successfully');
          return back();

  }
   public function saveparticulars(Request $request)
   {
      $particular=new particular();
      $particular->expenseheadid=$request->expenseheadid;
      $particular->particularname=$request->particularname;
      $particular->save();
          Session::flash('msg','Particular Added Successfully');
      return back();

   }

  public function particulars()
  {
    $expenseheads=expensehead::all();

    $particulars=particular::select('particulars.*','expenseheads.expenseheadname')
                 ->leftJoin('expenseheads','particulars.expenseheadid','=','expenseheads.id')
                 ->get();

    return view('accounts.particulars',compact('expenseheads','particulars'));
  }
    public function expensehead()
    {
      $expenseheads=expensehead::all();
      return view('accounts.expensehead',compact('expenseheads'));
    }

    public function saveexpensehead(Request $request)
    {
       $expensehead=new expensehead();

             $this->validate($request,[
            'expenseheadname'=>'required|string|max:255|unique:expenseheads',

       ]);
       $expensehead->expenseheadname=$request->expenseheadname;
       $expensehead->userid=Auth::id();

       $expensehead->save();
       Session::flash('msg','Expense Head Added Successfully');
       return back();
    }

    public function deleteexpensehead(Request $request,$id)
    {
      $expensehead=expensehead::find($id);
      $expensehead->delete();
      return back();
      Session::flash('Expense Head Delete Successfully');
    }

    public function updateexpensehead(Request $request)
    {
      $expensehead=expensehead::find($request->eid);
       $expensehead->expenseheadname=$request->expenseheadname;
       $expensehead->userid=Auth::id();

       $expensehead->save();
       Session::flash('msg','Expense Head Updated Successfully');

       return back();
    }

    public function managevendors()
    {

         $vendors=vendor::select('vendors.*','users.name')
         ->leftJoin('users','vendors.userid','=','users.id')
         ->get();
         //return $vendors;
         return view('accounts.managevendors',compact('vendors'));
    }
}

/*public function projectpaymenyttest()
{
  $allarray=array();
      $clients=billheader::select('clientname')->where('status','!=','REJECTED')->groupBy('clientname')->get();
       if($request->has('client') && $request->get('client')!='')
       {
           $projects=billheader::select('id','nameofthework','total','clientname')
                     ->where('nameofthework','!=','')
                     ->where('status','!=','REJECTED')
                     ->groupBy('nameofthework','clientname')
                     ->get();
            foreach ($projects as $key => $value) {

             
      
              $claimedamount=billheader::where('nameofthework',$value->nameofthework)
                 ->where('status','!=','REJECTED')
                 ->sum('claimedvalue');

              $creditedamount=crvoucherheader::where('nameofthework',$value->nameofthework)
                ->where('clientname',$value->clientname)
              ->sum('creditedamt');

              $totaldeduction=crvoucherheader::where('nameofthework',$value->nameofthework)
              ->where('clientname',$value->clientname)
              ->sum('totaldeduction');
              $totalbankcharges=crvoucherheader::where('nameofthework',$value->nameofthework)
              ->where('clientname',$value->clientname)

              ->sum('deductioncrg');

              $totalcgst=crvoucherheader::where('nameofthework',$value->nameofthework)
              ->where('clientname',$value->clientname)
              ->sum('cgstvalue');
              $totalsgst=crvoucherheader::where('nameofthework',$value->nameofthework)
              ->where('clientname',$value->clientname)
              ->sum('sgstvalue');
               $totaligst=crvoucherheader::where('nameofthework',$value->nameofthework)
               ->where('clientname',$value->clientname)
              ->sum('igstvalue');
            
         
              
              $custarr=array('clientname'=>$value->clientname,'nameofthework'=>$value->nameofthework,'workvalue'=>$value->total,'claimedamount'=>$claimedamount,'creditedamount'=> $creditedamount,'totaldeduction'=>$totaldeduction,'totalbankcharges'=>$totalbankcharges,'totalcgst'=>$totalcgst,'totalsgst'=>$totalsgst,'totaligst'=>$totaligst);

              $allarray[]=$custarr;
             
              

             
            }
            
           
       }


      
      //return $allarray;
}
*/