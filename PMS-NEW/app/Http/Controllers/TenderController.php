<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tender;
use Session;
use App\User;
use App\assignedtenderuser;
use Auth;
use App\tenderdocument;
use App\corrigendumfile;
use App\Associatepartner;
use DataTables;
use App\tendercommitteecomment;
use DB;



class TenderController extends Controller
{ 
public function ajaxfetchtendercomment(Request $request)
{

     $user=User::find($request->user);
    
     $comment=tendercommitteecomment::where('tenderid',$request->tenderid)
               ->where('userid',$request->user)
               ->first();
     return response()->json(compact('user','comment'));
}

public function associatepartner()
{
    $associatepartners=Associatepartner::get();
    return view('tender.associatespartner',compact('associatepartners'));
}
public function updateassociatepartner(Request $request)
            {
               $updateassociate =Associatepartner::find($request->apid);
               $updateassociate->associatepartnername=$request->associatepartnername;
               $updateassociate->officeaddress=$request->officeaddress;
               $updateassociate->contact1=$request->contact1;
               $updateassociate->contact2=$request->contact2;
               $updateassociate->officecontact=$request->officecontact;
               $updateassociate->email=$request->email;
               $updateassociate->gstn=$request->gstn;
               $updateassociate->panno=$request->panno;
               $updateassociate->city=$request->city;
               $updateassociate->dist=$request->dist;
               $updateassociate->state=$request->state;
               $updateassociate->country=$request->country;
               $updateassociate->additionalinfo=$request->additionalinfo;
               $updateassociate->save();
                Session::flash('message','Associatepartner Updated Successfully');
                return back();
            }
public function saveassociatepartner(Request $request)
{
     $associatepartner=new Associatepartner();
     $associatepartner->associatepartnername=$request->associatepartnername;
     $associatepartner->officeaddress=$request->officeaddress;
     $associatepartner->contact1=$request->contact1;
     $associatepartner->contact2=$request->contact2;
     $associatepartner->officecontact=$request->officecontact;
     $associatepartner->email=$request->email;
     $associatepartner->gstn=$request->gstn;
     $associatepartner->panno=$request->panno;
     $associatepartner->city=$request->city;
     $associatepartner->dist=$request->dist;
     $associatepartner->state=$request->state;
     $associatepartner->country=$request->country;
     $associatepartner->additionalinfo=$request->additionalinfo;
     $associatepartner->save();
     Session::flash('message','Save successfully');
     return back();
  
}
public function changepriorityadmin(Request $request,$id)
{
    $tender=Tender::find($id);
    $tender->tenderpriority=$request->tenderpriority;
    $tender->save();

    return back();
}
public function changerecomendtender(Request $request,$id)
{
    $tender=Tender::find($id);
    $tender->recomended=$request->recomended;
    $tender->associatepartner=$request->associatepartner;
    $tender->save();

    return back();
}

public function viewnotappliedtender($id)
{

   $users=assignedtenderuser::select('assignedtenderusers.*','users.name')
                  ->where('tenderid',$id)
                  ->leftJoin('users','assignedtenderusers.userid','=','users.id')
                  ->get();
    $tender=Tender::find($id);
    $tenderdocuments=tenderdocument::where('tenderid',$id)->get();
    $corrigendumfiles=corrigendumfile::where('tenderid',$id)->get();

    return view('tender.viewnotappliedtender',compact('tender','tenderdocuments','corrigendumfiles','users'));
}

public function approvedbutnotappliedtenders()
{
       $tenders=DB::table('tenders')
              ->select('tenders.*','users.name')
              ->leftJoin('users','tenders.author','=','users.id')
              ->where('status','NOT APPLIED')
              ->get();
   return view('tender.approvedbutnotappliedtenders',compact('tenders'));
}

public function viewappliedtenders($id)
{
    $tender=Tender::find($id);
    $users=assignedtenderuser::select('assignedtenderusers.*','users.name')
                  ->where('tenderid',$id)
                  ->leftJoin('users','assignedtenderusers.userid','=','users.id')
                  ->get();
    $tenderdocuments=tenderdocument::where('tenderid',$id)->get();
    $corrigendumfiles=corrigendumfile::where('tenderid',$id)->get();

    return view('tender.viewappliedtenders',compact('tender','tenderdocuments','corrigendumfiles','users'));
} 
public function appliedtenders()
{
    $tenders=DB::table('tenders')
          ->select('tenders.*','users.name')
          ->leftJoin('users','tenders.author','=','users.id')
          ->where('status','APPLIED')
          ->get();
   return view('tender.appliedtenders',compact('tenders'));
}

public function ajaxchangetenderstatus(Request $request)
{
    $tender=Tender::find($request->id);
    $tender->status=$request->status;
    $tender->notappliednotes=$request->description;
    $tender->save();

    return response()->json($tender);
}

public function viewalltenders()
{
              $tenders=tender::all();
              return view('tender.viewalltenders',compact('tenders'));
}


