<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 py-10">

<div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-lg">
    <!-- Header Section -->
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Order Details</h1>
        <p class="text-lg text-gray-600">Order Number: {{ $order->id }}</p>
    </div>

    <!-- Client & Order Details -->
    <table class="w-full mb-6 border-collapse border border-gray-200">
        <tr class="bg-gray-50">
            <td class="p-4 border border-gray-200 text-sm font-medium text-gray-700"><strong>Client Name:</strong> {{ $order->client_name }}</td>
            <td class="p-4 border border-gray-200 text-sm font-medium text-gray-700"><strong>Client Email:</strong> {{ $order->client_email }}</td>
        </tr>
        <tr>
            <td class="p-4 border border-gray-200 text-sm font-medium text-gray-700"><strong>Client Address:</strong> {{ $order->client_address }}</td>
            <td class="p-4 border border-gray-200 text-sm font-medium text-gray-700"><strong>Shipping Method:</strong> {{ $order->shipping_method }}</td>
        </tr>
        <tr class="bg-gray-50">
            <td colspan="2" class="p-4 border border-gray-200 text-sm font-medium text-gray-700"><strong>Order Date:</strong> {{ $order->created_at->format('d M Y H:i') }}</td>
        </tr>
    </table>

    <!-- Items Section -->
    <h3 class="text-lg font-semibold text-gray-800 mb-4">Items</h3>
    <table class="w-full table-auto border-collapse border border-gray-200">
        <thead>
        <tr class="bg-gray-100">
            <th class="p-4 border border-gray-200 text-left font-semibold text-gray-600">Description</th>
            <th class="p-4 border border-gray-200 text-left font-semibold text-gray-600">Quantity</th>
            <th class="p-4 border border-gray-200 text-left font-semibold text-gray-600">Price (Rs.)</th>
        </tr>
        </thead>
        <tbody>
        @foreach(json_decode($order->items, true) as $item)
            <tr>
                <td class="p-4 border border-gray-200 text-sm text-gray-700">{{ $item['description'] }}</td>
                <td class="p-4 border border-gray-200 text-sm text-gray-700">{{ $item['quantity'] }}</td>
                <td class="p-4 border border-gray-200 text-sm text-gray-700">Rs. {{ number_format($item['price'], 2) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <!-- Total Amount -->
    <div class="text-right mt-6 text-lg font-bold text-gray-800">
        Total Amount: Rs. {{ number_format($order->total_amount, 2) }}
    </div>

    <!-- Created At Field -->
    <div class="text-left mt-2 text-sm text-gray-600">
        Order placed on: {{ $order->created_at->toDayDateTimeString() }}
    </div>

    <!-- Footer Section -->
    <div class="text-center mt-8">
        <p class="text-gray-500">Thank you for your order!</p>
    </div>
</div>

</body>
</html>
