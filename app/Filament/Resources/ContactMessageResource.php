<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactMessageResource\Pages;
use App\Filament\Resources\ContactMessageResource\RelationManagers;
use App\Models\ContactMessage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Support\Colors\Color;

class ContactMessageResource extends Resource
{
    protected static ?string $model = ContactMessage::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';

    protected static ?string $navigationLabel = 'Contact Messages';

    protected static ?string $modelLabel = 'Contact Message';

    protected static ?string $pluralModelLabel = 'Contact Messages';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Message Details')
                    ->schema([
                        TextInput::make('name')
                            ->label('Name')
                            ->required()
                            ->disabled(),

                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->disabled(),

                        TextInput::make('phone')
                            ->label('Phone Number')
                            ->disabled(),

                        TextInput::make('subject')
                            ->label('Subject')
                            ->required()
                            ->disabled(),

                        Textarea::make('message')
                            ->label('Message')
                            ->required()
                            ->rows(6)
                            ->disabled(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Message Status')
                    ->schema([
                        Toggle::make('is_read')
                            ->label('Read')
                            ->default(false),

                        TextInput::make('ip_address')
                            ->label('IP Address')
                            ->disabled(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('subject')
                    ->label('Subject')
                    ->limit(50)
                    ->searchable()
                    ->sortable(),

                TextColumn::make('message')
                    ->label('Message')
                    ->limit(100)
                    ->searchable(),

                BooleanColumn::make('is_read')
                    ->label('Read')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Date Sent')
                    ->dateTime('Y-m-d H:i')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('is_read')
                    ->label('Read Status')
                    ->options([
                        '1' => 'Read',
                        '0' => 'Unread',
                    ]),
            ])
            ->actions([
                Action::make('mark_read')
                    ->label('Mark as Read')
                    ->icon('heroicon-o-eye')
                    ->color(Color::Green)
                    ->visible(fn(ContactMessage $record): bool => !$record->is_read)
                    ->action(function (ContactMessage $record): void {
                        $record->markAsRead();
                        Notification::make()
                            ->title('Message marked as read')
                            ->success()
                            ->send();
                    }),

                Action::make('mark_unread')
                    ->label('Mark as Unread')
                    ->icon('heroicon-o-eye-slash')
                    ->color(Color::Gray)
                    ->visible(fn(ContactMessage $record): bool => $record->is_read)
                    ->action(function (ContactMessage $record): void {
                        $record->markAsUnread();
                        Notification::make()
                            ->title('Message marked as unread')
                            ->success()
                            ->send();
                    }),

                Tables\Actions\ViewAction::make()
                    ->label('View'),
                Tables\Actions\DeleteAction::make()
                    ->label('Delete'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Delete Selected'),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListContactMessages::route('/'),
            'edit' => Pages\EditContactMessage::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('is_read', false)->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        $count = static::getModel()::where('is_read', false)->count();
        return $count > 0 ? 'warning' : null;
    }
}
