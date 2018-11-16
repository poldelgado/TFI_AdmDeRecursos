<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    protected $dates = ['date_order'];

    public function product(){
        return $this->belongsTo('App\Product');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function purchase_qualification(){
        return $this->hasOne(PurchaseQualification::class);
    }

    public function provider(){
        return $this->belongsTo('App\Provider');
    }


}
