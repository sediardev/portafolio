<?php

namespace App\Models\Personal;

use App\Enums\Personal\Arm;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BloodPressureMeasurement extends Model
{
    protected $table = 'blood_pressure_measurements';

    protected $fillable = [
        'user_id',
        'arm',
        'systolic',
        'diastolic',
        'heart_rate',
        'measured_at',
    ];

    protected $casts = [
        'arm' => Arm::class,
        'measured_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function getWidgetDataForUser(int $userId, Carbon $fromDate, Carbon $toDate): array
    {
        $measurements = self::where('user_id', $userId)
            ->whereBetween('measured_at', [$fromDate->copy()->startOfDay(), $toDate->copy()->endOfDay()])
            ->orderBy('measured_at', 'desc')
            ->get()
            ->sortBy('measured_at');

        $datasets = [
            [
                'label' => 'Presión sistólica',
                'data' => $measurements->pluck('systolic')->toArray(),
                'borderColor' => '#36A2EB',
            ],
            [
                'label' => 'Presión diastólica',
                'data' => $measurements->pluck('diastolic')->toArray(),
                'borderColor' => '#FF6384',
            ],
            [
                'label' => 'Frecuencia cardíaca',
                'data' => $measurements->pluck('heart_rate')->toArray(),
                'borderColor' => '#4BC0C0',
            ],
        ];

        $labels = $measurements->pluck('measured_at')->map(function ($date) {
            return $date->format('d/m/Y H:i');
        })->toArray();

        return [
            'systolic_avg' => number_format($measurements->avg('systolic'), 0) ?: 'N/A',
            'diastolic_avg' => number_format($measurements->avg('diastolic'), 0) ?: 'N/A',
            'heart_rate_avg' => number_format($measurements->avg('heart_rate'), 0) ?: 'N/A',
            'datasets' => $datasets,
            'labels' => $labels,
        ];
    }
}
