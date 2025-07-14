<?php

namespace App\Exports;

use App\Models\Alumni;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AlumniExport implements FromCollection, WithHeadings, WithMapping
{
    protected $selectedIds;

    public function __construct($selectedIds = null)
    {
        $this->selectedIds = $selectedIds;
    }

    public function collection()
    {
        $query = Alumni::with(['fakultas', 'jurusan']);
        
        if ($this->selectedIds) {
            $query->whereIn('id', $this->selectedIds);
        }
        
        return $query->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Lengkap',
            'NIM',
            'Email',
            'No HP',
            'Fakultas',
            'Jurusan',
            'Angkatan',
            'Pekerjaan',
            'Status',
            'Dibuat',
            'Diperbarui',
        ];
    }

    public function map($alumni): array
    {
        return [
            $alumni->id,
            $alumni->nama_lengkap,
            $alumni->nim,
            $alumni->email,
            $alumni->no_hp,
            $alumni->fakultas->nama_fakultas ?? '',
            $alumni->jurusan->nama_jurusan ?? '',
            $alumni->angkatan,
            $alumni->pekerjaan,
            $alumni->status_alumni,
            $alumni->created_at->format('d/m/Y H:i'),
            $alumni->updated_at->format('d/m/Y H:i'),
        ];
    }
}