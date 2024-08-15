<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModalShow extends Model
{
    public function modalContent()
    {
        return $this->belongsTo('App\Models\ModalContent');
    }
}
