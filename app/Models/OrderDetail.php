<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'order_details';
    protected $fillable = [
        'order_id','product_id','quantity'
    ];

    public function products()
    {
        return $this->belongsTo(Products::class,'product_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class,'order_id');
    }
}
