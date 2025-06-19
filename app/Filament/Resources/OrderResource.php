<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers\AddressRelationManager;
use App\Models\Order;
use App\Models\Product;
use App\Filament\Resources\OrderResource\Widgets\OrderStats;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Number;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;
    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    protected static ?int $navigationSort = 1;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'new')->count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return 'primary';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                    ->schema([
                        // Order Information Section
                        Section::make('Order Details')
                            ->schema([
                                Forms\Components\Select::make('user_id')
                                    ->relationship('user', 'name')
                                    ->label('Customer')
                                    ->searchable()
                                    ->preload()
                                    ->required()
                                    ->columnSpan(2),

                                Forms\Components\Select::make('payment_method')
                                    ->options([
                                        'stripe' => 'Stripe',
                                        'cod' => 'Cash on Delivery',
                                        'payhero' => 'M-Pesa STK',
                                        'equitel' => 'Equitel',
                                        'paypal' => 'PayPal',
                                    ])
                                    ->required()
                                    ->columnSpan(1),

                                Forms\Components\Select::make('payment_status')
                                    ->options([
                                        'pending' => 'Pending',
                                        'paid' => 'Paid',
                                        'failed' => 'Failed',
                                        'refunded' => 'Refunded',
                                    ])
                                    ->default('pending')
                                    ->required()
                                    ->columnSpan(1),

                                ToggleButtons::make('status')
                                    ->options([
                                        Order::STATUS_NEW => 'New',
                                        Order::STATUS_PROCESSING => 'Processing',
                                        Order::STATUS_SHIPPED => 'Shipped',
                                        Order::STATUS_DELIVERED => 'Delivered',
                                        Order::STATUS_CANCELED => 'Canceled',
                                    ])
                                    ->default('new')
                                    ->colors([
                                        Order::STATUS_NEW => 'primary',
                                        Order::STATUS_PROCESSING => 'warning',
                                        Order::STATUS_SHIPPED => 'info',
                                        Order::STATUS_DELIVERED => 'success',
                                        Order::STATUS_CANCELED => 'danger',
                                    ])
                                    ->icons([
                                        Order::STATUS_NEW => 'heroicon-m-sparkles',
                                        Order::STATUS_PROCESSING => 'heroicon-m-arrow-path',
                                        Order::STATUS_SHIPPED => 'heroicon-m-truck',
                                        Order::STATUS_DELIVERED => 'heroicon-m-check-badge',
                                        Order::STATUS_CANCELED => 'heroicon-m-x-circle',
                                    ])
                                    ->inline()
                                    ->required()
                                    ->columnSpan(2),
                            ])
                            ->columns(4),

                        // Shipping & Currency Section
                        Section::make('Shipping & Currency')
                            ->schema([
                                Forms\Components\Select::make('shipping_method')
                                    ->options([
                                        'fedex' => 'FedEX',
                                        'ups' => 'UPS',
                                        'sendy' => 'Sendy',
                                        'aerobatics' => 'Aerobatics',
                                        'pickup' => 'Pickup',
                                    ])
                                    ->columnSpan(1),

                                TextInput::make('shipping_amount')
                                    ->label('Shipping Cost')
                                    ->prefix('KSH')
                                    ->numeric()
                                    ->default(0)
                                    ->required()
                                    ->columnSpan(1),

                                Forms\Components\Select::make('currency')
                                    ->options([
                                        'ksh' => 'KSH - Kenyan Shilling',
                                        'USD' => 'USD - US Dollar',
                                        'EUR' => 'EUR - Euro',
                                        'GBP' => 'GBP - British Pound',
                                        'ZAR' => 'ZAR - South African Rand',
                                        'UGX' => 'UGX - Ugandan Shilling',
                                        'TZS' => 'TZS - Tanzanian Shilling',
                                    ])
                                    ->default('ksh')
                                    ->required()
                                    ->columnSpan(1),
                            ])
                            ->columns(3),

                        // Order Items Section
                        Section::make('Order Items')
                            ->schema([
                                Forms\Components\Repeater::make('items')
                                    ->relationship('items')
                                    ->label('Products')
                                    ->addActionLabel('Add Product')
                                    ->minItems(1)
                                    ->collapsible()
                                    ->itemLabel(fn(array $state) => Product::find($state['product_id'])?->name ?? 'Product')
                                    ->schema([
                                        Forms\Components\Select::make('product_id')
                                            ->relationship('product', 'name')
                                            ->preload()
                                            ->searchable()
                                            ->distinct()
                                            ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                                            ->required()
                                            ->reactive()
                                            ->afterStateUpdated(fn($state, Set $set) => $set('unit_amount', Product::find($state)?->price ?? 0))
                                            ->columnSpan(5),

                                        TextInput::make('quantity')
                                            ->numeric()
                                            ->default(1)
                                            ->minValue(1)
                                            ->reactive()
                                            ->afterStateUpdated(fn($state, Set $set, Get $get) => $set('total_amount', $state * $get('unit_amount')))
                                            ->required()
                                            ->columnSpan(2),

                                        TextInput::make('unit_amount')
                                            ->label('Unit Price')
                                            ->prefix('KSH')
                                            ->numeric()
                                            ->disabled()
                                            ->dehydrated()
                                            ->required()
                                            ->columnSpan(3),

                                        TextInput::make('total_amount')
                                            ->label('Total')
                                            ->prefix('KSH')
                                            ->numeric()
                                            ->required()
                                            ->dehydrated()
                                            ->columnSpan(2),
                                    ])
                                    ->columns(12)
                                    ->columnSpanFull(),

                                Forms\Components\Placeholder::make('grand_total_placeholder')
                                    ->label('Grand Total')
                                    ->content(function (Get $get) {
                                        $itemsTotal = 0;
                                        $shipping = $get('shipping_amount') ?? 0;

                                        if ($items = $get('items')) {
                                            foreach ($items as $item) {
                                                $itemsTotal += $item['total_amount'];
                                            }
                                        }

                                        $grandTotal = $itemsTotal + $shipping;
                                        return Number::currency($grandTotal, 'KSH');
                                    }),

                                Hidden::make('grand_total')
                                    ->default(0)
                                    ->dehydrated(),
                            ]),

                        // Additional Information Section
                        Section::make('Additional Information')
                            ->schema([
                                Forms\Components\Textarea::make('notes')
                                    ->label('Order Notes')
                                    ->placeholder('Internal notes or customer instructions...')
                                    ->rows(2)
                                    ->nullable()
                                    ->columnSpanFull(),
                            ])
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('Order ID')
                    ->formatStateUsing(fn($state) => 'ORD-' . str_pad($state, 5, '0', STR_PAD_LEFT))
                    ->description(fn($record) => $record->created_at->format('M j, Y'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Customer')
                    ->searchable()
                    ->sortable()
                    ->description(fn($record) => $record->user->email),

                Tables\Columns\SelectColumn::make('status')
                    ->label('Status')
                    ->options([
                        'new' => 'New',
                        'processing' => 'Processing',
                        'shipped' => 'Shipped',
                        'delivered' => 'Delivered',
                        'canceled' => 'Canceled',
                    ])
                    ->selectablePlaceholder(false)
                    ->afterStateUpdated(function ($record, $state) {
                        $record->update(['status' => $state]);
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('payment_status')
                    ->label('Payment')
                    ->badge()
                    ->formatStateUsing(fn($state) => ucfirst($state))
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'gray',
                        'paid' => 'success',
                        'failed' => 'danger',
                        'refunded' => 'warning',
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('grand_total')
                    ->label('Amount')
                    ->money('KSH')
                    ->sortable()
                    ->alignEnd()
                    ->weight('bold'),

                // Additional columns (hidden by default)
                Tables\Columns\TextColumn::make('payment_method')
                    ->label('Payment Method') // Changed from 'Method' to 'Payment Method'
                    ->formatStateUsing(fn($state) => match ($state) {
                        'payhero' => 'M-Pesa',
                        'cod' => 'Cash',
                        'equitel' => 'Equitel',
                        default => ucfirst($state)
                    })
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),

                Tables\Columns\TextColumn::make('shipping_method')
                    ->label('Shipping')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),

                Tables\Columns\TextColumn::make('shipping_amount')
                    ->label('Shipping Cost')
                    ->money('ksh')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('M d, Y H:i')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'new' => 'New',
                        'processing' => 'Processing',
                        'shipped' => 'Shipped',
                        'delivered' => 'Delivered',
                        'canceled' => 'Canceled',
                    ])
                    ->indicator('Status'),

                Tables\Filters\SelectFilter::make('payment_status')
                    ->options([
                        'pending' => 'Pending',
                        'paid' => 'Paid',
                        'failed' => 'Failed',
                        'refunded' => 'Refunded',
                    ])
                    ->indicator('Payment Status'),

                Tables\Filters\SelectFilter::make('payment_method')
                    ->options([
                        'stripe' => 'Stripe',
                        'cod' => 'Cash on Delivery',
                        'payhero' => 'M-Pesa',
                        'equitel' => 'Equitel',
                        'paypal' => 'PayPal',
                    ])
                    ->indicator('Payment Method'),

                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from'),
                        Forms\Components\DatePicker::make('created_until'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when(
                                $data['created_from'] ?? null,
                                fn($query, $date) => $query->whereDate('created_at', '>=', $date)
                            )
                            ->when(
                                $data['created_until'] ?? null,
                                fn($query, $date) => $query->whereDate('created_at', '<=', $date)
                            );
                    })
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                        ->icon('heroicon-o-eye'),

                    Tables\Actions\EditAction::make()
                        ->icon('heroicon-o-pencil'),

                    // Removed invoice action
                    Tables\Actions\DeleteAction::make()
                        ->icon('heroicon-o-trash'),
                ])
                    ->icon('heroicon-m-ellipsis-vertical')
                    ->size('sm')
                    ->link()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),

                    Tables\Actions\BulkAction::make('mark_paid')
                        ->icon('heroicon-o-banknotes')
                        ->action(fn($records) => $records->each->update(['payment_status' => 'paid']))
                        ->requiresConfirmation(),

                    Tables\Actions\BulkAction::make('mark_shipped')
                        ->icon('heroicon-o-truck')
                        ->action(fn($records) => $records->each->update(['status' => 'shipped']))
                        ->requiresConfirmation(),
                ]),
            ])
            ->emptyStateHeading('No orders found')
            ->emptyStateDescription('Create your first order to get started')
            ->emptyStateIcon('heroicon-o-shopping-bag')
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                    ->label('Create Order')
                    ->icon('heroicon-o-plus')
            ]);
    }

    public static function getRelations(): array
    {
        return [
                //
            AddressRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'view' => Pages\ViewOrder::route('/{record}'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            OrderStats::class
        ];
    }
}