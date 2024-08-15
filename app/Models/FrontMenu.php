<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FrontMenu extends Model
{

    public function childs() {
        return $this->hasMany('App\Models\FrontMenu','parent_id','id')->where('status', 1)->orderBy('sortIds', 'asc');
    }
    public function parent() {
        return $this->belongsTo('App\Models\FrontMenu','parent_id','id');
    }
    public function frontPage() {
        return $this->belongsTo('App\Models\FrontPage','page_id');
    }

}
