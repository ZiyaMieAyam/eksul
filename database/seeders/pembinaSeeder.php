<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PembinaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pembinas')->delete();
        DB::table('pembinas')->insert([
            ['id_user' => 7, 'nama_pembina' => 'Ibu Pembina 1'],
            ['id_user' => 8, 'nama_pembina' => 'Ibu Pembina 2'],
            ['id_user' => 9, 'nama_pembina' => 'Ibu Pembina 3'],
        ]);
    }
}
