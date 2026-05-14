<?php

namespace App\Filament\Personal\Resources\BloodPressureMeasurements;

use App\Filament\Personal\Resources\BloodPressureMeasurements\Pages\CreateBloodPressureMeasurement;
use App\Filament\Personal\Resources\BloodPressureMeasurements\Pages\EditBloodPressureMeasurement;
use App\Filament\Personal\Resources\BloodPressureMeasurements\Pages\ListBloodPressureMeasurements;
use App\Filament\Personal\Resources\BloodPressureMeasurements\Schemas\BloodPressureMeasurementForm;
use App\Filament\Personal\Resources\BloodPressureMeasurements\Tables\BloodPressureMeasurementsTable;
use App\Models\Personal\BloodPressureMeasurement;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class BloodPressureMeasurementResource extends Resource
{
    protected static ?string $model = BloodPressureMeasurement::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Medición de presión arterial';

    protected static ?string $modelLabel = 'Medición de presión arterial';

    protected static ?string $pluralModelLabel = 'Mediciones de presión arterial';

    protected static ?string $navigationLabel = 'Mediciones de presión arterial';

    public static function form(Schema $schema): Schema
    {
        return BloodPressureMeasurementForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BloodPressureMeasurementsTable::configure($table);
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
            'index' => ListBloodPressureMeasurements::route('/'),
            'create' => CreateBloodPressureMeasurement::route('/create'),
            'edit' => EditBloodPressureMeasurement::route('/{record}/edit'),
        ];
    }
}
