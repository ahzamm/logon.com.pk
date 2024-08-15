<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModalContent extends Model
{
    public function modalShow()
    {
        return $this->hasOne('App\Models\ModalShow');
    }
}
