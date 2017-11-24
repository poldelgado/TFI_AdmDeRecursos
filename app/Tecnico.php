<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tecnico extends Model
{
    //


    public function provider(){

        return $this->belongsToMany('App\Provider');

    }
}
