<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ConfigResource\Pages;
use App\Filament\Resources\ConfigResource\RelationManagers;
use App\Models\Config;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ConfigResource extends Resource
{
    protected static ?string $model = Config::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog';

    protected static ?int $navigationSort = 2;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Personal Information')
                    ->description('Basic personal and professional details')
                    ->icon('heroicon-o-user')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('name_ar')
                                    ->label('Name (Arabic)')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('name_en')
                                    ->label('Name (English)')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('job_title_ar')
                                    ->label('Job Title (Arabic)')
                                    ->maxLength(255)
                                    ->default(null),
                                Forms\Components\TextInput::make('job_title_en')
                                    ->label('Job Title (English)')
                                    ->maxLength(255)
                                    ->default(null),
                                Forms\Components\TextInput::make('summary_ar')
                                    ->label('Summary (Arabic)')
                                    ->maxLength(255)
                                    ->default(null),
                                Forms\Components\TextInput::make('summary_en')
                                    ->label('Summary (English)')
                                    ->maxLength(255)
                                    ->default(null),
                            ]),
                        Forms\Components\RichEditor::make('about_me_ar')
                            ->label('About Me (Arabic)')
                            ->columnSpanFull(),
                        Forms\Components\RichEditor::make('about_me_en')
                            ->label('About Me (English)')
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Contact Information')
                    ->description('Contact details and address')
                    ->icon('heroicon-o-phone')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('phone')
                                    ->tel()
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('email')
                                    ->email()
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('address')
                                    ->maxLength(255)
                                    ->default(null)
                                    ->columnSpanFull(),
                            ]),
                    ]),

                Forms\Components\Section::make('Media & Files')
                    ->description('Upload images, CV and other files')
                    ->icon('heroicon-o-photo')
                    ->schema([
                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\FileUpload::make('logo')
                                    ->image()
                                    ->imageEditor()
                                    ->imageResizeMode('cover')
                                    ->imageCropAspectRatio('1:1')
                                    ->imageResizeTargetWidth('200')
                                    ->imageResizeTargetHeight('200')
                                    ->directory('logos')
                                    ->visibility('public'),
                                Forms\Components\FileUpload::make('profile_image')
                                    ->image()
                                    ->imageEditor()
                                    ->imageResizeMode('cover')
                                    ->imageCropAspectRatio('1:1')
                                    ->imageResizeTargetWidth('400')
                                    ->imageResizeTargetHeight('400')
                                    ->directory('profile-images')
                                    ->visibility('public'),
                                Forms\Components\FileUpload::make('cv')
                                    ->acceptedFileTypes(['application/pdf'])
                                    ->directory('cv')
                                    ->visibility('public'),
                            ]),
                    ]),

                Forms\Components\Section::make('Website Settings')
                    ->description('SEO and website configuration')
                    ->icon('heroicon-o-globe-alt')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('site_name')
                                    ->maxLength(255)
                                    ->default(null),
                                Forms\Components\TextInput::make('site_description')
                                    ->maxLength(255)
                                    ->default(null),
                                Forms\Components\TextInput::make('copyright')
                                    ->maxLength(255)
                                    ->default(null)
                                    ->columnSpanFull(),
                            ]),
                        Forms\Components\RichEditor::make('site_keywords')
                            ->label('Site Keywords')
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Social Media Links')
                    ->description('Social media profiles and links')
                    ->icon('heroicon-o-share')
                    ->schema([
                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('facebook')
                                    ->url()
                                    ->maxLength(255)
                                    ->default(null)
                                    ->prefixIcon('heroicon-o-globe-alt'),
                                Forms\Components\TextInput::make('twitter')
                                    ->url()
                                    ->maxLength(255)
                                    ->default(null)
                                    ->prefixIcon('heroicon-o-globe-alt'),
                                Forms\Components\TextInput::make('instagram')
                                    ->url()
                                    ->maxLength(255)
                                    ->default(null)
                                    ->prefixIcon('heroicon-o-globe-alt'),
                                Forms\Components\TextInput::make('linkedin')
                                    ->url()
                                    ->maxLength(255)
                                    ->default(null)
                                    ->prefixIcon('heroicon-o-globe-alt'),
                                Forms\Components\TextInput::make('youtube')
                                    ->url()
                                    ->maxLength(255)
                                    ->default(null)
                                    ->prefixIcon('heroicon-o-globe-alt'),
                                Forms\Components\TextInput::make('github')
                                    ->url()
                                    ->maxLength(255)
                                    ->default(null)
                                    ->prefixIcon('heroicon-o-globe-alt'),
                                Forms\Components\TextInput::make('whatsapp')
                                    ->tel()
                                    ->maxLength(255)
                                    ->default(null)
                                    ->prefixIcon('heroicon-o-phone'),
                                Forms\Components\TextInput::make('telegram')
                                    ->tel()
                                    ->maxLength(255)
                                    ->default(null)
                                    ->prefixIcon('heroicon-o-phone'),
                                Forms\Components\TextInput::make('pinterest')
                                    ->url()
                                    ->maxLength(255)
                                    ->default(null)
                                    ->prefixIcon('heroicon-o-globe-alt'),
                                Forms\Components\TextInput::make('tiktok')
                                    ->url()
                                    ->maxLength(255)
                                    ->default(null)
                                    ->prefixIcon('heroicon-o-globe-alt'),
                                Forms\Components\TextInput::make('snapchat')
                                    ->url()
                                    ->maxLength(255)
                                    ->default(null)
                                    ->prefixIcon('heroicon-o-globe-alt'),
                            ]),
                    ]),

                Forms\Components\Section::make('App Store Links')
                    ->description('Mobile app download links')
                    ->icon('heroicon-o-device-phone-mobile')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('google_play')
                                    ->label('Google Play Store')
                                    ->url()
                                    ->maxLength(255)
                                    ->default(null)
                                    ->prefixIcon('heroicon-o-device-phone-mobile'),
                                Forms\Components\TextInput::make('app_store')
                                    ->label('Apple App Store')
                                    ->url()
                                    ->maxLength(255)
                                    ->default(null)
                                    ->prefixIcon('heroicon-o-device-phone-mobile'),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('logo')
                    ->circular()
                    ->default('https://placehold.co/600x400?text=Logo'),
                Tables\Columns\TextColumn::make('name_en')
                    ->searchable(),
                Tables\Columns\TextColumn::make('job_title_ar')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListConfigs::route('/'),
            'create' => Pages\CreateConfig::route('/create'),
            'edit' => Pages\EditConfig::route('/{record}/edit'),
        ];
    }



    public static function canCreate(): bool
    {
        return false;
    }

    public static function canDelete(\Illuminate\Database\Eloquent\Model $record): bool
    {
        return false;
    }
}
