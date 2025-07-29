<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocaleTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('locals')->insert([
            [
                'name' => 'Español',
                'code' => 'ES',
                'created_by_id' => 1,
                'updated_by_id' => 1
            ],
            [
                'name' => 'Ingles',
                'code' => 'EN',
                'created_by_id' => 1,
                'updated_by_id' => 1
            ],
        ]);
    }
}