  public function viewadminapprovedtender($id)
  {
        $tender=tender::find($id);
        $users=assignedtenderuser::select('assignedtenderusers.*','users.name')
                  ->where('tenderid',$id)
                  ->leftJoin('users','assignedtenderusers.userid','=','users.id')
                  ->get();
        $tenderdocuments=tenderdocument::where('tenderid',$id)->get();
        $corrigendumfiles=corrigendumfile::where('tenderid',$id)->get();
          return view('tender.viewadminapprovedtender',compact('tender','tenderdocuments','corrigendumfiles','users'));
  }


   public function adminapprovedtenders()
   {
         $tenders=DB::table('tenders')
                ->select('tenders.*','users.name')
                ->leftJoin('users','tenders.author','=','users.id')
                ->where('status','ADMIN APPROVED')
                ->get();
         //return $tenders;

         return view('tender.alladminapprovedtenders',compact('tenders'));
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
    $newDate = date("d-m-Y H:m:t", strtotime($originalDate));
    return $newDate;
   }


    public function approvetenderbyadmin(Request $request)
    {
        $tender=tender::find($request->taid);
        $tender->status='ADMIN APPROVED';
        $tender->notes=$request->notes;
        $tender->save();

        return redirect('/ata/admintenderapproval');
    } 
       public function rejecttenderbyadmin(Request $request)
    {
        $tender=tender::find($request->trid);
        $tender->status='ADMIN REJECTED';
        $tender->rejectnotes=$request->rejectnotes;
        $tender->save();

        return redirect('/ata/admintenderapproval');
    }

    public function viewtenderadminforapproval($id)
    {
       $users=assignedtenderuser::select('assignedtenderusers.*','users.name')
                  ->where('tenderid',$id)
                  ->leftJoin('users','assignedtenderusers.userid','=','users.id')
                  ->get();
       $tender=tender::find($id);
          $tenderdocuments=tenderdocument::where('tenderid',$id)->get();
           $corrigendumfiles=corrigendumfile::where('tenderid',$id)->get();
          return view('tender.viewtenderadminforapproval',compact('tender','tenderdocuments','corrigendumfiles','users'));
    }
    public function admintenderapproval()
    {
          $tenders=DB::table('tenders')
                 ->select('tenders.*','users.name')
                 ->leftJoin('users','tenders.author','=','users.id')
                 ->where('status','COMMITEE APPROVED')
                 ->where('lastdateofsubmisssion', '>=',date('Y-m-d'))
                 ->get();
          
         return view('tender.admintenderapproval',compact('tenders'));
    }

    public function approvetenderbycommitee(Request $request,$id)
    {
          $tender=tender::find($id);
           $tender->sitevisitrequired=$request->sitevisitrequired;
           $tender->sitevisitdescription=$request->sitevisitdescription;
           $tender->workablesite=$request->workablesite;
           $tender->safetyconcern=$request->safetyconcern;
           $tender->thirdpartyapprovaldetails=$request->thirdpartyapprovaldetails;
           $tender->thirdpartyapproval=$request->thirdpartyapproval;
           $tender->paymentsystem=$request->paymentsystem;
           $tender->inhousecapacity=$request->inhousecapacity;
           $tender->thirdpartyinvolvement=$request->thirdpartyinvolvement;
           $tender->areaaffectedbyextremist=$request->areaaffectedbyextremist;
           $tender->keypositionbemanaged=$request->keypositionbemanaged;
           $tender->projectdurationsufficient=$request->projectdurationsufficient;
           $tender->localofficesetup=$request->localofficesetup;
          
           $tender->paymentscheduleclear=$request->paymentscheduleclear;
           $tender->paymentscheduleambiguty=$request->paymentscheduleambiguty;
           $tender->penalityclause=$request->penalityclause;
           $tender->penalityclauseambiguty=$request->penalityclauseambiguty;
           $tender->wehaveexpertise=$request->wehaveexpertise;
           $tender->wehaveexpertisedescription=$request->wehaveexpertisedescription;
           $tender->contractualambiguty=$request->contractualambiguty;
           $tender->contractualambigutydescription=$request->contractualambigutydescription;
           $tender->extensivefieldinvestigation=$request->extensivefieldinvestigation;
           $tender->extensivefieldinvestigationdescription=$request->extensivefieldinvestigationdescription;
           $tender->requiredexperienceoffirm=$request->requiredexperienceoffirm;
           $tender->requiredexperienceoffirmdescription=$request->requiredexperienceoffirmdescription;
           $tender->anyotherrequirement=$request->anyotherrequirement;
           $tender->ratetobequoted=$request->ratetobequoted;
           $tender->paymentsystemdetails=$request->paymentsystemdetails;
           $tender->status='COMMITEE APPROVED';
           $tender->save();

           return redirect('/tendercom/pendingtenderapproval');
    }
    public function deletecorrigendumfile($id)
    {
          $corrigendumfile=corrigendumfile::find($id)->delete();

          return back();
    }
    public function deletetenderdocument(Request $request,$id)
    {
         $tenderdocument=tenderdocument::find($id)->delete();
         return back();
    }
    public function viewapprovedcommiteetender($id)
    {
          $tender=tender::find($id);
          $tenderdocuments=tenderdocument::where('tenderid',$id)->get();
           $corrigendumfiles=corrigendumfile::where('tenderid',$id)->get();
          return view('tender.viewapprovedcommiteetender',compact('tender','tenderdocuments','corrigendumfiles'));
    }


