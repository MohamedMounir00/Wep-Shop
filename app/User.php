<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public  function services(){

        return $this->hasMany('App\Service','user_id');
    }
    public  function comment(){

        return $this->hasMany('App\Comment','user_id');
    }
    public  function orderImade(){

        return $this->hasMany('App\Order','user_order');
    }

    public  function GetMyservicesOrder(){

        return $this->hasMany('App\Order','user_id');
    }
    public  function GetMyMessageAdd(){

        return $this->hasMany('App\Message','user_message_you');
    }
    public  function GetMyMessageResived(){

        return $this->hasMany('App\Message','user_id');
    }
    public function GetMyNotify(){

        return $this->hasMany('App\Notification','user_notify_you');
    }
    public function GetMyNotifaction(){

        return $this->hasMany('App\Notification','user_id');
    }
    public function vote(){

        return $this->hasMany('App\Vote','user_id');
    }
       public function Profit(){

        return $this->hasMany('App\Profit','user_id');
    }

}
