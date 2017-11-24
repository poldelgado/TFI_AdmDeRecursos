<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Provider extends Model
{
    //


    public function tecnico()
    {
        return $this->belongsToMany('App\Tecnico');
    }

    public function product()
    {
        return $this->belongsToMany('App\Product');
    }

    public function provider_qualification()
    {
        return $this->belongsTo('App\ProviderQualification');
    }
}
