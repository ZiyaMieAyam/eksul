<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('userss')->delete();

        DB::table('userss')->insert([
            ['id_user' => 1, 'username' => '543224', 'password' => Hash::make('siswa111'), 'role' => 'siswa'],
            ['id_user' => 2, 'username' => '543225', 'password' => Hash::make('siswa222'), 'role' => 'siswa'],
            ['id_user' => 3, 'username' => '543226', 'password' => Hash::make('siswa333'), 'role' => 'siswa'],

            ['id_user' => 4, 'username' => '10101', 'password' => Hash::make('guru111'), 'role' => 'guru'],
            ['id_user' => 5, 'username' => '10102', 'password' => Hash::make('guru222'), 'role' => 'guru'],
            ['id_user' => 6, 'username' => '10103', 'password' => Hash::make('guru333'), 'role' => 'guru'],

            ['id_user' => 7, 'username' => '20202', 'password' => Hash::make('pembina111'), 'role' => 'pembina'],
            ['id_user' => 8, 'username' => '20203', 'password' => Hash::make('pembina222'), 'role' => 'pembina'],
            ['id_user' => 9, 'username' => '20204', 'password' => Hash::make('pembina333'), 'role' => 'pembina'],
        ]);
    }
}
