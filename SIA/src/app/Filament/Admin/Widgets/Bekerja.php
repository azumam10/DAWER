<?php

namespace App\Filament\Admin\Widgets;

use App\Models\AlumniBekerja;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class Bekerja extends ChartWidget
{
    protected static ?string $heading = 'Alumni Bekerja (Fakultas - Jurusan - Angkatan)';
    protected static ?string $maxHeight = '400px';
    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        // Ambil data alumni yang bekerja dari model AlumniBekerja
        $data = AlumniBekerja::select(
                'fakultas.nama_fakultas',
                'jurusan.nama_jurusan',
                'angkatan',
                DB::raw('COUNT(*) as total')
            )
            ->join('fakultas', 'alumnis.fakultas_id', '=', 'fakultas.id')
            ->join('jurusan', 'alumnis.jurusan_id', '=', 'jurusan.id')
            ->groupBy('fakultas.nama_fakultas', 'jurusan.nama_jurusan', 'angkatan')
            ->orderBy('fakultas.nama_fakultas')
            ->get();

        $labels = [];
        $values = [];

        foreach ($data as $item) {
            $labels[] = "{$item->nama_fakultas} - {$item->nama_jurusan} - {$item->angkatan}";
            $values[] = $item->total;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Alumni Bekerja',
                    'data' => $values,
                    'backgroundColor' => 'rgba(75, 192, 192, 0.6)',
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
