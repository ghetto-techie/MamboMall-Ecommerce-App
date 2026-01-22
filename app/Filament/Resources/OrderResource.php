<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers\AddressRelationManager;
use App\Models\Order;
use App\Models\Product;
use App\Services\InvoiceService;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Number;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;
    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    protected static ?int $navigationSort = 5;

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
                                        'card' => 'Credit Card',
                                        'mpesa' => 'M-Pesa',
                                        'cash_on_delivery' => 'Cash on Delivery',
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
                                        'new' => 'New',
                                        'processing' => 'Processing',
                                        'shipped' => 'Shipped',
                                        'delivered' => 'Delivered',
                                        'canceled' => 'Canceled',
                                    ])
                                    ->default('new')
                                    ->colors([
                                        'new' => 'primary',
                                        'processing' => 'warning',
                                        'shipped' => 'info',
                                        'delivered' => 'success',
                                        'canceled' => 'danger',
                                    ])
                                    ->icons([
                                        'new' => 'heroicon-m-sparkles',
                                        'processing' => 'heroicon-m-arrow-path',
                                        'shipped' => 'heroicon-m-truck',
                                        'delivered' => 'heroicon-m-check-badge',
                                        'canceled' => 'heroicon-m-x-circle',
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
                                        'pickup' => 'Pickup',
                                        'motorbike' => 'Motorbike',
                                        'courier' => 'Courier',
                                        'matatu_parcel' => 'Matatu Parcel',
                                        'g4s' => 'G4S',
                                    ])
                                    ->columnSpan(1),

                                TextInput::make('shipping_amount')
                                    ->label('Shipping Cost')
                                    ->prefixIcon('heroicon-o-truck')
                                    ->numeric()
                                    ->default(0)
                                    ->required()
                                    ->columnSpan(1),

                                Forms\Components\Select::make('currency')
                                    ->options([
                                        'KES' => 'KES - Kenyan Shilling',
                                        'USD' => 'USD - US Dollar',
                                        'EUR' => 'EUR - Euro',
                                        'GBP' => 'GBP - British Pound',
                                        'ZAR' => 'ZAR - South African Rand',
                                        'UGX' => 'UGX - Ugandan Shilling',
                                        'TZS' => 'TZS - Tanzanian Shilling',
                                    ])
                                    ->default('KES')
                                    ->required()
                                    ->live()
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
                                            ->live()
                                            ->afterStateUpdated(function ($state, Set $set, Get $get) {
                                                $price = Product::find($state)?->price ?? 0;
                                                $set('unit_amount', $price);
                                                $set('total_amount', $get('quantity') * $price);
                                            })
                                            ->columnSpan(5),

                                        TextInput::make('quantity')
                                            ->numeric()
                                            ->default(1)
                                            ->minValue(1)
                                            ->live(debounce: 500)
                                            ->afterStateUpdated(function ($state, Set $set, Get $get) {
                                                $set('total_amount', $state * $get('unit_amount'));
                                            })
                                            ->required()
                                            ->columnSpan(2),

                                        TextInput::make('unit_amount')
                                            ->label('Unit Price')
                                            ->prefix(fn(Get $get) => $get('../../currency') ? $get('../../currency') . ' ' : '')
                                            ->numeric()
                                            ->disabled()
                                            ->dehydrated()
                                            ->required()
                                            ->columnSpan(3),

                                        TextInput::make('total_amount')
                                            ->label('Total')
                                            ->prefix(fn(Get $get) => $get('../../currency') ? $get('../../currency') . ' ' : '')
                                            ->numeric()
                                            ->disabled()
                                            ->dehydrated()
                                            ->columnSpan(2),
                                    ])
                                    ->columns(12)
                                    ->columnSpanFull()
                                    ->reorderable()
                                    ->cloneable()
                                    ->deleteAction(
                                        fn(Forms\Components\Actions\Action $action) => $action->requiresConfirmation(),
                                    ),

                                Forms\Components\Placeholder::make('grand_total_placeholder')
                                    ->label('Grand Total')
                                    ->content(function (Get $get) {
                                        $itemsTotal = 0;
                                        $shipping = (float)($get('shipping_amount') ?? 0);

                                        if ($items = $get('items')) {
                                            foreach ($items as $item) {
                                                $itemsTotal += (float)($item['total_amount'] ?? 0);
                                            }
                                        }

                                        $grandTotal = $itemsTotal + $shipping;
                                        $currency = $get('currency') ?? 'KES';

                                        return Number::currency($grandTotal, $currency);
                                    }),

                                Hidden::make('grand_total')
                                    ->default(0)
                                    ->dehydrated()
                                    ->dehydrateStateUsing(function (Get $get) {
                                        $itemsTotal = 0;
                                        $shipping = (float)($get('shipping_amount') ?? 0);

                                        if ($items = $get('items')) {
                                            foreach ($items as $item) {
                                                $itemsTotal += (float)($item['total_amount'] ?? 0);
                                            }
                                        }

                                        return $itemsTotal + $shipping;
                                    }),
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
                    ->description(fn($record) => $record->user->email)
                    ->limit(20)
                    ->tooltip(fn($record) => $record->user->name),

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
                    ->money(fn($record) => $record->currency)
                    ->sortable()
                    ->alignEnd()
                    ->weight('bold')
                    ->color(fn($record) => $record->payment_status === 'paid' ? 'success' : 'primary'),

                // Additional columns (hidden by default)
                Tables\Columns\TextColumn::make('payment_method')
                    ->label('Payment Method')
                    ->formatStateUsing(fn($state) => match ($state) {
                        'card' => 'Credit Card',
                        'mpesa' => 'M-Pesa',
                        'cash_on_delivery' => 'Cash on Delivery',
                        default => ucwords(str_replace('_', ' ', $state))
                    })
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),

                Tables\Columns\TextColumn::make('shipping_method')
                    ->label('Shipping')
                    ->formatStateUsing(fn($state) => ucwords(str_replace('_', ' ', $state)))
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),

                Tables\Columns\TextColumn::make('shipping_amount')
                    ->label('Shipping Cost')
                    ->money(fn($record) => $record->currency)
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
                        'card' => 'Credit Card',
                        'mpesa' => 'M-Pesa',
                        'cash_on_delivery' => 'Cash on Delivery',
                    ])
                    ->indicator('Payment Method'),

                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->label('From Date'),
                        Forms\Components\DatePicker::make('created_until')
                            ->label('To Date'),
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
                        ->icon('heroicon-o-eye')
                        ->color('info'),

                    Tables\Actions\EditAction::make()
                        ->icon('heroicon-o-pencil')
                        ->color('warning'),

                    Tables\Actions\Action::make('mark_paid')
                        ->icon('heroicon-o-currency-dollar')
                        ->color('success')
                        ->action(fn($record) => $record->update(['payment_status' => 'paid']))
                        ->requiresConfirmation()
                        ->hidden(fn($record) => $record->payment_status === 'paid'),

                Tables\Actions\Action::make('invoice')
                    ->label('Download Invoice')
                    ->icon('heroicon-o-document-arrow-down')
                    ->action(function (Order $record) {
                        $path = app(InvoiceService::class)->generateAndStore($record);

                        Notification::make()
                            ->title('Invoice ready')
                            ->body('Click to download the invoice.')
                            ->success()
                            ->actions([
                                \Filament\Notifications\Actions\Action::make('download')
                                    ->label('Download')
                                    ->url(Storage::disk('public')->url($path))
                                    ->openUrlInNewTab(),
                            ])
                            ->send();
                    }),

                    Tables\Actions\DeleteAction::make()
                        ->icon('heroicon-o-trash')
                        ->color('danger'),
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
                Tables\Actions\BulkAction::make('download_invoices')
                    ->label('Download Invoices')
                    ->icon('heroicon-o-archive-box-arrow-down')
                    ->requiresConfirmation()
                    ->action(function ($records) {
                        $path = app(InvoiceService::class)
                            ->generateBulk($records->all());

                        Notification::make()
                            ->title('Invoices ready')
                            ->body('Download the ZIP file containing all invoices.')
                            ->success()
                            ->actions([
                                \Filament\Notifications\Actions\Action::make('download')
                                    ->label('Download ZIP')
                                    ->url(Storage::disk('public')->url($path))
                                    ->openUrlInNewTab(),
                            ])
                            ->send();
                    }),
            ])
            ->headerActions([
                Tables\Actions\ExportAction::make()
                    ->exporter(\App\Filament\Exports\OrderExporter::class)
                    ->label('Export')
                    ->icon('heroicon-o-arrow-up-tray')
                    ->color('secondary')
                    ->tooltip('Export all orders to a CSV file or Spreadsheet'),
            ])
            ->emptyStateHeading('No orders found')
            ->emptyStateDescription('Create your first order to get started')
            ->emptyStateIcon('heroicon-o-shopping-bag')
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                    ->label('Create Order')
                    ->icon('heroicon-o-plus')
            ])
            ->deferLoading()
            ->persistSearchInSession(); // Removed problematic method
    }

    public static function getRelations(): array
    {
        return [
            AddressRelationManager::class
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['id', 'user.name', 'user.email', 'payment_method', 'status'];
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
}
