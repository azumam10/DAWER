<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\AlumniResource\Pages;
use App\Models\Alumni;
use App\Models\Fakultas;
use App\Models\Jurusan;
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
            Forms\Components\Select::make('fakultas_id')
                ->label('Fakultas')
                ->options(Fakultas::all()->pluck('nama_fakultas', 'id'))
                ->searchable()
                ->preload()
                ->required(),
            Forms\Components\Select::make('jurusan_id')
                ->label('Jurusan')
                ->options(Jurusan::all()->pluck('nama_dengan_id', 'id'))
                ->searchable()
                ->preload()
                ->required(),
            Forms\Components\TextInput::make('angkatan')
                ->required(),
            Forms\Components\TextInput::make('pekerjaan')
                ->maxLength(255)
                ->default(null),
            Forms\Components\Select::make('status_alumni')
                ->options([
                    'aktif' => 'Aktif',
                    'tidak_aktif' => 'Tidak Aktif',
                    'meninggal' => 'Meninggal',
                ])
                ->required(),
            Forms\Components\FileUpload::make('foto')
                ->image()
                ->disk('public')
                ->directory('alumni-foto')
                ->visibility('public')
                ->label('Foto Alumni'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID')->sortable()->searchable(),
                Tables\Columns\ImageColumn::make('foto')->label('Foto')->disk('public')->circular()->height(50)->width(50),
                Tables\Columns\TextColumn::make('nama_lengkap')->searchable(),
                Tables\Columns\TextColumn::make('nim')->searchable(),
                Tables\Columns\TextColumn::make('email')->searchable(),
                Tables\Columns\TextColumn::make('no_hp')->searchable(),
                Tables\Columns\TextColumn::make('fakultas.nama_fakultas')->label('Fakultas'),
                Tables\Columns\TextColumn::make('jurusan.nama_jurusan')->label('Jurusan'),
                Tables\Columns\TextColumn::make('angkatan'),
                Tables\Columns\TextColumn::make('pekerjaan')->searchable(),
                Tables\Columns\TextColumn::make('status_alumni'),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAlumnis::route('/'),
            'create' => Pages\CreateAlumni::route('/create'),
            'edit' => Pages\EditAlumni::route('/{record}/edit'),
        ];
    }
}
