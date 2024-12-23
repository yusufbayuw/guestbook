<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GuestResource\Pages;
use App\Filament\Resources\GuestResource\RelationManagers;
use App\Models\Guest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GuestResource extends Resource
{
    protected static ?string $model = Guest::class;

    protected static ?string $navigationIcon = 'heroicon-o-identification';

    protected static ?string $modelLabel = 'Tamu';

    protected static ?string $slug = 'guest';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->label('Nama')
                    ->maxLength(255),
                Forms\Components\TextInput::make('nomor_hp')
                    ->label('Nomor HP')
                    ->required()
                    ->numeric()
                    ->maxLength(255),
                Forms\Components\TextInput::make('alamat')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('keperluan')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nomor_hp')
                    ->searchable()
                    ->copyable(),
                Tables\Columns\TextColumn::make('alamat')
                    ->searchable(),
                Tables\Columns\TextColumn::make('keperluan')
                    ->searchable()
                    ->wrap(),
                Tables\Columns\TextColumn::make('datang')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('pulang')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('foto_datang')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('foto_pulang')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('lama_kunjungan')
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
            ->filters([
                //
            ])
            ->actions([
                Action::make('pulang')
                    ->action(function ($record) {
                        $record->pulang = now();
                        $hoursDifference = $record->pulang->diffInHours($record->datang);
                        $minutesDifference = $record->pulang->diffInMinutes($record->datang) % 60;

                        $decimalHours = $hoursDifference + ($minutesDifference / 60);
                        $record->lama_kunjungan = number_format(abs($decimalHours), 3);

                        $record->save();
                    })
                    ->hidden(fn ($record) => $record->pulang ? true : false),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ManageGuests::route('/'),
        ];
    }
}
