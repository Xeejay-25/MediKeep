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
        Schema::create('system_log', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('sadmin_id')->nullable()->index();
            $table->timestamp('timestamp');
            $table->text('action');
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
