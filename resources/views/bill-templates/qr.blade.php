<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipping Bill with QR Code</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        .container {
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 28px;
            color: #333;
        }

        .header p {
            font-size: 16px;
            color: #666;
        }

        .details-table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        .details-table td {
            padding: 10px;
            border: 1px solid #ddd;
            font-size: 14px;
            color: #333;
        }

        .details-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .details-table td strong {
            color: #555;
        }

        .items-table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .items-table th,
        .items-table td {
            padding: 10px;
            border: 1px solid #ddd;
            font-size: 14px;
        }

        .items-table th {
            background-color: #f1f1f1;
            color: #333;
            text-align: left;
        }

        .total {
            text-align: right;
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
        }

        .qrcode {
            text-align: center;
            margin-top: 40px;
        }

        .qrcode h3 {
            font-size: 18px;
            color: #333;
            margin-bottom: 10px;
        }

        .qrcode img {
            border: 1px solid #ddd;
            padding: 5px;
            background-color: #fff;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h1>Shipping Bill</h1>
        <p>Bill Number: {{ $billNumber }}</p>
    </div>

    <!-- Client & Order Details -->
    <table class="details-table">
        <tr>
            <td><strong>Client Name:</strong> {{ $order->client_name }}</td>
            <td><strong>Client Email:</strong> {{ $order->client_email }}</td>
        </tr>
        <tr>
            <td><strong>Client Address:</strong> {{ $order->client_address }}</td>
            <td><strong>Shipping Method:</strong> {{ $order->shipping_method }}</td>
        </tr>
    </table>

    <!-- Items Section -->
    <h3>Items</h3>
    <table class="items-table">
        <thead>
        <tr>
            <th>Description</th>
            <th>Quantity</th>
            <th>Price (Rs.)</th>
        </tr>
        </thead>
        <tbody>
        @foreach(json_decode($order->items, true) as $item)
            <tr>
                <td>{{ $item['description'] }}</td>
                <td>{{ $item['quantity'] }}</td>
                <td>Rs. {{ number_format($item['price'], 2) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <!-- Total Amount -->
    <div class="total">
        Total Amount: Rs. {{ number_format($order->total_amount, 2) }}
    </div>

    <!-- QR Code Section -->
    <div class="qrcode">
        <h3>QR Code</h3>
        <img
            width="100px"
            src="@php
                    echo \Endroid\QrCode\Builder\Builder::create()
                    ->writer(new \Endroid\QrCode\Writer\PngWriter())
                    ->data(route('orders.show', ['order' => $order->id], true))
                    ->build()->getDataUri()
                    @endphp"
            alt="QR Code"
        />
    </div>
</div>

</body>
</html>
