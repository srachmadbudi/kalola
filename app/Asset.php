<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $guided = [];

    public function business()
    {
        return $this->belongsTo(Business::class, 'business_id');
    }
}
