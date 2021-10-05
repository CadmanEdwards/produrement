<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function show_company_1()
    {
        return $this->belongsTo(Company::class,'seller_company_id');
    }

    public function show_company_2()
    {
        return $this->belongsTo(Company::class,'comapny_id');        
    }

    public function buyerUser()
    {
        return $this->belongsTo(User::class,'buyer_id');        
    }

    public function sellerUser()
    {
        return $this->belongsTo(User::class,'seller_id');        
    }
}
