<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table="notifications";
    public function GetUserSendNotication()
    {
        return $this->belongsTo('App\User','user_notify_you');
    }
    public function GetUserResivedNotication()
    {
        return $this->belongsTo('App\User','user_id');
    }

}
