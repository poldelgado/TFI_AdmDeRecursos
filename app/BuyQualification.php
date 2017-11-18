<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuyQualification extends Model
{
    //
    public function buy_order(){
        return $this->belongsTo('App\BuyOrder');
    }
}
