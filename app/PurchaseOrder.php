<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    //

    public function product(){
        return $this->belongsTo('App\Product');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function buy_qualification(){
        return $this->belongsTo('App\PurchaseQualification');
    }

    public function provider(){
        return $this->belongsTo('App\Provider');
    }
}
