<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    //
    protected $primarykey = 'id';
    
    protected $fillable = [
        'idOrder',
        'idProduct',
        'quantity',
        'size'
    ];
    public function order()
    {
        return $this->belongsTo(Order::class,'idOrder','idOrder','id');
    }

    public function product()
    {
        return $this->hasOne(Product::class, 'idProduct','idProduct');
    }
}
