<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use App\Models\Order;
use App\Services\InvoiceService;
use Filament\Actions;
use Filament\Facades\Filament;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Facades\Storage;

class ViewOrder extends ViewRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
                \Filament\Actions\Action::make('invoice')
                    ->label('Download Invoice')
                    ->icon('heroicon-o-document-arrow-down')
                    ->action(function (Order $record) {
                        $path = app(InvoiceService::class)->generateAndStore($record);
                        Notification::make()
                            ->title('Invoice ready')
                            ->body('Click to download the invoice.')
                            ->success()
                            ->icon('heroicon-o-check-circle')
                            ->actions([
                                \Filament\Notifications\Actions\Action::make('download')
                                    ->label('Download')
                                    ->url(Storage::disk('public')->url($path))
                                    ->openUrlInNewTab(),
                            ])
                            ->send();
                    }),
        ];
    }
}
