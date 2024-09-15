<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipping Bill</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; }
        .bill-details, .order-details { width: 100%; margin-top: 20px; }
        .bill-details td, .order-details td { padding: 5px; }
    </style>
</head>
<body>
<div class="header">
    <h1>Shipping Bill</h1>
    <p>Bill Number: {{ $billNumber }}</p>
</div>

<table class="order-details">
    <tr>
        <td><strong>Client Name:</strong> {{ $order->client_name }}</td>
        <td><strong>Client Email:</strong> {{ $order->client_email }}</td>
    </tr>
    <tr>
        <td><strong>Client Address:</strong> {{ $order->client_address }}</td>
        <td><strong>Shipping Method:</strong> {{ $order->shipping_method }}</td>
    </tr>
</table>

<h3>Items</h3>
<table class="items">
    {{--    {{dd(json_decode($order->items))}}--}}
    @foreach(json_decode($order->items, true) as $item)
        <tr>
            <td>{{ $item['description'] }}</td>
            <td>{{ $item['quantity'] }}</td>
            <td>{{ $item['price'] }}</td>
        </tr>
    @endforeach
</table>

<h3>Total Amount: ${{ $order->total_amount }}</h3>
</body>
</html>
