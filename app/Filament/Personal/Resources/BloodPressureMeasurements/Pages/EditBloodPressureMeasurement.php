<?php

namespace App\Filament\Personal\Resources\BloodPressureMeasurements\Pages;

use App\Filament\Personal\Resources\BloodPressureMeasurements\BloodPressureMeasurementResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBloodPressureMeasurement extends EditRecord
{
    protected static string $resource = BloodPressureMeasurementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
