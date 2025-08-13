<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuTablaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('menu')->insert([
            [ // 1
                'name' => 'Quiénes Somos',
                'url' => 'iz65e21qcql5xe119arsd99j',
                'created_at' => '2025-07-10 20:41:48.014000',
                'updated_at' => '2025-07-10 20:42:10.348000',
                'published_at' => null,
                'id_locale' => 1,
                'type' => 2
            ],
            [ // 2
                'name' => 'Qué hacemos',
                'url' => 'esq3c0khkkd0yhyek3l7566p',
                'created_at' => '2025-07-10 20:42:22.032000',
                'updated_at' => '2025-07-10 20:42:28.986000',
                'published_at' => null,
                'id_locale' => 1,
                'type' => 2
            ],
            [ // 3
                'name' => 'Experiencia PETS',
                'url' => 'gl8m4dxjyqnevbx8asn2ka85',
                'created_at' => '2025-07-10 20:42:47.949000',
                'updated_at' => '2025-07-10 20:42:47.949000',
                'published_at' => null,
                'id_locale' => 1,
                'type' => 2
            ],
            [ // 4
                'name' => 'Valoración',
                'url' => 'whwemvmddh6ziivkcnugw5lc',
                'created_at' => '2025-07-10 20:50:50.087000',
                'updated_at' => '2025-07-10 20:50:50.087000',
                'published_at' => null,
                'id_locale' => 1,
                'type' => 2
            ],
            [ // 5
                'name' => 'Formación',
                'url' => 'c9h178o6nn84u7bk9a5m5cn2',
                'created_at' => '2025-07-10 20:51:31.834000',
                'updated_at' => '2025-07-10 20:51:31.834000',
                'published_at' => null,
                'id_locale' => 1,
                'type' => 2
            ],
            [ // 6
                'name' => 'Haz tu cita',
                'url' => 'https://chivopets.sv/views/formQuotes.html',
                'created_at' => '2025-07-10 20:51:31.834000',
                'updated_at' => '2025-07-10 20:51:31.834000',
                'published_at' => null,
                'id_locale' => 1,
                'type' => 3
            ],
            [ // 7
                'name' => 'Contacto',
                'url' => 'asfawwedwqdasdasdassdds',
                'created_at' => '2025-07-10 20:51:31.834000',
                'updated_at' => '2025-07-10 20:51:31.834000',
                'published_at' => null,
                'id_locale' => 1,
                'type' => 2
            ],

            // Data en ingles
            [ // 8
                'name' => 'Who we are',
                'url' => 'asfawwedwqdasdasdassdds',
                'created_at' => '2025-07-10 20:51:31.834000',
                'updated_at' => '2025-07-10 20:51:31.834000',
                'published_at' => null,
                'id_locale' => 2,
                'type' => 1
            ],
            [ // 9
                'name' => 'What we do',
                'url' => 'asfawwedwqdasdasdassdds',
                'created_at' => '2025-07-10 20:51:31.834000',
                'updated_at' => '2025-07-10 20:51:31.834000',
                'published_at' => null,
                'id_locale' => 2,
                'type' => 1
            ],
            [ // 10
                'name' => 'Pets Experience',
                'url' => 'asfawwedwqdasdasdassdds',
                'created_at' => '2025-07-10 20:51:31.834000',
                'updated_at' => '2025-07-10 20:51:31.834000',
                'published_at' => null,
                'id_locale' => 2,
                'type' => 1
            ],
            [ // 11
                'name' => 'Feedback',
                'url' => 'asfawwedwqdasdasdassdds',
                'created_at' => '2025-07-10 20:51:31.834000',
                'updated_at' => '2025-07-10 20:51:31.834000',
                'published_at' => null,
                'id_locale' => 2,
                'type' => 1
            ],
            [ // 12
                'name' => 'Programs',
                'url' => 'asfawwedwqdasdasdassdds',
                'created_at' => '2025-07-10 20:51:31.834000',
                'updated_at' => '2025-07-10 20:51:31.834000',
                'published_at' => null,
                'id_locale' => 2,
                'type' => 1
            ],
            [ // 13
                'name' => 'Make your appointment ',
                'url' => 'https://chivopets.sv/views/formQuotes.html',
                'created_at' => '2025-07-10 20:51:31.834000',
                'updated_at' => '2025-07-10 20:51:31.834000',
                'published_at' => null,
                'id_locale' => 2,
                'type' => 3
            ],
            [ // 14
                'name' => 'Contact',
                'url' => 'asfawwedwqdasdasdassdds',
                'created_at' => '2025-07-10 20:51:31.834000',
                'updated_at' => '2025-07-10 20:51:31.834000',
                'published_at' => null,
                'id_locale' => 2,
                'type' => 2
            ],
        ]);
    }
}
