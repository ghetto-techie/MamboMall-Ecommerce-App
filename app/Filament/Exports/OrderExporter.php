<?php

namespace App\Filament\Exports;

use App\Models\Order;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;

class OrderExporter extends Exporter
{
    protected static ?string $model = Order::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('Order ID')
                ->formatStateUsing(fn ($state) => 'ORD-' . str_pad($state, 5, '0', STR_PAD_LEFT)),

            ExportColumn::make('user.name')
                ->label('Customer Name'),

            ExportColumn::make('user.email')
                ->label('Customer Email'),

            ExportColumn::make('status')
                ->label('Order Status')
                ->formatStateUsing(fn ($state) => ucfirst($state)),

            ExportColumn::make('payment_status')
                ->label('Payment Status')
                ->formatStateUsing(fn ($state) => ucfirst($state)),

            ExportColumn::make('payment_method')
                ->label('Payment Method')
                ->formatStateUsing(fn ($state) => ucwords(str_replace('_', ' ', $state))),

            ExportColumn::make('shipping_method')
                ->label('Shipping Method')
                ->formatStateUsing(fn ($state) => ucwords(str_replace('_', ' ', $state))),

            ExportColumn::make('shipping_amount')
                ->label('Shipping Cost')
                ->formatStateUsing(fn ($state, $record) =>
                    $record->currency . ' ' .
                    number_format($state, 2)
                ),

            ExportColumn::make('grand_total')
                ->label('Grand Total')
                ->formatStateUsing(fn ($state, $record) =>
                    $record->currency . ' ' .
                    number_format($state, 2)),

            /**
             * 🔥 Flatten order items
             */
            ExportColumn::make('items')
                ->label('Order Items')
                ->formatStateUsing(function ($state, Order $record) {
                    return $record->items
                        ->map(function ($item) use ($record) {
                            return "{$item->product->name} x{$item->quantity} ({$record->currency} "
                                . number_format($item->total_amount, 2) . ")";
                        })
                        ->implode(', ');
                }),

            ExportColumn::make('notes')
                ->label('Order Notes'),

            ExportColumn::make('created_at')
                ->label('Order Date')
                ->formatStateUsing(fn ($state) => $state->format('Y-m-d H:i')),
        ];
    }
    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your order export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }

    public static function getCompletedNotification(Export $export): Notification
    {
        return Notification::make()
            ->title('Export completed')
            ->body(static::getCompletedNotificationBody($export))
            ->success()
            ->actions([
                Action::make('download')
                    ->label('Download')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->url($export->getDownloadUrl())
                    ->openUrlInNewTab(),
            ]);
    }
}
