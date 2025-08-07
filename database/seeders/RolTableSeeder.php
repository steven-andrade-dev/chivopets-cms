<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rol')->insert([
                         [
                'name' => 'SuperAdmin',
                'created_by_id' => 1,
                'updated_by_id' => 1
            ],
            [
                'name' => 'Admin',
                'created_by_id' => 1,
                'updated_by_id' => 1
            ],

            [
                'name' => 'Editor',
                'created_by_id' => 1,
                'updated_by_id' => 1
            ],
        ]);
    }
}
