<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AktivitasSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('aktivitass')->insert([
            [
                'id_eskul' => 1,
                'id_pembina' => 1,
                'jenis_aktivitas' => 'Latihan Rutin',
                'tempat' => 'Lapangan Sekolah',
                'jam' => '15:00:00',
                'tanggal_aktivitas' => '2023-12-01',
            ],
            [
                'id_eskul' => 2,
                'id_pembina' => 2,
                'jenis_aktivitas' => 'Pertandingan Persahabatan',
                'tempat' => 'Stadion Kota',
                'jam' => '10:00:00',
                'tanggal_aktivitas' => '2023-12-05',
            ],
            [
                'id_eskul' => 3,
                'id_pembina' => 3,
                'jenis_aktivitas' => 'Workshop Seni',
                'tempat' => 'Ruang Kesenian',
                'jam' => '13:00:00',
                'tanggal_aktivitas' => '2023-12-10',
            ],
        ]);
    }
}
