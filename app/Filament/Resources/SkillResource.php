<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SkillResource\Pages;
use App\Filament\Resources\SkillResource\RelationManagers;
use App\Models\Skill;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SkillResource extends Resource
{
    protected static ?string $model = Skill::class;

    protected static ?string $navigationIcon = 'heroicon-o-cpu-chip';

    protected static ?string $navigationGroup = 'Portfolio Management';

    protected static ?int $navigationSort = 6;

    public static function getModelLabel(): string
    {
        return __('Skill');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Skills');
    }

    public static function getNavigationLabel(): string
    {
        return __('Skills');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('Skill Information'))
                    ->description(__('Programming languages, frameworks, and technical skills'))
                    ->icon('heroicon-o-cpu-chip')
                    ->collapsible()
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('name_ar')
                                    ->label(__('Skill Name (Arabic)'))
                                    ->required()
                                    ->maxLength(255)
                                    ->prefixIcon('heroicon-o-code-bracket'),
                                Forms\Components\TextInput::make('name_en')
                                    ->label(__('Skill Name (English)'))
                                    ->required()
                                    ->maxLength(255)
                                    ->prefixIcon('heroicon-o-code-bracket'),
                            ]),
                    ]),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name_en')
                    ->label('Skill Name (English)')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('name_ar')
                    ->label('Skill Name (Arabic)')
                    ->searchable()
                    ->sortable()
                    ->color('gray'),
                Tables\Columns\TextColumn::make('projects_count')
                    ->label('Projects Using This Skill')
                    ->counts('projects')
                    ->badge()
                    ->color(fn($state) => match (true) {
                        $state >= 5 => 'success',
                        $state >= 3 => 'warning',
                        $state >= 1 => 'info',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Updated')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\Filter::make('popular_skills')
                    ->label('Popular Skills')
                    ->query(
                        fn(Builder $query): Builder =>
                        $query->has('projects', '>=', 3)
                    ),
                Tables\Filters\Filter::make('unused_skills')
                    ->label('Unused Skills')
                    ->query(
                        fn(Builder $query): Builder =>
                        $query->doesntHave('projects')
                    ),
                Tables\Filters\Filter::make('recently_added')
                    ->label('Recently Added')
                    ->query(
                        fn(Builder $query): Builder =>
                        $query->where('created_at', '>=', now()->subDays(30))
                    ),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                        ->color('info'),
                    Tables\Actions\EditAction::make()
                        ->color('warning'),
                    Tables\Actions\DeleteAction::make()
                        ->color('danger'),
                ])
                    ->label('Actions')
                    ->icon('heroicon-m-ellipsis-vertical')
                    ->size('sm')
                    ->color('gray')
                    ->button(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('mark_as_featured')
                        ->label('Mark as Featured')
                        ->icon('heroicon-o-star')
                        ->color('warning')
                        ->action(function ($records) {
                            // You can add a 'featured' field to the skills table if needed
                            // $records->each(function ($record) {
                            //     $record->update(['featured' => true]);
                            // });
                        })
                        ->requiresConfirmation()
                        ->disabled(true)
                        ->tooltip('Feature coming soon'),
                ]),
            ])
            ->defaultSort('name_en', 'asc')
            ->striped()
            ->paginated([10, 25, 50, 100]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSkills::route('/'),
            'create' => Pages\CreateSkill::route('/create'),
            'edit' => Pages\EditSkill::route('/{record}/edit'),
        ];
    }
}
