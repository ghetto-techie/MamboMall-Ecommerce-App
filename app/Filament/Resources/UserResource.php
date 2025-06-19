<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class UserResource extends Resource
{
    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Account Information')
                    ->description('User account details')
                    ->icon('heroicon-o-user-circle')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->minLength(1)
                            ->label("Full Name")
                            ->placeholder('John Doe')
                            ->columnSpan(2),
                        
                        TextInput::make('email')
                            ->required()
                            ->email()
                            ->label('Email Address')
                            ->placeholder('user@example.com')
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->columnSpan(2),
                        
                        DateTimePicker::make('email_verified_at')
                            ->label('Email Verification Date')
                            ->displayFormat('M d, Y H:i')
                            ->default(now())
                            ->columnSpan(1),
                        
                        TextInput::make('password')
                            ->label('Password')
                            ->password()
                            ->revealable()
                            ->helperText('Minimum 8 characters')
                            ->minLength(8)
                            ->required(fn($livewire): bool => $livewire instanceof Pages\CreateUser)
                            ->dehydrated(fn($state) => filled($state))
                            ->placeholder('••••••••')
                            ->columnSpan(1),
                    ])
                    ->columns(2)
                    ->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->icon('heroicon-o-user')
                    ->description(fn (User $record) => $record->email),
                
                TextColumn::make('email_verified_at')
                    ->label('Verification Status')
                    ->badge()
                    ->color(fn ($state): string => $state ? 'success' : 'danger')
                    ->formatStateUsing(fn ($state) => $state ? 'Verified' : 'Pending')
                    ->icon(fn ($state) => $state ? 'heroicon-o-check-circle' : 'heroicon-o-clock'),
                
                TextColumn::make('created_at')
                    ->label('Joined')
                    ->dateTime('M d, Y')
                    ->sortable()
                    ->description(fn (User $record) => $record->created_at->diffForHumans())
                    ->icon('heroicon-o-calendar'),
            ])
            ->filters([
                TernaryFilter::make('email_verified_at')
                    ->label('Email Verification')
                    ->placeholder('All Users')
                    ->trueLabel('Verified')
                    ->falseLabel('Unverified'),
                
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->label('From'),
                        Forms\Components\DatePicker::make('created_until')
                            ->label('To'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['created_from'], 
                                fn($q) => $q->whereDate('created_at', '>=', $data['created_from'])
                            )
                            ->when($data['created_until'], 
                                fn($q) => $q->whereDate('created_at', '<=', $data['created_until'])
                            );
                    })
                    ->indicateUsing(function (array $data): ?string {
                        if (!$data['created_from'] && !$data['created_until']) return null;
                        return 'Joined between ' . ($data['created_from'] ?? '∞') . ' and ' . ($data['created_until'] ?? '∞');
                    })
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make()->icon('heroicon-o-eye'),
                    EditAction::make()->icon('heroicon-o-pencil'),
                    DeleteAction::make()->icon('heroicon-o-trash'),
                ])
                ->icon('heroicon-m-ellipsis-vertical')
                ->size('sm')
                ->color('gray')
                ->button()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->icon('heroicon-o-trash')
                        ->requiresConfirmation(),
                ]),
            ])
            ->emptyStateHeading('No users found')
            ->emptyStateDescription('Create your first user')
            ->emptyStateIcon('heroicon-o-user-plus')
            ->emptyStateActions([
                Tables\Actions\Action::make('create')
                    ->label('Create User')
                    ->url(route('filament.admin.resources.users.create'))
                    ->icon('heroicon-o-plus')
            ]);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'email'];
    }

    public static function getRelations(): array
    {
        return [
            \App\Filament\Resources\UserResource\RelationManagers\OrdersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}