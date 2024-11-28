<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product'; 

    protected $fillable = ['name','category','subcategory','description', 'measurement','manufacturer', 'price', 'quantity','prescription','updated_at', 'created_at']; 
  
    public $timestamps = true; 
}
