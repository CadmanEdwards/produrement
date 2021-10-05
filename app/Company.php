<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'comapny'; 

    protected $guarded = []; 

    public function buyerUser()
    {
        return $this->belongsTo(User::class,'buyer_id');
    }
    public function sellerUser()
    {
        return $this->belongsTo(User::class,'seller_id');
    }
}
