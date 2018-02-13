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
use App\Comment;
class AdminOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
      public function __construct(){
        $this->middleware('admin');
    }

     public function index()
    {
             $limit =env('limt');
                $orders= Order::with('GetMyOrders','GetUserAddSerivecs','service')->paginate($limit);
                return view('admin.orders.all',compact('orders'));

    }

                 /**
            search     *

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
        public function show($status)
    {
             $limit =env('limt');
             $expload= explode('-', $status);
            $array = ['id','created_at'];

            if (in_array($expload[0], $array)) {
              $orders= Order::orderBy($expload[0],$expload[1])
               ->with('GetMyOrders','GetUserAddSerivecs','service')
               ->paginate($limit); 
            }else{
               $orders= Order::where('status',$status)
               ->with('GetMyOrders','GetUserAddSerivecs','service')
               ->paginate($limit);                   
           }  
          

       
                return view('admin.orders.all',compact('orders'));

   
    }

  public function serach(Request $request){
        $serach= strip_tags($request->serach);
                $orders= Order::where('id',$serach)
                ->with('GetMyOrders','GetUserAddSerivecs','service')
               ->paginate(env('limt'));  

                
                return view('admin.orders.all',compact('orders'));

            }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order= Order::where('id',$id)->with('GetMyOrders','GetUserAddSerivecs','service','comment')->get()[0];
//dd($orders);
       
                return view('admin.orders.edit',compact('order'));

            }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        Order::findOrFail($id)->delete();
        return redirect()->back();

    }
     public function deletecomment($id)
    {
        Comment::findOrFail($id)->delete();
        return redirect()->back();

    }
     public function changOrderStatus(Request $request)
    {
        $order=Order::findOrFail($request->order_id);
         $service=Service::findOrFail($order->services_id);

        if ($order) {
            if ($request->status != 4) {
                buy::where('order_id',$request->order_id)
                ->where('user_id',$request->rev_id)
                ->where('rev_id',$request->user_id)
                ->delete();
            }else{
                if (buy::where('order_id',$request->order_id)
                ->where('user_id',$request->rev_id)
                ->where('rev_id',$request->user_id)->count()==0) {

                    $buy =new buy();
                    $buy->rev_id=$request->user_id;
                    $buy->user_id=$request->rev_id;
                    $buy->buy_price=$service->price;
                    $buy->order_id=$order->id;
                    $buy->finish=1;
                    $buy->save();
                }


            }
            $user= Auth::user();
            if ($request->status==0) {
                $status='AdminMakeNew';
            }elseif ($request->status==1) {
                $status='AdminMakeOld';

            }elseif ($request->status==2) {
                $status='AdminMakeAccepte';

            }elseif ($request->status==3) {
                $status='AdminMakeReject';

            }elseif ($request->status==4) {
                $status='AdminMakeFinsh';
            }
            MakeNewNotifaction($order->user_order, $user->id,$status,$order->id);
            MakeNewNotifaction($order->user_id, $user->id,$status,$order->id);

            $order->status=$request->status;
            $order->save();
          }
          return redirect()->back();

    }
    //  جميع الطابات التى تم  طلبها بداخل الخدمه الواحده
    public function getAllOrdersSold($id){
  $limit =env('limt');
                $orders= Order::where('services_id',$id)->with('GetMyOrders','GetUserAddSerivecs','service')->paginate($limit);
                return view('admin.orders.all',compact('orders'));
    }

    
      public function getMyorders($id)
    {
             $limit =env('limt');
                $orders= Order::where('user_order',$id)->with('GetMyOrders','GetUserAddSerivecs','service')->paginate($limit);
                return view('admin.orders.all',compact('orders'));

    }


        public function getUsersorders($id)
    {
             $limit =env('limt');
                $orders= Order::where('user_id',$id)->with('GetMyOrders','GetUserAddSerivecs','service')->paginate($limit);
                return view('admin.orders.all',compact('orders'));

    }
    
}
