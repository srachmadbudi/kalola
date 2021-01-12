<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $guarded = [];
    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }
}
