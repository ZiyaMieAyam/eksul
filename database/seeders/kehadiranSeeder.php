<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KehadiranSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('kehadirans')->insert([
            [
                'id_siswa' => 1,
                'id_eskul' => 1,
                'poin' => 100,
                'tanggal' => '2023-12-01',
                'status' => 'Hadir'
            ],
            [
                'id_siswa' => 2,
                'id_eskul' => 2,
                'poin' => 100,
                'tanggal' => '2023-12-02',
                'status' => 'Sakit'
            ],
            [
                'id_siswa' => 3,
                'id_eskul' => 3,
                'poin' => 100,
                'tanggal' => '2023-12-03',
                'status' => 'Izin'
            ],
        ]);
    }
}
