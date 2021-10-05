<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceItems extends Model
{
    protected $table = "invoice_item";   

    protected $guarded = [];

    public $timestamps = false;

}
