<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $guarded = [];

    public function purchaseDetails()
    {
        return $this->hasMany(PurchaseDetails::class);
    }
}
