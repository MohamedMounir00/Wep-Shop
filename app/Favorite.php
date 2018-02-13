<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    	protected $table="favorites";
    	public function user(){
    		return $this->belongsTo('App\User','user_id');
    	}
    	public function GetuserServises(){
    		return $this->belongsTo('App\User','user_service');
    	}
    	public function services(){
    		return $this->belongsTo('App\Service','service_id');
    	}
}
