<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\PayInfo;
use App\buy;
use App\User;
use App\Profit;
class AdminProfitContrllser extends Controller
{
      public function __construct(){
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
                   $limit =env('limt');
                $profits= Profit::with('user')->paginate($limit);
                return view('admin.profits.all',compact('profits'));    }

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
              $profits= Profit::orderBy($expload[0],$expload[1])
               ->with('user')
               ->paginate($limit); 
            }else{
               $profits= Profit::where('status',$status)
               ->with('user')
               ->paginate($limit);                   
           }  
          

       
                return view('admin.profits.all',compact('profits'));    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    public function destroy($id)
    {
        //
    }
      public function serach(Request $request){
        $serach= strip_tags($request->serach);
                $profits= Profit::where('id',$serach)
                ->with('user')
               ->paginate(env('limt'));  

                
                return view('admin.profits.all',compact('profits'));    

            }

             public function getOrderProfitsByDate(Request $request){
            $date= str_replace('/', '-',$request->serach);
            $date=(new \Moment\Moment($date, 'CET'))->subtractDays(env('profitDay'))->format('Y-m-d');
            $profits= Profit::where('created_at' , '>' , $date.' 00:00:00')
            ->where('created_at' , '<' , $date. ' 23:59:59') 
            
            ->paginate(env('limt'));  
 

                
                return view('admin.profits.all',compact('profits'));    

            }

            
            public function getUserProfirStatus($user_id , $status){

            $profits= Profit::where('user_id',$user_id)->where('status',$status)
                ->with('user')
               ->paginate(env('limt'));  

                
                return view('admin.profits.all',compact('profits'));  

            }
            public function getToDayOrderProfits($status =null){
                
             $date=(new \Moment\Moment('@'.time(), 'CET'))->subtractDays(env('profitDay'))->format('Y-m-d');
                
        if ($status ==null) {
      $profits= Profit::where('created_at' , '>' , $date.' 00:00:00')
            ->where('created_at' , '<' , $date. ' 23:59:59') 
            ->paginate(env('limt'));
                }

            $profits= Profit::where('created_at' , '>' , $date.' 00:00:00')
            ->where('created_at' , '<' , $date. ' 23:59:59')->where('status',$status) 
            ->paginate(env('limt'));  

               
                return view('admin.profits.all',compact('profits')); 

}
    
}
