<?php
 
 function GetNumFav($user_id){
 	return \App\Favorite::where('user_id' ,$user_id)->count();
 }

  function GetAllPayOrders($user_id){
 	return \App\Order::where('user_order' ,$user_id)->where('status',0)->count();
 }

 function GetAllNot($user_id)
 {
 	 	return \App\Notification::where('user_id' ,$user_id)->where('seen',0)->count();

 }
  function GetAllNotObject($user_id)
 {
 	 //	return \App\Notification::where('user_id' ,$user_id)->where('seen',0)->with('GetUserSendNotication')->orderBy('id','desc')->get();
 	 	 	return \App\Notification::where('user_id' ,$user_id)->with('GetUserSendNotication')->orderBy('id','desc')->limit(7)->get();


 }

 function MakeNotifactionSeen($type , $userId ,$id){

 		$notifaction =\App\Notification::where('notify_id',$id)->where('type',$type)->where('seen',0)->where('user_id',$userId)->get();
						if(count($notifaction) >0)
							{
							if(count($notifaction) ==0)
							{
							$notifaction[0]->seen=1;
							$notifaction[0]->save();
						}else{
							foreach ($notifaction as $not ) {
								$n= \App\Notification::find($not->id);
								$n->seen=1;
								$n->save();
							}
						}
					}


 }
 function MakeUserNotifactionSeen($userId){

 		$notifaction =\App\Notification::where('seen',0)->where('user_id',$userId)->get();
						if(count($notifaction) >0)
							{
							if(count($notifaction) ==0)
							{
							$notifaction[0]->seen=1;
							$notifaction[0]->save();
						}else{
							foreach ($notifaction as $not ) {
								$n= \App\Notification::find($not->id);
								$n->seen=1;
								$n->save();
							}
						}
					}


 }
 function MakeNewNotifaction($user_id , $notify_id ,$type , $id){

                        $not = new \App\Notification();
						$not ->user_id        =$user_id ;
						$not ->user_notify_you=$notify_id ;
						$not ->type           =$type ;
						$not ->seen           =0;
						$not ->notify_id      =$id;
						$not ->save();
 }
