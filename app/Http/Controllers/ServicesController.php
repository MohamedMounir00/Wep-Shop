<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;
use App\Service;
use App\User;
use App\View;
use App\Order;
use App\Vote;
use DB;
use App\Cat;

use Intervention\Image\Facades\Image;
class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Addservices(Requests\AddServices $request)
    {
      $user=Auth::user();
      $array = [5,10,20,30];
      if (in_array($request->price ,$array))
      {
        $image = $this->UploadImage($user->name ,$request);
        $services = new Service();
        $services->name = $request->name;
        $services->des = $request->des;
        $services->image = $image ;
        $services->cat_id = $request->cat_id;
        $services->price = $request->price;
        $services->user_id = $user->id;
        $services->status=0;

        if ($services->save())
          {  return 'done';
      }else
      {
        return 'error';
      }




    }
    return 'checkpricefiled';
  }
  protected function UploadImage ($username, $request,$url='' )
  {
    if ($url=='')
    {
      $url = public_path().'/images/services/';
    }
    $image= $request->file('image');
    $imageName= time().'_'.$username.$image->getClientOriginalName();

            // read image from temporary file
    $img = Image::make($image);

              // resize image
    $img->fit(800, 400);

               // save image
    $img->save($url.$imageName,60);
    return $imageName;
  }
  public function getMyservices($length = null)
  {
    $user= Auth::user();
 $query=DB::table('services');
    
     $query->join('users','users.id','=' , 'services.user_id');
    $query->leftJoin('views','services.id','=' ,'views.service_id');
    $query->where('services.user_id',$user->id);
     $query->select('services.id','services.name','services.image' ,'services.status','services.des','services.price','services.user_id'
      ,DB::raw('users.name as username'),
     DB::raw('COUNT(views.id) as view_count'));
     $query->groupBy('services.id');

     //$query->where('services.status',1);
      //->having('vote_sum' , '>', 0)
      //->limit(6)
     $query->orderBy('services.id','desc');
      if ($length == null) {
         $query->limit(env('limt'));
      }else{
         $query->offset($length)->limit(env('limt'));
      }
         $services=$query->get();
    return $array=[
    'user'=>$user,
    'services'=>$services
    ];
  }

  public  function GetServicesById($services_id)
  {

       // get data for 
    $service= Service::where('id',$services_id)->with('user')->withCount('vote')->get()[0];
          // add new view
    $ip=$_SERVER['REMOTE_ADDR'];
    $guest= Auth::guest();
    if (View::where('ip',$ip)->where('service_id' ,$service->id)->count()==0) {


      
      $view= new View();
      $view->service_id=$services_id;
      if ($guest) {
        $view->user_id=0;

      }else
      {
        $view->user_id=Auth::user()->id;
      }
      $view->ip=$ip;
      $view->save();
    }
    $sum = Vote::where('services_id', $service->id)->sum('vote');
    if ($service->status != 1) {
      if (Auth::guest()) {
        abort(403);
      }
      else{

        if (Auth::user()->id != $service->user_id) {

          abort(403);
        }
      }
    }
    if (!Auth::guest()) {
      # code...

      $user=Auth::user();
      $myOwnServicesIntheCat=
      Service::where('cat_id',$service->cat_id)
      ->where('id','!=',$service->id)
      ->where('user_id',$user->id)
      ->with('user')->withCount('view')
      ->orderBy('id','desc')
      ->limit(6)->get();

      $otherServicesIntheCat=
      Service::join('users','users.id','=' , 'services.user_id')
      ->leftJoin('votes','services.id','=' ,'votes.services_id')
      ->select('services.*' ,DB::raw('SUM(votes.vote) as vote_sum'),
        DB::raw('users.name as username'),
        DB::raw('COUNT(votes.vote) as vote_count'))
      ->where('services.cat_id',$service->cat_id)
      ->where('services.user_id','!=',$user->id)
      ->where('services.id','!=',$service->id)
      ->groupBy('services.id')
      ->where('services.status',1)->limit(6)
      ->orderBy('services.id','desc')->get();






    }else{
      $myOwnServicesIntheCat=[];
      $otherServicesIntheCat=[];

    }
          $order_count= Order::where('services_id',$service->id)->whereIn('status',[4,2,1,0])->count();

    $mostvote=
    Service::join('users','users.id','=' , 'services.user_id')
    ->leftJoin('votes','services.id','=' ,'votes.services_id')
    ->select('services.id','services.name' ,DB::raw('SUM(votes.vote) as vote_sum'))
      // DB::raw('COUNT(votes.vote) as vote_count')
    ->where('services.cat_id',$service->cat_id)
      //->where('services.user_id','!=',$user->id)
    ->where('services.id','!=',$service->id)
    ->groupBy('services.id')
    ->where('services.status',1)
    ->having('vote_sum' , '>', 0)
    ->limit(6)
    ->orderBy('vote_sum','desc')->get();

    $mostview=
    Service::join('users','users.id','=' , 'services.user_id')
    ->leftJoin('views','services.id','=' ,'views.service_id')
    ->select('services.id','services.name' ,DB::raw('COUNT(views.id) as view_count'))
      // DB::raw('COUNT(votes.vote) as vote_count')
    ->where('services.cat_id',$service->cat_id)
      //->where('services.user_id','!=',$user->id)
    ->where('services.id','!=',$service->id)
    ->groupBy('services.id')
    ->where('services.status',1)
    ->having('view_count' , '>', 0)
    ->limit(6)
    ->orderBy('view_count','desc')->get();
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

    $array=[
    'service'=>$service,
    'myOwnServicesIntheCat'=>$myOwnServicesIntheCat,
    'otherServicesIntheCat'=>$otherServicesIntheCat,
    'order_count'=>$order_count,
    'sum'=>$sum,
    'mostvote'=>$mostvote,
    'mostview'=>$mostview,
    'sidebarsection2'=>$sidebarsection2
    ];
    return $array;
  }


  public function getUserServices($user_id ,$length = null){
    $user_id = intval($user_id);
    $user= User::findOrfail($user_id);
    if ($user) {
       $query=DB::table('services');
     $query->join('users','users.id','=' , 'services.user_id');
      $query->leftJoin('votes','services.id','=' ,'votes.services_id');
      $query->select('services.*' ,DB::raw('SUM(votes.vote) as vote_sum'),
        DB::raw('users.name as username'),
        DB::raw('COUNT(votes.vote) as vote_count'));
      $query->where('services.user_id', $user->id);
      $query->groupBy('services.id');
      $query->where('services.status',1);
      $query->orderBy('services.id','desc');
   if ($length == null) {
         $query->limit(env('limt'));
      }else{
         $query->offset($length)->limit(env('limt'));
      }
         $services=$query->get();
      $array=[
      'user'=>$user,
      'services'=>$services

      ];
      return $array;

    }
    

  }
      public function getAllServices($length = null)
    {
 $query=DB::table('services');
    
     $query->join('users','users.id','=' , 'services.user_id');
     $query->leftJoin('votes','services.id','=' ,'votes.services_id');
     $query->select('services.id','services.name','services.image' ,'services.price','services.user_id'
      ,DB::raw('users.name as username')
      ,DB::raw('SUM(votes.vote) as vote_sum')
      ,DB::raw('COUNT(votes.vote) as vote_count'));
     $query->groupBy('services.id');
     $query->where('services.status',1);
      //->having('vote_sum' , '>', 0)
      //->limit(6)
     $query->orderBy('vote_sum','desc');
      if ($length == null) {
         $query->limit(env('limt'));
      }else{
         $query->offset($length)->limit(env('limt'));
      }
         $services=$query->get();
    //all cat
         if ($length == null) {
     //$cats= Cat::orderBy('id','desc')->get(['id','name']);

      //realsed services

     $ip=$_SERVER['REMOTE_ADDR'];
     $checkviewbefor = View::where('ip',$ip)->count();
     if ($checkviewbefor == 0) {

          //mostview

      $sidebarsection1= Service::join('users','users.id','=' , 'services.user_id')
      ->leftJoin('views','services.id','=' ,'views.service_id')
      ->select('services.id','services.name' ,DB::raw('COUNT(views.id) as view_count'))

      ->groupBy('services.id')
      ->where('services.status',1)
      //->having('view_count' , '>', 0)
      ->limit(6)
      ->orderBy('view_count','desc')->get();

     
    }
    else{
     $catview= View::join('services' , 'views.service_id' ,'=' ,'services.id' )
     ->where('ip',$ip)
     ->lists('services.cat_id')->all();

     $sidebarsection1= Service::join('users','users.id','=' , 'services.user_id')
     ->leftJoin('views','services.id','=' ,'views.service_id')
     ->select('services.id','services.name' ,DB::raw('COUNT(views.id) as view_count'))

     ->groupBy('services.id')
     ->where('services.status',1)
     ->whereIn('services.cat_id',$catview)
      //->having('view_count' , '>', 0)
     ->limit(6)
     ->orderBy('view_count','desc')->get();
   }
    /// mostpaying
        $sidebarsection3= 
      Service::leftJoin('orders','services.id','=' ,'orders.services_id')
      ->select('services.id','services.name' ,DB::raw('COUNT(orders.id) as orders_count'))

      ->groupBy('services.id')
      ->where('services.status',1)
      //->where('services.cat_id',$cat_id)
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
   //'cats'=>$cats,
   'sidebarsection1'=>$sidebarsection1,
   'sidebarsection2'=>$sidebarsection2,
   'sidebarsection3'=>$sidebarsection3,
   ];
   return  $array;  

 }
}
