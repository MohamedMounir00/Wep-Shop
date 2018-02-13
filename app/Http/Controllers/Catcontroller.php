<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Service;
use App\User;
use App\Cat;
use App\View;
use App\Vote;
use DB;
use App\Order;

use App\Http\Requests;

class Catcontroller extends Controller
{
 public function getServicesByCat($cat_id , $length = null)
 {
 	$cat = Cat::findOrFail($cat_id);
if ($cat) {
	# code...

     $query=DB::table('services');
      $query->join('users','users.id','=' , 'services.user_id');
      $query->leftJoin('votes','services.id','=' ,'votes.services_id');
      $query->select('services.id','services.name','services.image' ,'services.price','services.user_id'
      ,DB::raw('users.name as username')
      ,DB::raw('SUM(votes.vote) as vote_sum')
      ,DB::raw('COUNT(votes.vote) as vote_count'));
      $query->groupBy('services.id');
      $query->where('services.status',1);
       $query->where('services.cat_id',$cat_id);
      $query->orderBy('vote_sum','desc');
      if ($length == null) {
      	 $query->limit(env('limt'));
      }else{
      	 $query->offset($length)->limit(env('limt'));
      }
     
      $services=$query->get();


  if ($length == null) {

   //all cat
     $cats= Cat::where('id','!=',$cat_id)->orderBy('id','desc')->get(['id','name']);

      //realsed services

  

          //mostview

      $sidebarsection1= Service::join('users','users.id','=' , 'services.user_id')
      ->leftJoin('views','services.id','=' ,'views.service_id')
      ->select('services.id','services.name' ,DB::raw('COUNT(views.id) as view_count'))

      ->groupBy('services.id')
      ->where('services.status',1)
      ->where('services.cat_id',$cat_id)
      ->limit(6)
      ->orderBy('view_count','desc')->get();

      ///most paying
           $sidebarsection3= 
      Service::leftJoin('orders','services.id','=' ,'orders.services_id')
      ->select('services.id','services.name' ,DB::raw('COUNT(orders.id) as orders_count'))

      ->groupBy('services.id')
      ->where('services.status',1)
      ->where('services.cat_id',$cat_id)
      ->limit(6)
      ->orderBy('orders_count','desc')->get();
    
  
    // append to user order  we chooce you services
    $guest= Auth::guest();
    if (!$guest) {
      $user= Auth::user();
     $orderCat= Order::join('services' , 'orders.services_id' ,'=' ,'services.id' )
     ->where('user_order',$user->id)
     ->lists('services.cat_id')->all();

     $sidebarsection2= Service::join('users','users.id','=' , 'services.user_id')
 
     ->select('services.id','services.name' )
     ->where('services.status',1)
     ->whereIn('services.cat_id',$orderCat)
     ->limit(6)
     ->inRandomOrder()->get();

    }

    else{
      $sidebarsection2=null;
    }
    }
     else{
      $sidebarsection2=null;
       $sidebarsection1=null;
        $sidebarsection3=null;

    }










     $array=[
    'services'=>$services,
    'cat'=>$cat,
    'cats'=>$cats,
    'sidebarsection1'=>$sidebarsection1,
    'sidebarsection2'=>$sidebarsection2,
    'sidebarsection3'=>$sidebarsection3,

     ];
     return $array;
 }
 abort(403);
 }
}
