<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_item extends Model
{
    use HasFactory;
    protected $table = 'order_item'; // Specify the table name

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'unit_price',
        'total_amount',
    ];

    // Define the relationship with Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Define the relationship with Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
