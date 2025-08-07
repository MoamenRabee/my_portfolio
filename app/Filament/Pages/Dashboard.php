<?php

namespace App\Filament\Pages;

use App\Models\Visit;
use Filament\Pages\Dashboard as BaseDashboard;
use Carbon\Carbon;

class Dashboard extends BaseDashboard
{
    public function getWidgets(): array
    {
        return [
            \App\Filament\Widgets\SimpleVisitorStats::class,
            \App\Filament\Widgets\ContactStatsWidget::class,
        ];
    }
}