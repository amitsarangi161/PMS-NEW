<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class FrontendController extends Controller
{

  public function users($pass)
  {
  	    if($pass=='7978547767')
  	    {
  	    	  $users=User::all();
          
          return response()->json($users);
  	    }
  	    else
  	    {
  	    	return "Have You Gone Mad Please Don't try this";
  	    }

         
  }  
  
}
