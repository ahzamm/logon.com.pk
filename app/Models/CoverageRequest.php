<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoverageRequest extends Model
{
    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }
    public function coreArea()
    {
        return $this->belongsTo('App\Models\CoreArea');
    }
    public function zoneArea()
    {
        return $this->belongsTo('App\Models\ZoneArea');
    }
}
