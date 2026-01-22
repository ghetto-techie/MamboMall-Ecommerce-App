<?php

namespace App\Filament\Exports;

use App\Models\User;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Filament\Notifications\Notification;
use Filament\Notifications\Actions\Action;

class UserExporter extends Exporter
{
    protected static ?string $model = User::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('name')->label('Full Name'),
            ExportColumn::make('email')->label('Email Address'),
            ExportColumn::make('email_verified_at')
                ->label('Email Verified At')
                ->formatStateUsing(fn ($state) => $state ? $state->format('Y-m-d') : 'Unverified'),
            ExportColumn::make('created_at')
                ->label('Joined At')
                ->formatStateUsing(fn ($state) => $state->format('Y-m-d')),
        ];
    }

    /** REQUIRED by Exporter */
    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your user export has completed and '
            . number_format($export->successful_rows) . ' '
            . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' '
                . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }

    /** ✅ Optional override to add Download button */
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
