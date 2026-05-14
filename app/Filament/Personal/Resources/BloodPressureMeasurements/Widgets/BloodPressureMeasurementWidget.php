<?php

namespace App\Filament\Personal\Resources\BloodPressureMeasurements\Widgets;

use App\Models\Personal\BloodPressureMeasurement;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class BloodPressureMeasurementWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $widgetData = BloodPressureMeasurement::getWidgetDataForUser(auth()->id(), Carbon::today()->subDays(15), Carbon::today());

        return [
            Stat::make('Presión sistólica promedio', $widgetData['systolic_avg']),
            Stat::make('Presión diastólica promedio', $widgetData['diastolic_avg']),
            Stat::make('Frecuencia cardíaca promedio', $widgetData['heart_rate_avg']),
        ];
    }
}
