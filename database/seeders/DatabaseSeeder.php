<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            \Database\Seeders\UserSeeder::class,   // <-- pastikan muncul dulu
            \Database\Seeders\SiswaSeeder::class,
            \Database\Seeders\GuruSeeder::class,
            \Database\Seeders\PembinaSeeder::class,
            \Database\Seeders\EskulSeeder::class,
            \Database\Seeders\AktivitasSeeder::class,
            \Database\Seeders\KehadiranSeeder::class,
            \Database\Seeders\PrestasiSeeder::class,
            \Database\Seeders\PendaftaranSeeder::class,
        ]);
    }
}
