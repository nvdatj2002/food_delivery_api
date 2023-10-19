<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $primarykey = 'id';
    //
    protected $fillable = [
        'name'
    ];

    public function status(){
        return $this -> hasMany(StatusOrder::class, 'idStatus', 'id');
    }
}
