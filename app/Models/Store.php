<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Address;
use App\Models\TypeAccount;
class Store extends Model
{
    protected $primarykey = 'id';
    //
    protected $fillable = [
        'nameStore',
        'username',
        'password',
        'email',
        'phone',
        'status'
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'idStore','id');
    }
    
    public function order(){
        return $this -> hasMany(Order::class,'idStore','id');
    }

    public function addressStore(){
        return $this -> hasOne(AddressStore::class,'id_store','id');
    }

 
}
