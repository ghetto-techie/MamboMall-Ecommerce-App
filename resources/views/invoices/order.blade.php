<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice</title>

    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ddd; padding: 6px; }
        th { background: #f3f3f3; }
        .right { text-align: right; }
        .header { display: flex; justify-content: space-between; }
        .logo { height: 60px; }
        .company { text-align: right; }
    </style>
</head>
<body>

<div class="header">
    <div>
        <img class="logo" src="{{ public_path('storage/' . config('company.logo')) }}">
    </div>
    <div class="company">
        <strong>{{ config('company.name') }}</strong><br>
        {{ config('company.email') }}<br>
        {{ config('company.phone') }}<br>
        {{ config('company.address') }}
    </div>
</div>

<hr>

<h3>Invoice</h3>

<p>
    <strong>Invoice:</strong> ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}<br>
    <strong>Date:</strong> {{ $order->created_at->format('Y-m-d') }}
</p>

<p>
    <strong>Bill To:</strong><br>
    {{ $order->user->name }}<br>
    {{ $order->user->email }}
</p>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Product</th>
            <th class="right">Qty</th>
            <th class="right">Price</th>
            <th class="right">Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($order->items as $i => $item)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $item->product->name }}</td>
                <td class="right">{{ $item->quantity }}</td>
                <td class="right">{{ number_format($item->unit_amount, 2) }}</td>
                <td class="right">{{ number_format($item->total_amount, 2) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<p class="right">
    <strong>Grand Total:</strong>
    {{ number_format($order->grand_total, 2) }} {{ $order->currency }}
</p>

</body>
</html>
