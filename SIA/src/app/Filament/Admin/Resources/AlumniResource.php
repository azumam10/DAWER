<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\AlumniResource\Pages;
use App\Models\Alumni;
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
        return $form->schema([
            Forms\Components\TextInput::make('nama_lengkap')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('nim')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('email')
                ->email()
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('no_hp')
                ->maxLength(255)
                ->default(null),
            Forms\Components\TextInput::make('fakultas_id')
                ->required()
                ->numeric(),
            Forms\Components\TextInput::make('jurusan_id')
                ->required()
                ->numeric(),
            Forms\Components\TextInput::make('angkatan')
                ->required(),
            Forms\Components\TextInput::make('pekerjaan')
                ->maxLength(255)
                ->default(null),
            Forms\Components\TextInput::make('status_alumni')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_lengkap')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nim')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('no_hp')
                    ->searchable(),
                Tables\Columns\TextColumn::make('fakultas_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jurusan_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('angkatan'),
                Tables\Columns\TextColumn::make('pekerjaan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status_alumni'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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

    public static function getPages(): array
{
    return [
        'index' => Pages\ListAlumnis::route('/'),
        'create' => Pages\CreateAlumni::route('/create'),
        'edit' => Pages\EditAlumni::route('/{record}/edit'),
    ];
}

}
