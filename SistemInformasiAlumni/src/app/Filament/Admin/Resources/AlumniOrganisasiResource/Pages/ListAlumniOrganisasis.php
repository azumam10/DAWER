<?php

namespace App\Filament\Admin\Resources\AlumniOrganisasiResource\Pages;

use App\Filament\Admin\Resources\AlumniOrganisasiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAlumniOrganisasis extends ListRecords
{
    protected static string $resource = AlumniOrganisasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
