<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoreArea extends Model
{
    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }
    public function zoneAreas()
    {
        return $this->hasMany('App\Models\ZoneArea');
    }
    public function coverageRequests()
    {
        return $this->hasMany('App\Models\CoverageRequest');
    }
}
