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
        // إضافة عمود box_number من نوع string ويمكن أن يكون فارغًا
        $table->string('box_number')->nullable();
    });
}

public function down()
{
    // في حالة التراجع عن الـ migration، نقوم بحذف العمود
    Schema::table('device_receipts', function (Blueprint $table) {
        $table->dropColumn('box_number');
    });
}

};
