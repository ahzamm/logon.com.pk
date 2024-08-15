<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubMenu extends Model
{
    protected $fillable = [
        'submenu','menu_id','route_name'
    ];
    public function menu()
    {
        return $this->belongsTo('App\Models\Menu');
    }
    public function usermenu_accesses()
    {
        return $this->hasMany('App\Models\UserMenuAccess','sub_menu_id');
    }
}
