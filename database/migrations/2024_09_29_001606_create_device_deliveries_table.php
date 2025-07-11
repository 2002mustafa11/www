<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('device_deliveries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('device_receipt_id')->constrained()->onDelete('cascade');
            $table->foreignId('technician_id')->constrained()->onDelete('cascade');
            $table->foreignId('customer_id')->constrained()->onDelete('cascade'); // إضافة customer_id
            $table->decimal('repair_cost', 10, 2);
            $table->enum('status', ['completed', 'rejected'])->default('completed'); // إضافة status
            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('device_deliveries');
    }
};
