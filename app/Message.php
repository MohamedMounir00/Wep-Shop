<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table="messages";
public  function getSendUser(){
    return $this->belongsTo('App\User','user_message_you');
}
    public  function getResivedUser(){
        return $this->belongsTo('App\User','user_id');
    }
}
