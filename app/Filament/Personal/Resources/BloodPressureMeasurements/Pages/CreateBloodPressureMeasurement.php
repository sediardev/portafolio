<?php

namespace App\Filament\Personal\Resources\BloodPressureMeasurements\Pages;

use App\Filament\Personal\Resources\BloodPressureMeasurements\BloodPressureMeasurementResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBloodPressureMeasurement extends CreateRecord
{
    protected static string $resource = BloodPressureMeasurementResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();

        return $data;
    }
}
