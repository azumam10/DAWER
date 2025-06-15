<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ✅ Buat role 'super_admin' kalau belum ada
        Role::firstOrCreate(['name' => 'super_admin']);

        // ✅ Cek jika belum ada user
        if(User::count() == 0){
            $user = User::factory()->create([
                'name' => 'Admin',
                'email' => 'admin@admin.com',
            ]);

            // ✅ Beri role 'super_admin'
            $user->assignRole('super_admin');
        }

        // ✅ Panggil seeder lain
        $this->call([
            FakultasSeeder::class,
            AlumniSeeder::class,
            OrganisasiSeeder::class,
            AlumniOrganisasiSeeder::class,
        ]);
    }
}
