<?php

namespace App\Filament\Personal\Resources\BloodPressureMeasurements\Schemas;

use App\Enums\Personal\Arm;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BloodPressureMeasurementForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('arm')
                    ->label('Brazo')
                    ->options(
                        collect(Arm::cases())->mapWithKeys(fn (Arm $arm) => [
                            $arm->value => $arm->label(),
                        ])->toArray()
                    )
                    ->required(),
                TextInput::make('systolic')
                    ->label('Presión sistólica')
                    ->required()
                    ->numeric(),
                TextInput::make('diastolic')
                    ->label('Presión diastólica')
                    ->required()
                    ->numeric(),
                TextInput::make('heart_rate')
                    ->label('Frecuencia cardíaca')
                    ->required()
                    ->numeric(),
                DateTimePicker::make('measured_at')
                    ->label('Fecha y hora de la medición')
                    ->required()
                    ->default(now()),
            ]);
    }
}
