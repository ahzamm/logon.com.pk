<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HappyClient extends Model
{
    protected $fillable = ['client_type', 'no_of_clients', 'is_active', 'sortIds'];
}
