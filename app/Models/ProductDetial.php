<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDetial extends Model
{
    //
    protected $filltable = [
        'id', 'idProduct','price','size','status'
    ];
}
