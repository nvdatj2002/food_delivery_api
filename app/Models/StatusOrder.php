<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusOrder extends Model
{
    protected $primarkey = 'id';
    //
    protected $fillable = [
        'idOrder',
        'idStatus'
        
    ];
    public function status()
    {
        return $this->belongsTo(Status::class, 'idStatus');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'idOrder','id');
    }
    
}
