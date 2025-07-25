<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\AlumniOrganisasiResource\Pages;
use App\Filament\Admin\Resources\AlumniOrganisasiResource\RelationManagers;
use App\Models\AlumniOrganisasi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AlumniOrganisasiResource extends Resource
{
    protected static ?string $model = AlumniOrganisasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('alumni_id')
                    ->label('Nama Alumni')
                    ->relationship('alumni', 'nama')
                    ->searchable()
                    ->preload()
                    ->required(),

                Forms\Components\Select::make('organisasi_id')
                    ->label('Jenis Organisasi')
                    ->relationship('organisasi', 'jenis_organisasi')
                    ->searchable()
                    ->preload()
                    ->required(),
            ]);
    }


    public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('alumni.nama') // Nama Alumni dari relasi
                ->label('Nama Alumni')
                ->searchable(),

            Tables\Columns\TextColumn::make('organisasi.jenis_organisasi') // Nama Organisasi dari relasi
                ->label('Jenis Organisasi')
                ->searchable(),

            Tables\Columns\TextColumn::make('created_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),

            Tables\Columns\TextColumn::make('updated_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ])
        ->filters([])
        ->actions([
            Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
        ]);
    }


    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAlumniOrganisasis::route('/'),
            'create' => Pages\CreateAlumniOrganisasi::route('/create'),
            'edit' => Pages\EditAlumniOrganisasi::route('/{record}/edit'),
        ];
    }
}
