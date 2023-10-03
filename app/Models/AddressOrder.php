<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AddressOrder extends Model
{
    //
    protected $fillTable = [
        'id', 'idOrder','city','district','ward', 'address'
    ];
}
