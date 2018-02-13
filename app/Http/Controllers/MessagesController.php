<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\User;
use App\Message;
use App\Notification;

class MessagesController extends Controller
{
  public function AddMessage(Requests\MessagesRequest $request)
   {
   	$user = Auth::user();
   	$resaveuser= User::findOrFail(intval($request->user_id));
   	if ($resaveuser) {
   	  if ($user->id != $resaveuser->id) {

   	  $message = new Message();
   	  $message ->user_message_you=$user->id;
   	  $message ->user_id = $request->user_id;
   	  $message ->message = $request->message;
   	  $message ->title   = $request->title;
   	  if ($message->save()) {
             MakeNewNotifaction($resaveuser->id , $user->id,'Reacvemessage' , $message->id);

        
   	  	return 'done';
   	  }
   	   abort(403);
   	  }
   	  abort(403);
   	}
   	abort(403);
   }

   public function GetMessageList()
   {
   	$user = Auth::user();
   return Message::where('user_message_you',$user->id)->with('getResivedUser')->orderBy('id','desc')->get();

   }


   public function  GetMyReseviedMessage()
   {
   	$user = Auth::user();
   return Message::where('user_id',$user->id)->with('getSendUser')->orderBy('id','desc')->get();

   }
public function    GetMyNewMessage()
   {
   	$user = Auth::user();
   return Message::where('user_id',$user->id)->where('seen',0)->with('getSendUser')->orderBy('id','desc')->get();

   }
public function    GetMyReadMessage()
   {
   	$user = Auth::user();
   return Message::where('user_id',$user->id)->where('seen',1)->with('getSendUser')->orderBy('id','desc')->get();

   }

   public function GetThisMessageDetiles($message_id){
$message = Message::findOrFail(intval($message_id));
if ($message) {
	$user = Auth::user();

	if ($user->id == $message->user_message_you || $user->id == $message->user_id) {
		 if ($message->seen == 0 && $user->id == $message->user_id ) {
  	$message->seen = 1;
  	$message->save();
  }
  //seen  
              MakeNotifactionSeen('Reacvemessage',$user->id,$message_id);

               
		return Message::where('id',$message_id)->with('getResivedUser','getSendUser')->get()[0];
	abort(403);}
}
	abort(403);
   }

}
   	    
