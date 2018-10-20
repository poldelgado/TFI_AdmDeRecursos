<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Provider extends Model
{
    //


    public function technicians()
    {
        return $this->belongsToMany('App\Technician');
    }

    public function products()
    {
        return $this->belongsToMany('App\Product');
    }

    public function provider_qualification()
    {
        return $this->belongsTo('App\ProviderQualification');
    }

    public function purchase_order()
    {
        return $this->hasOne('App\PurchaseOrder');
    }
}
