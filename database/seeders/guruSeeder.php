<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GuruSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('gurus')->delete();
        DB::table('gurus')->insert([
            ['id_user' => 4, 'nama_guru' => 'Bapak Guru 1', 'jabatan' => 'Wali Kelas X-A'],
            ['id_user' => 5, 'nama_guru' => 'Bapak Guru 2', 'jabatan' => 'Wali Kelas XI-B'],
            ['id_user' => 6, 'nama_guru' => 'Bapak Guru 3', 'jabatan' => 'Wali Kelas XII-C'],
        ]);
    }
}