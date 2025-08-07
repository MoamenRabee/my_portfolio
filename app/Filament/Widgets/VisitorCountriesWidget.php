<?php

namespace App\Filament\Widgets;

use App\Models\Visit;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\DB;

class VisitorCountriesWidget extends BaseWidget
{
    protected static ?string $heading = 'Top Visiting Countries';

    protected static ?int $sort = 5;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Visit::query()
                    ->selectRaw('COALESCE(MAX(id), 1) as id, country, COUNT(*) as visits, COUNT(DISTINCT ip_address) as unique_visitors')
                    ->whereNotNull('country')
                    ->where('country', '!=', '')
                    ->groupBy('country')
                    ->orderByDesc('visits')
                    ->limit(10)
            )
            ->columns([
                Tables\Columns\TextColumn::make('country')
                    ->label('الدولة')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('visits')
                    ->label('عدد الزيارات')
                    ->badge()
                    ->color('primary')
                    ->sortable(),
                Tables\Columns\TextColumn::make('unique_visitors')
                    ->label('زوار فريدون')
                    ->badge()
                    ->color('success')
                    ->sortable(),
                Tables\Columns\TextColumn::make('percentage')
                    ->label('النسبة المئوية')
                    ->getStateUsing(function ($record) {
                        $total = Visit::count();
                        return $total > 0 ? round(($record->visits / $total) * 100, 1) . '%' : '0%';
                    })
                    ->badge()
                    ->color('warning'),
            ])
            ->paginated(false);
    }

    public function getTableRecordKey($record): string
    {
        return (string) ($record->id ?? md5($record->country ?? 'unknown'));
    }
}
