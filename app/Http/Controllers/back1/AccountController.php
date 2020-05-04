<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\expensehead;
use Auth;
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
use DB;
use App\debitvoucher;
use App\debitvoucherheader;
use App\debitvoucherpayment;
use App\labour;
use App\vehicle;


class AccountController extends Controller
{      

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
              $vehicles=vehicle::all();
              return view('accounts.vehicles',compact('vehicles'));
           }

           
          public function labours()
             {
                  $labours=labour::all();
                  return view('accounts.labours',compact('labours'));
             }
       public function updaterequisitionsmgrapprove(Request $request,$id)
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
           $requisition->amount=$request->amount[$i];
           $requisition->requisitionheaderid=$rid;
           $requisition->approvedamount=$request->amount[$i];
           $requisition->approvestatus="FULLY APPROVED";
           $requisition->save();
        }

        

        
         $r=requisitionheader::find($id);
         $r->status="PENDING";
         $r->save();
        return redirect('/viewrequisitions/pendingrequisitionsmgr');
       }

      public function viewpendingrequisitionmgr(Request $request,$id)
      { 

           $rq=requisitionheader::find($id);
           $empid=$rq->employeeid;
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

          $all=array('totalamt'=>$totalamt,'totalexpense'=>$totalamtentry,'balance'=>$bal);





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

         return view('accounts.viewpendingrequisitionmgr',compact('users','expenseheads','particulars','projects','requisitionheader','requisitions','totalamt','totalamtentry','bal'));
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
           $debitvoucherpayments=debitvoucherpayment::select('debitvoucherpayments.*','banks.bankname','vendors.vendorname','users.name as paidbyname')
                                ->where('paymentstatus','PAID')
                               ->leftJoin('banks','debitvoucherpayments.bankid','=','banks.id')
                               ->leftJoin('debitvoucherheaders','debitvoucherpayments.did','=','debitvoucherheaders.id')
                               ->leftJoin('vendors','debitvoucherheaders.vendorid','=','vendors.id')
                               ->leftJoin('users','debitvoucherpayments.paidby','=','users.id')
                                ->get();

          return view('accounts.paiddramount',compact('debitvoucherpayments'));       
     }

     public function pendingdrpayment()
     {
          $debitvoucherpayments=debitvoucherpayment::select('debitvoucherpayments.*','banks.bankname','vendors.vendorname')
                                ->where('paymentstatus','PENDING')
                               ->leftJoin('banks','debitvoucherpayments.bankid','=','banks.id')
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

             $bankpayments=debitvoucherpayment::select('debitvoucherpayments.*','banks.bankname')
                          ->leftJoin('banks','debitvoucherpayments.bankid','=','banks.id')
                          ->where('debitvoucherpayments.did',$id)
                          ->get();
        
             $paid=debitvoucherpayment::where('did',$id)->sum('amount');
              $bankpaid=debitvoucherpayment::where('did',$id)->where('paymentstatus','PAID')->sum('amount');
             $banks=useraccount::select('useraccounts.*','banks.bankname')
                        ->where('useraccounts.type','COMPANY')
                        ->leftJoin('banks','useraccounts.bankid','=','banks.id')
                        ->get();
          $debitvoucherheader=debitvoucherheader::select('debitvoucherheaders.*','vendors.vendorname')
                     ->leftJoin('vendors','debitvoucherheaders.vendorid','=','vendors.id')
                     ->where('debitvoucherheaders.id',$id)
                     ->first();

          $debitvouchers=debitvoucher::where('headerid',$id)->get();

        return view('accounts.viewapproveddebitvoucher',compact('debitvoucherheader','debitvouchers','banks','paid','bankpaid','bankpayments'));
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
           $debitvouchers=debitvoucherheader::select('debitvoucherheaders.*','vendors.vendorname')
                     ->leftJoin('vendors','debitvoucherheaders.vendorid','=','vendors.id')
                     ->where('debitvoucherheaders.status','=','MGR APPROVED')
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
          $debitvoucherheader=debitvoucherheader::select('debitvoucherheaders.*','vendors.vendorname')
                     ->leftJoin('vendors','debitvoucherheaders.vendorid','=','vendors.id')
                     ->where('debitvoucherheaders.id',$id)
                     ->first();

          $debitvouchers=debitvoucher::where('headerid',$id)->get();


          return view('accounts.viewpendinfdebitvouchermgr',compact('debitvoucherheader','debitvouchers'));
     }

      public function viewpendinfdebitvoucheradmin($id)
     {
          $debitvoucherheader=debitvoucherheader::select('debitvoucherheaders.*','vendors.vendorname')
                     ->leftJoin('vendors','debitvoucherheaders.vendorid','=','vendors.id')
                     ->where('debitvoucherheaders.id',$id)
                     ->first();

          $debitvouchers=debitvoucher::where('headerid',$id)->get();


          return view('accounts.viewpendinfdebitvoucheradmin',compact('debitvoucherheader','debitvouchers'));
     }

      public function approveddebitvoucher()
    {
            $debitvouchers=debitvoucherheader::select('debitvoucherheaders.*','vendors.vendorname')
                     ->leftJoin('vendors','debitvoucherheaders.vendorid','=','vendors.id')
                     ->where('debitvoucherheaders.status','=','ADMIN APPROVED')
                     ->get();
         

          return view('accounts.approveddebitvoucher',compact('debitvouchers'));
    }
     public function pendingdebitvouchermgr()
     {
             $debitvouchers=debitvoucherheader::select('debitvoucherheaders.*','vendors.vendorname')
                     ->leftJoin('vendors','debitvoucherheaders.vendorid','=','vendors.id')
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

          //return view('accounts.approvedexpenseentry',compact('expenseentry','vendor'));
     }
     public function changepartiallyapprovedexpense(Request $request)
     {
          $expenseentry=expenseentry::find($request->pid);
          $expenseentry->status="PARTIALLY APPROVED";
          $expenseentry->approvalamount=$request->amount;
          $expenseentry->remarks=$request->remarks;
          $expenseentry->approvedby=Auth::id();
          $expenseentry->save();

          return back();
     }

    public function viewalldebitvoucher()
    {

       $debitvouchers=debitvoucherheader::select('debitvoucherheaders.*','vendors.vendorname')
                     ->leftJoin('vendors','debitvoucherheaders.vendorid','=','vendors.id')
                     ->get();
        return view('accounts.viewalldebitvoucher',compact('debitvouchers'));
    }

    public function savedebitvouchers(Request $request)
    {
         
         $debitvoucherheader=new debitvoucherheader();
         $debitvoucherheader->vendorid=$request->vendorid;
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
       $vendors=vendor::all();
       $units=unit::all();
       return view('accounts.debitvoucher',compact('vendors','units'));
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


      public function cashierpaidrequsitionamt($bankname,$id)
      {
           $requisitionpayments=requisitionpayment::select('requisitionpayments.*','users.name')
             ->leftJoin('requisitionheaders','requisitionpayments.rid','=','requisitionheaders.id')
             ->leftJoin('users','requisitionheaders.employeeid','=','users.id')
            ->where('requisitionpayments.bankid',$id)
             ->where('requisitionpayments.paymentstatus','PAID')
             ->get();
           return view('accounts.cashierpaidrequsitionamt',compact('bankname','requisitionpayments'));
      }

       public function cashierviewdetailsonlinepayment($bankname,$id)
       {
            $requisitionpayments=requisitionpayment::select('requisitionpayments.*','users.name','users.id as uid')
             ->leftJoin('requisitionheaders','requisitionpayments.rid','=','requisitionheaders.id')
             ->leftJoin('users','requisitionheaders.employeeid','=','users.id')
             ->where('requisitionpayments.id',$id)
             ->first();
             $uid=$requisitionpayments->uid;
             $rid=$requisitionpayments->rid;



           $userbankaccount=useraccount::select('useraccounts.*','banks.bankname','users.name')
           ->leftJoin('banks','useraccounts.bankid','=','banks.id')
           ->leftJoin('users','useraccounts.user','=','users.id')
           ->where('useraccounts.user',$uid)
           ->first();

            return view('accounts.cashierviewdetailsonlinepayment',compact('requisitionpayments','userbankaccount','bankname'));
       }
       public function viewpaidrequisitioncash()
       {
             $requisitionpayments=requisitionpayment::select('requisitionpayments.*','users.name')
             ->leftJoin('requisitionheaders','requisitionpayments.rid','=','requisitionheaders.id')
             ->leftJoin('users','requisitionheaders.employeeid','=','users.id')

             ->where('requisitionpayments.paymenttype','CASH')
             ->where('requisitionpayments.paymentstatus','PAID')
             ->get();
           return view('accounts.viewpaidrequisitioncash',compact('requisitionpayments'));
       }

       public function cashierpaidrequsitioncash(Request $request,$id)
       {
          $requisitionpayment=requisitionpayment::find($id);
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

             ->where('requisitionpayments.paymenttype','CASH')
             ->where('requisitionpayments.paymentstatus','PENDING')
             ->paginate(15);
          return view('accounts.requisitioncashrequest',compact('requisitionpayments'));
      }
    public function cashierpaidrequsitiononline(Request $request,$bankname,$id)
    {
        $requisitionpayment=requisitionpayment::find($request->pid);
        $requisitionpayment->paymentstatus="PAID";
        $requisitionpayment->transactionid=$request->transactionid;
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




        return redirect('/prb/'.$bankname.'/'.$id);
    }
     public function viewallbankrequisitionpayment($bankname,$id)
     {
           

             $requisitionpayments=requisitionpayment::select('requisitionpayments.*','users.name')
             ->leftJoin('requisitionheaders','requisitionpayments.rid','=','requisitionheaders.id')
             ->leftJoin('users','requisitionheaders.employeeid','=','users.id')
            ->where('requisitionpayments.bankid',$id)
             ->where('requisitionpayments.paymentstatus','PENDING')
             ->get();

            return view('accounts.viewallbankrequisitionpayment',compact('bankname','requisitionpayments'));
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
          $vendor=vendor::select('vendors.*','users.name')
            ->leftJoin('users','vendors.userid','=','users.id')
            ->where('vendors.id',$expenseentry->vendorid)
            ->first();

          return view('accounts.viewpendingexpenseentrydetails',compact('expenseentry','vendor'));
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
          $vendor=vendor::select('vendors.*','users.name')
            ->leftJoin('users','vendors.userid','=','users.id')
            ->where('vendors.id',$expenseentry->vendorid)
            ->first();

          return view('accounts.viewexpenseentrydetails',compact('expenseentry','vendor'));
      }
      public function updatecompanybankaccount(Request $request)
      {

        $useraccount=useraccount::find($request->uid);

        $useraccount->bankid=$request->bankid;
        $useraccount->acno=$request->acno;
        $useraccount->ifsccode=$request->ifsccode;
        $useraccount->branchname=$request->branchname;
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
        $useraccount->ifsccode=$request->ifsccode;
        $useraccount->branchname=$request->branchname;
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
          $requisitionpayment=new requisitionpayment();
          $requisitionpayment->amount=$request->amount;
          $requisitionpayment->rid=$id;
          $requisitionpayment->bankid=$request->bankid;
          $requisitionpayment->paymenttype=$request->paymenttype;
          $requisitionpayment->remarks=$request->remarks;
       
           $requisitionpayment->save();
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

     
     public function viewapprovedrequisition($id)
     {

          $rq=requisitionheader::find($id);
            $empid=$rq->employeeid;
           $requisition=requisitionheader::select('requisitions.*','requisitionpayments.amount as paidamt')
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

          
          $bal1=$totalamt-$totalamtentry;
           
          
         

        
                 $banks=useraccount::select('useraccounts.*','banks.bankname')
                        ->where('useraccounts.type','COMPANY')
                        ->leftJoin('banks','useraccounts.bankid','=','banks.id')
                        ->get();
                 $paidamounts=requisitionpayment::where('rid',$id)->get();

                   $requisitionheader=requisitionheader::select('requisitionheaders.*','u1.name as employee','u2.name as author','u3.name as approver','projects.projectname')
                      ->leftJoin('users as u1','requisitionheaders.employeeid','=','u1.id')
                      ->leftJoin('users as u2','requisitionheaders.userid','=','u2.id')
                      ->leftJoin('users as u3','requisitionheaders.approvedby','=','u3.id')
                      ->leftJoin('projects','requisitionheaders.projectid','=','projects.id')
                      ->where('requisitionheaders.status','APPROVED')
                      ->where('requisitionheaders.id',$id)
                      ->first();
           
           $requisitions=requisition::select('requisitions.*','expenseheads.expenseheadname','particulars.particularname')
                       ->leftJoin('expenseheads','requisitions.expenseheadid','=','expenseheads.id')
                       ->leftJoin('particulars','requisitions.particularid','=','particulars.id')
                       ->where('requisitions.requisitionheaderid',$id)
                       ->get();

      
          return view('accounts.viewapprovedrequisition',compact('paidamounts','requisitionheader','requisitions','banks','totalamt','totalamtentry','bal1'));        
     } 
      public function viewcompletedrequisition($id)
      {
            $paidamounts=requisitionpayment::where('rid',$id)->get();
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


          return view('accounts.viewcompletedrequisition',compact('requisitionheader','requisitions','paidamounts'));        
           
      }
     public function viewcanceledrequisition($id)
     {
           $paidamounts=requisitionpayment::where('rid',$id)->get();
          $requisitionheader=requisitionheader::select('requisitionheaders.*','u1.name as employee','u2.name as author','u3.name as approver','projects.projectname')
                      ->leftJoin('users as u1','requisitionheaders.employeeid','=','u1.id')
                      ->leftJoin('users as u2','requisitionheaders.userid','=','u2.id')
                      ->leftJoin('users as u3','requisitionheaders.approvedby','=','u3.id')
                      ->leftJoin('projects','requisitionheaders.projectid','=','projects.id')
                      ->where('requisitionheaders.status','CANCELLED')
                      ->where('requisitionheaders.id',$id)
                      ->first();
           
           $requisitions=requisition::select('requisitions.*','expenseheads.expenseheadname','particulars.particularname')
                       ->leftJoin('expenseheads','requisitions.expenseheadid','=','expenseheads.id')
                       ->leftJoin('particulars','requisitions.particularid','=','particulars.id')
                       ->where('requisitions.requisitionheaderid',$id)
                       ->get();
           
         
          return view('accounts.viewcanceledrequisition',compact('requisitionheader','requisitions','paidamounts'));
     }
     public function viewpendingrequisition($id)
     {

            $rq=requisitionheader::find($id);
            $empid=$rq->employeeid;
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
           
           $requisitions=requisition::select('requisitions.*','expenseheads.expenseheadname','particulars.particularname')
                       ->leftJoin('expenseheads','requisitions.expenseheadid','=','expenseheads.id')
                       ->leftJoin('particulars','requisitions.particularid','=','particulars.id')
                       ->where('requisitions.requisitionheaderid',$id)
                       ->get();
           
          
          return view('accounts.viewpendingrequisition',compact('requisitionheader','requisitions','paidamounts','totalamt','totalamtentry','bal'));
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

     public function viewapplicationdetails($id)
     {
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


          return view('accounts.viewapplicationdetails',compact('requisitionheader','requisitions','paidamounts'));  
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
         // return $request->all();
        
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
          $expenseentries=expenseentry::select('expenseentries.*','u1.name as for','u2.name as by','projects.projectname','clients.clientname','expenseheads.expenseheadname','particulars.particularname','vendors.vendorname','u3.name as approvedbyname')
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
                      ->get();
      return view('accounts.pendingexpenseentry',compact('expenseentries'));
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
      return view('accounts.viewallexpenseentry',compact('expenseentries'));
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
     $vendor->details=$request->details;
      $vendor->bankname=$request->bankname;
      $vendor->acno=$request->acno;
     $vendor->branchname=$request->branchname;
     $vendor->ifsccode=$request->ifsccode;
     $vendor->userid=Auth::id();
     
     
      $rarefile = $request->file('vendoridproof');    
        if($rarefile!=''){
        $raupload = public_path() .'/img/vendor/';
        $rarefilename=time().'.'.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$rarefilename);
        $vendor->vendoridproof = $rarefilename;
        }

         $rarefile1 = $request->file('photo');    
        if($rarefile1!=''){
        $raupload1 = public_path() .'/img/vendor/';
        $rarefilename1=time().'.'.$rarefile1->getClientOriginalName();
        $success1=$rarefile1->move($raupload1,$rarefilename1);
        $vendor->photo = $rarefilename1;
        }

        $vendor->save();
        Session::flash('msg','vendor added successfully');

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
     $vendor->details=$request->details;
     $vendor->bankname=$request->bankname;
     $vendor->acno=$request->acno;
     $vendor->branchname=$request->branchname;
     $vendor->ifsccode=$request->ifsccode;
     $vendor->userid=Auth::id();
     
     
      $rarefile = $request->file('vendoridproof');    
        if($rarefile!=''){
        $raupload = public_path() .'/img/vendor/';
        $rarefilename=time().'.'.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$rarefilename);
        $vendor->vendoridproof = $rarefilename;
        }

         $rarefile1 = $request->file('photo');    
        if($rarefile1!=''){
        $raupload1 = public_path() .'/img/vendor/';
        $rarefilename1=time().'.'.$rarefile1->getClientOriginalName();
        $success1=$rarefile1->move($raupload1,$rarefilename1);
        $vendor->photo = $rarefilename1;
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
  public function banks()
  {
     $banks=bank::all();
     return view('accounts.banks',compact('banks'));
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
         return view('accounts.managevendors',compact('vendors'));
    }
}
