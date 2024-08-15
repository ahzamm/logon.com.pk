<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    public function job_post()
    {
        return $this->belongsTo(Job::class);
    }
}
