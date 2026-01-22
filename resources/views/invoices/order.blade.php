<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice</title>

    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 6px; }
        th { background: #f5f5f5; }
        .right { text-align: right; }
    </style>
</head>
<body>

<h2>Invoice</h2>

<p>
    <strong>Invoice:</strong> ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}<br>
    <strong>Date:</strong> {{ $order->created_at->format('Y-m-d') }}
</p>

<p>
    <strong>Customer:</strong><br>
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
