<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewShiper extends Model
{
    //
    protected $filltable = [
        'id', 'idShiper','idCustomer','content','quanlity'
    ];
}
