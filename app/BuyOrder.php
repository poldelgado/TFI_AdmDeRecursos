<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuyOrder extends Model
{
    //

    public function product(){
        return $this->belongsToMany('App\Product');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function buy_qualification(){
        return $this->hasOne('App\BuyQualification');
    }
}
