<?php

namespace App\Http\Controllers;
use Auth;
use App\Service;
use App\Vote;
use Illuminate\Http\Request;

use App\Http\Requests;

class Votecontroller extends Controller
{
   public function AddNewVote($val ,$service_id){
   	
   	$service = Service::findOrfail($service_id);
   	if ($service ) {
   		$array= [1,2,3,4,5];
   		if (in_array($val, $array)) {
   			$user= Auth::user();
   			$voteBefor = Vote::where('user_id',$user->id)->where('services_id',$service->id)->count();
   			if ($voteBefor == 0) {
   				if ($user->id !=$service->user_id  ) {
   					# code...
   				
   				$vote = new Vote();
   			$vote->services_id = $service->id;
   			$vote->user_id = $user->id;
   			$vote->vote = intval($val);
   			if ($vote->save()) {
   				return 'done';
   				}
   					abort(403);
   			}
   			abort(403);
   			}
   			
   			 abort(403);
   		}
   		 abort(403);
   	}
 abort(403);
   }
}
