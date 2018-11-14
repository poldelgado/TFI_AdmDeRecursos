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

    public function purchaseOrders()
    {
        return $this->hasMany('App\PurchaseOrder');
    }

    public function getQualification() {
        return $this->purchaseOrders()->average('average');
    }
}
