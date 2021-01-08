<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $guided = [];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }
}
