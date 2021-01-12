<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];
    protected $casts = ['date' => 'datetime:Y-m-d'];

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function consumer()
    {
        return $this->belongsTo(Consumer::class);
    }

    public function details()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
