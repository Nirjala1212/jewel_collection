<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'email',
        'full_name',
        'phone',
        'province',
        'city',
        'area',
        'landmark',
        'delivery_address',
        'payment_method',
        'payment_status',
        'order_status',
        'total_amount',
        'transaction_uuid',
        'esewa_ref_id',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}