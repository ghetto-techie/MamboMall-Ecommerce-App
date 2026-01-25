<?php


namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class OrdersChart extends ChartWidget
{
    protected static ?string $heading = 'Orders Overview';
    protected static ?int $sort = 2;
    protected int|string|array $columnSpan = 1;

    protected function getData(): array
    {
        $orders = Order::query()
            ->where('created_at', '>=', now()->subMonths(6))
            ->get()
            ->groupBy(fn ($order) => $order->created_at->format('M'));

        return [
            'datasets' => [
                [
                    'label' => 'Orders',
                    'data' => $orders->map->count()->values(),
                ],
            ],
            'labels' => $orders->keys(),
        ];
    }

    protected function getType(): string
    {
        return 'bar'; // line | bar | pie | doughnut | radar
    }
}
