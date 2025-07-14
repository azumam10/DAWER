<?php

namespace App\Imports;

use App\Models\Alumni;
use App\Models\Fakultas;
use App\Models\Jurusan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;

class AlumniImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Ambil ID fakultas berdasarkan nama
            $fakultas = Fakultas::where('nama_fakultas', $row['fakultas_id'])->first();
            $jurusan  = Jurusan::where('nama_jurusan', $row['jurusan_id'])->first();

            // Jika fakultas atau jurusan tidak ditemukan, skip baris ini
            if (!$fakultas || !$jurusan) {
                Log::warning('Data tidak valid saat import alumni.', [
                    'nama_lengkap'   => $row['nama_lengkap'] ?? '-',
                    'fakultas_input' => $row['fakultas_id'] ?? '-',
                    'jurusan_input'  => $row['jurusan_id'] ?? '-',
                ]);
                continue;
            }

            // Update jika NIM sudah ada, atau buat baru
            Alumni::updateOrCreate(
                ['nim' => $row['nim']], // Kondisi pencarian (unik)
                [
                    'nama_lengkap'   => $row['nama_lengkap'],
                    'email'          => $row['email'],
                    'no_hp'          => $row['no_hp'],
                    'fakultas_id'    => $fakultas->id,
                    'jurusan_id'     => $jurusan->id,
                    'angkatan'       => $row['angkatan'],
                    'pekerjaan'      => $row['pekerjaan'],
                    'status_alumni'  => $row['status_alumni'],
                ]
            );
        }
    }
}
    