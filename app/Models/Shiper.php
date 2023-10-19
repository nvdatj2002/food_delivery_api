<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shiper extends Model
{
    //
    protected $primarykey = 'id';

    protected $fillable = [
        'fullname',
        'username',
        'password',
        'email',
        'address',
        'phone',
        'birthDay',
        'gender',
        'status'
    ];

    public function order() {
        return $this->hasMany(Order::class, 'idShiper','id');
    }

   
}
