<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $guarded = [];

    public function business()
    {
        return $this->belongsTo(Business::class, 'business_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'supplier_id');
    }
}
