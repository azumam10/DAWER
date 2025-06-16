<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\EventResource\Pages;
use App\Models\Event;
use App\Models\Fakultas;
use App\Models\Jurusan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('judul_event')
                ->required()
                ->maxLength(255),
            Forms\Components\Textarea::make('deskripsi')
                ->required()
                ->columnSpanFull(),
            Forms\Components\DatePicker::make('tanggal_mulai')->required(),
            Forms\Components\DatePicker::make('tanggal_selesai')->required(),
            Forms\Components\TextInput::make('lokasi')
                ->required()
                ->maxLength(255),
            Forms\Components\Select::make('target_fakultas_id')
                ->label('Target Fakultas')
                ->options(Fakultas::all()->pluck('nama_fakultas', 'id'))
                ->searchable()
                ->preload(),
            Forms\Components\Select::make('target_jurusan_id')
                ->label('Target Jurusan')
                ->options(Jurusan::all()->pluck('nama_dengan_id', 'id'))
                ->searchable()
                ->preload()
                ->nullable(),
            Forms\Components\TextInput::make('target_angkatan'),
            Forms\Components\FileUpload::make('foto_event')
                ->image()
                ->disk('public')
                ->directory('event-foto')
                ->visibility('public')
                ->label('Foto Event'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('judul_event')->searchable(),
            Tables\Columns\ImageColumn::make('foto_event')->label('Foto')->disk('public')->circular()->height(50)->width(50),
            Tables\Columns\TextColumn::make('tanggal_mulai')->date()->sortable(),
            Tables\Columns\TextColumn::make('tanggal_selesai')->date()->sortable(),
            Tables\Columns\TextColumn::make('lokasi')->searchable(),
            Tables\Columns\TextColumn::make('targetFakultas.nama_fakultas')->label('Fakultas'),
            Tables\Columns\TextColumn::make('targetJurusan.nama_jurusan')->label('Jurusan'),
            Tables\Columns\TextColumn::make('target_angkatan'),
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
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
