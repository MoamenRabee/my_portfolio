<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EducationResource\Pages;
use App\Models\Education;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class EducationResource extends Resource
{
    protected static ?string $model = Education::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationGroup = 'Portfolio Management';

    protected static ?int $navigationSort = 4;



    public static function getModelLabel(): string
    {
        return __('filament.Education');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament.Education');
    }

    public static function getNavigationLabel(): string
    {
        return __('filament.Education');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('filament.Basic Information'))
                    ->schema([
                        Forms\Components\TextInput::make('degree_ar')
                            ->label(__('filament.Degree (Arabic)'))
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('degree_en')
                            ->label(__('filament.Degree (English)'))
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('institution_ar')
                            ->label(__('filament.Institution (Arabic)'))
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('institution_en')
                            ->label(__('filament.Institution (English)'))
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('field_of_study_ar')
                            ->label(__('filament.Field of Study (Arabic)'))
                            ->maxLength(255),

                        Forms\Components\TextInput::make('field_of_study_en')
                            ->label(__('filament.Field of Study (English)'))
                            ->maxLength(255),

                        Forms\Components\TextInput::make('location')
                            ->label(__('filament.Location'))
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Forms\Components\Section::make(__('filament.Academic Performance'))
                    ->schema([
                        Forms\Components\TextInput::make('gpa')
                            ->label(__('filament.GPA'))
                            ->numeric()
                            ->step(0.01)
                            ->minValue(0)
                            ->maxValue(4),

                        Forms\Components\TextInput::make('gpa_scale')
                            ->label(__('filament.GPA Scale'))
                            ->placeholder('4.0')
                            ->maxLength(10),
                    ])
                    ->columns(2),

                Forms\Components\Section::make(__('filament.Duration'))
                    ->schema([
                        Forms\Components\DatePicker::make('start_date')
                            ->label(__('filament.Start Date'))
                            ->required(),

                        Forms\Components\DatePicker::make('end_date')
                            ->label(__('filament.End Date')),
                    ])
                    ->columns(2),

                Forms\Components\Section::make(__('filament.Description'))
                    ->schema([
                        Forms\Components\Textarea::make('description_ar')
                            ->label(__('filament.Description (Arabic)'))
                            ->rows(4)
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('description_en')
                            ->label(__('filament.Description (English)'))
                            ->rows(4)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('degree_en')
                    ->label(__('filament.Degree'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('institution_en')
                    ->label(__('filament.Institution'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('field_of_study_en')
                    ->label(__('filament.Field of Study'))
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('gpa')
                    ->label(__('filament.GPA'))
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('start_date')
                    ->label(__('filament.Start Date'))
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('end_date')
                    ->label(__('filament.End Date'))
                    ->date()
                    ->sortable()
                    ->placeholder(__('filament.Present')),

                Tables\Columns\TextColumn::make('location')
                    ->label(__('filament.Location'))
                    ->toggleable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEducations::route('/'),
            'create' => Pages\CreateEducation::route('/create'),
            'edit' => Pages\EditEducation::route('/{record}/edit'),
        ];
    }

    public static function canAccess(): bool
    {
        return false;
    }


}
