<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sections')->insert([
            [
                'name' => 'Inicio',
                'created_by_id' => 1,
                'updated_by_id' => 1,
                'id_locale' => 1,
            ],
            [
                'name' => 'Quienes Somos',
                'created_by_id' => 1,
                'updated_by_id' => 1,
                'id_locale' => 1,
            ],
            [
                'name' => 'Que hacemos',
                'created_by_id' => 1,
                'updated_by_id' => 1,
                'id_locale' => 1,
            ],
        ]);
    }
}
