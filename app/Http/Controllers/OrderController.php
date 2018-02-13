<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Order;
use App\Service;
use Auth;
use App\User;
use App\buy;
use App\PayInfo;
use App\Notification;
use App\Profit;
class OrderController extends Controller
{
    //
	public function AddOrder($services_id){

			    	/**
					* 0--- طلب جديد
					* 1--- طلب قديم
					* 2---تمت الموافقه على الطلب
					* 3--- تم الغاء الطلب
					* 4---تم انهاء الطلب
					
			    	*/
					$services =Service::findOrFail($services_id);
					if ($services) {
						$user=Auth::user();

						if ($user->id !=$services->user_id) {
							$orderitBefore=Order::where('user_order',$user->id)->whereIn('status',[1,2,0])->where('services_id',$services->id)->count();
							if ($orderitBefore == 0) {
								$buyCheck = buy::where('user_id' ,$user->id)->where('finish','!=',2)->sum('buy_price');
								$pay =PayInfo::where('user_id' ,$user->id)->sum('price');
								$proft = Profit::where('user_id' ,$user->id)->sum('profit_price'); 
								$realProfit=buy::where('rev_id' ,$user->id)->where('finish',1)->sum('buy_price');
								$ifUserHaveMoney= ($pay + $realProfit) - ($buyCheck + $proft);

								if ($ifUserHaveMoney >= $services->price) {
									$orders = new Order();
									$orders->services_id=$services->id;
									$orders->user_order =$user->id;
									$orders->user_id    =$services->user_id;
									$orders->type       =0;
									$orders->status     =0;
									if ($orders->save()) {
										$buy = new buy();
										$buy->user_id  = $user->id;
										$buy->order_id =$orders   ->id;
										$buy->buy_price= $services->price;
										$buy->finish   =0;
										$buy->rev_id   =$orders   ->user_id;
										$buy->save();

						 MakeNewNotifaction($services->user_id , $user->id,'ReacveOrder' , $orders->id);




										return 'true';
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

				public function GetMySendOrders($length = null){

					$user= Auth::user();
					if ($length == null) {
						$services= Order::where('user_order',$user->id)->with('service','GetUserAddSerivecs')->orderBy('id','desc')->limit(env('limt'))->get();
					}else{
						$services= Order::where('user_order',$user->id)->with('service','GetUserAddSerivecs')->orderBy('id','desc')->offset($length)->limit(env('limt'))->get();
					}
					$array=[
					'user'=>$user,
					'services'=>$services
					];
					return $array;
				}

				public function GetOrderById($order_id){
					$authuser=Auth::user();
					$order= Order::findOrFail($order_id);
					if($order){
						$user_id= User::where('id',$order->user_id)->with(['services'=> function($query){
							return $query->where('status',1)->limit(3)->orderBy('id','desc');
						}])->get()[0];

						$order_user= User::where('id',$order->user_order)->with(['services'=> function($query){
							return $query->where('status',1)->limit(3)->orderBy('id','desc');
						}])->get()[0];

						if ($user_id->id != $order_user->user_order) {
							if ($authuser->id == $user_id->id ) {
								if ($order->status== 0) {
								$order->status=1; // change a status from new to old atumatic
								$order->save();
							}

						}
						$order= Order::where('id',$order_id)->with('service')->get()[0];
						$order_count= Order::where('services_id',$order->services_id)->whereIn('status',[4,2,1,0])->count();
						
								//seen  
						MakeNotifactionSeen('ReacveOrder',$authuser->id,$order_id);
						MakeNotifactionSeen('ComplateOrder',$authuser->id,$order_id);
						MakeNotifactionSeen('RejectOrder',$authuser->id,$order_id);
						MakeNotifactionSeen('DoneOrder',$authuser->id,$order_id);
					    MakeNotifactionSeen('AddComment',$authuser->id,$order_id);


						$array =[
						'user_id'=>$user_id,
						'order_user'=>$order_user,
						'order'=>$order,
						'order_count'=>$order_count,
						'auth_user'=>$authuser
						];
						return $array;

					}
					abort(403);

				}

				abort(403);


			}
			public function GetMyIncomeOrders($length = null){

				$user= Auth::user();
				if ($length == null) {
					$services= Order::where('user_id',$user->id)->with('service','GetMyOrders')->orderBy('id','desc')->limit(env('limt'))->get();
				}else{
					$services= Order::where('user_id',$user->id)->with('service','GetMyOrders')->orderBy('id','desc')->offset($length)->limit(env('limt'))->get();
				}
				$array=[
				'user'=>$user,
				'services'=>$services
				];
				return $array;
			}
			public function ChangStatus($order_id , $status )
			{
				$user= Auth::user();

				$order = Order::findOrFail(intval($order_id ));
				if ($order) {
					if($user->id == $order->user_id)
					{
						$array= [2,3];
						if (in_array($status, $array)) {
							if ($status != $order->status) {
								$order->status=intval($status);
								if ($status == 3) {
									

									$buy = buy::where('order_id', $order_id)->get()[0];
									$buy->finish=2;
									$buy->save();
								}
								if ($order->save()) {

									if($status == 2){
							    MakeNewNotifaction($order->user_order , $user->id,'DoneOrder' , $order->id);

									}else{
								 MakeNewNotifaction($order->user_order , $user->id,'RejectOrder' , $order->id);

									}
								
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
			public function finshOrder($order_id){
				$user= Auth::user();
				$order = Order::findOrFail(intval($order_id ));
				if($order){
					if ($user->id == $order->user_order) {
						if ($order->status ==2) {
							$order->status=4;
							$buy = buy::where('order_id', $order_id)->get()[0];
							$buy->finish=1;
							$buy->save();
							if ($order->save()) {

						     MakeNewNotifaction($order->user_id , $user->id,'ComplateOrder' , $order->id);

								
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

		}


