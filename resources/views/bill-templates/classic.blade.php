<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipping Bill</title>
    <style>
        body {
            padding: 40px 0; /* Tailwind py-10 */
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 600px; /* Tailwind max-w-2xl */
            margin: 0 auto; /* Tailwind mx-auto */
            background-color: white; /* Tailwind bg-white */
            padding: 32px; /* Tailwind p-8 */
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1); /* Tailwind shadow-lg */
            border-radius: 12px; /* Tailwind rounded-lg */
        }

        .header {
            text-align: center; /* Tailwind text-center */
            margin-bottom: 32px; /* Tailwind mb-8 */
        }

        .header h1 {
            font-size: 24px; /* Tailwind text-3xl */
            font-weight: bold; /* Tailwind font-bold */
            color: #374151; /* Tailwind text-gray-700 */
        }

        .header p {
            color: #6b7280; /* Tailwind text-gray-500 */
        }

        .header span {
            font-weight: 600; /* Tailwind font-semibold */
        }

        table {
            width: 100%; /* Tailwind w-full */
            text-align: left; /* Tailwind text-left */
            margin-bottom: 24px; /* Tailwind mb-6 */
            border-collapse: collapse; /* Make borders collapse for a cleaner look */
        }

        table th, table td {
            padding: 8px 16px; /* Tailwind py-2 px-4 */
            border: 1px solid #d1d5db; /* Tailwind border-gray-300 */
            color: #1f2937; /* Tailwind text-gray-900 */
        }

        table thead th {
            background-color: #f3f4f6; /* Tailwind bg-gray-100 */
            color: #4b5563; /* Tailwind text-gray-600 */
            font-weight: 500; /* Tailwind font-medium */
        }

        table tbody tr:nth-child(odd) {
            background-color: #f9fafb; /* Tailwind bg-gray-50 */
        }

        table tbody td {
            color: #1f2937; /* Tailwind text-gray-900 */
        }

        .total {
            text-align: right; /* Tailwind text-right */
        }

        .total h3 {
            font-size: 24px; /* Tailwind text-2xl */
            font-weight: 600; /* Tailwind font-semibold */
            color: #374151; /* Tailwind text-gray-700 */
        }
    </style>
</head>
<body>
<div class="container">
    <!-- Header -->
    <div class="header">
        <h1>Shipping Bill</h1>
        <p>Bill Number: <span>{{ $billNumber }}</span></p>
    </div>

    <!-- Order & Client Details -->
    <table>
        <tbody>
        <tr>
            <td><strong>Client Name:</strong></td>
            <td>{{ $order->client_name }}</td>
        </tr>
        <tr>
            <td><strong>Client Email:</strong></td>
            <td>{{ $order->client_email }}</td>
        </tr>
        <tr>
            <td><strong>Client Address:</strong></td>
            <td>{{ $order->client_address }}</td>
        </tr>
        <tr>
            <td><strong>Shipping Method:</strong></td>
            <td>{{ $order->shipping_method }}</td>
        </tr>
        </tbody>
    </table>

    <!-- Items Section -->
    <h3>Items</h3>
    <table>
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
        <h3>Total Amount: Rs. {{ number_format($order->total_amount, 2) }}</h3>
    </div>
</div>
</body>
</html>
