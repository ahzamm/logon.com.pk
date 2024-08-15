<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function coreAreas()
    {
        return $this->hasMany('App\Models\CoreArea');
    }
    public function coverageRequests()
    {
        return $this->hasMany('App\Models\CoverageRequest');
    }
}
