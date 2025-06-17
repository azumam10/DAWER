<?php

namespace App\Filament\Admin\Resources\AlumniBekerjaResource\Pages;

use App\Filament\Admin\Resources\AlumniBekerjaResource;
use Filament\Resources\Pages\ListRecords;

class ListAlumniBekerjas extends ListRecords
{
    protected static string $resource = AlumniBekerjaResource::class;

    protected function getHeaderActions(): array
    {
        return []; // disable tombol tambah jika tidak perlu
    }
}
