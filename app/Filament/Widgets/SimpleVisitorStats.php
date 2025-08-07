<?php

namespace App\Filament\Widgets;

use App\Models\Visit;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Carbon\Carbon;

class SimpleVisitorStats extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        // Calculate statistics safely
        $todayCount = $this->getTodayVisits();
        $totalCount = Visit::count();
        $weekCount = $this->getWeekVisits();
        $monthCount = $this->getMonthVisits();

        return [
            Stat::make('Today\'s Visitors', number_format($todayCount))
                ->description('Total visits today')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),

            Stat::make('This Week\'s Visitors', number_format($weekCount))
                ->description('Total visits this week')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('primary'),

            Stat::make('This Month\'s Visitors', number_format($monthCount))
                ->description('Total visits this month')
                ->descriptionIcon('heroicon-m-chart-bar')
                ->color('warning'),

            Stat::make('Total Visits', number_format($totalCount))
                ->description('All visits since beginning')
                ->descriptionIcon('heroicon-m-globe-alt')
                ->color('info'),
        ];
    }

    private function getTodayVisits(): int
    {
        try {
            return Visit::whereDate('visited_at', Carbon::today())->count();
        } catch (\Exception $e) {
            return 0;
        }
    }

    private function getWeekVisits(): int
    {
        try {
            return Visit::whereBetween('visited_at', [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek()
            ])->count();
        } catch (\Exception $e) {
            return 0;
        }
    }

    private function getMonthVisits(): int
    {
        try {
            return Visit::whereBetween('visited_at', [
                Carbon::now()->startOfMonth(),
                Carbon::now()->endOfMonth()
            ])->count();
        } catch (\Exception $e) {
            return 0;
        }
    }
}
