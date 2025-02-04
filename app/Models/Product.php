<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function purchaseDetails()
    {
        return $this->hasMany(Purchase::class);
    }

    public function salesDetails()
    {
        return $this->hasMany(SalesDetails::class);
    }
}
