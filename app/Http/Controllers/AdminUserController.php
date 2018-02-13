<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Order;
use App\Service;
use App\User;
use Auth;
  use Intervention\Image\Facades\Image;

class AdminUserController extends Controller
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
                $users= User::withCount('services','orderImade','GetMyservicesOrder')->paginate($limit);
                
                return view('admin.users.all',['users'=>$users]);    
    }

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
            $users= User::orderBy($expload[0],$expload[1])
                ->paginate($limit);
        }else{
            $users= User::where('admin',$status)
                ->paginate($limit);
        }

        return view('admin.users.all',compact('users'));


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users= User::where('id',$id)->get()[0];
        $services= Service::where('user_id',$users->id)->get();
        $orders= Order::where('user_id',$users->id)->get();
        $myorders= Order::where('user_order',$users->id)->get();


       return view('admin.users.edit',compact('users','services','orders','myorders'));
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
        
        $user= User::findOrFail($id);
         $image = $this->UploadImage($user->name ,$request);

        if ($user) {
            $user->name=$request->name;
            $user->email=$request->email;
            $user->admin=$request->admin;
            if ($user->image !='') {
                  if ($request->file('image')) {
                $url = public_path().'/images/users/';
                if (file_exists($url.$user->image)) {
                   @unlink($url.$user->image);
                }
                $user->image = $image ;
            }
            
            }
          
            $user->save();

        }

        return redirect()->back();
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
                $users= User::where('id',$serach)
                ->orwhere('name','LIKE','%'.$serach.'%')
               ->paginate(env('limt'));  

                
        return view('admin.users.all',compact('users'));

            }
               protected function UploadImage ($username, $request,$url='' )
                {
                  if ($url=='')
                  {
                    $url = public_path().'/images/users/';
                  }
                  $image= $request->file('image');
                  $imageName= time().'_'.$username.$image->getClientOriginalName();

                          // read image from temporary file
                  $img = Image::make($image);

                            // resize image
                  $img->fit(100,100);

                             // save image
                  $img->save($url.$imageName,60);
                  return $imageName;
                }

}