     public function approvedcommiteetender()
     {

         $tenders=DB::table('tenders')->where('status','COMMITEE APPROVED')
                  ->select('tenders.*','users.name')
                  ->leftJoin('users','tenders.author','=','users.id')
                  ->get();

         return view('tender.approvedcommiteetender',compact('tenders'));
     }


      public function viewtendertendercomiteeapproval($id)
      {
          $tender=tender::find($id);
            $tenderdocuments=tenderdocument::where('tenderid',$id)->get();
           $corrigendumfiles=corrigendumfile::where('tenderid',$id)->get();
           $users=assignedtenderuser::select('assignedtenderusers.*','users.name')
                  ->where('tenderid',$id)
                  ->leftJoin('users','assignedtenderusers.userid','=','users.id')
                  ->get();
          
           return view('tender.viewtendertendercomiteeapproval',compact('tender','tenderdocuments','corrigendumfiles','users'));
      }


      public function pendingtenderapproval()
      {
           $tenders=DB::table('tenders')->where('status','PENDING COMMITEE APPROVAL')
                  ->select('tenders.*','users.name')
                  ->leftJoin('users','tenders.author','=','users.id')
                  ->get();
           return view('tender.pendingtenderapproval',compact('tenders'));
      }


       public function fillformtendercommitee(Request $request,$id)
       {
           
           $tender=tender::find($id);
           $tender->sitevisitrequired=$request->sitevisitrequired;
           $tender->sitevisitdescription=$request->sitevisitdescription;
           $tender->workablesite=$request->workablesite;
           $tender->safetyconcern=$request->safetyconcern;
           $tender->thirdpartyapprovaldetails=$request->thirdpartyapprovaldetails;
           $tender->thirdpartyapproval=$request->thirdpartyapproval;
           $tender->paymentsystem=$request->paymentsystem;
           $tender->inhousecapacity=$request->inhousecapacity;
           $tender->thirdpartyinvolvement=$request->thirdpartyinvolvement;
           $tender->areaaffectedbyextremist=$request->areaaffectedbyextremist;
           $tender->keypositionbemanaged=$request->keypositionbemanaged;
           $tender->projectdurationsufficient=$request->projectdurationsufficient;
           $tender->localofficesetup=$request->localofficesetup;
           $tender->paymentscheduleclear=$request->paymentscheduleclear;
           $tender->paymentscheduleambiguty=$request->paymentscheduleambiguty;
           $tender->penalityclause=$request->penalityclause;
           $tender->penalityclauseambiguty=$request->penalityclauseambiguty;
           $tender->wehaveexpertise=$request->wehaveexpertise;
           $tender->wehaveexpertisedescription=$request->wehaveexpertisedescription;
           $tender->contractualambiguty=$request->contractualambiguty;
           $tender->contractualambigutydescription=$request->contractualambigutydescription;
           $tender->extensivefieldinvestigation=$request->extensivefieldinvestigation;
           $tender->extensivefieldinvestigationdescription=$request->extensivefieldinvestigationdescription;
           $tender->requiredexperienceoffirm=$request->requiredexperienceoffirm;
           $tender->requiredexperienceoffirmdescription=$request->requiredexperienceoffirmdescription;
           $tender->anyotherrequirement=$request->anyotherrequirement;
           $tender->ratetobequoted=$request->ratetobequoted;
           $tender->paymentsystemdetails=$request->paymentsystemdetails;
           $tender->status='COMMITEE APPROVED';
           $tender->save();

           return back();


       }public function fillformuser(Request $request,$id)
       {

           //return $request->all();

           $chk=tendercommitteecomment::where('userid',Auth::id())
                ->where('tenderid',$id)
                ->get();
          if (count($chk)>0) {
            return back();
            
          }
           
           $tendercommitteecomment=new tendercommitteecomment();
           $tendercommitteecomment->sitevisitrequired=$request->sitevisitrequired;
           $tendercommitteecomment->tenderid=$id;
           $tendercommitteecomment->userid=Auth::id();
           $tendercommitteecomment->sitevisitdescription=$request->sitevisitdescription;
           $tendercommitteecomment->workablesite=$request->workablesite;
           $tendercommitteecomment->safetyconcern=$request->safetyconcern;
           $tendercommitteecomment->thirdpartyapprovaldetails=$request->thirdpartyapprovaldetails;
           $tendercommitteecomment->thirdpartyapproval=$request->thirdpartyapproval;
           $tendercommitteecomment->paymentsystem=$request->paymentsystem;
           $tendercommitteecomment->inhousecapacity=$request->inhousecapacity;
           $tendercommitteecomment->thirdpartyinvolvement=$request->thirdpartyinvolvement;
           $tendercommitteecomment->areaaffectedbyextremist=$request->areaaffectedbyextremist;
           $tendercommitteecomment->keypositionbemanaged=$request->keypositionbemanaged;
           $tendercommitteecomment->projectdurationsufficient=$request->projectdurationsufficient;
           $tendercommitteecomment->localofficesetup=$request->localofficesetup;
           $tendercommitteecomment->paymentscheduleclear=$request->paymentscheduleclear;
           $tendercommitteecomment->paymentscheduleambiguty=$request->paymentscheduleambiguty;
           $tendercommitteecomment->penalityclause=$request->penalityclause;
           $tendercommitteecomment->penalityclauseambiguty=$request->penalityclauseambiguty;
           $tendercommitteecomment->wehaveexpertise=$request->wehaveexpertise;
           $tendercommitteecomment->wehaveexpertisedescription=$request->wehaveexpertisedescription;
           $tendercommitteecomment->contractualambiguty=$request->contractualambiguty;
           $tendercommitteecomment->contractualambigutydescription=$request->contractualambigutydescription;
           $tendercommitteecomment->extensivefieldinvestigation=$request->extensivefieldinvestigation;
           $tendercommitteecomment->extensivefieldinvestigationdescription=$request->extensivefieldinvestigationdescription;
           $tendercommitteecomment->requiredexperienceoffirm=$request->requiredexperienceoffirm;
           $tendercommitteecomment->requiredexperienceoffirmdescription=$request->requiredexperienceoffirmdescription;
           $tendercommitteecomment->anyotherrequirement=$request->anyotherrequirement;
           $tendercommitteecomment->ratetobequoted=$request->ratetobequoted;
            $tendercommitteecomment->paymentsystemdetails=$request->paymentsystemdetails;
           
           $tendercommitteecomment->save();

           $assignedtenderuser=assignedtenderuser::where('tenderid',$id)
                              ->where('userid',Auth::id())
                              ->first();
            $assignedtenderuser->status='COMPLETED';
            $assignedtenderuser->save();

            $tender=tender::find($id);
            $tender->status='PENDING COMMITEE APPROVAL';
            $tender->save();

           return redirect('/mytenders/assignedtenders');


       }

