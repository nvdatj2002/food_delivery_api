<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    //
    protected $primarykey = 'id';

    protected $fillable = [
        'price',
        'size',
        'status'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'idProduct');
    }
}
