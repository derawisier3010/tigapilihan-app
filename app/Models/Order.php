<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
    'nama',
    'alamat',
    'no_hp',
    'metode',
    'total',
    'status'
];
}
