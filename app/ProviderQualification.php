<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProviderQualification extends Model
{
    //
    public function provider()
    {
        return $this->hasOne('App\Providers');
    }
}
