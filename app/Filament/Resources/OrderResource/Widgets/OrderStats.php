<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use App\Filament\Resources\OrderResource;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;

class OrderStats extends BaseWidget
{
    protected static ?string $resource = OrderResource::class;
    protected function getStats(): array
    {
        $userCounts = User::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('count', 'date');
        $orderCounts = Order::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('count', 'date');
        $dates = collect(range(0, 29))->map(function ($i) {
            return Carbon::today()->subDays(29 - $i)->toDateString();
        });
        return [
            //
            Stat::make('New Orders',Order::query()->where('status','new')->count()),
            Stat::make('Processing Orders', Order::query()->where('status', 'processing')->count()),
            Stat::make('Shipped Orders', Order::query()->where('status', 'shipped')->count()),
            // Stat::make('Active Products', Product::query()->where('is_active', true)->count())->description("All active products"),
            // Stat::make('Total Users', User::count())->description("All users"),
            Stat::make('Average Price', Number::currency(Order::query()->avg('grand_total') ?? 0, 'KSH'))
        ];
    }
}
