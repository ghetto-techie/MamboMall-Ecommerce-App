<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\OrderResource;
use App\Models\Order;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestOrders extends BaseWidget
{
    protected int | string | array $columnSpan = 'full'; // Full width of the parent container
    protected static ?int $sort = 2; // Position in the dashboard
    public function table(Table $table): Table
    {
        return $table
            ->query(OrderResource::getEloquentQuery())
            ->defaultPaginationPageOption(5)
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('id')
                    ->label('Order ID')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('user.name')
                    ->label('Customer Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Order Date')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('grand_total')
                    ->label('Total Amount')
                    ->formatStateUsing(fn ($state, Order $record): string => 
                        $record->currency . ' ' . number_format($state, 2))
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        Order::STATUS_NEW => 'gray',
                        Order::STATUS_PROCESSING => 'info',
                        Order::STATUS_SHIPPED => 'warning',
                        Order::STATUS_DELIVERED => 'success',
                        Order::STATUS_CANCELED => 'danger',
                        default => 'secondary',
                    })
                    ->icon(fn (string $state): string => match ($state) {
                        Order::STATUS_NEW => 'heroicon-m-sparkles',
                        Order::STATUS_PROCESSING => 'heroicon-m-arrow-path',
                        Order::STATUS_SHIPPED => 'heroicon-m-truck',
                        Order::STATUS_DELIVERED => 'heroicon-m-check-circle',
                        Order::STATUS_CANCELED => 'heroicon-m-x-circle',
                        default => 'heroicon-m-question-mark-circle',
                    })
                    ->sortable(),
                TextColumn::make('payment_status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'paid' => 'success',
                        'pending' => 'warning',
                        'failed' => 'danger',
                        default => 'secondary',
                    }),
                TextColumn::make('payment_method')
                    ->label('Payment Method')
                    ->sortable(),
            ])
            ->actions([
                Action::make('view')
                    ->label('View Order')
                    ->icon('heroicon-o-eye')
                    ->url(fn (Order $record): string => OrderResource::getUrl('view', [
                        'record' => $record,
                    ]))
                    ->color('info')
            ]);
    }


}
