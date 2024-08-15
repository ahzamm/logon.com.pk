<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FrontPage extends Model
{
    public function frontMenu()
    {
        return $this->hasOne('App\Models\FrontMenu','page_id');
    }
}
