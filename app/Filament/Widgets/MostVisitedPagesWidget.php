<?php

namespace App\Filament\Widgets;

use App\Models\Visit;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class MostVisitedPagesWidget extends BaseWidget
{
    protected static ?string $heading = '📊 Most Visited Pages';

    protected static ?int $sort = 3;

    protected int|string|array $columnSpan = [
        'md' => 2,
        'xl' => 1,
    ];

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Visit::query()
                    ->selectRaw('COALESCE(MAX(id), 1) as id, page_title, page_url, COUNT(*) as visits')
                    ->whereNotNull('page_title')
                    ->where('page_title', '!=', '')
                    ->groupBy('page_title', 'page_url')
                    ->orderByDesc('visits')
                    ->limit(8)
            )
            ->columns([
                Tables\Columns\TextColumn::make('page_title')
                    ->label('عنوان الصفحة')
                    ->searchable(),
                Tables\Columns\TextColumn::make('page_url')
                    ->label('رابط الصفحة')
                    ->limit(30),
                Tables\Columns\TextColumn::make('visits')
                    ->label('عدد الزيارات')
                    ->badge()
                    ->color('success')
                    ->sortable(),
            ])
            ->paginated(false)
            ->defaultSort('visits', 'desc');
    }

    public function getTableRecordKey($record): string
    {
        return (string) ($record->id ?? md5($record->page_url ?? 'unknown'));
    }
}
