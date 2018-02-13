<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\Service;
use App\User;
use App\Cat;
use App\Vote;

  use Intervention\Image\Facades\Image;


class AdminServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('admin');
    }
    public function index($status = null)
    {
        $limit =env('limt');
        if($status != null){
            $explode= explode('-',$status);
            $array = ['id-desc','id-asc','created_at-asc','created_at-desc'];

            if (in_array($status, $array)||$explode[0] == 'cat' ) {
                   if ($explode[0] =='cat' ) {
                      $services= Service::where('cat_id',$explode[1])->withCount('order')->with('user')->paginate($limit);

                   } 
                   else{
                  $services= Service::orderBy($explode[0],$explode[1])->withCount('order')->with('user')->paginate($limit);
                  }
            }
            else{
                $services= Service::where('status',$status)->withCount('order')->with('user')->paginate($limit);

        }

        }
        else{
               $services= Service::with('user')->withCount('order')->paginate($limit);

        }
        $cat= Cat::orderBy('id','desc')->get(['id','name']);
                return view('admin.services.all',compact('services','cat'));

            }

                 /**
            search     *
     * @return \Illuminate\Http\Response
     */
     public function serach(Request $request){
        $serach= strip_tags($request->serach);
                $services= Service::where('user_id',$serach)
                ->orwhere('name','LIKE','%'.$serach.'%')
                ->withCount('order')
                ->with('user')
                ->paginate(env('limt'));

                $cat= Cat::orderBy('id','desc')->get(['id','name']);
                return view('admin.services.all',compact('services','cat'));

            }
            
      public function accepteservices($service_id, $status)
      {
          $services= Service::findOrFail($service_id);
          if ($services) {
           if ($status == 1) {
            MakeNewNotifaction($services->user_id ,Auth::user()->id,'AdminAccepteServices' ,$services->id);

               }else{
            MakeNewNotifaction($services->user_id ,Auth::user()->id,'AdminRejectServices' ,$services->id);

               }
           $services->status = $status;
           $services->save();

         return redirect()->back();
          }

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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

      $services= Service::where('id',$id)
      ->with('user','cat','order')
      ->withCount('view','vote')
      ->get()[0];
      $sum = Vote::where('services_id',$id)->sum('vote');
     $cat= Cat::where('id','!=',$services->cat_id)->orderBy('id','desc')->get(['id','name']);

       return view('admin.services.edit',compact('services','cat' ,'sum'));

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
   
    $services= Service::findOrFail($id);
      $user=User::find($services->user_id);
    $image = $this->UploadImage($user->name ,$request);
    $services->name=$request->name;
    $services->des=$request->des;
    $services->cat_id=$request->cat_id;
    $services->price=$request->price;
    $services->image = $image ;
    $services->save();
     return redirect()->back();




            }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($service_id)
    {
       $services= Service::findOrFail($service_id);
       $services->delete();
               return redirect()->back();

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

 public function getServicesByUser($id){
        $limit =env('limt');

       $services= Service::where('user_id',$id)->with('user')->withCount('order')->paginate($limit);

       
        $cat= Cat::orderBy('id','desc')->get(['id','name']);
                return view('admin.services.all',compact('services','cat'));
                }
}
