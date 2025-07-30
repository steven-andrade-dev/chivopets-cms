<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class SubMainTablaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('submains')->insert([
            [
                'name' => 'Historia',
                'url' => '/Quienes/quienessomos/#historia',
                'created_by_id' => 1,
                'updated_by_id' => 1,
                'locale' => 1,
                'id_main' => 1,
            ],
            [
                'name' => 'Misión y Visión',
                'url' => '/Quienes/quienessomos/#mision_visio',
                'created_by_id' => 1,
                'updated_by_id' => 1,
                'locale' => 1,
                'id_main' => 1,
            ],
            [
                'name' => 'Áreas de especialidad',
                'url' => '/Quienes/quienessomos/#servicios',
                'created_by_id' => 1,
                'updated_by_id' => 1,
                'locale' => 1,
                'id_main' => 1,
            ],
            [
                'name' => 'Convenios',
                'url' => '/Quienes/quienessomos/#convenios',
                'created_by_id' => 1,
                'updated_by_id' => 1,
                'locale' => 1,
                'id_main' => 1,
            ],
            [
                'name' => 'Estadísticas de servicio',
                'url' => '/Quehacemos/quehacemos/#huellas',
                'created_by_id' => 1,
                'updated_by_id' => 1,
                'locale' => 1,
                'id_main' => 2,
            ],
            [
                'name' => 'Servicios',
                'url' => '/Quehacemos/quehacemos/#servicios',
                'created_by_id' => 1,
                'updated_by_id' => 1,
                'locale' => 1,
                'id_main' => 2,
            ],
            [
                'name' => 'Preguntas frecuentes',
                'url' => '/Experiencia/experiencia/#preguntas',
                'created_by_id' => 1,
                'updated_by_id' => 1,
                'locale' => 1,
                'id_main' => 3,
            ],
            [
                'name' => 'Guía Chivo Pets',
                'url' => '/Experiencia/experiencia/#guia_chivo',
                'created_by_id' => 1,
                'updated_by_id' => 1,
                'locale' => 1,
                'id_main' => 3,
            ],
            [
                'name' => 'Campaña de prevención',
                'url' => '/Experiencia/experiencia/#campaña',
                'created_by_id' => 1,
                'updated_by_id' => 1,
                'locale' => 1,
                'id_main' => 3,
            ],
            [
                'name' => 'Blog Chivo Pet',
                'url' => '/Blog/blog/',
                'created_by_id' => 1,
                'updated_by_id' => 1,
                'locale' => 1,
                'id_main' => 3,
            ],
            [
                'name' => 'Estadísticas de satisfacción',
                'url' => '/Valoracion/valoracion/#estadisticas',
                'created_by_id' => 1,
                'updated_by_id' => 1,
                'locale' => 1,
                'id_main' => 4,
            ],
            [
                'name' => 'Experiencias y reseñas',
                'url' => '/Valoracion/valoracion/#reseñas',
                'created_by_id' => 1,
                'updated_by_id' => 1,
                'locale' => 1,
                'id_main' => 4,
            ],
            [
                'name' => 'Programa de pasantías',
                'url' => '/Formacion/formacion/#pasantias',
                'created_by_id' => 1,
                'updated_by_id' => 1,
                'locale' => 1,
                'id_main' => 5,
            ],
            [
                'name' => 'Pets EDUCA',
                'url' => '/Formacion/formacion/#pets',
                'created_by_id' => 1,
                'updated_by_id' => 1,
                'locale' => 1,
                'id_main' => 5,
            ],
            [
                'name' => 'Casos de estudio',
                'url' => '/Formacion/casos/',
                'created_by_id' => 1,
                'updated_by_id' => 1,
                'locale' => 1,
                'id_main' => 5,
            ],
        ]);
    }
}
