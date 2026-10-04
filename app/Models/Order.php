<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'user_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'street_address',
        'landmark',
        'city',
        'state',
        'pincode',
        'delivery_notes',
        'payment_method',
        'payment_status',
        'order_status',
        'subtotal',
        'discount_amount',
        'coupon_code',
        'shipping_amount',
        'gift_wrap_amount',
        'total_amount',
    ];

    protected $casts = [
        'subtotal' => 'float',
        'discount_amount' => 'float',
        'shipping_amount' => 'float',
        'gift_wrap_amount' => 'float',
        'total_amount' => 'float',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
