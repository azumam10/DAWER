<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Organisasi;
use App\Models\Alumni;

class OrganisasiSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil data alumni pertama
        $alumni = Alumni::first();

        if ($alumni) {
            // Insert data organisasi dengan DB Facade
            DB::table('organisasi')->insert([
                'jenis_organisasi' => 'Himpunan Mahasiswa',
                'kegiatan' => 'Pengabdian masyarakat',
                'periode_kerja' => '2019-2020',
                'status_aktif' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
            // Ambil data organisasi pertama
            $organisasi = Organisasi::first();

            // Hubungkan organisasi ke alumni (jika relasi many-to-many)
            if (method_exists($alumni, 'organisasi')) {
                $alumni->organisasi()->attach($organisasi->id);
            }
        }
    }
}
