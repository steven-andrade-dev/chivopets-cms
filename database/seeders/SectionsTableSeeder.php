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
                'status' => 'Creado',
                'created_by_id' => 1,
                'updated_by_id' => 1,
                'id_locale' => 1,
            ],
            [
                'name' => 'Quienes Somos',
                'status' => 'Publicado',
                'created_by_id' => 1,
                'updated_by_id' => 1,
                'id_locale' => 1,
            ],
            [
                'name' => 'Que hacemos',
                'status' => 'Creado',
                'created_by_id' => 1,
                'updated_by_id' => 1,
                'id_locale' => 1,
            ],
            [
                'name' => 'Experiencia PETS',
                'status' => 'Creado',
                'created_by_id' => 1,
                'updated_by_id' => 1,
                'id_locale' => 1,
            ],
            [
                'name' => 'Valoración',
                'status' => 'Creado',
                'created_by_id' => 1,
                'updated_by_id' => 1,
                'id_locale' => 1,
            ],
            [
                'name' => 'Formación',
                'status' => 'Creado',
                'created_by_id' => 1,
                'updated_by_id' => 1,
                'id_locale' => 1,
            ],

            // Data en ingles
            [
                'name' => 'Home',
                'status' => 'Creado',
                'created_by_id' => 1,
                'updated_by_id' => 1,
                'id_locale' => 2,
            ],
            [
                'name' => 'Who we are',
                'status' => 'Creado',
                'created_by_id' => 1,
                'updated_by_id' => 1,
                'id_locale' => 2,
            ],
            [
                'name' => 'What we do',
                'status' => 'Creado',
                'created_by_id' => 1,
                'updated_by_id' => 1,
                'id_locale' => 2,
            ],
            [
                'name' => 'Pets Experience',
                'status' => 'Creado',
                'created_by_id' => 1,
                'updated_by_id' => 1,
                'id_locale' => 2,
            ],
            [
                'name' => 'Feedback',
                'status' => 'Creado',
                'created_by_id' => 1,
                'updated_by_id' => 1,
                'id_locale' => 2,
            ],
            [
                'name' => 'Programs',
                'status' => 'Creado',
                'created_by_id' => 1,
                'updated_by_id' => 1,
                'id_locale' => 2,
            ],
        ]);
    }
}
