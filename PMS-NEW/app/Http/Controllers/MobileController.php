<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MobileController extends Controller
{
    public function mobile()
    {
    	 return view('mobile.home');
    }

    public function vendors()
    {
    	return view('mobile.vendors');
    }
}
