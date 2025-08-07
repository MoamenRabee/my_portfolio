<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExperienceResource\Pages;
use App\Filament\Resources\ExperienceResource\RelationManagers;
use App\Models\Experience;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ExperienceResource extends Resource
{
    protected static ?string $model = Experience::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $navigationGroup = 'Portfolio Management';

    protected static ?int $navigationSort = 2;

    public static function getModelLabel(): string
    {
        return __('Experience');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Experiences');
    }

    public static function getNavigationLabel(): string
    {
        return __('Experiences');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('Position Details'))
                    ->description(__('Job title and position information'))
                    ->icon('heroicon-o-briefcase')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('title_ar')
                                    ->label(__('Job Title (Arabic)'))
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('title_en')
                                    ->label(__('Job Title (English)'))
                                    ->required()
                                    ->maxLength(255),
                            ]),
                        Forms\Components\RichEditor::make('description_ar')
                            ->label(__('Job Description (Arabic)'))
                            ->columnSpanFull(),
                        Forms\Components\RichEditor::make('description_en')
                            ->label(__('Job Description (English)'))
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Company Information')
                    ->description('Company details and branding')
                    ->icon('heroicon-o-building-office')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('company_name_ar')
                                    ->label('Company Name (Arabic)')
                                    ->maxLength(255)
                                    ->default(null),
                                Forms\Components\TextInput::make('company_name_en')
                                    ->label('Company Name (English)')
                                    ->maxLength(255)
                                    ->default(null),
                            ]),
                        Forms\Components\FileUpload::make('company_logo')
                            ->label('Company Logo')
                            ->image()
                            ->imageEditor()
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('1:1')
                            ->imageResizeTargetWidth('200')
                            ->imageResizeTargetHeight('200')
                            ->directory('company-logos')
                            ->visibility('public')
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Work Period & Location')
                    ->description('Duration and location of employment')
                    ->icon('heroicon-o-calendar-days')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\DatePicker::make('start_date')
                                    ->label('Start Date')
                                    ->required()
                                    ->displayFormat('d/m/Y')
                                    ->format('Y-m-d'),
                                Forms\Components\DatePicker::make('end_date')
                                    ->label('End Date')
                                    ->displayFormat('d/m/Y')
                                    ->format('Y-m-d')
                                    ->after('start_date')
                                    ->helperText('Leave empty if currently working here'),
                            ]),
                        Forms\Components\TextInput::make('location')
                            ->label('Work Location')
                            ->maxLength(255)
                            ->placeholder('e.g., Cairo, Egypt or Remote')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('company_logo')
                    ->label('Logo')
                    ->circular()
                    ->size(40)
                    ->defaultImageUrl('https://placehold.co/100x100?text=Logo'),
                Tables\Columns\TextColumn::make('title_en')
                    ->label('Position')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('company_name_en')
                    ->label('Company')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('location')
                    ->label('Location')
                    ->searchable()
                    ->badge()
                    ->color('gray'),
                Tables\Columns\TextColumn::make('start_date')
                    ->label('Start Date')
                    ->date('M Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->label('End Date')
                    ->date('M Y')
                    ->sortable()
                    ->placeholder('Present')
                    ->color(fn($state) => $state ? 'gray' : 'success'),
                Tables\Columns\TextColumn::make('duration')
                    ->label('Duration')
                    ->state(function ($record) {
                        $start = \Carbon\Carbon::parse($record->start_date);
                        $end = $record->end_date ? \Carbon\Carbon::parse($record->end_date) : \Carbon\Carbon::now();
                        return $start->diffForHumans($end, true);
                    })
                    ->badge()
                    ->color('primary'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\Filter::make('current_position')
                    ->label('Current Position')
                    ->query(fn(Builder $query): Builder => $query->whereNull('end_date')),
                Tables\Filters\Filter::make('past_positions')
                    ->label('Past Positions')
                    ->query(fn(Builder $query): Builder => $query->whereNotNull('end_date')),
                Tables\Filters\SelectFilter::make('location')
                    ->options(function () {
                        return \App\Models\Experience::whereNotNull('location')
                            ->distinct()
                            ->pluck('location', 'location')
                            ->toArray();
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('start_date', 'desc');
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
            'index' => Pages\ListExperiences::route('/'),
            'create' => Pages\CreateExperience::route('/create'),
            'edit' => Pages\EditExperience::route('/{record}/edit'),
        ];
    }
}
