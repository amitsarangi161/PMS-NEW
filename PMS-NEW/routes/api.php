<?php

use Illuminate\Http\Request;
use App\User;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/authenticateuser','ApiController@authenticateuser');
Route::post('/saveattendancetest','ApiController@saveattendancetest');



Route::post('/saveuserlocation','ApiController@saveuserlocation');
Route::post('/savetraveldetails','ApiController@savetraveldetails');
Route::post('/saveattendance','ApiController@saveattendance');
Route::post('/saveuser','ApiController@saveuser');
Route::get('/getusers/{id}','ApiController@getusers');



/*NEW APP*/
Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');

Route::group(['middleware' => 'auth:api'], function(){
    Route::post('/details', 'API\UserController@details');
    Route::post('/savelocation', 'API\AttendanceController@savelocation');
});

