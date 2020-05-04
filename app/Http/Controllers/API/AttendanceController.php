<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\attendance;
class AttendanceController extends Controller
{
    public function savelocation(Request $request)
     {
        header('Access-Control-Allow-Origin: *');
        header( 'Access-Control-Allow-Headers: Authorization, Content-Type' );
       
        
        
        $get_result_arr = json_decode($request->getContent(), true);
        //return $get_result_arr;
        $countdata=0;
        $count=sizeof($get_result_arr['locations']);

        for ($i=0; $i < $count; $i++) { 

        $attendance=new attendance();
        $attendance->userid=$get_result_arr['userid'];
        $attendance->deviceid=$get_result_arr['deviceid'];
        $attendance->version=$get_result_arr['version'];
        $attendance->status=$get_result_arr['locations'][$i]['status'];
        $attendance->present=$get_result_arr['locations'][$i]['present'];
        $attendance->latitude=$get_result_arr['locations'][$i]['latitude'];
        $attendance->longitude=$get_result_arr['locations'][$i]['longitude'];
        $attendance->battery=$get_result_arr['locations'][$i]['battery'];
        $attendance->time=$get_result_arr['locations'][$i]['time'];
        $attendance->mode=$get_result_arr['locations'][$i]['mode'];
        $attendance->save();
        ++$countdata;

        }
        //done For Test

        
        $data=['statuscode'=>200,'noofdatasaved'=>$countdata,'msg'=>'success','request'=>$get_result_arr];

        return response()->json($data);


     }
}
