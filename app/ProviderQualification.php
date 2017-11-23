<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProviderQualification extends Model
{
    //
    public function providers()
    {
        return this->$this->belongsTo('App\Providers');
    }
}
