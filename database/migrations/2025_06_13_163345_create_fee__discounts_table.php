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
        Schema::create('fee_discounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fee_id')->constrained('fees')->onDelete('cascade');
            $table->integer('min_score');
            $table->integer('max_score');
            $table->integer('discount_percent');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fee_discounts');
    }
};