       public function viewtenderuser($id)
       {
           $tender=tender::find($id);
           $tenderdocuments=tenderdocument::where('tenderid',$id)->get();
           $corrigendumfiles=corrigendumfile::where('tenderid',$id)->get();

           return view('viewtenderuser',compact('tender','tenderdocuments','corrigendumfiles'));
       }

       public function assignedtenders()
       {
            $mytenders=assignedtenderuser::select('tenderid')
                        ->where('userid',Auth::id())
                        ->where('status','PENDING')
                        ->get();


            $tenders=tender::whereIn('id',$mytenders)->get();

            return view('myassignedtender',compact('tenders'));
       }

       public function deleteuserfromtender($uid,$tid)
       {
             $assignedtenderuser=assignedtenderuser::where('userid',$uid)->where('tenderid',$tid)->delete();

             return back();
       }

       public function assignedusertotender(Request $request,$id)
       {

             $chk=assignedtenderuser::where('tenderid',$id)
                  ->where('userid',$request->user)
                  ->get();
              if (count($chk)>0) {
                return back();
                
              }
             $assignedtenderuser=new assignedtenderuser();
             $assignedtenderuser->tenderid=$id;
             $assignedtenderuser->userid=$request->user;
             $assignedtenderuser->save();

             $tender=tender::find($id);
             $tender->status='ASSIGNED TO USER';
             $tender->save();

             return back();
       }

