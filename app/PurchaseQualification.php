<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseQualification extends Model
{
    //
    public function buy_order(){
        return $this->hasOne('App\PurchaseOrder');
    }
}
