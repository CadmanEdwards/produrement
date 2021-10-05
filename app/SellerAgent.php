<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SellerAgent extends Model
{
    protected $table = "saller_agent";
    protected $primaryKey = 'agent_id';

    protected $guarded = [];

    public $timestamps = false;

      public function company_assign()
    {
        return $this->hasMany(SellerAgentCompanyAssign::class);
    }
}
