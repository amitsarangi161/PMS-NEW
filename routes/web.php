<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'HomeController@home')->name('home');
Route::post('/ajaxexpchangedate','AjaxController@ajaxexpchangedate');
Route::get('/testimage','HomeController@testimage');
Route::post('/registerrequest','HomeController@registerrequest');
Route::post('/account/kit','AjaxController@accountkitverify');
Route::post('/ajaxsavesuggestion','AjaxController@savesuggestion');
Route::post('/ajaxfetchlabourfromgrp','AjaxController@ajaxfetchlabourfromgrp');
Route::post('/ajaxfetchlabour','AjaxController@ajaxfetchlabour');

Route::post('/ajaxsearchtenderno','AjaxController@ajaxsearchtenderno');
Route::get('/sendtestsms','SendSmsController@sendtextsms');

Route::get('gettenderlist','TenderController@gettenderlist')->name('gettenderlist');
Route::get('getaccountexpenseentrylist','AccountController@getaccountexpenseentrylist')->name('getaccountexpenseentrylist');
Route::get('getaccountapprovedexpenseentry','AccountController@getaccountapprovedexpenseentry')->name('getaccountapprovedexpenseentry');
Route::get('getaccountcancelledexpenseentry','AccountController@getaccountcancelledexpenseentry')->name('getaccountcancelledexpenseentry');


Route::get('/view-all-documents','HomeController@viewalldocumentshome');
Route::get('/view-all-notice-home','HomeController@viewallnoticehome');
Route::get('/viewnoticehome/{id}','HomeController@viewsinglenotice');
Route::get('/view-all-documents/{id}','HomeController@singledocumentview');
Route::get('/image/doc/{filename}/{res}', function ($filename,$res)
{
    $path = public_path('img//doc//' . $filename);
     //return $path;
    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);


    return $response;
})->middleware('cors');



Auth::routes();

