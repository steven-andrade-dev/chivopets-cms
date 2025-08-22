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

                'question'       => '¿Cuánto cuesta una consulta?',
                'answer'         => '<p>Cada consulta tiene un costo simbólico de $0.25. Puedes pagar utilizando Chivo Wallet o cualquier billetera digital compatible.</p>',
                'created_at'     => '2025-07-14 16:49:44',
                'updated_at'     => '2025-07-14 16:49:44',
                'published_at'   => null,
                'created_by_id'  => 1,
                'updated_by_id'  => 1,
                'id_locale'         => 1,
            ],

            // English version (id_locale = 2)
            [
                'question'       => 'What are Chivo Pets’ operating hours?',
                'answer'         => '<ul><li><strong>Outpatient consultations:</strong> Every day from 7:00 a.m. to 8:30 p.m., by appointment only. Book your appointment at chivopets.sv.</li><li><strong>Grooming services:</strong> Daily from 7:00 a.m. to 6:00 p.m., by appointment and with updated vaccinations.</li><li><strong>Emergency care:</strong> Available 24/7, attending according to the urgency of the case.</li></ul>',
                'created_at'     => '2025-07-14 16:44:57',
                'updated_at'     => '2025-07-14 16:44:57',
                'published_at'   => null,
                'created_by_id'  => 1,
                'updated_by_id'  => 1,
                'id_locale'      => 2,
            ],
            [
                'question'       => 'Why is the hospital called “Chivo Pets”?',
                'answer'         => '<p>In El Salvador, the word “chivo” is a slang term meaning something cool, nice, or of excellent quality.</p><p>The name <strong>“Chivo Pets”</strong> reflects exactly that: our commitment to providing high-quality, warm, and accessible veterinary care for all pets—from the most common to the most unconventional.</p><p>We want you to think of something “chivo” when you think of your pet’s well-being… and that’s why we exist.</p>',
                'created_at'     => '2025-07-14 16:47:06',
                'updated_at'     => '2025-07-14 16:47:06',
                'published_at'   => null,
                'created_by_id'  => 1,
                'updated_by_id'  => 1,
                'id_locale'      => 2,
            ],
            [
                'question'       => 'Do you only treat dogs and cats?',
                'answer'         => '<p>No, we also treat exotic and less common species such as rabbits, reptiles, hamsters, and more. Subject to the availability of a specialist.</p>',
                'created_at'     => '2025-07-14 16:47:34',
                'updated_at'     => '2025-07-14 16:47:34',
                'published_at'   => null,
                'created_by_id'  => 1,
                'updated_by_id'  => 1,
                'id_locale'      => 2,
            ],
            [
                'question'       => 'Do I need an appointment for my pet?',
                'answer'         => '<p>Yes, we recommend scheduling an appointment to avoid wait times. You can do so on our website or by calling 195.<br>Remember: in case of emergency, no appointment is needed.</p>',
                'created_at'     => '2025-07-14 16:48:34',
                'updated_at'     => '2025-07-14 16:48:34',
                'published_at'   => null,
                'created_by_id'  => 1,
                'updated_by_id'  => 1,
                'id_locale'      => 2,
            ],
            [
                'question'       => 'How much does a consultation cost?',
                'answer'         => '<p>Each consultation has a symbolic cost of $0.25. You can pay using Chivo Wallet or any compatible digital wallet.</p>',
                'created_at'     => '2025-07-14 16:49:44',
                'updated_at'     => '2025-07-14 16:49:44',
                'published_at'   => null,
                'created_by_id'  => 1,
                'updated_by_id'  => 1,
                'id_locale'      => 2,
            ],
        ]);
    }
}
