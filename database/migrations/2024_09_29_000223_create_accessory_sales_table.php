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
        Schema::create('accessory_sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('accessory_id')->constrained('accessories')->onDelete('cascade');
            $table->integer('quantity');
            $table->decimal('total_price', 10, 2); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accessory_sales');
    }
};
