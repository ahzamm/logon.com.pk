<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ZoneArea extends Model
{
    public function coreArea()
    {
        return $this->belongsTo('App\Models\CoreArea');
    }
    public function coverageRequests()
    {
        return $this->hasMany('App\Models\CoverageRequest');
    }
}
