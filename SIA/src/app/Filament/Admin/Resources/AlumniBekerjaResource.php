<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\AlumniBekerjaResource\Pages;
use App\Filament\Admin\Resources\AlumniBekerjaResource\RelationManagers;
use App\Models\AlumniBekerja;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AlumniBekerjaResource extends Resource
{
    protected static ?string $model = AlumniBekerja::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('foto')->label('Foto')->circular(),
                Tables\Columns\TextColumn::make('nama_lengkap')->searchable(),
                Tables\Columns\TextColumn::make('nim'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('no_hp'),
                Tables\Columns\TextColumn::make('fakultas.nama_fakultas')->label('Fakultas'),
                Tables\Columns\TextColumn::make('jurusan.nama_jurusan')->label('Jurusan'),
                Tables\Columns\TextColumn::make('angkatan'),
            ])
            ->filters([
                //
            ])
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
            'index' => Pages\ListAlumniBekerjas::route('/'),
        ];
    }
}
