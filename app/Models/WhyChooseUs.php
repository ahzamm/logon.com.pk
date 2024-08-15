<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhyChooseUs extends Model
{
    protected $table = 'why_choose_us';
    protected $fillable = ['icon', 'heading', 'text', 'sort_ids'];
}
