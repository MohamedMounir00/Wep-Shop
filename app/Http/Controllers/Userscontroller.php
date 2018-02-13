<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
class Userscontroller extends Controller
{
    public function GetAuthUser(){
    	return Auth::user();
    }
}
