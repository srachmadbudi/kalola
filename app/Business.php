<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $guarded = [];

    public function employees()
    {
        return $this->hasMany(User::class, 'business_id');
    }

    public function categories()
    {
        return $this->hasMany(ProductCategory::class, 'business_id');
    }

    public function assets()
    {
        return $this->hasMany(Asset::class, 'business_id');
    }

    public function consumers()
    {
        return $this->hasMany(Consumer::class, 'business_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'business_id');
    }

    public function suppliers()
    {
        return $this->hasMany(Supplier::class, 'business_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'business_id');
    }
}
