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
        Schema::table('device_receipts', function (Blueprint $table) {
            $table->date('delivery_date')->nullable(); // إضافة العمود الجديد
        });
    }
    
    public function down()
    {
        Schema::table('device_receipts', function (Blueprint $table) {
            $table->dropColumn('delivery_date'); // حذف العمود إذا تم التراجع عن التغييرات
        });
    }
};
