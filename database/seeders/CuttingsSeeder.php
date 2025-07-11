<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;

class CuttingsSeeder extends Seeder
{
    public function run()
    {
        // مسار الملف
        $csvPath = storage_path('cuttings.csv');

        // قراءة الملف
        $csv = Reader::createFromPath($csvPath, 'r');
        $csv->setHeaderOffset(0); // استخدام الصف الأول كرؤوس أعمدة

        // إدخال البيانات في قاعدة البيانات
        foreach ($csv as $record) {
            DB::table('cuttings')->insert([
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

