<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;

class CuttingUPSSeeder extends Seeder
{
    public function run()
    {
        // مسار الملف
        $csvPath = storage_path('cutting_u_p_s.csv');

        // قراءة الملف
        $csv = Reader::createFromPath($csvPath, 'r');
        $csv->setHeaderOffset(0); // استخدام الصف الأول كرؤوس أعمدة

        // إدخال البيانات في قاعدة البيانات
        foreach ($csv as $record) {
            DB::table('cutting_u_p_s')->insert([
                'id' => $record['id'], // إذا كان `id` يتم توليده تلقائيًا يمكنك إزالته
                'company' => $record['company'],
                'model' => $record['model'],
                'content' => $record['content'],
                'created_at' => $record['created_at'],
                'updated_at' => $record['updated_at'],
            ]);
        }
    }
}
