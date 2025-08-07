<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CertificationResource\Pages;
use App\Models\Certification;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CertificationResource extends Resource
{
    protected static ?string $model = Certification::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';

    protected static ?string $navigationGroup = 'Portfolio Management';

    protected static ?int $navigationSort = 5;

    public static function getModelLabel(): string
    {
        return __('filament.Certification');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament.Certifications');
    }

    public static function getNavigationLabel(): string
    {
        return __('filament.Certifications');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('Certification Information'))
                    ->schema([
                        Forms\Components\TextInput::make('name_ar')
                            ->label(__('Certification Name (Arabic)'))
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('name_en')
                            ->label(__('Certification Name (English)'))
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('issuing_organization_ar')
                            ->label(__('Issuing Organization (Arabic)'))
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('issuing_organization_en')
                            ->label(__('Issuing Organization (English)'))
                            ->required()
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Forms\Components\Section::make(__('Credential Details'))
                    ->schema([
                        Forms\Components\TextInput::make('credential_id')
                            ->label(__('Credential ID'))
                            ->maxLength(255),

                        Forms\Components\TextInput::make('credential_url')
                            ->label(__('Credential URL'))
                            ->url()
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Forms\Components\Section::make(__('Dates'))
                    ->schema([
                        Forms\Components\DatePicker::make('issue_date')
                            ->label(__('Issue Date')),

                        Forms\Components\DatePicker::make('expiry_date')
                            ->label(__('Expiry Date')),
                    ])
                    ->columns(2),

                Forms\Components\Section::make(__('Description'))
                    ->schema([
                        Forms\Components\Textarea::make('description_ar')
                            ->label(__('Description (Arabic)'))
                            ->rows(4)
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('description_en')
                            ->label(__('Description (English)'))
                            ->rows(4)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name_en')
                    ->label(__('Certification Name'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('issuing_organization_en')
                    ->label(__('Issuing Organization'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('issue_date')
                    ->label(__('Issue Date'))
                    ->date()
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('expiry_date')
                    ->label(__('Expiry Date'))
                    ->date()
                    ->sortable()
                    ->toggleable()
                    ->placeholder(__('No Expiry')),

                Tables\Columns\TextColumn::make('credential_url')
                    ->label(__('Credential URL'))
                    ->limit(30)
                    ->url(fn($record) => $record->credential_url)
                    ->openUrlInNewTab()
                    ->toggleable(),
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
            'index' => Pages\ListCertifications::route('/'),
            'create' => Pages\CreateCertification::route('/create'),
            'edit' => Pages\EditCertification::route('/{record}/edit'),
        ];
    }



    public static function canAccess(): bool
    {
        return false;
    }
}
