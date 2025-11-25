<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrestasiSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('prestasis')->insert([
            [
                'id_siswa' => 1,
                'id_eskul' => 1,
                'nama_prestasi' => 'Juara 1 Lomba Cerdas Cermat',
                'tanggal_diraih' => '2023-10-15',
                'bukti' => 'bukti1.pdf',
                'tingkat' => 'Kota',
                'status' => 'Diverifikasi'
            ],
            [
                'id_siswa' => 2,
                'id_eskul' => 2,
                'nama_prestasi' => 'Juara 2 Lomba Tari Tradisional',
                'tanggal_diraih' => '2023-11-05',
                'bukti'=> 'bukti2.pdf',
                'tingkat' => 'Provinsi',
                'status' => 'Diverifikasi'
            ],
            [
                'id_siswa' => 3,
                'id_eskul' => 3,
                'nama_prestasi' => 'Juara Harapan Lomba Fotografi',
                'tanggal_diraih' => '2023-09-20',
                'bukti' => 'bukti3.pdf',
                'tingkat' => 'Nasional',
                'status' => 'Pending'
            ],
        ]);
    }
}