       public function tendernotelligible(Request $request)
       {
           $tender=tender::find($request->tid);
           $tender->status='NOT ELLIGIBLE';
           $tender->notelligiblereason=$request->notelligiblereason;
           $tender->save();

            return redirect('/tm/tenderlist');
       }

        public function tenderelligible(Request $request,$id)
        {
            $tender=tender::find($id);
            $tender->status='ELLIGIBLE';
            $tender->save();

            return redirect('/tm/tenderlist');
        }
        public function viewtendertendercomitee($id)
        {
            $tenderdocuments=tenderdocument::where('tenderid',$id)->get();
           $corrigendumfiles=corrigendumfile::where('tenderid',$id)->get();
           $tender=tender::find($id);
            $users=User::all();
            $assignedusers=assignedtenderuser::select('users.*','assignedtenderusers.tenderid')
                            ->where('tenderid',$id)
                           ->leftJoin('users','assignedtenderusers.userid','=','users.id')
                          ->get();

           return view('tender.viewtendertendercomitee',compact('tender','users','assignedusers','tenderdocuments','corrigendumfiles'));
        }

        public function tenderlistforcommitee()
        {
          $tenders=DB::table('tenders')->where('status','ELLIGIBLE')
          ->select('tenders.*','users.name')
          ->leftJoin('users','tenders.author','=','users.id')
          ->where('lastdateofsubmisssion', '>=',date('Y-m-d'))
          ->get();
        
          return view('tender.tenderlistforcommitee',compact('tenders'));

        }
       public function updatetender(Request $request,$id){


                $tender=tender::find($id);
                $tender->nameofthework=$request->nameofthework;
                $tender->clientname=$request->clientname;
                $tender->recomended=$request->recomended;
                $tender->workvalue=$request->workvalue;
                $tender->nitpublicationdate=$request->nitpublicationdate;
                $tender->source=$request->source;
                $tender->tenderpriority=$request->tenderpriority;
                $tender->typeofwork=$request->typeofwork;
                $tender->lastdateofsubmisssion=$request->lastdateofsubmisssion;
                $tender->rfpavailabledate=$request->rfpavailabledate;
              
                $tender->refpageofrfp=$request->refpageofrfp;
                
                $tender->emdamount=$request->emdamount;
                $tender->amountinword=$request->amountinword;
                $tender->emdinformof=$request->emdinformof;
                $tender->tenderamount=$request->tenderamount;
                $tender->tenderamountinword=$request->tenderamountinword;
                $tender->tendercostinformof=$request->tendercostinformof;
                $tender->tenderrefno=$request->tenderrefno;
                $tender->noofcovers=$request->noofcovers;
                $tender->salestartdate=$request->salestartdate;
                $tender->saleenddate=$request->saleenddate;
                $tender->bidstartdate=$request->bidstartdate;
                $tender->bidenddate=$request->bidenddate;
                $tender->prebidmeetingdate=$request->prebidmeetingdate;
                $tender->emdpayableto=$request->emdpayableto;
                $tender->tenderfeepayableto=$request->tenderfeepayableto;
                $tender->tendervalidityindays=$request->tendervalidityindays;
                $tender->tendervaliditydate=$request->tendervaliditydate;
                    $tender->registrationamount=$request->registrationamount;
                $tender->registrationamountinword=$request->registrationamountinword;
                $tender->registrationamountinformof=$request->registrationamountinformof;
                $tender->registrationamountpayableto=$request->registrationamountpayableto;

                $tender->save();
                $tid=$tender->id;
              
                 /*   $rarefile = $request->file('rfpdocument');    
                      if($rarefile!=''){
                      $raupload = public_path() .'/img/tender/';
                      $rarefilename=time().'.'.$rarefile->getClientOriginalName();
                      $success=$rarefile->move($raupload,$rarefilename);
                      $tender->rfpdocument = $rarefilename;
                      }*/
               
                      $rfpdocuments=$request['rfpdocument'];

                      if ($rfpdocuments) {
                          foreach($rfpdocuments as $rfp)
                          {
                        
                          if($rfp!='')
                            {
                                $tenderdocument = new tenderdocument();
                                $raupload = public_path() .'/img/tender/';
                                $rarefilename=time().'.'.$rfp->getClientOriginalName();
                                $success=$rfp->move($raupload,$rarefilename);
                                $tenderdocument->file  = $rarefilename;
                                $tenderdocument->tenderid=$tid;
                                $tenderdocument->save();
                             } 
                               
                               
                            }
                      }
                    
                 
            /*        $rarefile1 = $request->file('corrigendumfile');    
                      if($rarefile1!=''){
                      $raupload1 = public_path() .'/img/tender/';
                      $rarefilename1=time().'.'.$rarefile1->getClientOriginalName();
                      $success1=$rarefile1->move($raupload1,$rarefilename1);
                      $tender->corrigendumfile = $rarefilename1;
                      }*/


                       $corrigendumfiles=$request['corrigendumfile'];

                       if ($corrigendumfiles) {
                         foreach($corrigendumfiles as $cor)
                          {
                        
                          if($cor!='')
                            {
                                $corrigendumfile = new corrigendumfile();
                                $raupload = public_path() .'/img/tender/';
                                $rarefilename=time().'.'.$cor->getClientOriginalName();
                                $success=$cor->move($raupload,$rarefilename);
                                $corrigendumfile->file  = $rarefilename;
                                $corrigendumfile->tenderid=$tid;
                                $corrigendumfile->save();
                             } 
                               
                               
                            }
                       }
                       
                 
                 Session::flash('msg','Tender Updated Successfully');
               return redirect()->route('tenderlist');



       }
       public function edittender($id)
       {
           $tender=tender::find($id);
           $tenderdocuments=tenderdocument::where('tenderid',$id)->get();
           $corrigendumfiles=corrigendumfile::where('tenderid',$id)->get();
           return view('tender.edittender',compact('tender','tenderdocuments','corrigendumfiles'));
       }

