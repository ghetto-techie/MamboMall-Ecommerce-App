<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class UsersTrendChart extends ChartWidget
{
    protected static ?string $heading = 'Users Trend in 30 days';
    protected static string $color = 'Amber';

    protected function getData(): array
    {
        $userCounts = User::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('count', 'date');

        $dates = collect(range(0, 29))->map(function ($i) {
            return Carbon::today()->subDays(29 - $i)->toDateString();
        });

        $data = $dates->map(fn($date) => $userCounts[$date] ?? 0)->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Users',
                    'data' => $data,
                ],
            ],
            'labels' => $dates->toArray(),
        ];
    }


    protected function getType(): string
    {
        return 'bar';
    }
}
