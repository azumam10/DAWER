<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('jurusan')->insert([
            ['fakultas_id' => 1, 'nama_jurusan' => 'Teknik Informatika'],
            ['fakultas_id' => 1, 'nama_jurusan' => 'Sistem Informasi'],
            ['fakultas_id' => 2, 'nama_jurusan' => 'Manajemen'],
            ['fakultas_id' => 3, 'nama_jurusan' => 'Teknik Elektro'],
        ]);
    }
}