       public function viewtender($id)
       {
           $tender=tender::find($id);
            $tenderdocuments=tenderdocument::where('tenderid',$id)->get();
           $corrigendumfiles=corrigendumfile::where('tenderid',$id)->get();
           $associatepartners=Associatepartner::get();
           return view('tender.viewtender',compact('tender','tenderdocuments','corrigendumfiles','associatepartners'));
       }

       public function tenderlist()
       {
              $tenders=tender::select('tenders.*','users.name as author')
                      ->leftJoin('users','tenders.author','=','users.id')
                      ->get();
              //return $tenders;

              return view('tender.tenderlist',compact('tenders'));
       }

       public function gettenderlist()
       {
          $tenders=DB::table('tenders')
          ->select('tenders.*','users.name')
          ->leftJoin('users','tenders.author','=','users.id')
          ->where('lastdateofsubmisssion', '>=',date('Y-m-d'));
          
          return DataTables::of($tenders)
                 ->setRowClass(function ($tenders) {
                        $date = \Carbon\Carbon::parse($tenders->lastdateofsubmisssion);
                        $now = \Carbon\Carbon::now();
                        $diff = $now->diffInDays($date);
                        if($date<$now){
                            $day=-($diff);
                         }
                        else
                        {
                          $day=$diff;
                        }
                              if($day>0 && $day<=5)
                                {
                                  return 'blink';
                                }
                              
                   
                })
                 
                 
                 ->addColumn('idbtn', function($tenders){
                         return '<a href="/viewtender/'.$tenders->id.'" class="btn btn-info">'.$tenders->id.'</a>';
                    })

                  ->addColumn('sta', function($tenders) {
                    /*if ($tenders->status=='PENDING') return '<span class="label label-default">'.$tenders->status.'</span>';*/
                      if ($tenders->status=='ELLIGIBLE') return '<span class="label label-success">'.$tenders->status.'</span>';
                    if ($tenders->status=='NOT ELLIGIBLE') return '<span class="label label-warning">'.$tenders->status.'</span>';
                    if ($tenders->status=='PENDING')
                      return '<select id="status" onchange="changestatus(this.value,'.$tenders->id.')">'.
                               '<option value="PENDING">PENDING</option>'.
                               '<option value="ELLIGIBLE">ELLIGIBLE</option>'.
                               '<option value="NOT ELLIGIBLE">NOT ELLIGIBLE</option>'.
                               '</select>';



                    if ($tenders->status=='COMMITEE APPROVED') return '<span class="label label-info">'.$tenders->status.'</span>';
                    if ($tenders->status=='ADMIN APPROVED') return '<span class="label label-primary">'.$tenders->status.'</span>';
                    if ($tenders->status=='ADMIN REJECTED') return '<span class="label label-danger">'.$tenders->status.'</span>';
                    else
                      return '<span class="label label-default">'.$tenders->status.'</span>';
                    
                    
                    })
                  ->addColumn('view', function($tenders){
                         return '<a href="/viewtender/'.$tenders->id.'" class="btn btn-info">VIEW</a>';
                    })
                  ->addColumn('edit', function($tenders){
                         return '<a href="/edittender/'.$tenders->id.'" class="btn btn-warning">EDIT</a>';
                    })
                  ->addColumn('now', function($tenders){
                         return '<p class="b" title="'.$tenders->nameofthework.'">'.$tenders->nameofthework.'</p>';
                    })
                  ->editColumn('nitpublicationdate', function($tenders) {
                    return $this->changedateformat($tenders->nitpublicationdate);
                     })
                  ->editColumn('lastdateofsubmisssion', function($tenders) {
                    return $this->changedateformat($tenders->lastdateofsubmisssion);
                     })
                  ->editColumn('rfpavailabledate', function($tenders) {
                    return $this->changedateformat($tenders->rfpavailabledate);
                     })
                  ->editColumn('created_at', function($tenders) {
                        return $this->changedatetimeformat($tenders->created_at);
                     })
                  
                  ->rawColumns(['idbtn','view','edit','now','sta'])
                
               
                 ->make(true);
       }public function getviewalltenderlist()
       {
          $tenders=DB::table('tenders')
          ->select('tenders.*','users.name')
          ->leftJoin('users','tenders.author','=','users.id');

          return DataTables::of($tenders)
                 ->setRowClass(function ($tenders) {
                        $date = \Carbon\Carbon::parse($tenders->lastdateofsubmisssion);
                        $now = \Carbon\Carbon::now();
                        $diff = $now->diffInDays($date);
                        if($date<$now){
                            $day=-($diff);
                         }
                        else
                        {
                          $day=$diff;
                        }
                              if($day>0 && $day<=5)
                                {
                                  return 'blink';
                                }
                              
                   
                })
                 
                 
                 ->addColumn('idbtn', function($tenders){
                         return '<a href="/viewtender/'.$tenders->id.'" class="btn btn-info">'.$tenders->id.'</a>';
                    })

                  ->addColumn('sta', function($tenders) {
                    if ($tenders->status=='PENDING') return '<span class="label label-default">'.$tenders->status.'</span>';
                      if ($tenders->status=='ELLIGIBLE') return '<span class="label label-success">'.$tenders->status.'</span>';
                    if ($tenders->status=='NOT ELLIGIBLE') return '<span class="label label-warning">'.$tenders->status.'</span>';
                    if ($tenders->status=='COMMITEE APPROVED') return '<span class="label label-info">'.$tenders->status.'</span>';
                    if ($tenders->status=='ADMIN APPROVED') return '<span class="label label-primary">'.$tenders->status.'</span>';
                    if ($tenders->status=='ADMIN REJECTED') return '<span class="label label-danger">'.$tenders->status.'</span>';
                    else
                      return '<span class="label label-default">'.$tenders->status.'</span>';
                    
                    
                    })
                  ->addColumn('view', function($tenders){
                         return '<a href="/viewtender/'.$tenders->id.'" class="btn btn-info">VIEW</a>';
                    })
                  ->addColumn('edit', function($tenders){
                         return '<a href="/edittender/'.$tenders->id.'" class="btn btn-warning">EDIT</a>';
                    })
                  ->addColumn('now', function($tenders){
                         return '<p class="b" title="'.$tenders->nameofthework.'">'.$tenders->nameofthework.'</p>';
                    })
                  ->editColumn('nitpublicationdate', function($tenders) {
                    return $this->changedateformat($tenders->nitpublicationdate);
                     })
                  ->editColumn('lastdateofsubmisssion', function($tenders) {
                    return $this->changedateformat($tenders->lastdateofsubmisssion);
                     })
                  ->editColumn('rfpavailabledate', function($tenders) {
                    return $this->changedateformat($tenders->rfpavailabledate);
                     })
                  ->editColumn('created_at', function($tenders) {
                        return $this->changedatetimeformat($tenders->created_at);
                     })
                  
                  ->rawColumns(['idbtn','view','edit','now','sta'])
                
               
                 ->make(true);
       }
       public function home()
       {
           return view('tender.home');
       }

