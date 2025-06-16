<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\LokerDistribusiManualResource\Pages;
use App\Filament\Admin\Resources\LokerDistribusiManualResource\RelationManagers;
use App\Models\LokerDistribusiManual;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LokerDistribusiManualResource extends Resource
{
    protected static ?string $model = LokerDistribusiManual::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('alumni_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('loker_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('status_kirim')
                    ->required(),
                Forms\Components\DateTimePicker::make('waktu_kirim')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('alumni_id')
                    ->label('ID Alumni')
                    ->sortable(),

                Tables\Columns\TextColumn::make('alumni.nama_lengkap')
                    ->label('Nama Alumni')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('loker_id')
                    ->label('ID Loker')
                    ->sortable(),

                Tables\Columns\TextColumn::make('loker.judul_loker')
                    ->label('Judul Loker')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('status_kirim'),

                Tables\Columns\TextColumn::make('waktu_kirim')
                    ->dateTime()
                    ->sortable(),

                Tables\Columns\ImageColumn::make('alumni.foto')
                    ->label('Foto Alumni')
                    ->disk('public')
                    ->circular(),

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
            'index' => Pages\ListLokerDistribusiManuals::route('/'),
            'create' => Pages\CreateLokerDistribusiManual::route('/create'),
            'edit' => Pages\EditLokerDistribusiManual::route('/{record}/edit'),
        ];
    }
}
