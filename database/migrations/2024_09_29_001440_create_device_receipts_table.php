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
         Schema::create('device_receipts', function (Blueprint $table) {
             $table->id();
             $table->string('device_type');
             $table->text('device_issue');
             $table->foreignId('customer_id')->constrained()->onDelete('cascade');
             $table->string('notes')->nullable();
             $table->string('employee_name');
             $table->enum('status', ['pending', 'completed', 'rejected'])->default('pending');
             $table->timestamps();
         });
     }
     


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('device_receipts');
    }
};
