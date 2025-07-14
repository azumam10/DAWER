<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AlumniSeeder extends Seeder
{
    public function run(): void
    {
        $namaDepan = ['Ahmad', 'Dina', 'Budi', 'Siti', 'Rizky', 'Lina', 'Fajar', 'Rani', 'Hendra', 'Putri'];
        $namaBelakang = ['Saputra', 'Permata', 'Wijaya', 'Anjani', 'Kurniawan', 'Sari', 'Santoso', 'Maulana', 'Utami', 'Rahmawati'];
        $pekerjaanList = ['Software Engineer', 'Data Analyst', 'Product Manager', 'UI/UX Designer', 'Network Engineer', 'Web Developer', 'IT Support', 'Mobile Developer'];
        $statusList = ['aktif', 'tidak_aktif', 'meninggal'];

        $alumni = [];

        for ($i = 1; $i <= 30; $i++) {
            $firstName = $namaDepan[array_rand($namaDepan)];
            $lastName = $namaBelakang[array_rand($namaBelakang)];
            $fullName = "$firstName $lastName";

            // Random jurusan_id yang valid (dari 1 sampai 7)
            $jurusan_id = rand(1, 7);

            // Mapping jurusan ke fakultas_id
            $fakultas_id = match ($jurusan_id) {
                1, 2, 7 => 1, // Teknik Informatika, Sistem Informasi, DKV
                3 => 2,       // Manajemen
                4 => 3,       // Teknik Elektro
                5 => 4,       // Pendidikan Dokter
                6 => 5,       // Ilmu Hukum
            };

            // Buat prefix NIM berdasarkan jurusan
            $nimPrefix = match ($jurusan_id) {
                1 => 'TI',
                2 => 'SI',
                3 => 'MNJ',
                4 => 'ELK',
                5 => 'DKT',
                6 => 'HKM',
                7 => 'DKV',
            };

            $angkatan = rand(2018, 2023);
            $nim = $nimPrefix . $angkatan . str_pad($i, 3, '0', STR_PAD_LEFT);

            $pekerjaan = rand(1, 4) === 1 ? null : $pekerjaanList[array_rand($pekerjaanList)];

            $alumni[] = [
                'nama_lengkap' => $fullName,
                'nim' => $nim,
                'email' => strtolower(Str::slug($fullName, '.')) . $i . '@email.com',
                'no_hp' => '08' . rand(111111111, 999999999),
                'fakultas_id' => $fakultas_id,
                'jurusan_id' => $jurusan_id,
                'angkatan' => $angkatan,
                'pekerjaan' => $pekerjaan,
                'status_alumni' => $statusList[array_rand($statusList)],
                'foto' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('alumnis')->insert($alumni);
    }
}
