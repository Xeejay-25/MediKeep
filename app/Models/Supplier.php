<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $table = 'suppliers';

    // Define the fillable properties
    protected $fillable = [
        'name',
        'contact_info',
        'address', 
        'updated_at', 
        'created_at'
    ];
}
