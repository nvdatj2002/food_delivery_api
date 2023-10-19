<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $primarykey = 'id';

    protected $fillable = [
        'idCustomer',
        'idStore',
        'idShiper',
        'address'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class,'idCustomer');
    }
    public function store()
    {
        return $this->belongsTo(Store::class,'idStore');
    }
    public function shipper()
    {
        return $this->belongsTo(Shiper::class,'idShiper');
    }
    public function status()
    {
        return $this->hasMany(StatusOrder::class, 'idOrder', 'id');
    }
    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class, 'idOrder');
    }
}
