<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = "invoice";
   
    protected $guarded = [];

    public $timestamps = false;

    public function invoice_items()
    {
        return $this->hasMany(InvoiceItems::class,'id','invoice_item');
    }

    public function show_company_1()
    {
        return $this->belongsTo(Company::class,'seller_company_id');
    }

    public function show_company_2()
    {
        return $this->belongsTo(Company::class,'buyer_company_id');        
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
