<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_id','product_id','name','email','phone',
        'reserve_date','qty','total','payment_status'
    ];

    public function ticket()
    {
        return $this->hasOne(Ticket::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

