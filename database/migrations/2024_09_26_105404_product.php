<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('subcategory');
            $table->string('category');
            $table->text('description');
            $table->integer('price');
            $table->integer('quantity')->default(0);
            $table->string('manufacturer');
            $table->string('measurement');
            $table->boolean('prescription')->default(false); 
            $table->timestamps(); 
        });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
