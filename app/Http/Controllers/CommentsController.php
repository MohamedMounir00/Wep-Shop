<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Order;
use App\Comment;
use App\Http\Requests;

class CommentsController extends Controller
{
    public function AddComment(Requests\CommentsRequest $request){

    	$user= Auth::user();
    	$order= Order::findOrFail($request->order_id);
   if ($order) {
    	if ($user->id == $order->user_id || $user->id == $order->user_order) {
    	  $comment = new Comment();
    	   $comment->user_id=$user->id;
    	    $comment->comment =strip_tags($request->comment);
    	     $comment->order_id=intval($request->order_id) ;
    	      if ($comment->save()) {
                if ($user->id == $order->user_id) {
                    // comment by owner services
                     MakeNewNotifaction($order->user_order , $user->id,'AddComment' , $order->id);
                }else{
                   MakeNewNotifaction($order->user_id , $user->id,'AddComment' , $order->id);

                }
    	      	return Comment::where('id',$comment->id)->with('user')->get()[0];
    	      }
    	        abort(403);
    	}
    	  abort(403);
   }
   abort(403);
    }

    public function GetAllComment($order_id){


    	return Comment::where('order_id' ,$order_id)->with('user')->orderBy('id','desc')->get();

    }
 }
