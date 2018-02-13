<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\Notification;
use App\Cat;


class NoticationControler extends Controller
{
    public function GetNotifaction()
{
	$user =Auth::user();
	$not=Notification::where('user_id',$user->id)->with('GetUserSendNotication')->orderBy('id','desc')->get();
		$sum=Notification::where('user_id',$user->id)->count();

	$array=[
	'user'=>$user,
	'not'=>$not,
	'sum'=>$sum

	];
	return $array;
}
public function GetAllNot(){
	$cat=Cat::get(['id','name']);

	if (Auth::user()) {
    $user=Auth::user()->id;
	$note=GetAllNot($user);
	$fav=GetNumFav($user);
	$orders=GetAllPayOrders($user);

	return [
	'login'=>'doneLogin',

    'note'=>$note,
	'fav'=>$fav,
	'orders'=>$orders,
	'cat'=>$cat

	];	}
	
		return [
        'login'=>'errorLogin',
			'cat'=>$cat
		];
	
	
}

public function notAll()
{
		$user=Auth::user()->id;
		$note=GetAllNotObject($user);
          MakeUserNotifactionSeen($user);
          	$noteSum=GetAllNot($user);

	return [
     'note'=>$note,
	'noteSum'=>$noteSum,
	];
}
}
