@php use Milon\Barcode\DNS1D; @endphp
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipping Bill with Barcode</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .header {
            text-align: center;
        }

        .bill-details, .order-details, .items {
            width: 100%;
            margin-top: 20px;
        }

        .bill-details td, .order-details td, .items td {
            padding: 5px;
            border-bottom: 1px solid #ddd;
        }

        .barcode {
            text-align: center;
            margin-top: 20px;
        }

        table {
            border-collapse: collapse;
        }

        td, th {
            border: 1px solid black;
        }
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
    @foreach(json_decode($order->items, true) as $item)
        <tr>
            <td>{{ $item['description'] }}</td>
            <td>{{ $item['quantity'] }}</td>
            <td>{{ $item['price'] }}</td>
        </tr>
    @endforeach
</table>

<h3>Total Amount: ${{ $order->total_amount }}</h3>

<!-- Barcode Section -->
<div class="barcode">
    <h3>Barcode</h3>
    @php
        $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
    @endphp
    <img src="data:image/png;base64,'{{base64_encode($generator->getBarcode('081231723897', $generator::TYPE_CODE_128)) }}'">
</div>

</body>
</html>
