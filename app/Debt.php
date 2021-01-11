<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{
    protected $guarded = [];

    public function business()
    {
        return $this->belongsTo(Business::class, 'business_id');
    }
}
