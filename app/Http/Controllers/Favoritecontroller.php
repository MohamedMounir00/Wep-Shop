<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\Service;
use App\Favorite;
class Favoritecontroller extends Controller
{
   public function Addfav($services_id){
   	$service= Service::findOrfail($services_id);
   	if ($service) {
   		$user=Auth::user();
   		$serviseAddBefor= Favorite::where('service_id' ,$services_id)->where('user_id',$user->id)->count();
   		if ($serviseAddBefor == 0) {
   			if ($service->user_id != $user->id) {
   				$fav= new Favorite();
   				$fav->service_id= $services_id;
   				$fav->user_id= $user->id;
   				$fav->user_service=	$service->user_id;
   				if ($fav->save()) {
   					return Favorite::where('user_id',$user->id)->count();
                  }
   				abort(403);
   			}
   			abort(403);
   		}
   		abort(403);
   	}
abort(403);

   }
   public function GetMyFav(){
   	$user=Auth::user();
   	return Favorite::where('user_id',$user->id)->with('services','GetuserServises')->orderBy('id','desc')->get();
   }
 public function Deletefav($id){
 	$fave= Favorite::findOrfail($id);
 	if ($fave) {
 		$user=Auth::user();
 		
 		if ($fave->user_id == $user->id) {
 			if (Favorite::find($id)->delete()) {
 				return  Favorite::where('user_id',$user->id)->count();
 			}
 			 		abort(403);

 		}
 		abort(403);
 	}
 	abort(403);
   	

   }
   
}
