<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;

class AccessoriesSeeder extends Seeder
{
    public function run()
    {
        // Path to the CSV file 
        $csvPath = storage_path('screens.csv');

        // Read the CSV file
        $csv = Reader::createFromPath($csvPath, 'r');
        $csv->setHeaderOffset(0); // Use the first row as the header

        // Insert each row into the database
        foreach ($csv as $record) {
            DB::table('accessories')->insert([
                // 'id' => $record['id'], // Optional if `id` is auto-increment
                'name' => $record['name'],
                'price' => $record['price'],
                'stock' => $record['stock'],
                'created_at' => $record['created_at'],
                'updated_at' => $record['updated_at'],
                'device_type' => $record['device_type'],
                'type' => $record['type'],
            ]);
        }
    }
}
