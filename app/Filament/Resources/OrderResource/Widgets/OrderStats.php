<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use App\Filament\Resources\OrderResource;
use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;

class OrderStats extends BaseWidget
{
    protected static ?string $resource = OrderResource::class;

    protected function getStats(): array
    {
        $paidOrders = Order::query()
            ->where('payment_status', 'paid')
            ->whereNot('status', 'cancelled');

        $totalOrders = $paidOrders->count();
        $revenue = $paidOrders->sum('grand_total');
        $aov = $totalOrders > 0 ? $revenue / $totalOrders : 0;

        $pendingOrders = Order::where('status', 'processing')->count();
        $cancelledOrders = Order::where('status', 'cancelled')->count();

        return [

            Stat::make('Revenue', Number::currency($revenue, 'KES'))
                ->description('Completed sales')
                ->color('success'),

            Stat::make('Average Order Value', Number::currency($aov, 'KES'))
                ->description('Revenue per order'),

            Stat::make('Orders', $totalOrders)
                ->description('Paid orders')
                ->color('primary'),

            Stat::make('Pending Orders', $pendingOrders)
                ->description('Need processing')
                ->color('warning'),

            // OPTIONAL: swap this with Pending if you prefer
            Stat::make('Cancelled Orders', $cancelledOrders)
                ->description('Lost sales')
                ->color('danger'),
        ];
    }
}
