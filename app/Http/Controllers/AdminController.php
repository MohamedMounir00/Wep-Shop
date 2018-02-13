<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\Profit;
use App\Service;
use App\Order;
use App\User;



class AdminController extends Controller
{
    public function index(){

    		
			    	//Profit
    	$websiteprofit =  Profit::sum('webite_profit');
    	 $userprofit =  Profit::sum('profit_price');

    	 //services
    	 $services = Service::count();
    	 $servicesWaiting = Service::where('status',0)->count();
    	 $servicesDone = Service::where('status',1)->count();

    	 	//order
/**
					* 0--- طلب جديد
					* 1--- طلب قديم
					* 2---تمت الموافقه على الطلب
					* 3--- تم الغاء الطلب
					* 4---تم انهاء الطلب
					
			    	*/

			    	$orders = Order::count();
			    	$orderNew = Order::where('status',0)->count();
			    	$orderOld = Order::where('status',1)->count();
			    	$orderDone = Order::where('status',4)->count();
			    	$orderWatiing = Order::where('status',2)->count();
			    	$orderCansel = Order::where('status',3)->count();
			    	//Users
			    	$Allusers = User::count();
			    	$usersM = User::where('admin',1)->count();
			    	$users = User::where('admin',0)->count();

    	return  view('admin.pages.index',compact('websiteprofit',
    		'userprofit',
    		'services',
    		'servicesWaiting',
    		'servicesDone',
    		'orders',
    		'orderNew',
    		'orderOld',
    		'orderDone',
    		'orderWatiing',
    		'orderCansel',
    		'Allusers',
    		'usersM',
    		'users'

    		));
    }
}
