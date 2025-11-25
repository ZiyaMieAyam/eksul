<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('siswas')->delete();
        DB::table('siswas')->insert([
            ['id_user' => 1, 'nama_siswa' => 'Ahmad Fauzi', 'kelas' => '10A', 'alamat' => 'Jl. Merpati No. 10'],
            ['id_user' => 2, 'nama_siswa' => 'Siti Aminah', 'kelas' => '11B', 'alamat' => 'Jl. Kenanga No. 5'],
            ['id_user' => 3, 'nama_siswa' => 'Budi Santoso', 'kelas' => '12C', 'alamat' => 'Jl. Melati No. 8'],
        ]);
    }
}
