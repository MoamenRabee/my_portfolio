<?php

namespace App\Filament\Widgets;

use App\Models\Visit;
use Filament\Widgets\ChartWidget;
use Carbon\Carbon;

class DashboardVisitsChart extends ChartWidget
{
    protected static ?string $heading = 'Visits Chart (Last 30 Days)';

    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 'full';

    protected function getData(): array
    {
        $visits = Visit::getVisitsByDate(30);

        // Fill missing dates with zero
        $data = [];
        $labels = [];

        for ($i = 29; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $labels[] = Carbon::now()->subDays($i)->format('d/m');

            $visit = $visits->firstWhere('date', $date);
            $data[] = $visit ? $visit->count : 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'الزيارات',
                    'data' => $data,
                    'backgroundColor' => [
                        'rgba(59, 130, 246, 0.1)',
                        'rgba(16, 185, 129, 0.1)',
                        'rgba(245, 101, 101, 0.1)',
                        'rgba(251, 191, 36, 0.1)',
                        'rgba(139, 92, 246, 0.1)',
                    ],
                    'borderColor' => 'rgb(59, 130, 246)',
                    'borderWidth' => 3,
                    'fill' => true,
                    'tension' => 0.4,
                    'pointBackgroundColor' => 'rgb(59, 130, 246)',
                    'pointBorderColor' => 'rgb(255, 255, 255)',
                    'pointBorderWidth' => 2,
                    'pointRadius' => 5,
                    'pointHoverRadius' => 8,
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
            'maintainAspectRatio' => false,
            'interaction' => [
                'intersect' => false,
                'mode' => 'index',
            ],
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'top',
                    'labels' => [
                        'usePointStyle' => true,
                        'padding' => 20,
                    ],
                ],
                'tooltip' => [
                    'backgroundColor' => 'rgba(0, 0, 0, 0.8)',
                    'titleColor' => 'rgba(255, 255, 255, 1)',
                    'bodyColor' => 'rgba(255, 255, 255, 1)',
                    'borderColor' => 'rgba(59, 130, 246, 1)',
                    'borderWidth' => 1,
                ],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'grid' => [
                        'color' => 'rgba(0, 0, 0, 0.05)',
                    ],
                    'ticks' => [
                        'color' => 'rgba(0, 0, 0, 0.6)',
                    ],
                ],
                'x' => [
                    'grid' => [
                        'display' => false,
                    ],
                    'ticks' => [
                        'color' => 'rgba(0, 0, 0, 0.6)',
                    ],
                ],
            ],
        ];
    }
}
