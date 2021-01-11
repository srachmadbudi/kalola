<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = [];
    protected $casts = ['date' => 'datetime:Y-m-d'];

    public function business()
    {
        return $this->belongsTo(Business::class, 'business_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function details()
    {
        return $this->hasMany(TransactionDetail::class, 'transaction_id');
    }
}
