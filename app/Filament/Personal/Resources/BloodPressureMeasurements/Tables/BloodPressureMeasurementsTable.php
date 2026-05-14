<?php

namespace App\Filament\Personal\Resources\BloodPressureMeasurements\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BloodPressureMeasurementsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('arm')
                    ->label('Brazo')
                    ->searchable()
                    ->formatStateUsing(fn($state) => $state->label()),
                TextColumn::make('systolic')
                    ->label('Presión sistólica')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('diastolic')
                    ->label('Presión diastólica')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('heart_rate')
                    ->label('Frecuencia cardíaca')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('measured_at')
                    ->label('Fecha y hora de la medición')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('measured_at', 'desc')
            ->modifyQueryUsing(function ($query) {
                $query->where('user_id', auth()->id());
            });
    }
}
