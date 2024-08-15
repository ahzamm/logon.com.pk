<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactInformation extends Model
{
    protected $table = 'contact_information';

    protected $fillable = [
        'phone','email','address', 'address_url', 'phone_slogan', 'email_slogan', 'address_slogan'];
}
