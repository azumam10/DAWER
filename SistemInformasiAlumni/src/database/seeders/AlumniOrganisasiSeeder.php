<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Alumni;
use App\Models\Organisasi;

class AlumniOrganisasiSeeder extends Seeder
{
    public function run(): void
    {
        $alumni1 = Alumni::first();
        $organisasi1 = Organisasi::first();

        if ($alumni1 && $organisasi1) {
            $alumni1->organisasi()->attach($organisasi1->id);
        }

        // Contoh tambahan jika kamu ingin lebih dari 1 relasi
        $alumni2 = Alumni::skip(1)->first();
        $organisasi2 = Organisasi::skip(1)->first();

        if ($alumni2 && $organisasi2) {
            $alumni2->organisasi()->attach($organisasi2->id);
        }
    }
}
