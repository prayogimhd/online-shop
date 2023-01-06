<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = [
        'user_id', 'invoice', 'total', 'snap_token', 'transaction_status', 'order_status', 'first_name', 'last_name', 'street', 'detailstreet', 'city', 'postcode', 'phone', 'email'
    ];
}
