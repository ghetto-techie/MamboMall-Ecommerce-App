<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;

class DashboardStats extends BaseWidget
{
    protected function getStats(): array
    {

        $totalOrders = Order::query()->where('payment_status','paid')->count();
        $totalSales = Order::where('payment_status', 'paid')
            ->whereNot('status', 'cancelled')
            ->count();
        $revenue = Order::query()->where('payment_status','paid')->sum('grand_total');
        $averageOrderValue = $totalOrders > 0 ? $revenue / $totalOrders : 0;
        $newCustomers = User::where('created_at', '>=', now()->subDays(30))->count();
        $pending = Order::where('status', 'processing')->count();
        $paidRate = $totalOrders > 0
            ? (Order::where('payment_status', 'paid')->count() / $totalOrders) * 100
            : 0;

        return [
            //
            Stat::make('Total Sales', $totalSales)
                ->color('primary')
                ->description('Paid orders only'),
            Stat::make('Pending Orders', $pending)
                ->color('warning'),
            Stat::make('Revenue',Number::currency($revenue, 'KES'))
                ->description('Paid orders only')
                ->color('success'),
            Stat::make('AOV', $averageOrderValue > 0 ? Number::currency($averageOrderValue, 'KSH') : Number::currency(0, 'KSH'))
                ->description('Average Order Value'),
            Stat::make('New Customers', $newCustomers)
                ->description('Last 30 days'),
            Stat::make('Payment Success Rate', number_format($paidRate, 1) . '%')
                ->color($paidRate >= 80 ? 'success' : 'danger'),

        ];
    }
}
