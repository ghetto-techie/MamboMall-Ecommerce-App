<?php

namespace App\Filament\Exports;

use App\Models\Product;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Models\Export;
use Filament\Notifications\Notification;
use Filament\Notifications\Actions\Action;
class ProductExporter extends Exporter
{
    protected static ?string $model = Product::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id'),

            ExportColumn::make('name')
                ->label('Product Name'),

            // TODO: Enable image export when needed
            // ExportColumn::make('images')
            //     ->label('Image URLs')
            //     ->formatStateUsing(function ($state) {
            //         if (! is_array($state)) {
            //             return null;
            //         }

            //         return collect($state)
            //             ->map(fn ($path) => asset('storage/' . $path))
            //             ->implode(', ');
            //     }),

            ExportColumn::make('slug'),

            ExportColumn::make('category.name')
                ->label('Category'),

            ExportColumn::make('brand.name')
                ->label('Brand'),

            ExportColumn::make('price')
                ->label('Price (KES)')
                ->formatStateUsing(fn ($state) => 'KES ' . number_format($state, 2)),

            ExportColumn::make('is_active')
                ->label('Active')
                ->formatStateUsing(fn (bool $state) => $state ? 'Yes' : 'No'),

            ExportColumn::make('in_stock')
                ->label('In Stock')
                ->formatStateUsing(fn (bool $state) => $state ? 'Yes' : 'No'),

            ExportColumn::make('is_featured')
                ->label('Featured')
                ->formatStateUsing(fn (bool $state) => $state ? 'Yes' : 'No'),

            ExportColumn::make('on_sale')
                ->label('On Sale')
                ->formatStateUsing(fn (bool $state) => $state ? 'Yes' : 'No'),

            ExportColumn::make('created_at')
                ->label('Created At')
                ->formatStateUsing(fn ($state) => $state->format('Y-m-d H:i')),
        ];
    }


    /** REQUIRED by Exporter */
    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your Product export has completed and '
            . number_format($export->successful_rows) . ' '
            . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' '
                . str('row')->plural($failedRowsCount) . ' failed to export.';
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
