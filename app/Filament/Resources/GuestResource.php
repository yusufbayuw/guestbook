<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Guest;
use App\Models\Gedung;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\Filter;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\GuestResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\GuestResource\RelationManagers;

class GuestResource extends Resource
{
    protected static ?string $model = Guest::class;

    protected static ?string $navigationIcon = 'heroicon-o-identification';

    protected static ?string $modelLabel = 'Tamu';

    protected static ?string $slug = 'guest';

    public static function getEloquentQuery(): Builder
    {
        $userAuth = auth()->user();
        if ($userAuth->hasRole('super_admin')) {
            return parent::getEloquentQuery();
        } else {
            //dd($userAuth->gedung->pluck('id')->toArray());
            return parent::getEloquentQuery()->whereIn('gedung_id', $userAuth->gedung->pluck('id')->toArray());
        }
    } 

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
                Forms\Components\Radio::make('gedung_id')
                    ->label('Pilih Lokasi Kunjungan:')
                    ->options(Gedung::all()->pluck('nama', 'id')->toArray())
                    ->descriptions(Gedung::all()->pluck('alamat', 'id')->toArray())
                    ->required(),
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
                    ->searchable()
                    ->wrap(),
                Tables\Columns\TextColumn::make('keperluan')
                    ->searchable()
                    ->wrap(),
                Tables\Columns\TextColumn::make('gedung.nama')
                    ->label('Gedung')
                    ->sortable(),
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
                    ->formatStateUsing(function ($state) {
                        if (!$state) {
                            return '-';
                        }
                        $totalSeconds = (float)$state * 3600;
                        $hours = floor($totalSeconds / 3600);
                        $minutes = floor(($totalSeconds % 3600) / 60);
                        $seconds = floor($totalSeconds % 60);

                        $result = '';
                        if ($hours > 0) {
                            $result .= $hours . ' jam ';
                        }
                        if ($minutes > 0) {
                            $result .= $minutes . ' menit ';
                        }
                        if ($seconds > 0 || $result === '') {
                            $result .= $seconds . ' detik';
                        }
                        return trim($result);
                    })
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
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from')
                            ->label('Dari: ')
                            ->inlineLabel()
                            ->default(now()->startOfDay())
                            ->maxDate(now()->subDay()->startOfDay())
                            ->columnSpan(2), // Each field takes 1 column
                        DatePicker::make('created_until')
                            ->label('s.d.')
                            ->inlineLabel()
                            ->default(now()->endOfDay())
                            ->maxDate(now()->endOfDay())
                            ->columnSpan(2),
                    ])
                    ->columns(4) // Ensure the form has 2 columns
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'] ?? null,
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'] ?? null,
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
            ], layout: FiltersLayout::AboveContent)
            ->hiddenFilterIndicators()
            ->defaultSort('pulang','asc')
            ->actions([
                Action::make('pulang')
                    ->icon('heroicon-o-arrow-right-end-on-rectangle')
                    ->action(function ($record) {
                        $record->pulang = now();
                        $hoursDifference = $record->pulang->diffInHours($record->datang);
                        $minutesDifference = $record->pulang->diffInMinutes($record->datang) % 60;

                        $decimalHours = $hoursDifference + ($minutesDifference / 60);
                        $record->lama_kunjungan = number_format(abs($decimalHours), 3);

                        $record->save();
                    })
                    ->hidden(fn($record) => $record->pulang ? true : false),
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
