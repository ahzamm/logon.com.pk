<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneralConfiguration extends Model
{
    protected $fillable = [
        'brand_logo', 'favicon', 'footer_logo', 'brand_name','site_footer', 'otp_status'
    ];
}
