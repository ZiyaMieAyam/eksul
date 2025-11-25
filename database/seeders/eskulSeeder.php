<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EskulSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('eskuls')->insert([
            [
                'id_pembina' => 1,
                'nama_eskul' => 'Sepak Bola',
                'jadwal_eskul' => 'Senin dan Rabu',
                'materi' => 'Latihan teknik dasar dan strategi permainan sepak bola.',
            ],
            [
                'id_pembina' => 2,
                'nama_eskul' => 'Pramuka',
                'jadwal_eskul' => 'Selasa dan Kamis',
                'materi' => 'Kegiatan kepramukaan, pelatihan kepemimpinan, dan survival.',
            ],
            [
                'id_pembina' => 3,
                'nama_eskul' => 'Seni Tari',
                'jadwal_eskul' => 'Jumat',
                'materi' => 'Pembelajaran berbagai jenis tarian tradisional dan modern.',
            ],
        ]);
    }
}
