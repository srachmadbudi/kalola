<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consumer extends Model
{
    protected $guided = [];

    public function business()
    {
        return $this->belongsTo(Business::class, 'business_id');
    }
}
