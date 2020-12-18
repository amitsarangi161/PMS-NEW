<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Smssetting;

class SendSmsController extends Controller
{
    public function sendtextsms(){
     
     return $this->sendSms('hello','7008460411');
    }
    public function sendSms($message,$mobile,$usernumber=''){
    $smssetting=Smssetting::first();
    //dd($smssetting->status);
    if($smssetting->status==1){
    $url = "https://message.datagramindia.com/api/api_http.php";
    if($mobile != 'RECEPTION'){
      $recipients = array($smssetting->mobile,$mobile);
    }else{
      $recipients = array($smssetting->receptioncontact,$usernumber);
    }
    $param = array('username' => $smssetting->username,
                   'password' => $smssetting->password,
                   'senderid' => 'PBTGRP',
                   'text' => $message,
                   'route' => 'Informative',
                   'type' => 'text',
                   'datetime' => date("Y-m-d h:i:s"),
                   'to' => implode(';', $recipients),
                    );
    //dd($param);
    try{
    $post = http_build_query($param, '', '&');
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);     curl_setopt($ch, CURLOPT_POSTFIELDS, $post);curl_setopt($ch, CURLOPT_HTTPHEADER, array("Connection: close"));
    $result = curl_exec($ch);
    if(curl_errno($ch)) {         $result = "cURL ERROR: " . curl_errno($ch) . " " . curl_error($ch);     } else {         $returnCode = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);         switch($returnCode) {             case 200 :                 break;             default :                 $result = "HTTP ERROR: " . $returnCode;         }     }
    curl_close($ch);
    //dd($result);
    return $result;
    }
   catch (\Exception $ex) {
      return 1;
    } 

    }
     else{
    return 1;
  }
  }


 


}

   
