<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\ContactMessage;

class ContactStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Messages', ContactMessage::count())
                ->description('Total number of messages')
                ->descriptionIcon('heroicon-o-envelope')
                ->color('primary'),

            Stat::make('Unread Messages', ContactMessage::where('is_read', false)->count())
                ->description('Messages that need review')
                ->descriptionIcon('heroicon-o-exclamation-circle')
                ->color('warning'),

            Stat::make('Today\'s Messages', ContactMessage::whereDate('created_at', today())->count())
                ->description('Messages received today')
                ->descriptionIcon('heroicon-o-calendar-days')
                ->color('success'),

            Stat::make('This Week\'s Messages', ContactMessage::whereBetween('created_at', [
                now()->startOfWeek(),
                now()->endOfWeek()
            ])->count())
                ->description('Messages this week')
                ->descriptionIcon('heroicon-o-chart-bar')
                ->color('info'),
        ];
    }
}
