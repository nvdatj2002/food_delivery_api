<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    //
    protected $filltable = [
        'id', 'idOrder','idProduct','quantity','size'
    ];
}
