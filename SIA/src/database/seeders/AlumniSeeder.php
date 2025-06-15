<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlumniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('alumnis')->insert([
            [
                'nama_lengkap' => 'Ahmad Syahreza',
                'nim' => 'TI2020001',
                'email' => 'ahmad@email.com',
                'no_hp' => '08123456789',
                'fakultas_id' => 1,
                'jurusan_id' => 1,
                'angkatan' => 2020,
                'pekerjaan' => 'Software Engineer',
                'status_alumni' => 'aktif',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'nama_lengkap' => 'Dina Permata',
                'nim' => 'SI2019002',
                'email' => 'dina@email.com',
                'no_hp' => '08129876543',
                'fakultas_id' => 1,
                'jurusan_id' => 2,
                'angkatan' => 2019,
                'pekerjaan' => 'Data Analyst',
                'status_alumni' => 'aktif',
                'created_at' => now(), 'updated_at' => now()
            ],
        ]);
    }
}
