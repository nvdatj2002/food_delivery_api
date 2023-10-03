<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adrress extends Model
{
    //
    protected $fillTable = [
        'id', 'city', 'district', 'ward', 'address'
    ];
}
