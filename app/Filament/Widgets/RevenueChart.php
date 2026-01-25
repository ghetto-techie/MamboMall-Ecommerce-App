<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;
use Filament\Forms\Components\Select;
use Illuminate\Support\Collection;

class RevenueChart extends ChartWidget
{
    protected static ?string $heading = 'Revenue by Payment Method';
    protected static ?int $sort = 1;
    protected int|string|array $columnSpan = 2;

    protected function getFiltersFormSchema(): array
    {
        return [
            Select::make('range')
                ->label('Period')
                ->options([
                    '7' => 'Last 7 days',
                    '30' => 'Last 30 days',
                    '90' => 'Last 90 days',
                    '180' => 'Last 6 months',
                ])
                ->default('180'),
        ];
    }

    protected function getData(): array
    {
        $days = (int) ($this->filters['range'] ?? 180);
        $startDate = now()->subDays($days);

        $methods = [
            'cash' => [
                'label' => 'Cash',
                'color' => '#64748B', // slate
            ],
            'mpesa' => [
                'label' => 'M-Pesa',
                'color' => '#16A34A', // green
            ],
            'card' => [
                'label' => 'Card',
                'color' => '#2563EB', // blue
            ],
        ];

        $labels = $days <= 30
            ? $this->dailyLabels($days)
            : $this->monthlyLabels($days);

        $datasets = [];

        foreach ($methods as $method => $config) {
            $totals = Order::query()
                ->where('payment_status', 'paid')
                ->where('payment_method', $method)
                ->where('created_at', '>=', $startDate)
                ->get()
                ->groupBy(fn ($order) => $this->dateKey($order->created_at, $days))
                ->map(fn ($orders) => $orders->sum('grand_total'));

            $datasets[] = [
                'label' => $config['label'],
                'data' => $this->mapToLabels($labels, $totals),
                'borderColor' => $config['color'],
                'backgroundColor' => $config['color'],
                'tension' => 0.3,
            ];
        }

        return [
            'datasets' => $datasets,
            'labels' => array_values($labels),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => ['position' => 'bottom'],
            ],
            'scales' => [
                'y' => ['beginAtZero' => true],
            ],
        ];
    }

    /* ---------- Helpers ---------- */

    private function dailyLabels(int $days): array
    {
        return collect(range($days - 1, 0))
            ->map(fn ($i) => now()->subDays($i)->format('M d'))
            ->toArray();
    }

    private function monthlyLabels(int $days): array
    {
        return collect(range(ceil($days / 30) - 1, 0))
            ->map(fn ($i) => now()->subMonths($i)->format('M Y'))
            ->toArray();
    }

    private function dateKey($date, int $days): string
    {
        return $days <= 30
            ? $date->format('M d')
            : $date->format('M Y');
    }

    private function mapToLabels(array $labels, Collection $totals): array
    {
        return collect($labels)
            ->map(fn ($label) => (float) ($totals[$label] ?? 0))
            ->values()
            ->toArray();
    }
}
