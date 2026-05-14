<?php

namespace App\Filament\Personal\Resources\BloodPressureMeasurements\Widgets;

use App\Models\Personal\BloodPressureMeasurement;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Schema;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\ChartWidget\Concerns\HasFiltersSchema;

class BloodPressureMeasurementChartWidget extends ChartWidget
{
    use HasFiltersSchema;
    
    protected ?string $heading = 'Últimas mediciones de presión arterial';

    protected int | string | array $columnSpan = 'full';

    public function filtersSchema(Schema $schema): Schema
    {
        return $schema->components([
            DatePicker::make('fromDate')
                ->label('Desde')
                ->default(Carbon::today()->subDays(7)),
            DatePicker::make('toDate')
                ->label('Hasta')
                ->default(Carbon::today()),
        ]);
    }

    protected function getData(): array
    {
        try {
            $fromDate = $this->filters['fromDate'] ?? null;
            $toDate = $this->filters['toDate'] ?? null;

            if ($fromDate){
                $fromDate = Carbon::parse($fromDate)->startOfDay();
            }
            if ($toDate){
                $toDate = Carbon::parse($toDate)->endOfDay();
            }
        } catch (\Throwable $th) {
            $fromDate = null;
            $toDate = null;
        }

        if (!$fromDate || !$toDate) {
            $fromDate = Carbon::today()->subDays(7)->startOfDay();
            $toDate = Carbon::today()->endOfDay();
        }

        $widgetData = BloodPressureMeasurement::getWidgetDataForUser(auth()->id(), $fromDate, $toDate);
        
        return [
            'datasets' => $widgetData['datasets'],
            'labels' => $widgetData['labels'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
