<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PendaftaranSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pendaftarans')->insert([
            [
                'id_siswa' => 1,
                'id_eskul' => 1,
                'tanggal_daftar' => '2023-11-20',
                'status' => 'Diterima',
            ],
            [
                'id_siswa' => 2,
                'id_eskul' => 2,
                'tanggal_daftar' => '2023-11-22',
                'status' => 'Pending',
            ],
            [
                'id_siswa' => 3,
                'id_eskul' => 3,
                'tanggal_daftar' => '2023-11-25',
                'status' => 'Ditolak',
            ],
        ]);
    }
}
