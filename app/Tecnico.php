<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tecnico extends Model
{
    //


    public function providers(){

        return $this->belongsToMany('App\Provider');

    }
}