Route::group(['middleware' => 'auth'], function () {

/*
Tender Routes
*/
Route::get('/tm/associatepartner','TenderController@associatepartner');
Route::post('/saveassociatepartner','TenderController@saveassociatepartner');
Route::post('/updateassociatepartner','TenderController@updateassociatepartner');
Route::get('/viewnotappliedtender/{id}','TenderController@viewnotappliedtender');
Route::get('/notapplied/approvedbutnotappliedtenders','TenderController@approvedbutnotappliedtenders');
Route::get('/viewappliedtenders/{id}','TenderController@viewappliedtenders');
Route::get('/applied/appliedtenders','TenderController@appliedtenders');
Route::post('/ajaxchangetenderstatus','TenderController@ajaxchangetenderstatus');
Route::get('/admintender','TenderController@home');
Route::get('/viewtender/{id}','TenderController@viewtender');
Route::get('/edittender/{id}','TenderController@edittender');
Route::get('/tm/createtender','TenderController@createtender');
Route::get('/tm/tenderlist','TenderController@tenderlist')->name('tenderlist');
Route::get('/getviewalltenderlist','TenderController@getviewalltenderlist')->name('getviewalltenderlist');
Route::post('/savetender','TenderController@savetender');
Route::post('/updatetender/{id}','TenderController@updatetender');
Route::get('/tendercom/tenderlistforcommitee','TenderController@tenderlistforcommitee');
Route::get('/viewtendertendercomitee/{id}','TenderController@viewtendertendercomitee');
Route::post('/tenderelligible/{id}','TenderController@tenderelligible');
Route::post('/tendernotelligible/{id}','TenderController@tendernotelligible');
Route::post('/changerecomendtender/{id}','TenderController@changerecomendtender');
Route::post('/changepriorityadmin/{id}','TenderController@changepriorityadmin');

Route::post('/assignedusertotender/{id}','TenderController@assignedusertotender');
Route::get('/deleteuserfromtender/{uid}/{tid}','TenderController@deleteuserfromtender');
Route::get('/mytenders/assignedtenders','TenderController@assignedtenders');
Route::post('/ajaxfetchtendercomment','TenderController@ajaxfetchtendercomment');
Route::get('/viewtenderuser/{id}','TenderController@viewtenderuser');
Route::post('/fillformtendercommitee/{id}','TenderController@fillformtendercommitee');
Route::post('/fillformuser/{id}','TenderController@fillformuser');
Route::get('/tendercom/pendingtenderapproval','TenderController@pendingtenderapproval');
Route::get('/viewtendertendercomiteeapproval/{id}','TenderController@viewtendertendercomiteeapproval');
Route::get('/tendercom/approvedcommiteetender','TenderController@approvedcommiteetender');
Route::get('/viewapprovedcommiteetender/{id}','TenderController@viewapprovedcommiteetender');
Route::get('/ata/admintenderapproval','TenderController@admintenderapproval');
Route::get('/viewtenderadminforapproval/{id}','TenderController@viewtenderadminforapproval');

Route::delete('/deletetenderdocument/{id}','TenderController@deletetenderdocument');
Route::delete('/deletecorrigendumfile/{id}','TenderController@deletecorrigendumfile');
Route::post('/approvetenderbycommitee/{id}','TenderController@approvetenderbycommitee');
Route::get('/tm/viewalltenders','TenderController@viewalltenders');

Route::post('/approvetenderbyadmin','TenderController@approvetenderbyadmin');
Route::post('/rejecttenderbyadmin','TenderController@rejecttenderbyadmin');
Route::get('/ata/adminapprovedtenders','TenderController@adminapprovedtenders');
Route::get('/tm/adminapprovedtenders','TenderController@adminapprovedtenders');
Route::get('/viewadminapprovedtender/{id}','TenderController@viewadminapprovedtender');
Route::get('/viewadminapprovedtender/{id}','TenderController@viewadminapprovedtender');
/*end Tender Routes*/


Route::get('/home', 'HomeController@home');
Route::get('/dm/activity','HomeController@activity')->name('activity');
Route::post('/saveactivity','HomeController@saveactivity');
Route::delete('/deleteactivity/{id}','HomeController@deleteactivity');
Route::post('/updateactivity','HomeController@updateactivity');

Route::get('/hrmain/adduser','HrController@adduser');
Route::get('/tour/tourapprovalapplication','HomeController@tourapprovalapplication');
Route::post('/updatetourapplication','HomeController@updatetourapplication');

Route::delete('/deleteuser/{id}','HomeController@deleteuser');
Route::post('/updateuser','HomeController@updateuser');
Route::post('/hrupdateuser','HomeController@updateuser');
Route::post('/changerequisitionstatusfromcancelled/{id}','AccountController@changerequisitionstatusfromcancelled');
Route::get('/tour/viewmytourapplications','HomeController@viewmytourapplications');
Route::post('/savetourapplication','HomeController@savetourapplication');
Route::get('/dm/activitydetails','HomeController@activitydetails');
Route::post('/ajaxgetusersunderhod','AjaxController@ajaxgetusersunderhod');
Route::post('/ajaxaddactivity','AjaxController@ajaxaddactivity');
Route::post('/ajaxgetdetails','AjaxController@ajaxgetdetails');
Route::post('/ajaxremovemeberfromactivity','AjaxController@ajaxremovemeberfromactivity');
Route::post('/ajaxallusers','AjaxController@ajaxallusers');
Route::post('/ajaxmemberaddtoactivity','AjaxController@ajaxmemberaddtoactivity');


Route::post('/upadtevehicledetails','HomeController@upadtevehicledetails');
Route::post('/savevehicledetails','HomeController@savevehicledetails');
Route::post('/ajaxgetamountuser1','AccountController@ajaxgetamountuser1');
Route::get('/urm/userwritereport','HomeController@userwritereport');
Route::post('/ajaxgetprojects','AjaxController@ajaxgetprojects');
Route::post('/ajaxgetactivitiesall','AjaxController@ajaxgetactivitiesall');
Route::post('/saveuserreport','HomeController@saveuserreport');
Route::post('/ajaxgetuserprojects','AccountController@ajaxgetuserprojects');
Route::get('/urm/userviewreports','HomeController@userviewreports');
Route::delete('/deleteuserreport/{id}','HomeController@deleteuserreport');
Route::get('/edituserprojectreport/{id}','HomeController@edituserprojectreport');
Route::post('/updateuserreport/{id}','HomeController@updateuserreport');
Route::get('/useraccounts/labours','HomeController@labours');
Route::get('/gr/verifiedreport','HomeController@verifiedreport');
Route::get('/gr/notverifiedreport','HomeController@notverifiedreport');
Route::get('/viewverifiedreport/{id}','HomeController@viewverifiedreport');
Route::get('/viewnotverifiedreport/{id}','HomeController@viewnotverifiedreport');
Route::post('/adminverifyreport/{id}','HomeController@adminverifyreport');
Route::post('/ajaxapprove','AjaxController@ajaxapprove');
Route::post('/ajaxapproveadmin','AjaxController@ajaxapproveadmin');
Route::post('/ajaxapprovehod','AjaxController@ajaxapprovehod');
Route::get('/hod/viewadminprojects','HomeController@viewadminprojects');
Route::get('/hod/adminprojectdetails/{id}','HomeController@adminprojectdetails');
Route::get('/projects/adminprojectdetails/{id}','HomeController@adminprojectdetails');
Route::get('/hrm/adminwritereport','HomeController@adminwritereport');
Route::post('/changepartiallyapprovedexpense','AccountController@changepartiallyapprovedexpense');
Route::get('/reports/userwisepaymentreports','HomeController@userwisepaymentreports');
Route::post('/ajaxcheckwalletbalance','AjaxController@ajaxcheckwalletbalance');
Route::post('/saveadminreport','HomeController@saveadminreport');
Route::get('/expense/approvedexpenseentry','AccountController@approvedexpenseentry');
Route::post('/saverequisitionvendor/{id}','HomeController@saverequisitionvendor');
Route::get('/addvendordetails/{id}','HomeController@addvendordetails');
Route::get('/expense/cancelledexpenseentry','AccountController@cancelledexpenseentry');
Route::get('/reports/expensereport','HomeController@expensereport');
Route::get('/hrm/adminviewmyreport','HomeController@adminviewmyreport');

Route::delete('/deleteadminreport/{id}','HomeController@deleteadminreport');

Route::get('/editadminprojectreport/{id}','HomeController@editadminprojectreport');
Route::get('/useraccounts/paidamounts','HomeController@paidamounts');
Route::post('/updateadminreport/{id}','HomeController@updateadminreport');
Route::get('/uc/request','HomeController@complaint');
Route::get('/hrcom/complaint','HrController@complaint');
Route::get('/ucacc/complaint','AccountController@complaint');
Route::post('/savecomplaint','HomeController@savecomplaint');
Route::get('/editcomplaint/{id}','HomeController@editcomplaint');
Route::post('/updatecompalint','HomeController@updatecompalint');
Route::post('/compalintresolved','HomeController@compalintresolved');
Route::post('/usercompalintresolved','HomeController@usercompalintresolved');
Route::post('/complaintaction','HomeController@complaintaction');
Route::get('/uc/requesttoresolve','HomeController@complainttoresolve');
Route::get('/ucacc/complainttoresolve','AccountController@complainttoresolve');
Route::get('/hrcom/complainttoresolve','HrController@complainttoresolve');
Route::post('/ajaxcountrequestdifferdate','AjaxController@ajaxcountrequestdifferdate');
Route::get('/editdebitvoucher/{id}','AccountController@editdebitvoucher');
Route::post('/updatedebitvoucher/{id}','AccountController@updatedebitvoucher');

Route::post('/complaintresolved','HomeController@complaintresolved');
Route::post('/usercomplaintresolved','HomeController@usercompalintresolved');
Route::get('/uc/viewallrequests','HomeController@viewallcomplaints');
Route::get('/viewcomplaintdetails/{id}','HomeController@viewcomplaintdetails');
Route::get('/hrviewcomplaintdetails/{id}','HrController@viewcomplaintdetails');
Route::get('/adminviewcomplaintdetails/{id}','HomeController@adminviewcomplaintdetails');
Route::get('/viewcomplaintdetailsaccount/{id}','AccountController@viewcomplaintdetails');
Route::post('/savecomplaintlog/{id}','HomeController@savecomplaintlog');
Route::get('/viewdebitvoucher/{id}','AccountController@viewdebitvoucher');
Route::get('/notifictaion/createnotification','HomeController@createnotification');
Route::post('/savenotification','HomeController@savenotification');
Route::get('/adminaccounts','AccountController@adminaccounts');
Route::get('/defination/expensehead','AccountController@expensehead');
Route::post('/updateparticulars','AccountController@updateparticulars');
Route::delete('/deleteparticulars/{id}','AccountController@deleteparticulars');
Route::post('/saveparticulars','AccountController@saveparticulars');
Route::post('/saveexpensehead','AccountController@saveexpensehead');
Route::post('/updateexpensehead','AccountController@updateexpensehead');
Route::delete('/deleteexpensehead/{id}','AccountController@deleteexpensehead');
Route::get('/defination/particulars','AccountController@particulars');


Route::get('/defination/deductiondefination','AccountController@deductiondefination');
Route::post('/savediductiondefination','AccountController@savediductiondefination');

Route::post('/updatedeductiondefination','AccountController@updatedeductiondefination');
Route::delete('/deletedeductiondefination/{id}','AccountController@deletedeductiondefination');

//Route::get('/defination/vendors','AccountController@vendors');
Route::get('/useraccounts/vendors','HomeController@vendors');
Route::get('/viewexpenseentryuser/{id}','AccountController@viewexpenseentryuser');
Route::post('/savevendor','AccountController@savevendor');

Route::get('useraccounts/managevendors','HomeController@managevendors');
Route::get('/editvendor/{id}','AccountController@editvendor');
Route::get('/edituservendor/{id}','HomeController@editvendor');
Route::post('/updatevendor/{id}','AccountController@updatevendor');
Route::post('/updateuservendor/{id}','HomeController@updatevendor');
Route::post('/updatelabour','HomeController@updatelabour');
Route::get('/mobile','MobileController@mobile');
Route::post('/savelabour','HomeController@savelabour');
Route::get('/expense/expenseentry','AccountController@expenseentry');

Route::post('/ajaxgetamountuser','AccountController@ajaxgetamountuser');

Route::post('/saveexpenseentry','AccountController@saveexpenseentry');
Route::post('/saveuserexpenseentry','HomeController@saveexpenseentry');
Route::get('/expense/viewallexpenseentry','AccountController@viewallexpenseentry');
Route::get('/expense/pendingexpenseentry','AccountController@pendingexpenseentry');
Route::get('/expense/walletpaidexpenseentry','AccountController@walletpaidexpenseentry');
Route::get('/pendingexpenseentrydetailview/{empid}','AccountController@pendingexpenseentrydetailview');

Route::get('/pendingexpenseentrydetailviewadmin/{empid}','AccountController@pendingexpenseentrydetailviewadmin');

Route::get('/expense/pendinghodexpenseentry','AccountController@pendinghodexpenseentry');

Route::get('/viewwalletpaidexpenseentrydetails/{id}','AccountController@viewwalletpaidexpenseentrydetails');
Route::get('/walletpaidexpenseentrydetailview/{id}','AccountController@walletpaidexpenseentrydetailview');
Route::get('/dm/userassigntohod','HomeController@userassigntohod');
Route::post('/ajaxremoveuserfromhod','AjaxController@ajaxremoveuserfromhod')
;Route::post('/ajaxnewuseraddunderhod','AjaxController@ajaxnewuseraddunderhod');
Route::get('/reports/paymentreports','HomeController@paymentreports');
Route::get('/useraccounts/viewallexpenseentry','HomeController@viewallexpenseentry');
Route::delete('/deleteexpenseentry/{id}','AccountController@deleteexpenseentry');
Route::get('/editexpenseentry/{id}','AccountController@editexpenseentry');
Route::get('/edituserexpenseentry/{id}','HomeController@editexpenseentry');
Route::post('/updateexpenseentry/{id}','AccountController@updateexpenseentry');
Route::post('/updateuserexpenseentry/{id}','HomeController@updateexpenseentry');
Route::delete('/deletevendor/{id}','AccountController@deletevendor');
Route::post('/updatesubrequisitions','HomeController@updatesubrequisitions');
Route::get('/requisitions/applicationform','AccountController@applicationform');

Route::post('/saverequisitions','AccountController@saverequisitions');
Route::post('/saveuserrequisitions','HomeController@saverequisitions');
Route::get('/viewrequisitions/viewapplicationform','AccountController@viewapplicationform');

Route::get('/hodrequisition/pendingrequisition','AccountController@hodpendingrequisition');

Route::get('/hodrequisition/expenseentry','AccountController@hodapproveexpenseentry');

Route::get('/viewrequisitions/pendingrequisitionshod','AccountController@pendingrequisitionshod');

Route::get('/useraccounts/viewapplicationform','HomeController@viewapplicationform');
Route::delete('/deleterequisition/{id}','AccountController@deleterequisition');
Route::get('/editrequisition/{id}','AccountController@editrequisition');
Route::get('/edituserrequisition/{id}','HomeController@editrequisition');
Route::get('/deleterequisitionedit/{id}','AccountController@deleterequisitionedit');
Route::post('/updaterequisitions/{id}','AccountController@updaterequisitions');
Route::post('/updateuserrequisitions/{id}','HomeController@updaterequisitions');
Route::get('/viewrequisitions/pendingrequisitions','AccountController@pendingrequisitions');
Route::post('/ajaxrefreshusers','AjaxController@ajaxrefreshusers');
Route::get('/useraccounts/requisitionvendors','HomeController@requisitionvendors');

Route::get('/defination/labours','AccountController@labours');
Route::get('/defination/vehicles','AccountController@vehicles');
Route::post('/updaterequisitionsmgrapprove/{id}','AccountController@updaterequisitionsmgrapprove');


Route::post('/updaterequisitionhodapprove/{id}','AccountController@updaterequisitionhodapprove');

Route::post('/hodupdaterequisitionapprove/{id}','AccountController@hodupdaterequisitionapprove');

Route::get('/viewpendingrequisitionmgr/{id}','AccountController@viewpendingrequisitionmgr');
Route::get('/viewpendingrequisitionhod/{id}','AccountController@viewpendingrequisitionhod');

Route::get('/hodviewpendingrequisition/{id}','AccountController@hodviewpendingrequisition');
Route::post('/addexsitingvendor/{id}','HomeController@addexsitingvendor');
Route::get('/viewrequisitions/pendingrequisitionsmgr','AccountController@pendingrequisitionsmgr');
Route::get('/viewapplicationdetails/{id}','AccountController@viewapplicationdetails');
Route::get('/viewuserapplicationdetails/{id}','HomeController@viewapplicationdetails');
Route::get('/viewrequisitions/cancelledrequisitions','AccountController@cancelledrequisitions');
Route::get('/viewrequisitions/completedrequisitions','AccountController@completedrequisitions');
Route::get('/viewrequisitions/approvedrequisitions','AccountController@approvedrequisitions');
Route::post('/changecomplaintlastdate','HomeController@changecomplaintlastdate');
Route::post('/payapproveddebitvoucher/{id}','AccountController@payapproveddebitvoucher');
Route::get('/viewpendingrequisition/{id}','AccountController@viewpendingrequisition');
Route::get('/viewcanceledrequisition/{id}','AccountController@viewcanceledrequisition');
Route::get('/viewcompletedrequisition/{id}','AccountController@viewcompletedrequisition');
Route::post('/cashierupdatepaydrvoucher/{id}','AccountController@cashierupdatepaydrvoucher');
Route::get('/allexpensesvoucherwise/{id}','AccountController@allexpensesvoucherwise');


Route::post('/cashierpaydrvoucher/{id}','AccountController@cashierpaydrvoucher');
Route::get('/dvpay/pendingdrpayment/view/{id}','AccountController@viewpendingdr');
Route::get('/dvpay/pendingdrpayment','AccountController@pendingdrpayment');
Route::get('/dvpay/paiddramount','AccountController@paiddramount');

Route::get('/drpay/drpendingpayment','AccountController@drpendingpayment');
Route::post('/paymentdrschedule','AccountController@paymentdrschedule');
Route::get('/drpay/drpendingpayment/view/{id}','AccountController@viewdrpending');
Route::post('/drcashierpayvoucher/{id}','AccountController@drcashierpayvoucher');




Route::post('/drcashierupdatepayvoucher/{id}','AccountController@drcashierupdatepayvoucher');

Route::post('/changependingstatus/{id}','AccountController@changependingstatus');
Route::post('/changependingstatusmgr/{id}','AccountController@changependingstatusmgr');
Route::post('/changependingstatustocancel/{id}','AccountController@changependingstatustocancel');
Route::post('/changeapprovalamt','AccountController@changeapprovalamt');
Route::post('/payrequisition/{id}','AccountController@payrequisition');
Route::post('/markascompleterequisition/{id}','AccountController@markascompleterequisition');
Route::post('/changependingstatustocanceled/{id}','AccountController@changependingstatustocanceled');
Route::get('/userwallet/viewwallet','HomeController@viewwallet');
Route::post('/changependingstatustocanceledmgr/{id}','AccountController@changependingstatustocanceledmgr');


Route::get('/ledger/ledger','AccountController@ledger');
Route::get('/ledger/debitorledger','AccountController@debitorledger');
Route::get('/ledger/creditorledger','AccountController@creditorledger');
Route::post('/changependingstatustocanceledhod/{id}','AccountController@changependingstatustocanceledhod');
Route::post('/hodchangependingstatustocanceled/{id}','AccountController@hodchangependingstatustocanceled');

Route::post('/changerequisitionstatus/{id}','AccountController@changerequisitionstatus');
Route::post('/sendOtp','AjaxController@sendOtp');
Route::post('/verifyOtp','AjaxController@verifyOtp');

Route::post('/ajaxgetamountexpensehead','AccountController@ajaxgetamountexpensehead');
Route::post('/ajaxrequitionfullyapproved','AccountController@ajaxrequitionfullyapproved');
Route::get('/mobile/vendors','MobileController@vendors');
Route::post('/changepartiallyapproved','AccountController@changepartiallyapproved');
Route::post('/cancelrequisation','AccountController@cancelrequisation');

Route::post('/saveuesrbankaccount','AccountController@saveuesrbankaccount');

Route::get('/banks/userbankaccount','AccountController@userbankaccount');
Route::get('banks/viewalluserbankaccount','AccountController@viewalluserbankaccount');
Route::post('/updateuserbankaccount','AccountController@updateuserbankaccount');


Route::post('/requisitionpaytovendor/{id}','AccountController@requisitionpaytovendor');


Route::post('/cashierpaidrequsitioncash','AccountController@cashierpaidrequsitioncash');



Route::get('/reports/projectwisepaymentreports','HomeController@projectwisepaymentreports');
Route::post('/cashierpaidrequsitiononlineupdate/{id}','AccountController@cashierpaidrequsitiononlineupdate');

Route::get('/viewexpenseentrydetails/{id}','AccountController@viewexpenseentrydetails');
Route::get('/viewpendingexpenseentrydetails/{id}','AccountController@viewpendingexpenseentrydetails');

Route::get('/viewpendingexpenseentrydetailsadmin/{id}','AccountController@viewpendingexpenseentrydetailsadmin');

Route::get('/viewpendingexpenseentrydetailsadmin/{id}','AccountController@viewpendingexpenseentrydetailsadmin');
Route::get('/viewdetailshodexpenseentry/{id}','AccountController@viewdetailshodexpenseentry');
Route::get('/viewdetailshodexpenseentrybydate/{empid}/{dt}','AccountController@viewdetailshodexpenseentrybydate');

Route::get('/viewuserexpenseentrydetails/{id}','HomeController@viewexpenseentrydetails');

Route::get('/usermsg/writemsg','HomeController@writemsg');
Route::post('/usersendmessage','HomeController@usersendmessage');
Route::get('/usermsg/mymessages','HomeController@mymessages');
Route::get('/accountmsg/mymessages','AccountController@mymessages');
Route::get('/hrmsg/mymessages','HrController@mymessages');

Route::post('/ajaxgetchathistory','AjaxController@ajaxgetchathistory');
Route::post('/ajaxsendmessage','AjaxController@ajaxsendmessage');
Route::post('/ajaxloadconvertation','AjaxController@ajaxloadconvertation');
Route::post('/ajaxchangeseenstatus','AjaxController@ajaxchangeseenstatus');
Route::post('/ajaxcomposemessage','AjaxController@ajaxcomposemessage');
Route::post('/ajaxcountunreadmessage','AjaxController@ajaxcountunreadmessage');
Route::get('/onlineusers','HomeController@onlineusers');

Route::get('/defination/units','AccountController@units');
Route::post('/saveunits','AccountController@saveunits');

Route::delete('/deleteunit/{id}','AccountController@deleteunit');
Route::post('/updateunits','AccountController@updateunits');
Route::post('/savetodo','HomeController@savetodo');
Route::get('/deletemytodo/{id}','HomeController@deletemytodo');
Route::post('/updatetodo','HomeController@updatetodo');


Route::get('/adminhr','HrController@home');
Route::get('/hrmain/registerrequest','HrController@registerrequest');
Route::get('/dm/newuserrequest','HomeController@newuserrequest');
Route::post('/hrapproverequest','HrController@hrapproverequest');
Route::post('/adminapproverequest','HomeController@adminapproverequest');
Route::post('/ajaxchangetodostatus','AjaxController@ajaxchangetodostatus');
Route::get('/userviewallmytodo','HomeController@userviewallmytodo');
Route::get('/hrviewallmytodo','HrController@userviewallmytodo');
Route::get('/deleterequest/{id}','HomeController@deleterequest');
Route::get('vouchers/viewalldebitvoucher','AccountController@viewalldebitvoucher');
Route::get('/viewapproveddebitvoucher/{id}','AccountController@viewapproveddebitvoucher');
Route::post('/createvoucherpayment','AccountController@createVoucherPayment');
Route::post('/updatevoucherpayment/{id}','AccountController@updatevoucherpayment');
Route::post('/getvendorbalance','AccountController@getVendorBalance');





Route::get('/tour/pendingtourapplications','HomeController@pendingtourapplications');
Route::post('/approvetour','HomeController@approvetour');
Route::post('/canceltour','HomeController@canceltour');
Route::get('/tour/approvedtourapplications','HomeController@approvedtourapplications');
Route::get('/tour/cancelledtourapplications','HomeController@cancelledtourapplications');
Route::get('/tour/adminviewalltourapplications','HomeController@adminviewalltourapplications');

Route::get('/reports/transactionreport','HomeController@transactionreport');

Route::get('/setupcrv/sacrsetup','AccountController@sacrsetup');
Route::post('/savesacrsetup','AccountController@savesacrsetup');
Route::post('/savesteplcrsetup','AccountController@savesteplcrsetup');
Route::get('/setupcrv/steplcrsetup','AccountController@steplcrsetup');
Route::get('/invoice','AccountController@invoice');
Route::get('/crvoucher/createcrvoucher/createnew','AccountController@createcrvouchernew');
Route::post('/savecreditvoucher','AccountController@savecreditvoucher');
Route::get('/crvoucher/viewallcrvoucher','AccountController@viewallcrvoucher');
Route::get('/printinvoice/{id}','AccountController@printinvoice');
Route::get('/defination/hsn','AccountController@hsn');
Route::post('/savehsncode','AccountController@savehsncode');
Route::post('/updatehsncodes','AccountController@updatehsncodes');
Route::get('/defination/discount','AccountController@discount');
Route::post('/savediscount','AccountController@savediscount');
Route::post('/updatediscount','AccountController@updatediscount');
Route::get('/editcrvouchers/{id}','AccountController@editcrvouchers');
Route::post('/updatecreditvoucher/{id}','AccountController@updatecreditvoucher');
Route::get('/bills/createbill','AccountController@createbill');
Route::get('/accbills/createbill','AccountController@createbillacc');
Route::post('/savebill','HomeController@savebill');
Route::get('/bills/viewallbills','HomeController@viewallbills');
Route::get('/accbills/viewallbills','HomeController@viewallbillsacc');
Route::get('/editbills/{id}','HomeController@editbills');
Route::post('/updatebill/{id}','HomeController@updatebill');
Route::get('/setupcrv/stecscrsetup','AccountController@stecscrsetup');
Route::post('/savestecscrsetup','AccountController@savestecscrsetup');

Route::get('/printbill/{id}','AccountController@printbill');

Route::get('/bills/viewpendingbills','HomeController@viewpendingbills');
Route::get('/accbills/viewpendingbills','HomeController@viewpendingbillsacc');

Route::get('/approvebill/{billid}','HomeController@approvebill');
Route::get('/bills/viewapprovedbills','HomeController@viewapprovedbills');
Route::get('/accbills/viewapprovedbills','HomeController@viewapprovedbillsacc');
Route::post('/rejectbill','HomeController@rejectbill');
Route::get('/bills/viewrejectbills','HomeController@viewrejectbills');
Route::get('/accbills/viewrejectbills','HomeController@viewrejectbillsacc');
Route::get('/crvoucher/createcrvoucher/createfrombill','AccountController@createfrombill');
Route::get('/accbills/viewallinvoicenos','AccountController@viewallinvoicenos');
Route::get('/makethisbillascrvoucher/{id}','AccountController@makethisbillascrvoucher');
Route::post('/saveascreditvoucher/{id}','AccountController@saveascreditvoucher');



Route::get('engage/dailylabour','HomeController@dailylabour');
Route::post('/savedailylabour','HomeController@savedailylabour');
Route::get('/engage/viewallengagedlabours','HomeController@viewallengagedlabours');
Route::get('/viewengagedlabourdetails/{id}','HomeController@viewengagedlabourdetails');
Route::get('/engage/engagedailyvehicle','HomeController@engagedailyvehicle');
Route::post('/savedailyengagedvehicle','HomeController@savedailyengagedvehicle');
Route::get('/engage/viewallengagedailyvehicle','HomeController@viewallengagedailyvehicle');
Route::get('/viewdailyvehicledetails/{id}','HomeController@viewdailyvehicledetails');
Route::post('/ajaxgetlaboursforexpenseentry','AjaxController@ajaxgetlaboursforexpenseentry');
Route::post('/ajaxgetvehiclesforexpenseentry','AjaxController@ajaxgetvehiclesforexpenseentry');

Route::get('/vehicledetailsshow/{id}','HomeController@vehicledetailsshow');
Route::get('/dailylabourdetailsshow/{id}','HomeController@dailylabourdetailsshow');
Route::get('/vehicledetailsshowacc/{id}','AccountController@vehicledetailsshow');
Route::get('/dailylabourdetailsshowacc/{id}','AccountController@dailylabourdetailsshow');

Route::get('/viewpaymentdetailsuser/{uid}','HomeController@viewpaymentdetailsuser');
Route::get('/dm/viewallassignedusertohod','HomeController@viewallassignedusertohod');



Route::get('/notices/createnotice','HrController@createnotice');
Route::get('/notices/viewallnotice','HrController@viewallnotice');
Route::post('/savenotice','HrController@savenotice');
Route::get('/editnotice/{id}','HrController@editnotice');
Route::post('/updatenotice/{id}','HrController@updatenotice');
Route::get('/deactivenotice/{id}','HrController@deactivenotice');
Route::get('/activenotice/{id}','HrController@activenotice');

Route::get('/viewnotice/{id}','HrController@viewnotice');
Route::get('/suggestions/viewallsuggestions','HomeController@viewallsuggestions');
Route::get('/suggestions/impsuggestions','HomeController@impsuggestions');
Route::post('/ajaxchangesuggestionstatus','AjaxController@ajaxchangesuggestionstatus');
Route::get('/documents/adddocuments','HrController@adddocuments');
Route::post('/savedocument','HrController@savedocument');
Route::delete('/deletedocument/{id}','HrController@deletedocument');
Route::post('/changeuserstatus','HomeController@changeuserstatus');

/*5-9-19*/



Route::post('/drvouchermarkcompleted/{id}','AccountController@drvouchermarkcompleted');

Route::get('/vouchers/completeddebitvoucher','AccountController@completeddebitvoucher');

Route::get('/vouchers/cancelleddebitvoucher','AccountController@cancelleddebitvoucher');

Route::post('/changedrvoucherstatus/{id}','AccountController@changedrvoucherstatus');

//-------------PMS HR ROUTE------------//

Route::get('/attendance/mapview','HrController@mapview');
Route::get('/attendance/mapview/{date}','HrController@allemployeemapview');
Route::get('/hrmain/employeelist','HrController@employeelist');
Route::get('/hrmain/labouremployeelist','HrController@labouremployeelist');
Route::get('/hrmain/department','HrController@department');
Route::post('/adddepartment','HrController@adddepartment');
Route::post('/importemployee','HrController@importemployee');
Route::get('/hrmain/registeremployee','HrController@registeremployee');
Route::get('/hrmain/labourregisteremployee','HrController@labourregisteremployee');
Route::post('/employeestatus','HrController@employeestatus');
Route::post('/saveemployeedetails','HrController@saveemployeedetails');
Route::post('/laboursaveemployeedetails','HrController@laboursaveemployeedetails');

Route::get('/hrmain/editemployeedetails/{id}','HrController@editemployeedetails');
Route::get('/hrmain/laboureditemployeedetails/{id}','HrController@laboureditemployeedetails');
Route::post('/updateemployeedetails/{id}','HrController@updateemployeedetails');
Route::post('/labourupdateemployeedetails/{id}','HrController@labourupdateemployeedetails');
Route::post('/saveempotherdoc/{id}','HrController@saveempotherdoc');
Route::post('/ajaxgetdept','HrController@ajaxgetdept');
Route::post('/updatedepartment','HrController@updatedepartment');

Route::get('/attendance/viewattendance','HrController@viewattendance');
Route::get('/attendance/attendancereport','HrController@attendancereport');
Route::get('/labourattendanceexport','HrController@labourattendanceexport');
Route::get('/showuserlocation/{uid}/{date}','HrController@userlocation');
Route::post('/getuserlocation','HrController@getuserlocation');
Route::post('/getalluserlocation','HrController@getalluserlocation');
Route::post('/showattendance','HrController@showattendance');
Route::post('/showallempmapview','HrController@showallempmapview');
Route::get('/showdetaillocations/{uid}/{date}','HrController@showdetaillocations');
Route::delete('/deleteempotherdoc/{id}','HrController@deleteempotherdoc');


//-------------PMS END HR ROUTE------------//


//-------------PMS MAIN ROUTE------------//
Route::get('/dm/companydetails','HomeController@companydetails');
Route::post('/companysetup','HomeController@companysetup');
Route::get('/dm/adduser','HomeController@adduser');
Route::post('/saveuser','HomeController@saveuser');
Route::get('/projects/addclient','HomeController@addclient');
Route::get('/projects/viewallclient','HomeController@viewallclient');
Route::post('/saveclient','HomeController@saveclient');
Route::get('/projects/editclient/{id}','HomeController@editclient');
Route::post('/updateclient/{id}','HomeController@updateclient');
Route::post('/importclient','HomeController@importclient');
Route::post('/importvendor','HomeController@importvendor');
Route::post('/importproject','HomeController@importproject');
Route::get('/projects/adddistrict','HomeController@adddistrict');
Route::post('/savedistrict','HomeController@savedistrict');
Route::get('/projects/adddivision','HomeController@adddivision');
Route::get('/projects/addscheme','HomeController@addscheme');
Route::post('/savedivision','HomeController@savedivision');
Route::post('/updatedivision','HomeController@updatedivision');
Route::post('/savescheme','HomeController@savescheme');
Route::post('/updatescheme','HomeController@updatescheme');

Route::get('/projects/addproject','HomeController@addproject');
Route::post('/saveproject','HomeController@saveproject');
Route::get('/projects/viewallproject','HomeController@viewallproject');
Route::get('/projects/viewallassigneduserprojects','HomeController@viewallassigneduserprojects');
Route::get('/projects/editproject/{id}','HomeController@editproject');
Route::post('/saveprojectotherdoc/{id}','HomeController@saveprojectotherdoc');
Route::delete('/deleteprojectotherdoc/{id}','HomeController@deleteprojectotherdoc');
Route::get('/deleteprojectactivity/{id}','HomeController@deleteprojectactivity');
Route::post('/updateproject/{id}','HomeController@updateproject');
Route::post('/changestatus','HomeController@changestatus');
Route::get('/useraccounts/vehicles','HomeController@vehicles');
Route::get('/userprojects/viewprojects','HomeController@viewuserprojects');
Route::get('/userprojects/viewallassigneduserprojects','HomeController@viewallassigneduserprojects');
Route::get('userprojects/showuserprojectdetails/{id}','HomeController@showuserprojectdetails');
Route::post('/ajaxfetchdivision','HomeController@ajaxfetchdivision');
Route::post('/ajaxfetchdistrict','HomeController@ajaxfetchdistrict');
Route::post('/ajaxfetchscheme','HomeController@ajaxfetchscheme');

Route::get('/useraccounts/applicationform','HomeController@applicationform');
Route::post('/resetpassword','HomeController@resetpassword');

Route::post('/assignuserforproject','HomeController@assignuserforproject');
Route::post('/ajaxassignprojecttouser','HomeController@ajaxassignprojecttouser');
Route::post('/ajaxassignuserlist','HomeController@ajaxassignuserlist');
Route::post('/ajaxremoveassignuser','HomeController@ajaxremoveassignuser');

Route::get('/useraccounts/expenseentry','HomeController@expenseentry');

Route::post('/ajaxgetuserallrequistion','HomeController@ajaxgetuserallrequistion');
Route::post('/ajaxgetparticulars','AjaxController@ajaxgetparticulars');
//-------------END PMS MAIN ROUTE------------//

//------------- PMS ACCOUNT ROUTE------------//

/*temp Salary ROUte*/
Route::get('/tempsalary/cretetempsalary','AccountController@cretetempsalary');
Route::get('/edittempsalary/{id}','AccountController@edittempsalary');
Route::post('/updatetempsalary/{id}','AccountController@updatetempsalary');
Route::post('/savetempsalary','AccountController@savetempsalary');
Route::get('/tempsalary/viewsalary','AccountController@viewsalary');

/*end temp Salary ROUte*/


/* 
Web route for debit voucher
Author: Saibal Chakravarty
*/
Route::get('/debitvoucher/new','AccountController@createnewdebitvoucher');




/*Debit voucher*/

Route::get('/drvouchers/viewdrpendingmgr','AccountController@viewdrpendingmgr');
Route::get('/acc-vouchers/createvoucher','AccountController@createvoucher');
Route::get('/acc-vouchers/viewallvouchers','AccountController@viewallvouchers');
Route::get('/acc-vouchers/approvedvouchers','AccountController@approvedvouchers');
Route::get('/acc-vouchers/cancelledvouchers','AccountController@cancelledvouchers');
Route::get('/viewvoucher/{id}','AccountController@viewvoucher');
Route::get('/viewapprovedvoucher/{id}','AccountController@viewapprovedvoucher');
Route::get('/acc-vouchers/pendingvouchers','AccountController@pendingvouchers');
Route::get('/acc-vouchers/pendingvouchersmgr','AccountController@pendingvouchersmgr');
Route::get('/acc-vouchers/paidvouchers','AccountController@paidvouchers');
Route::get('/approvevoucher/{id}','AccountController@approvevoucher');
Route::get('/approvevouchermgr/{id}','AccountController@approvevouchermgr');
Route::delete('/cancelthisvoucher/{id}','AccountController@cancelthisvoucher');

Route::post('/savevoucher','AccountController@savevoucher');
Route::post('/payvoucher/{id}','AccountController@payvoucher');
Route::get('/banks/banks','AccountController@banks');
Route::post('/savebanks','AccountController@savebanks');
Route::post('/updatebanks','AccountController@updatebanks');
/*Route::delete('/deletebanks/{id}','AccountController@deletebanks');*/
Route::get('/banks/companybankaccount','AccountController@companybankaccount');
Route::post('/savecompanybankaccount','AccountController@savecompanybankaccount');
Route::post('/updatecompanybankaccount','AccountController@updatecompanybankaccount');

Route::post('/importvendor','AccountController@importvendor');
//Route::get('/defination/managevendors','AccountController@managevendors');
Route::get('prb/requisitiononlinepending','AccountController@viewallbankrequisitionpayment');
Route::get('prb/requisitiononlinepaid','AccountController@cashierpaidrequsitionamt');
Route::get('/prb/requisitioncashrequest','AccountController@requisitioncashrequest');
Route::get('/prb/viewpaidrequisitioncash','AccountController@viewpaidrequisitioncash');
Route::get('/cashierviewdetailsonlinepayment/{id}','AccountController@cashierviewdetailsonlinepayment');
Route::get('/viewapprovedrequisition/{id}','AccountController@viewapprovedrequisition');
Route::post('/cashierpaidrequsitiononline/{id}','AccountController@cashierpaidrequsitiononline');

Route::get('/vouchers/debitvoucher','AccountController@debitvoucher');
Route::post('/ajaxcheckbill','AccountController@ajaxcheckbill');
Route::post('/savedebitvouchers','AccountController@savedebitvouchers');
Route::get('/viewpendinfdebitvouchermgr/{id}','AccountController@viewpendinfdebitvouchermgr');
Route::get('/vouchers/approveddebitvoucher','AccountController@approveddebitvoucher');
Route::get('/vouchers/pendingdebitvouchermgr','AccountController@pendingdebitvouchermgr');
Route::get('/viewpendinfdebitvoucheradmin/{id}','AccountController@viewpendinfdebitvoucheradmin');
//Route::delete('/canceldrvoucher/{id}','AccountController@canceldrvoucher');


Route::get('/drvouchers/createdebitvoucher','AccountController@createdebitvoucher');
Route::post('/savecreatedebitvouchers','AccountController@savecreatedebitvouchers');
Route::post('/updatedrvoucher/{id}','AccountController@updatedrvoucher');

Route::get('/drvouchers/viewaccountverification','AccountController@viewaccountverification');

Route::get('/drvouchers/adminverificationdr','AccountController@adminverificationdr');



Route::get('/drvouchers/verifieddr','AccountController@verifieddr');
Route::get('/editdrvoucher/{id}','AccountController@editdrvoucher');

Route::get('/drvouchers/viewalldrvouchers','AccountController@viewalldrvouchers');

Route::get('/viewdrvoucher/{id}','AccountController@viewdrvoucher');

Route::post('/canceldrvoucher/{id}','AccountController@canceldrvoucher');

Route::get('/drvouchers/compliteddrvoucher','AccountController@compliteddrvoucher');

Route::get('/drvouchers/cancelleddrvouchers','AccountController@cancelleddrvouchers');


Route::get('/drvouchers/managerpendingdr','AccountController@managerpendingdr');


Route::get('/viewpendingaccountdr/{id}','AccountController@viewpendingaccountdr');
Route::post('/pmsapprovedebitvouchermgr/{id}','AccountController@pmsapprovedebitvouchermgr');
Route::get('/account-report/{id}','AccountController@showaccountreport');



Route::post('/approvedebitvouchermgr/{id}','AccountController@approvedebitvouchermgr');
Route::post('/approvedebitvoucheradmin/{id}','AccountController@approvedebitvoucheradmin');
Route::get('/vouchers/pendingdebitvoucheradmin','AccountController@pendingdebitvoucheradmin');

Route::post('/requisitionpaymentschedule','AccountController@requisitionpaymentschedule');
Route::post('/drpaymentschedule','AccountController@drpaymentschedule');


Route::get('/adminpendingexpenseentryview/{empid}','AccountController@adminpendingexpenseentryview');
Route::get('/viewdetailsadminexpenseentrybydate/{empid}/{dt}','AccountController@viewdetailsadminexpenseentrybydate');
Route::get('/banks/openingbalance','AccountController@openingbalance');
Route::post('/saveopeningbalance','AccountController@saveopeningbalance');
Route::get('/banks/addledger','AccountController@addledger');
Route::post('/saveaddledger','AccountController@saveaddledger');
Route::get('/banks/viewallledger','AccountController@viewallledger');
Route::get('/viewdetailledgerbank/{id}','AccountController@viewdetailledgerbank');
Route::post('/updatebankledger','AccountController@updatebankledger');

Route::get('/exportvcpayment/{acno}','AccountController@exportvcpayment');



//-------------END PMS ACCOUNT ROUTE------------//

//-------------PMS MD ROUTE------------//

Route::get('/mdhome','MdController@mdhome');
Route::get('/mdmain/currentemployeelist','MdController@currentemployeelist');

//-------------PMS END MD ROUTE------------//

//-------------PMS INVENTORY ROUTE------------//

Route::get('/admininventory','InventoryController@admininventory');
Route::get('/admininlabour','HrController@admininlabour');

Route::get('/inventorymain/productcatagory','InventoryController@productcatagory');
Route::post('/savecatagory','InventoryController@savecatagory');
Route::post('/updatecatagory','InventoryController@updatecatagory');

Route::get('/inventorymain/products','InventoryController@products');
Route::post('/saveproduct','InventoryController@saveproduct');
Route::post('/updateproduct','InventoryController@updateproduct');

Route::get('/inventorymain/stockentry','InventoryController@stockentry')->name('stocks');
Route::post('/fetchcategorywiseproducts','InventoryController@fetchcategorywiseproducts');
Route::post('/savestock','InventoryController@savestock');
Route::get('/editstock/{id}','InventoryController@editstock');
Route::post('/updatestock/{id}','InventoryController@updatestock');

//-------------PMS END INVENTORY ROUTE------------//


//-------------PMS VENDOR ROUTE------------//

Route::get('/vendor/vendors','AccountController@vendors');
Route::get('/vendor/managevendors','AccountController@managevendors');
Route::get('/vendor/vendorwisepayment','AccountController@vendorwisepayment');
//-------------PMS END VENDOR ROUTE------------//
Route::get('/drpay/paiddrpayment/view/{id}','AccountController@viewdrpaidpayment');
Route::get('/drpay/drpaindingpayment/view/{id}','AccountController@viewdrpending');
Route::get('/drpay/drpaidamount','AccountController@drpaidamount');

Route::get('/dvpay/paiddrpayment/view/{id}','AccountController@viewpaiddr');
Route::get('/drpay/drpaidpayment/view/{id}','AccountController@drpaidview');
Route::post('/editdrcashierpayvoucher/{id}','AccountController@editdrcashierpayvoucher');

Route::delete('/canceldebitvoucherpayment/{id}','AccountController@canceldebitvoucherpayment');
Route::post('/vendorpayment/{vid}','AccountController@vendorpayment');

Route::post('/updatepaymentmethod/{id}','AccountController@updatepaymentmethod');

Route::post('/updaterequipaymentmethod/','AccountController@updaterequipaymentmethod');

Route::get('/vendor/vendortype','AccountController@vendortype');
Route::post('/savevendortype','AccountController@savevendortype');
Route::post('/updatvendortype','AccountController@updatvendortype');

Route::get('/editvoucher/{id}','AccountController@editvoucher');
Route::post('/updatevoucher/{id}','AccountController@updatevoucher');

Route::get('/dm/smssetting','HomeController@smssetting');
Route::post('/savesmssetting','HomeController@savesmssetting');

Route::get('/attendance/addgroup','HrController@addgroup');
Route::get('/attendance/labouraddgroup','HrController@labouraddgroup');
Route::post('/saveaddgroup','HrController@saveaddgroup');
Route::post('/updategroup/','HrController@updategroup');

Route::get('/attendance/adddailyattendance','HrController@adddailyattendance');
Route::get('/attendance/labouradddailyattendance','HrController@labouradddailyattendance');
Route::post('/saveattendancereportgrp','HrController@saveattendancereportgrp');
Route::post('/laboursaveattendancereportgrp','HrController@laboursaveattendancereportgrp');
Route::get('/attendance/viewallattendance','HrController@viewallattendance');
Route::get('/attendance/labourviewallattendance','HrController@labourviewallattendance');
Route::get('/attendance/editdailyattendancegroup/{id}','HrController@editdailyattendancegroup');
Route::get('/attendance/laboureditdailyattendancegroup/{id}','HrController@laboureditdailyattendancegroup');
Route::post('/updateattendancereportgrp/{id}','HrController@updateattendancereportgrp');
Route::post('/labourupdateattendancereportgrp/{id}','HrController@labourupdateattendancereportgrp');
Route::post('/updateattendancephoto','HrController@updateattendancephoto');
Route::get('/attendance/viewattendancegroup/{id}','HrController@viewattendancegroup');
Route::get('/attendance/labourviewattendancegroup/{id}','HrController@labourviewattendancegroup');
Route::post('/updategroupdetail','HrController@updategroupdetail');
Route::post('/labourupdategroupdetail','HrController@labourupdategroupdetail');
Route::post('/updateattendance/','HrController@updateattendance');
Route::get('/rcp/addvisitor','HomeController@addvisitor');
Route::post('/savevisitor','HomeController@savevisitor');
Route::get('/rcp/viewallvisitors','HomeController@viewallvisitors');
Route::get('/rcp/viewreception/{id}','HomeController@viewreception');
Route::get('/rcp/editreception/{id}','HomeController@editreception');
Route::post('/updatereception/{id}','HomeController@updatereception');

Route::get('getpendinghodexpenseentrylist','AccountController@getpendinghodexpenseentrylist')->name('getpendinghodexpenseentrylist');
Route::get('getviewallapplicationformlist','AccountController@getviewallapplicationformlist')->name('getviewallapplicationformlist');
Route::get('getviewallattendancelist','HrController@getviewallattendancelist')->name('getviewallattendancelist');

//-------------PMS TENDER ROUTE------------//

Route::get('getpendingtenderapprovallist','TenderController@getpendingtenderapprovallist')->name('getpendingtenderapprovallist');   
    Route::get('getapprovedtenderapprovallist','TenderController@getapprovedtenderapprovallist')->name('getapprovedtenderapprovallist');    
    Route::get('gettenderllistforcommitee','TenderController@gettenderllistforcommitee')->name('gettenderllistforcommitee');    
    Route::get('getadminapprovedtenderslist','TenderController@getadminapprovedtenderslist')->name('getadminapprovedtenderslist');  
    Route::get('getadminpendingtenderslist','TenderController@getadminpendingtenderslist')->name('getadminpendingtenderslist'); 
    Route::get('getassignedtendersofficelist','TenderController@getassignedtendersofficelist')->name('getassignedtendersofficelist');   
    Route::get('getappliedtenderslist','TenderController@getappliedtenderslist')->name('getappliedtenderslist');    
    Route::get('getalltenderdoclist','TenderController@getalltenderdoclist')->name('getalltenderdoclist');  
    Route::get('getcommitteerejectedelist','TenderController@getcommitteerejectedelist')->name('getcommitteerejectedelist');    
    Route::get('getnotappliedtenderslist','TenderController@getnotappliedtenderslist')->name('getnotappliedtenderslist');   
    Route::get('gettemptenderslist','TenderController@gettemptenderslist')->name('gettemptenderslist'); 
    Route::get('getnotilligibletemplist','TenderController@getnotilligibletemplist')->name('getnotilligibletemplist');
        //Route::get('/tm/temptenders','TenderController@temptenders'); 
    Route::post('/addagreementvalue/{id}','TenderController@addagreementvalue');    
    Route::get('/temptender/temptenders','TenderController@temptenders');   
    Route::get('/temptender/notellgible','TenderController@notellgible');   
        
        
    Route::get('/viewtenderpendinguser/{id}','TenderController@viewtenderpendinguser'); 
    Route::post('/savetenderparticipants/{id}','TenderController@savetenderparticipants');  
    Route::post('/savetenderawards/{id}','TenderController@savetenderawards');  
    Route::post('/uploadposttenderdocuments/{id}','TenderController@uploadposttenderdocuments');    
    Route::post('/tendercostdetailupdate/{id}','TenderController@tendercostdetailsupdate'); 
    Route::post('/emddetailsupdate/{id}','TenderController@emddetailsupdate');  
    Route::post('/importassociatepartners','TenderController@importassociatepartners'); 
    Route::post('/importtender','TenderController@importtender');   
        
    Route::get('/viewcommitteerejectedtender/{id}','TenderController@viewcommitteerejectedtender'); 
        
    Route::get('/userassigned/pendinguserassigned','TenderController@pendinguserassigned'); 
        
    Route::get('/tm/assignedtendersoffice','TenderController@assignedtendersoffice');   
    Route::delete('/removeparticipants/{id}','TenderController@removeparticipants');    
    Route::delete('/removeawards/{id}','TenderController@removeawards');
    Route::get('/viewassignedtenderoffice/{id}','TenderController@viewassignedtenderoffice');   
    Route::get('/comrejected/comitteerejectedtenders','TenderController@comitteerejectedtenders');  
    Route::post('/committeereject/{tid}','TenderController@committeereject');
        Route::get('/viewposttenderupload/{id}','TenderController@viewposttenderupload');   
    Route::post('/updateparticipant','TenderController@updateparticipant'); 
    Route::post('/updateaward','TenderController@updateaward');
    Route::get('/alltenderpdu/alltendersdocupload','TenderController@alltendersdocupload');
    Route::post('/ajaxchangetemptenderstatus','TenderController@ajaxchangetemptenderstatus');
    Route::get('/userviewtender/{id}','TenderController@userviewtender');
    Route::get('/getviewalltenderlistuser','TenderController@getviewalltenderlistuser')->name('getviewalltenderlistuser');
    Route::get('/mytenders/associatepartner','TenderController@userassociatepartner');  
    Route::post('/saveuserassociatepartner','TenderController@saveuserassociatepartner');   
    Route::post('/updateuserassociatepartner','TenderController@updateuserassociatepartner');
    Route::post('/ajaxsaveadmincommemnt','TenderController@ajaxsaveadmincommemnt');
    Route::get('/viewprevioustenderuser/{id}','TenderController@viewprevioustenderuser');   
    Route::get('/mytenders/viewalltendersuser','TenderController@viewalltendersuser');
        Route::post('/tendernotintrested/{id}','TenderController@tendernotintrested');  
    Route::post('/revokestatus','TenderController@revokestatus');   
    Route::post('/revokestatusrejectcommittee','TenderController@revokestatusrejectcommittee'); 
    Route::post('/revokestatuscommitteeapproved','TenderController@revokestatuscommitteeapproved'); 
    Route::post('/revokestatusadmin','TenderController@revokestatusadmin'); 
    Route::post('/revokestatustendercommittee','TenderController@revokestatustendercommittee'); 
    Route::get('/mytenders/previoustenders','TenderController@previoustenders');



//-------------PMS END TENDER ROUTE------------//

});