<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmtpEmail extends Model
{
    protected $fillable = ['emails', 'smtp_server', 'smtp_password', 'port'];
}
