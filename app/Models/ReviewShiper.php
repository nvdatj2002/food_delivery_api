<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewShiper extends Model
{
    //
    protected $primarykey = 'id';

    protected $fillable = [
        'content',
        'quanlity'
    ];

    public function shiper(){
        return $this->belongsTo(Shiper::class,'idShiper');
    }
    public function customer(){
        return $this->belongsTo(Shiper::class,'idCustomer');
    }
}
