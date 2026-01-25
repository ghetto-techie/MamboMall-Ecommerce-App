<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class UsersChart extends ChartWidget
{
    protected static ?string $heading = 'Users Overview';
    protected static ?int $sort = 2;
    protected int|string|array $columnSpan = 1;

    protected function getData(): array
    {
        $months = collect();

        for ($i = 5; $i >= 0; $i--) {
            $months->put(
                now()->subMonths($i)->format('M'),
                0
            );
        }

        $users = User::query()
            ->where('created_at', '>=', now()->subMonths(6))
            ->get()
            ->groupBy(fn ($user) => $user->created_at->format('M'));

        foreach ($users as $month => $group) {
            if ($months->has($month)) {
                $months[$month] = $group->count();
            }
        }

        return [
            'datasets' => [
                [
                    'label' => 'Users',
                    'data' => $months->values(),
                ],
            ],
            'labels' => $months->keys(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
