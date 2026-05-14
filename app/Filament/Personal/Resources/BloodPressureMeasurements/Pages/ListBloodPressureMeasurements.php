<?php

namespace App\Filament\Personal\Resources\BloodPressureMeasurements\Pages;

use App\Ai\Agents\Personal\BloodPressureMeasurementAgent;
use App\Enums\Personal\Arm;
use App\Filament\Forms\Components\AudioRecorder;
use App\Filament\Personal\Resources\BloodPressureMeasurements\BloodPressureMeasurementResource;
use App\Filament\Personal\Resources\BloodPressureMeasurements\Widgets\BloodPressureMeasurementChartWidget;
use App\Filament\Personal\Resources\BloodPressureMeasurements\Widgets\BloodPressureMeasurementWidget;
use App\Models\Personal\BloodPressureMeasurement;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Laravel\Ai\Enums\Lab;
use Laravel\Ai\Transcription;

class ListBloodPressureMeasurements extends ListRecords
{
    protected static string $resource = BloodPressureMeasurementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
            Action::make('save-with-audio')
                ->label('Guardar con audio')
                ->modalSubmitActionLabel('Guardar con audio')
                ->modalHeading('Guardar medición de presión arterial con audio')
                ->schema([
                    Select::make('arm')
                        ->label('Brazo')
                        ->options(
                            collect(Arm::cases())->mapWithKeys(fn (Arm $arm) => [
                                $arm->value => $arm->label(),
                            ])->toArray()
                        )
                        ->required(),
                    AudioRecorder::make('audio')
                        ->required(),
                ])
                ->action(function (array $data) {
                    DB::beginTransaction();

                    try {
                        $transcript = Transcription::fromStorage($data['audio'], 'public')->generate();

                        $responseAi = (new BloodPressureMeasurementAgent)
                            ->prompt(
                                prompt: $transcript, 
                                provider: Lab::OpenAI,
                                model: 'gpt-4.1',
                            );

                        BloodPressureMeasurement::create([
                            'user_id' => auth()->id(),
                            'arm' => $data['arm'],
                            'systolic' => $responseAi['systolic'],
                            'diastolic' => $responseAi['diastolic'],
                            'heart_rate' => $responseAi['heart_rate'],
                            'measured_at' => now(),
                        ]);
                        
                        Storage::disk('public')->delete($data['audio']);

                        Notification::make()
                            ->title('Medición de presión arterial guardada')
                            ->info()
                            ->send();
                        
                        DB::commit();
                    } catch (\Throwable $th) {
                        DB::rollBack();

                        Notification::make()
                            ->title('Error al guardar la medición de presión arterial')
                            ->danger()
                            ->send();
                    }
                }),
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
