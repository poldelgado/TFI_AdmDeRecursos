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

    public function products()
    {
        return $this->belongsToMany('App\Product');
    }

    public function provider_qualification()
    {
        return $this->belongsTo('App\ProviderQualification');
    }

    public function buy_order()
    {
        return $this->hasOne('App\BuyOrder');
    }
}