       public function createtender()
       {
            return view('tender.createtender');
       }

       public function savetender(Request $request)
       {
              

                $tender=new tender();
                $tender->author=Auth::id();
                $tender->nameofthework=$request->nameofthework;
                $tender->clientname=$request->clientname;
                $tender->recomended=$request->recomended;
                $tender->workvalue=$request->workvalue;
                $tender->nitpublicationdate=$request->nitpublicationdate;
                $tender->source=$request->source;
                $tender->tenderpriority=$request->tenderpriority;
                $tender->typeofwork=$request->typeofwork;
                $tender->lastdateofsubmisssion=$request->lastdateofsubmisssion;
                $tender->rfpavailabledate=$request->rfpavailabledate;
              
                $tender->refpageofrfp=$request->refpageofrfp;
                
                $tender->emdamount=$request->emdamount;
                $tender->amountinword=$request->amountinword;
                $tender->emdinformof=$request->emdinformof;
                $tender->tenderamount=$request->tenderamount;
                $tender->tenderamountinword=$request->tenderamountinword;
                $tender->tendercostinformof=$request->tendercostinformof;
                $tender->tenderrefno=$request->tenderrefno;
                $tender->noofcovers=$request->noofcovers;
                $tender->salestartdate=$request->salestartdate;
                $tender->saleenddate=$request->saleenddate;
                $tender->bidstartdate=$request->bidstartdate;
                $tender->bidenddate=$request->bidenddate;
                $tender->prebidmeetingdate=$request->prebidmeetingdate;
                $tender->emdpayableto=$request->emdpayableto;
                $tender->tenderfeepayableto=$request->tenderfeepayableto;
                $tender->tendervalidityindays=$request->tendervalidityindays;
                $tender->tendervaliditydate=$request->tendervaliditydate;
                $tender->registrationamount=$request->registrationamount;
                $tender->registrationamountinword=$request->registrationamountinword;
                $tender->registrationamountinformof=$request->registrationamountinformof;
                $tender->registrationamountpayableto=$request->registrationamountpayableto;

                $tender->save();

                $tid=$tender->id;
              
                 /*   $rarefile = $request->file('rfpdocument');    
                      if($rarefile!=''){
                      $raupload = public_path() .'/img/tender/';
                      $rarefilename=time().'.'.$rarefile->getClientOriginalName();
                      $success=$rarefile->move($raupload,$rarefilename);
                      $tender->rfpdocument = $rarefilename;
                      }*/
               
            $rfpdocuments=$request['rfpdocument'];

                      if ($rfpdocuments) {
                          foreach($rfpdocuments as $rfp)
                          {
                        
                          if($rfp!='')
                            {
                                $tenderdocument = new tenderdocument();
                                $raupload = public_path() .'/img/tender/';
                                $rarefilename=time().'.'.$rfp->getClientOriginalName();
                                $success=$rfp->move($raupload,$rarefilename);
                                $tenderdocument->file  = $rarefilename;
                                $tenderdocument->tenderid=$tid;
                                $tenderdocument->save();
                             } 
                               
                               
                            }
                      }
                    
                 
            /*        $rarefile1 = $request->file('corrigendumfile');    
                      if($rarefile1!=''){
                      $raupload1 = public_path() .'/img/tender/';
                      $rarefilename1=time().'.'.$rarefile1->getClientOriginalName();
                      $success1=$rarefile1->move($raupload1,$rarefilename1);
                      $tender->corrigendumfile = $rarefilename1;
                      }*/


                       $corrigendumfiles=$request['corrigendumfile'];

                       if ($corrigendumfiles) {
                         foreach($corrigendumfiles as $cor)
                          {
                        
                          if($cor!='')
                            {
                                $corrigendumfile = new corrigendumfile();
                                $raupload = public_path() .'/img/tender/';
                                $rarefilename=time().'.'.$cor->getClientOriginalName();
                                $success=$cor->move($raupload,$rarefilename);
                                $corrigendumfile->file  = $rarefilename;
                                $corrigendumfile->tenderid=$tid;
                                $corrigendumfile->save();
                             } 
                               
                               
                            }
                       }


                    
                 
                 Session::flash('msg','Tender Saved Successfully');
                 return back();


       }
}
