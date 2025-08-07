<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FAQTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('FAQs')->insert([
            [
               
                'question'       => '¿En qué horarios atiende Chivo Pets?',
                'answer'         => '<ul><li><strong>Consulta externa:</strong> Todos los días, de 7:00 a.m. a 8:30 p.m., con cita previa. Agenda tu cita en chivopets.sv.</li><li><strong>Peluquería:</strong> Todos los días, de 7:00 a.m. a 6:00 p.m., también con cita previa y vacunas al día.</li><li><strong>Emergencias: </strong>Disponibles las 24 horas, los 7 días de la semana, atendiendo según la urgencia del caso.</li></ul>',
                'created_at'     => '2025-07-14 16:44:57',
                'updated_at'     => '2025-07-14 16:44:57',
                'published_at'   => null,
                'created_by_id'  => 1,
                'updated_by_id'  => 1,
                'id_locale'         => 1,
            ],
            [
               
                'question'       => '¿En qué horarios atiende Chivo Pets?',
                'answer'         => '<ul><li><strong>Consulta externa:</strong> Todos los días, de 7:00 a.m. a 8:30 p.m., con cita previa. Agenda tu cita en chivopets.sv.</li><li><strong>Peluquería:</strong> Todos los días, de 7:00 a.m. a 6:00 p.m., también con cita previa y vacunas al día.</li><li><strong>Emergencias: </strong>Disponibles las 24 horas, los 7 días de la semana, atendiendo según la urgencia del caso.</li></ul>',
                'created_at'     => '2025-07-14 16:44:57',
                'updated_at'     => '2025-07-14 16:44:57',
                'published_at'   => '2025-07-14 16:44:57',
                'created_by_id'  => 1,
                'updated_by_id'  => 1,
                'id_locale'         => 1,
            ],
            [
               
                'question'       => '¿Por qué el hospital se llama “Chivo Pets”?',
                'answer'         => '<p>En El Salvador, la palabra “chivo” es una expresión coloquial que significa algo genial, bonito o de excelente calidad.</p><p>El nombre <strong>“Chivo Pets”</strong> refleja precisamente eso: nuestro compromiso de ofrecer un servicio veterinario de alta calidad, cálido y accesible, para todas las mascotas —desde las más comunes hasta las menos convencionales.</p><p>Queremos que cuando pienses en el bienestar de tu mascota, pienses en algo “chivo”… y por eso existimos.</p>',
                'created_at'     => '2025-07-14 16:47:06',
                'updated_at'     => '2025-07-14 16:47:06',
                'published_at'   => null,
                'created_by_id'  => 1,
                'updated_by_id'  => 1,
                'id_locale'         => 1,
            ],
            [
               
                'question'       => '¿Por qué el hospital se llama “Chivo Pets”?',
                'answer'         => '<p>En El Salvador, la palabra “chivo” es una expresión coloquial que significa algo genial, bonito o de excelente calidad.</p><p>El nombre <strong>“Chivo Pets”</strong> refleja precisamente eso: nuestro compromiso de ofrecer un servicio veterinario de alta calidad, cálido y accesible, para todas las mascotas —desde las más comunes hasta las menos convencionales.</p><p>Queremos que cuando pienses en el bienestar de tu mascota, pienses en algo “chivo”… y por eso existimos.</p>',
                'created_at'     => '2025-07-14 16:47:06',
                'updated_at'     => '2025-07-14 16:47:06',
                'published_at'   => '2025-07-14 16:47:06',
                'created_by_id'  => 1,
                'updated_by_id'  => 1,
                'id_locale'         => 1,
            ],
            [
               
                'question'       => '¿Atienden solo perros y gatos?',
                'answer'         => '<p>No, también recibimos especies exóticas y poco convencionales como conejos, reptiles, hámster y más. Según disponibilidad de médico especialista.</p>',
                'created_at'     => '2025-07-14 16:47:34',
                'updated_at'     => '2025-07-14 16:47:34',
                'published_at'   => null,
                'created_by_id'  => 1,
                'updated_by_id'  => 1,
                'id_locale'         => 1,
            ],
            [
               
                'question'       => '¿Atienden solo perros y gatos?',
                'answer'         => '<p>No, también recibimos especies exóticas y poco convencionales como conejos, reptiles, hámster y más. Según disponibilidad de médico especialista.</p>',
                'created_at'     => '2025-07-14 16:47:34',
                'updated_at'     => '2025-07-14 16:47:34',
                'published_at'   => '2025-07-14 16:47:34',
                'created_by_id'  => 1,
                'updated_by_id'  => 1,
                'id_locale'         => 1,
            ],
            [
               
                'question'       => '¿Se necesita cita para atender a mi mascota?',
                'answer'         => '<p>Sí, recomendamos que agendes una cita para evitar tiempos de espera. Puedes hacerlo en nuestro sitio web o llamando al 195.<br>Recuerda: en caso de emergencia, no necesitas cita.</p>',
                'created_at'     => '2025-07-14 16:48:34',
                'updated_at'     => '2025-07-14 16:48:34',
                'published_at'   => null,
                'created_by_id'  => 1,
                'updated_by_id'  => 1,
                'id_locale'         => 1,
            ],
            [
               
                'question'       => '¿Se necesita cita para atender a mi mascota?',
                'answer'         => '<p>Sí, recomendamos que agendes una cita para evitar tiempos de espera. Puedes hacerlo en nuestro sitio web o llamando al 195.<br>Recuerda: en caso de emergencia, no necesitas cita.</p>',
                'created_at'     => '2025-07-14 16:48:34',
                'updated_at'     => '2025-07-14 16:48:34',
                'published_at'   => '2025-07-14 16:48:34',
                'created_by_id'  => 1,
                'updated_by_id'  => 1,
                'id_locale'         => 1,
            ],
            [
               
                'question'       => '¿Cuánto cuesta una consulta?',
                'answer'         => '<p>Cada consulta tiene un costo simbólico de $0.25. Puedes pagar utilizando Chivo Wallet o cualquier billetera digital compatible.</p>',
                'created_at'     => '2025-07-14 16:49:44',
                'updated_at'     => '2025-07-14 16:49:44',
                'published_at'   => null,
                'created_by_id'  => 1,
                'updated_by_id'  => 1,
                'id_locale'         => 1,
            ],
            [
               
                'question'       => '¿Cuánto cuesta una consulta?',
                'answer'         => '<p>Cada consulta tiene un costo simbólico de $0.25. Puedes pagar utilizando Chivo Wallet o cualquier billetera digital compatible.</p>',
                'created_at'     => '2025-07-14 16:49:44',
                'updated_at'     => '2025-07-14 16:49:44',
                'published_at'   => '2025-07-14 16:49:44',
                'created_by_id'  => 1,
                'updated_by_id'  => 1,
                'id_locale'         => 1,
            ],
        ]);
    }
}
