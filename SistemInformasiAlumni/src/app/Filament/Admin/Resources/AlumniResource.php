<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\AlumniResource\Pages;
use App\Models\Alumni;
use App\Models\Fakultas;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AlumniResource extends Resource
{
    protected static ?string $model = Alumni::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('nim')
                    ->required()
                    ->maxLength(20),

                // ✅ Ini untuk tampilkan nama fakultas tapi simpan fakultas_id
                Forms\Components\Select::make('fakultas_id')
                    ->label('Fakultas')
                    ->relationship('fakultas', 'nama_fakultas')
                    ->searchable()
                    ->required(),

                Forms\Components\TextInput::make('tahun_lulus')
                    ->required(),

                Forms\Components\TextInput::make('pekerjaan')
                    ->maxLength(255)
                    ->default(null),

                Forms\Components\TextInput::make('email')
                    ->email()
                    ->maxLength(255)
                    ->default(null),

                Forms\Components\TextInput::make('no_telepon')
                    ->tel()
                    ->maxLength(15)
                    ->default(null),

                Forms\Components\Textarea::make('alamat')
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('status_pekerjaan')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->searchable(),

                Tables\Columns\TextColumn::make('nim')
                    ->searchable(),

                // ✅ Tampilkan nama fakultas dari relasi
                Tables\Columns\TextColumn::make('fakultas.nama_fakultas')
                    ->label('Fakultas')
                    ->searchable(),

                Tables\Columns\TextColumn::make('tahun_lulus'),

                Tables\Columns\TextColumn::make('pekerjaan')
                    ->searchable(),

                Tables\Columns\TextColumn::make('email')
                    ->searchable(),

                Tables\Columns\TextColumn::make('no_telepon')
                    ->searchable(),

                Tables\Columns\TextColumn::make('status_pekerjaan')
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAlumnis::route('/'),
            'create' => Pages\CreateAlumni::route('/create'),
            'edit' => Pages\EditAlumni::route('/{record}/edit'),
        ];
    }
}
