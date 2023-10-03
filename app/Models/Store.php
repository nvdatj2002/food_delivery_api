<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    //
    protected $filltable = [
        'id', 'storeName','username','password','email','phone','image','address','createDate',
        'idTypeAccount'
    ];
}
