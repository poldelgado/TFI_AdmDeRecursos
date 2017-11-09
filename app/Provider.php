<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Provider extends Model
{
    //


    public function tecnicos()
    {
        return $this->belongsToMany('App\Tecnico');
    }
}
