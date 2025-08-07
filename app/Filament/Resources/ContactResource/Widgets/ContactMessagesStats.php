<?php

namespace App\Filament\Resources\ContactResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\ContactMessage;

class ContactMessagesStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('إجمالي الرسائل', ContactMessage::count())
                ->description('العدد الكلي للرسائل')
                ->descriptionIcon('heroicon-o-envelope')
                ->color('primary'),

            Stat::make('رسائل غير مقروءة', ContactMessage::unreadCount())
                ->description('رسائل تحتاج إلى المراجعة')
                ->descriptionIcon('heroicon-o-exclamation-circle')
                ->color('warning'),

            Stat::make('رسائل اليوم', ContactMessage::todayCount())
                ->description('الرسائل المستلمة اليوم')
                ->descriptionIcon('heroicon-o-calendar-days')
                ->color('success'),

            Stat::make('رسائل هذا الأسبوع', ContactMessage::thisWeekCount())
                ->description('رسائل الأسبوع الحالي')
                ->descriptionIcon('heroicon-o-chart-bar')
                ->color('info'),
        ];
    }
}
