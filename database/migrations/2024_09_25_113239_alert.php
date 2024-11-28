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
        Schema::create('alert', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('product_id')->nullable()->index();
            $table->string('alert_type');
            $table->text('message');
            $table->string('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alert_id');
    }
};
