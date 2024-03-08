<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'order_date',
        'customer_name',
        'customer_address',
        'contact_number',
        'payment_type',
        'payment_status',
        'order_status',
        'order_notes',
        'user_id',
    ];
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
