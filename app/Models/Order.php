<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Order extends Model
{
    protected $fillable = [
    'customer_name',
    'address',
    'phone',
    'payment_method',
    'transfer_proof',
    'payment_status',
    'payment_note',
    'total_amount',
    'order_status',
    'user_id',
    'order_date'
];


    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function logs()
    {
        return $this->hasMany(OrderLog::class);
    }
}