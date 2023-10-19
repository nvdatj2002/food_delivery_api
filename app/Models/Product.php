<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $primarykey = 'id';

    protected $fillable = [
        'name',
        
    ];

    public function store(){
       return $this->belongsTo(Store::class, 'idStore');
    }

    public function productDetails(){
        return $this->hasMany(ProductDetail::class,'idProduct','id');
    }
 

}
