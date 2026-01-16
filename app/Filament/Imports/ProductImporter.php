<?php

namespace App\Filament\Imports;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\ImportColumn;
use Illuminate\Support\Str;
use Filament\Actions\Imports\Models\Import;

class ProductImporter extends Importer
{
    protected static ?string $model = Product::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('name')
                ->requiredMapping()
                ->rules(['required', 'string', 'max:255']),

            ImportColumn::make('description')
                ->rules(['nullable', 'string']),

            ImportColumn::make('price')
                ->requiredMapping()
                ->rules(['required', 'numeric', 'min:0']),

            ImportColumn::make('category')
                ->requiredMapping()
                ->rules(['required'])
                ->relationship(
                    resolveUsing: fn ($state) =>
                        Category::firstOrCreate(
                            ['name' => $state],
                            ['slug' => Str::slug($state)]
                        )
                ),

            ImportColumn::make('brand')
                ->requiredMapping()
                ->rules(['required'])
                ->relationship(
                    resolveUsing: fn ($state) =>
                        Brand::firstOrCreate(
                            ['name' => $state],
                            ['slug' => Str::slug($state)]
                        )
                ),

            ImportColumn::make('is_active'),

            ImportColumn::make('in_stock'),

            ImportColumn::make('is_featured'),

            ImportColumn::make('on_sale'),
        ];
    }

    public static function getDescription(): ?string
    {
        return 'Supported formats: CSV, XLSX, XLS, ODS';
    }

    public function resolveRecord(): Product
    {
        return Product::firstOrNew([
            'slug' => Str::slug(
                $this->data['slug']
                    ?? $this->data['name']
            ),
        ]);
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your product import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
