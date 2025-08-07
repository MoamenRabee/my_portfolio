<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-code-bracket';

    protected static ?string $navigationGroup = 'Portfolio Management';

    protected static ?int $navigationSort = 3;

    public static function getModelLabel(): string
    {
        return __('Project');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Projects');
    }

    public static function getNavigationLabel(): string
    {
        return __('Projects');
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Project Information')
                    ->description('Basic project details and descriptions')
                    ->icon('heroicon-o-code-bracket')
                    ->collapsible()
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('title_ar')
                                    ->label('Project Title (Arabic)')
                                    ->required()
                                    ->maxLength(255)
                                    ->prefixIcon('heroicon-o-document-text'),
                                Forms\Components\TextInput::make('title_en')
                                    ->label('Project Title (English)')
                                    ->required()
                                    ->maxLength(255)
                                    ->prefixIcon('heroicon-o-document-text'),
                            ]),
                        Forms\Components\RichEditor::make('description_ar')
                            ->label('Project Description (Arabic)')
                            ->toolbarButtons([
                                'bold',
                                'bulletList',
                                'italic',
                                'link',
                                'orderedList',
                                'redo',
                                'strike',
                                'underline',
                                'undo',
                            ])
                            ->columnSpanFull(),
                        Forms\Components\RichEditor::make('description_en')
                            ->label('Project Description (English)')
                            ->toolbarButtons([
                                'bold',
                                'bulletList',
                                'italic',
                                'link',
                                'orderedList',
                                'redo',
                                'strike',
                                'underline',
                                'undo',
                            ])
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Project Links')
                    ->description('External links and repositories')
                    ->icon('heroicon-o-link')
                    ->collapsible()
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('website_link')
                                    ->label('Website URL')
                                    ->url()
                                    ->maxLength(255)
                                    ->default(null)
                                    ->prefixIcon('heroicon-o-globe-alt')
                                    ->placeholder('https://example.com'),
                                Forms\Components\TextInput::make('github_link')
                                    ->label('GitHub Repository')
                                    ->url()
                                    ->maxLength(255)
                                    ->default(null)
                                    ->prefixIcon('heroicon-o-code-bracket-square')
                                    ->placeholder('https://github.com/username/repo'),
                            ]),
                    ]),

                Forms\Components\Section::make('Mobile App Links')
                    ->description('App store download links')
                    ->icon('heroicon-o-device-phone-mobile')
                    ->collapsible()
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('google_play_link')
                                    ->label('Google Play Store')
                                    ->url()
                                    ->maxLength(255)
                                    ->default(null)
                                    ->prefixIcon('heroicon-o-device-phone-mobile')
                                    ->placeholder('https://play.google.com/store/apps/details?id=...'),
                                Forms\Components\TextInput::make('app_store_link')
                                    ->label('Apple App Store')
                                    ->url()
                                    ->maxLength(255)
                                    ->default(null)
                                    ->prefixIcon('heroicon-o-device-phone-mobile')
                                    ->placeholder('https://apps.apple.com/app/...'),
                            ]),
                    ]),

                Forms\Components\Section::make('Related Experience')
                    ->description('Link this project to work experience')
                    ->icon('heroicon-o-briefcase')
                    ->collapsible()
                    ->schema([
                        Forms\Components\Select::make('experience_id')
                            ->label('Related Experience')
                            ->relationship('experience', 'company_name_en')
                            ->searchable()
                            ->preload()
                            ->placeholder('Select related work experience (optional)')
                            ->helperText('Link this project to a specific work experience if applicable')
                            ->columnSpanFull(),
                    ]),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title_en')
                    ->label('Project Title')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('experience.company_name_en')
                    ->label('Related Experience')
                    ->searchable()
                    ->placeholder('No related experience')
                    ->color('gray'),
                Tables\Columns\TextColumn::make('skills.name_en')
                    ->label('Skills')
                    ->badge()
                    ->color('info')
                    ->limitList(3)
                    ->listWithLineBreaks()
                    ->placeholder('No skills assigned'),
                Tables\Columns\TextColumn::make('images_count')
                    ->label('Images')
                    ->counts('images')
                    ->badge()
                    ->color(fn($state) => match (true) {
                        $state >= 5 => 'success',
                        $state >= 3 => 'warning',
                        $state >= 1 => 'info',
                        default => 'gray',
                    }),
                Tables\Columns\IconColumn::make('website_link')
                    ->label('Website')
                    ->icon('heroicon-o-globe-alt')
                    ->color('primary')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle'),
                Tables\Columns\IconColumn::make('github_link')
                    ->label('GitHub')
                    ->icon('heroicon-o-code-bracket-square')
                    ->color('gray')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle'),
                Tables\Columns\IconColumn::make('google_play_link')
                    ->label('Play Store')
                    ->icon('heroicon-o-device-phone-mobile')
                    ->color('success')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle'),
                Tables\Columns\IconColumn::make('app_store_link')
                    ->label('App Store')
                    ->icon('heroicon-o-device-phone-mobile')
                    ->color('info')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle'),
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
                Tables\Filters\SelectFilter::make('experience_id')
                    ->label('Related Experience')
                    ->relationship('experience', 'title_en')
                    ->searchable()
                    ->preload(),
                Tables\Filters\SelectFilter::make('skills')
                    ->label('Skills')
                    ->relationship('skills', 'name_en')
                    ->searchable()
                    ->preload()
                    ->multiple(),
                Tables\Filters\Filter::make('has_images')
                    ->label('Has Images')
                    ->query(fn(Builder $query): Builder => $query->has('images')),
                Tables\Filters\Filter::make('no_images')
                    ->label('No Images')
                    ->query(fn(Builder $query): Builder => $query->doesntHave('images')),
                Tables\Filters\Filter::make('has_website')
                    ->label('Has Website')
                    ->query(fn(Builder $query): Builder => $query->whereNotNull('website_link')),
                Tables\Filters\Filter::make('has_github')
                    ->label('Has GitHub')
                    ->query(fn(Builder $query): Builder => $query->whereNotNull('github_link')),
                Tables\Filters\Filter::make('has_mobile_apps')
                    ->label('Has Mobile Apps')
                    ->query(fn(Builder $query): Builder => $query->where(function ($query) {
                        $query->whereNotNull('google_play_link')
                            ->orWhereNotNull('app_store_link');
                    })),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                        ->color('info'),
                    Tables\Actions\EditAction::make()
                        ->color('warning'),
                    Tables\Actions\DeleteAction::make()
                        ->color('danger'),
                    Tables\Actions\Action::make('visit_website')
                        ->label('Visit Website')
                        ->icon('heroicon-o-globe-alt')
                        ->color('primary')
                        ->url(fn($record) => $record->website_link)
                        ->openUrlInNewTab()
                        ->visible(fn($record) => !empty($record->website_link)),
                    Tables\Actions\Action::make('view_on_github')
                        ->label('View on GitHub')
                        ->icon('heroicon-o-code-bracket-square')
                        ->color('gray')
                        ->url(fn($record) => $record->github_link)
                        ->openUrlInNewTab()
                        ->visible(fn($record) => !empty($record->github_link)),
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
                    Tables\Actions\BulkAction::make('link_to_experience')
                        ->label('Link to Experience')
                        ->icon('heroicon-o-link')
                        ->color('primary')
                        ->form([
                            Forms\Components\Select::make('experience_id')
                                ->label('Experience')
                                ->relationship('experience', 'title_en')
                                ->searchable()
                                ->preload()
                                ->required(),
                        ])
                        ->action(function ($records, array $data) {
                            $records->each(function ($record) use ($data) {
                                $record->update(['experience_id' => $data['experience_id']]);
                            });
                        }),
                    Tables\Actions\BulkAction::make('assign_skills')
                        ->label('Assign Skills')
                        ->icon('heroicon-o-cpu-chip')
                        ->color('info')
                        ->form([
                            Forms\Components\Select::make('skills')
                                ->label('Skills')
                                ->relationship('skills', 'name_en')
                                ->multiple()
                                ->searchable()
                                ->preload()
                                ->required(),
                        ])
                        ->action(function ($records, array $data) {
                            $records->each(function ($record) use ($data) {
                                $record->skills()->sync($data['skills']);
                            });
                        }),
                    Tables\Actions\BulkAction::make('remove_experience_link')
                        ->label('Remove Experience Link')
                        ->icon('heroicon-o-x-mark')
                        ->color('warning')
                        ->action(function ($records) {
                            $records->each(function ($record) {
                                $record->update(['experience_id' => null]);
                            });
                        })
                        ->requiresConfirmation(),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->striped()
            ->paginated([10, 25, 50, 100]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ImagesRelationManager::class,
            RelationManagers\SkillsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
