<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{
    protected $table="cats";
    public  function service(){
        return $this->hasMany('App\Service','cat_id');
    }

}
