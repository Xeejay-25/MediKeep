<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Order extends Model
{
    use HasFactory;
    
    protected $table = 'order'; // Specify the table name

    protected $fillable = [
        'supplier_id',
        'staff_id',
        'order_date',
        'total_amount',
        'status',
    ];

    protected $casts = [
        'order_date' => 'datetime',
    ];

    // Define the relationship with OrderItem
    public function items()
    {
        return $this->hasMany(Order_item::class);
    }

    public function getOrderDateAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');
    }

    // Define the relationship with Supplier
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    // Define the relationship with Staff
    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id'); // Assuming staff is a User
    }

}
