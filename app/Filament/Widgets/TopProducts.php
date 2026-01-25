<?php

namespace App\Filament\Widgets;

use App\Models\OrderItem;
use Filament\Widgets\ChartWidget;

class TopProducts extends ChartWidget
{
    protected static ?string $heading = 'Top Selling Products';
    protected static ?int $sort = 2;
    protected int|string|array $columnSpan = 1;

    protected function getData(): array
    {
        $items = OrderItem::query()
            ->selectRaw('product_id, SUM(quantity) as total_qty')
            ->groupBy('product_id')
            ->orderByDesc('total_qty')
            ->with('product')
            ->limit(5)
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Units Sold',
                    'data' => $items->pluck('total_qty'),
                    'backgroundColor' => '#2563EB',
                ],
            ],
            'labels' => $items->map(fn ($item) => $item->product->name),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
