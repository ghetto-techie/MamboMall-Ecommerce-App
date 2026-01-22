<?php

namespace App\Filament\Imports;

use App\Models\User;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserImporter extends Importer
{
    protected static ?string $model = User::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('name')
                ->requiredMapping()
                ->rules(['required', 'string', 'max:255']),

            ImportColumn::make('email')
                ->requiredMapping()
                ->rules(['required', 'email']),

            ImportColumn::make('password')
                ->rules(['nullable', 'string', 'min:8']),

            ImportColumn::make('email_verified_at')
                ->rules(['nullable', 'date']),
        ];
    }

    public function resolveRecord(): User
    {
        return User::firstOrNew([
            'email' => $this->data['email'],
        ]);
    }

    protected function beforeSave(): void
    {
        if (! empty($this->data['password'])) {
            $this->record->password = Hash::make($this->data['password']);
        } elseif (! $this->record->exists) {
            $this->record->password = Hash::make(Str::random(12));
        }
    }

    protected function afterSave(): void
    {
        if (! $this->record->email_verified_at) {
            $this->record->forceFill([
                'email_verified_at' => now(),
            ])->save();
        }
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        return "User import completed: {$import->successful_rows} imported, {$import->getFailedRowsCount()} failed.";
    }
}
