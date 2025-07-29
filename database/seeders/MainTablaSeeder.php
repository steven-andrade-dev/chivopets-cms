<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MainTablaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('main')->insert([
            [
                'name' => 'Quiénes Somos',
                'url' => 'iz65e21qcql5xe119arsd99j',
                'created_at' => '2025-07-10 20:41:48.014000',
                'updated_at' => '2025-07-10 20:42:10.348000',
                'published_at' => null,
                'id_locale' => 1,
            ],
            [
                'name' => 'Quiénes Somos',
                'url' => 'iz65e21qcql5xe119arsd99j',
                'created_at' => '2025-07-10 20:41:48.014000',
                'updated_at' => '2025-07-10 20:42:10.348000',
                'published_at' => '2025-07-10 20:42:10.369000',
                'id_locale' => 1,
            ],
            [
                'name' => 'Qué hacemos',
                'url' => 'esq3c0khkkd0yhyek3l7566p',
                'created_at' => '2025-07-10 20:42:22.032000',
                'updated_at' => '2025-07-10 20:42:28.986000',
                'published_at' => null,
                'id_locale' => 1,
            ],
            [
                'name' => 'Qué hacemos',
                'url' => 'esq3c0khkkd0yhyek3l7566p',
                'created_at' => '2025-07-10 20:42:22.032000',
                'updated_at' => '2025-07-10 20:42:28.986000',
                'published_at' => '2025-07-10 20:42:29.002000',
                'id_locale' => 1,
            ],
            [
                'name' => 'Experiencia PETS',
                'url' => 'gl8m4dxjyqnevbx8asn2ka85',
                'created_at' => '2025-07-10 20:42:47.949000',
                'updated_at' => '2025-07-10 20:42:47.949000',
                'published_at' => null,
                'id_locale' => 1,
            ],
            [
                'name' => 'Experiencia PETS',
                'url' => 'gl8m4dxjyqnevbx8asn2ka85',
                'created_at' => '2025-07-10 20:42:47.949000',
                'updated_at' => '2025-07-10 20:42:47.949000',
                'published_at' => '2025-07-10 20:42:47.974000',
                'id_locale' => 1,
            ],
            [
                'name' => 'Valoración',
                'url' => 'whwemvmddh6ziivkcnugw5lc',
                'created_at' => '2025-07-10 20:50:50.087000',
                'updated_at' => '2025-07-10 20:50:50.087000',
                'published_at' => null,
                'id_locale' => 1,
            ],
            [
                'name' => 'Valoración',
                'url' => 'whwemvmddh6ziivkcnugw5lc',
                'created_at' => '2025-07-10 20:50:50.087000',
                'updated_at' => '2025-07-10 20:50:50.087000',
                'published_at' => '2025-07-10 20:50:50.105000',
                'id_locale' => 1,
            ],
            [
                'name' => 'Formación',
                'url' => 'c9h178o6nn84u7bk9a5m5cn2',
                'created_at' => '2025-07-10 20:51:31.834000',
                'updated_at' => '2025-07-10 20:51:31.834000',
                'published_at' => null,
                'id_locale' => 1,
            ],
            [
                'name' => 'Formación',
                'url' => 'c9h178o6nn84u7bk9a5m5cn2',
                'created_at' => '2025-07-10 20:51:31.834000',
                'updated_at' => '2025-07-10 20:51:31.834000',
                'published_at' => '2025-07-10 20:51:31.852000',
                'id_locale' => 1,
            ],
        ]);
    }
}
