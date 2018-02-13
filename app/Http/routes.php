<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

   Route::get('/', function () {
    return view('welcome');
   });

   Route::auth();
Route::group( ['prefix' => 'admin','middleware' => 'admin'], function () {
	  Route::get('/', 'AdminController@index');
	  Route::get('/services/{status?}', 'AdminServicesController@index');
	  Route::post('/services', 'AdminServicesController@serach');
	  Route::get('/accepteservices/{service_id}/{status}', 'AdminServicesController@accepteservices');
	  Route::get('/delete/{service_id}', 'AdminServicesController@delete');
	  Route::get('/services/getByUser/{id}', 'AdminServicesController@getServicesByUser');

	 // Route::get('/services/{service_id}/edit', 'AdminServicesController@edit');
	  Route::resource('/services', 'AdminServicesController' , ['only'=>['update','edit']]);
	  Route::resource('/orders', 'AdminOrderController');
	  Route::post('/orders/search', 'AdminOrderController@serach');
	  Route::get('/orders/delete/{id}', 'AdminOrderController@delete');
      Route::get('/comment/{id}/delete', 'AdminOrderController@deletecomment');
	  Route::post('/orders/changOrderStatus', 'AdminOrderController@changOrderStatus');
      Route::get('/orders/getAllOrdersSold/{id}', 'AdminOrderController@getAllOrdersSold');
      Route::get('/orders/getMyorders/{id}', 'AdminOrderController@getMyorders');
      Route::get('/orders/getUsersorders/{id}', 'AdminOrderController@getUsersorders');

      
	  Route::resource('/user', 'AdminUserController');
	  Route::post('/user', 'AdminUserController@serach');
	  Route::resource('/profits', 'AdminProfitContrllser');
	  Route::post('/profits', 'AdminProfitContrllser@serach');
	  Route::get('/profits/user/{user_id}/{status}', 'AdminProfitContrllser@getUserProfirStatus');
	  Route::get('/getToDayOrderProfits/{status?}', 'AdminProfitContrllser@getToDayOrderProfits');

	  Route::post('/getOrderProfitsByDate', 'AdminProfitContrllser@getOrderProfitsByDate');
	  Route::get('/AddSendMoney/{id}', 'PaypalController@AddSendMoney');



   });

Route::group( ['middleware' => 'auth'], function () {

	Route::post('/addservices','ServicesController@Addservices');
	Route::post('/AddComment/','CommentsController@AddComment');
	Route::post('/AddMessage/','MessagesController@AddMessage');
	Route::get('/getMyservices/{length?}','ServicesController@getMyservices');
	Route::get('/AddOrder/{services_id}','OrderController@AddOrder');
	Route::get('/Addfav/{services_id}','Favoritecontroller@Addfav');
	Route::get('/GetMyFav','Favoritecontroller@GetMyFav');
	Route::get('/Deletefav/{id}','Favoritecontroller@Deletefav');
	Route::get('/GetMySendOrders/{length?}','OrderController@GetMySendOrders');
	Route::get('/GetMyIncomeOrders/{length?}','OrderController@GetMyIncomeOrders');
	Route::get('/GetOrderById/{order_id}','OrderController@GetOrderById');
	Route::get('/GetAllComment/{order_id}','CommentsController@GetAllComment');
	Route::get('/ChangStatus/{order_id}/{status}','OrderController@ChangStatus');
	Route::get('/finshOrder/{order_id}','OrderController@finshOrder');
	Route::get('/GetMessageList/','MessagesController@GetMessageList');
	Route::get('/GetMyReseviedMessage/','MessagesController@GetMyReseviedMessage');
	Route::get('/GetMyNewMessage/','MessagesController@GetMyNewMessage');
	Route::get('/GetMyReadMessage/','MessagesController@GetMyReadMessage');
	Route::get('/GetThisMessageDetiles/{message_id}','MessagesController@GetThisMessageDetiles');
	Route::get('/AddNewVote/{val}/{service_id}','Votecontroller@AddNewVote');
	Route::get('/GetAuthUser','Userscontroller@GetAuthUser');
	Route::post('/AddCartItme','PaypalController@AddCartItme');
	Route::get('/GetAllShowChearg','PaypalController@GetAllShowChearg');
	Route::get('/ShowAllPay','PaypalController@ShowAllPay');
	Route::get('/ShowAllProfit','PaypalController@ShowAllProfit');
	Route::get('/ShowAllBlance','PaypalController@ShowAllBlance');
	Route::post('/Getprofit','PaypalController@Getprofit');
	Route::get('/RetainedProfits','PaypalController@RetainedProfits');
	Route::get('/DoneCharge','PaypalController@DoneCharge');
	Route::get('/ErorrCharage','PaypalController@ErorrCharage');



	
	Route::get('/GetNotifaction','NoticationControler@GetNotifaction');
	Route::get('/notAll','NoticationControler@notAll');
});

Route::get('/home', 'HomeController@index');
Route::get('/getAllServices/{length?}','ServicesController@getAllServices');
Route::get('/GetServicesById/{services_id}','ServicesController@GetServicesById');
Route::get('/getUserServices/{user_id}/{length?}','ServicesController@getUserServices');
Route::get('/getServicesByCat/{cat_id}/{length?}','Catcontroller@getServicesByCat');
Route::get('/GetAllNot','NoticationControler@GetAllNot');



















