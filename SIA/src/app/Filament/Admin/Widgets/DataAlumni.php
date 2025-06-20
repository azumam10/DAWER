<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Alumni;
use App\Models\Fakultas;
use App\Models\Jurusan;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class DataAlumni extends ChartWidget
{
    protected static ?string $heading = 'Distribusi Alumni per Fakultas & Jurusan';
    
    protected static ?int $sort = 1;
    
    // Membuat widget dapat direfresh
    protected static ?string $pollingInterval = '30s';
    
    // Menentukan ukuran widget
    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        // Data Alumni per Fakultas
        $alumniPerFakultas = Alumni::select('fakultas_id', DB::raw('count(*) as total'))
            ->with('fakultas:id,nama_fakultas')
            ->groupBy('fakultas_id')
            ->get();

        // Data Alumni per Jurusan (Top 10)
        $alumniPerJurusan = Alumni::select('jurusan_id', DB::raw('count(*) as total'))
            ->with('jurusan:id,nama_jurusan')
            ->groupBy('jurusan_id')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->get();

        // Warna untuk grafik
        $colors = [
            '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', 
            '#9966FF', '#FF9F40', '#FF6384', '#C9CBCF',
            '#4BC0C0', '#FF9F40', '#36A2EB', '#FFCE56'
        ];

        return [
            'datasets' => [
                [
                    'label' => 'Alumni per Fakultas',
                    'data' => $alumniPerFakultas->pluck('total')->toArray(),
                    'backgroundColor' => array_slice($colors, 0, $alumniPerFakultas->count()),
                    'borderColor' => array_slice($colors, 0, $alumniPerFakultas->count()),
                    'borderWidth' => 2,
                    'tension' => 0.4,
                ],
                [
                    'label' => 'Alumni per Jurusan (Top 10)',
                    'data' => $alumniPerJurusan->pluck('total')->toArray(),
                    'backgroundColor' => array_slice($colors, 0, $alumniPerJurusan->count()),
                    'borderColor' => array_slice($colors, 0, $alumniPerJurusan->count()),
                    'borderWidth' => 2,
                    'tension' => 0.4,
                ]
            ],
            'labels' => [
                ...$alumniPerFakultas->map(fn($item) => $item->fakultas->nama_fakultas ?? 'Unknown')->toArray(),
                ...$alumniPerJurusan->map(fn($item) => $item->jurusan->nama_jurusan ?? 'Unknown')->toArray()
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar'; // Bisa diganti dengan: 'bar', 'line', 'pie', 'polarArea', 'radar'
    }

    protected function getOptions(): array
    {
        return [
            'responsive' => true,
            'maintainAspectRatio' => false,
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'bottom',
                    'labels' => [
                        'usePointStyle' => true,
                        'padding' => 20,
                        'font' => [
                            'size' => 12,
                            'weight' => 'bold'
                        ]
                    ]
                ],
                'tooltip' => [
                    'backgroundColor' => 'rgba(0,0,0,0.8)',
                    'titleColor' => '#fff',
                    'bodyColor' => '#fff',
                    'borderColor' => '#fff',
                    'borderWidth' => 1,
                    'cornerRadius' => 8,
                    'displayColors' => true,
                    'callbacks' => [
                        'label' => 'function(context) {
                            return context.label + ": " + context.parsed + " Alumni (" + 
                                   Math.round((context.parsed / context.dataset.data.reduce((a, b) => a + b, 0)) * 100) + "%)";
                        }'
                    ]
                ]
            ],
            'animation' => [
                'animateRotate' => true,
                'animateScale' => true,
                'duration' => 2000,
                'easing' => 'easeOutQuart'
            ]
        ];
    }
}
