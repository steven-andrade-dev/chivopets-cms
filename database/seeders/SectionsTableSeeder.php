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
            [
                'name' => 'Experiencia PETS',
                'created_by_id' => 1,
                'updated_by_id' => 1,
                'id_locale' => 1,
            ],
            [
                'name' => 'Valoración',
                'created_by_id' => 1,
                'updated_by_id' => 1,
                'id_locale' => 1,
            ],
            [
                'name' => 'Formación',
                'created_by_id' => 1,
                'updated_by_id' => 1,
                'id_locale' => 1,
            ],

            // Data en ingles
            [
                'name' => 'Home',
                'created_by_id' => 1,
                'updated_by_id' => 1,
                'id_locale' => 2,
            ],
            [
                'name' => 'Who we are',
                'created_by_id' => 1,
                'updated_by_id' => 1,
                'id_locale' => 2,
            ],
            [
                'name' => 'What we do',
                'created_by_id' => 1,
                'updated_by_id' => 1,
                'id_locale' => 2,
            ],
            [
                'name' => 'Pets Experience',
                'created_by_id' => 1,
                'updated_by_id' => 1,
                'id_locale' => 2,
            ],
            [
                'name' => 'Feedback',
                'created_by_id' => 1,
                'updated_by_id' => 1,
                'id_locale' => 2,
            ],
            [
                'name' => 'Programs',
                'created_by_id' => 1,
                'updated_by_id' => 1,
                'id_locale' => 2,
            ],
        ]);
    }
}
