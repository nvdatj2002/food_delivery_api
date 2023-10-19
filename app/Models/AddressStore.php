<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AddressStore extends Model
{
    //
    protected $primaryKey = 'id';
    protected $fillable = [
        'latitude',
        'longitude',
        'id_store'
    ];

    public function store(){
        return $this -> belongsto(Store::class,'id_store','id');
    }

}
