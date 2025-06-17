<?php

namespace App\Filament\Admin\Widgets;

use App\Models\AlumniTidakBekerja;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class Belum_Bekerja extends ChartWidget
{
    protected static ?string $heading = 'Alumni Tidak Bekerja (Per Fakultas, Jurusan, Angkatan)';
    protected static ?string $maxHeight = '400px';
    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        // Ambil data agregat alumni tidak bekerja
        $data = AlumniTidakBekerja::select(
                'fakultas.nama_fakultas',
                'jurusan.nama_jurusan',
                'angkatan',
                DB::raw('count(*) as total')
            )
            ->join('fakultas', 'alumnis.fakultas_id', '=', 'fakultas.id')
            ->join('jurusan', 'alumnis.jurusan_id', '=', 'jurusan.id')
            ->groupBy('fakultas.nama_fakultas', 'jurusan.nama_jurusan', 'angkatan')
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
                    'label' => 'Jumlah Alumni Tidak Bekerja',
                    'data' => $values,
                    'backgroundColor' => 'rgba(54, 162, 235, 0.6)',
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
