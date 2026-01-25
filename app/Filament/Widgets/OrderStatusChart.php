<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;

class OrderStatusChart extends ChartWidget
{
    protected static ?string $heading = 'Orders by Status';
    protected static ?int $sort = 2;
    protected int|string|array $columnSpan = 1;

    protected function getData(): array
    {
        $data = Order::query()
            ->selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        return [
            'datasets' => [
                [
                    'data' => $data->values(),
                    'backgroundColor' => [
                        '#2563EB', // new
                        '#F59E0B', // processing
                        '#0EA5E9', // shipped
                        '#16A34A', // delivered
                        '#DC2626', // canceled
                    ],
                ],
            ],
            'labels' => $data->keys()->map(fn ($s) => ucfirst($s)),
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
