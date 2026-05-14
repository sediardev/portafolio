<?php

namespace App\Filament\Personal\Resources\BloodPressureMeasurements\Pages;

use App\Filament\Personal\Resources\BloodPressureMeasurements\BloodPressureMeasurementResource;
use App\Filament\Personal\Resources\BloodPressureMeasurements\Widgets\BloodPressureMeasurementChartWidget;
use App\Filament\Personal\Resources\BloodPressureMeasurements\Widgets\BloodPressureMeasurementWidget;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBloodPressureMeasurements extends ListRecords
{
    protected static string $resource = BloodPressureMeasurementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            BloodPressureMeasurementWidget::class,
            BloodPressureMeasurementChartWidget::class,
        ];
    }
}
