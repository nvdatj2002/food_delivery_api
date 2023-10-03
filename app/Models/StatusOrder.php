<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusOrder extends Model
{
    //
    protected $filltable = [
        'id', 'idStatus', 'idOrder','type_account',
    ];
}
