<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'menu','has_submenu','icon','order_menu', 'sortIds'
    ];
    public function subMenus()
    {
        return $this->hasMany('App\Models\SubMenu');
    }
}
