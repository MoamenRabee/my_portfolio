<?php

namespace App\Filament\Widgets;

use App\Models\Visit;
use Filament\Widgets\ChartWidget;
use Carbon\Carbon;

class VisitsPerHourChart extends ChartWidget
{
    protected static ?string $heading = 'Visits by Hour (Today)';

    protected static ?int $sort = 4;

    protected function getData(): array
    {
        $data = [];
        $labels = [];
        $today = Carbon::today();

        for ($hour = 0; $hour <= 23; $hour++) {
            $startTime = $today->copy()->addHours($hour);
            $endTime = $startTime->copy()->addHour();

            $count = Visit::whereBetween('visited_at', [$startTime, $endTime])->count();
            $data[] = $count;
            $labels[] = sprintf('%02d:00', $hour);
        }
        return [
            'datasets' => [
                [
                    'label' => 'الزيارات',
                    'data' => $data,
                    'backgroundColor' => 'rgba(34, 197, 94, 0.1)',
                    'borderColor' => 'rgb(34, 197, 94)',
                    'borderWidth' => 2,
                    'fill' => true,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'responsive' => true,
            'plugins' => [
                'legend' => [
                    'display' => false,
                ],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                ],
            ],
        ];
    }
}
