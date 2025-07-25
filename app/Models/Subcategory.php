<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;
    
    protected $table = 'subcategory'; 

    protected $fillable = ['name', 'description', 'updated_at', 'created_at']; 
  
    public $timestamps = true; 
}
