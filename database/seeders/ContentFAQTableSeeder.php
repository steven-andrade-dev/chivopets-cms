<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContentFAQTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Asociar FAQs al contenido "Preguntas frecuentes (FAQ)" que tiene id=9
        DB::table('content_f_a_q_s')->insert([
            [
                'id_content' => 9, // Preguntas frecuentes (FAQ)
                'id_faq' => 1,     // ¿En qué horarios atiende Chivo Pets?
            ],
            [
                'id_content' => 9, // Preguntas frecuentes (FAQ)
                'id_faq' => 3,     // ¿Por qué el hospital se llama "Chivo Pets"?
            ],
            [
                'id_content' => 9, // Preguntas frecuentes (FAQ)
                'id_faq' => 5,     // ¿Atienden solo perros y gatos?
            ],
            [
                'id_content' => 9, // Preguntas frecuentes (FAQ)
                'id_faq' => 7,     // ¿Se necesita cita para atender a mi mascota?
            ],
            [
                'id_content' => 9, // Preguntas frecuentes (FAQ)
                'id_faq' => 9,     // ¿Cuánto cuesta una consulta?
            ],
        ]);
    }
}
