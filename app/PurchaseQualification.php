<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseQualification extends Model
{
    //
    public function purchase_order(){
        return $this->belongsTo('App\PurchaseOrder');
    }
}
