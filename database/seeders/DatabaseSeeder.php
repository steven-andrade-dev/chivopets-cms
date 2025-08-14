<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            LocaleTablesSeeder::class,
            SectionsTableSeeder::class,
            ContentTableSeeder::class,
            FAQTableSeeder::class,
            MenuTablaSeeder::class,
            SubMenuTablaSeeder::class,
            RolTableSeeder::class,
            UserTableSeeder::class,
            CarruselTableSeeder::class,
        ]);
    }
}
