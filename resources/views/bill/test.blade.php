<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill Generation</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* General Reset and Layout */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 16px;
        }

        /* Container Styling */
        .container {
            background-color: #fff;
            padding: 32px;
            border-radius: 8px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 640px;
            position: relative;
        }

        /* Form Element Styling */
        h2 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 16px;
        }
        p {
            color: #4b5563;
            margin-bottom: 24px;
        }
        h3 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 12px;
        }

        /* Input and Select Styling */
        .form-input, .form-select {
            width: 100%;
            padding: 10px;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            margin-bottom: 12px;
        }

        /* Button Styling */
        .btn, .btn-remove {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }
        .btn-add {
            background-color: #e5e7eb;
            color: #1f2937;
        }
        .btn-add:hover {
            background-color: #d1d5db;
        }
        .btn-submit {
            background-color: #fbbf24;
            color: #ffffff;
            margin-top: 12px;
        }
        .btn-submit:hover {
            background-color: #f59e0b;
        }
        .btn-remove {
            background-color: #ef4444;
            color: #ffffff;
        }
        .btn-remove:hover {
            background-color: #dc2626;
        }

        /* Dropdown Styling */
        .template-select {
            position: absolute;
            top: 16px;
            right: 16px;
        }
    </style>
</head>
<body>
<div class="container">
    <form action="{{ route('bill.generate') }}" method="POST">
        @csrf
        <div class="template-select">
            <select name="template" class="form-select">
                <option value="classic">Classic</option>
                <option value="qr">QR</option>
                <option value="barcode">Barcode</option>
            </select>
        </div>

        <h2>Bill Generation</h2>
        <p>Please fill in the details below to generate your bill.</p>

        <div>
            <h3>Personal Info</h3>
            <input type="text" name="client_name" class="form-input" placeholder="Client Name" required>
            <input type="text" name="client_address" class="form-input" placeholder="Client Address" required>
            <input type="email" name="client_email" class="form-input" placeholder="Client Email" required>
        </div>

        <div id="items-container">
            <!-- Items will be added here dynamically -->
        </div>

        <button type="button" id="add-item" class="btn btn-add">Add Item</button>

        <div>
            <select name="shipping_method" class="form-select" required>
                <option value="">Select Shipping Method</option>
                <option value="delivery">Delivery</option>
                <option value="pickup">Pickup</option>
            </select>
        </div>

        <input type="number" name="total_amount" class="form-input" placeholder="Total Amount" required>

        <button type="submit" class="btn btn-submit">Generate Bill</button>
    </form>
</div>

<script>
    let itemIndex = 0;

    document.getElementById('add-item').addEventListener('click', function () {
        const itemsContainer = document.getElementById('items-container');
        const newItem = document.createElement('div');
        newItem.classList.add('item-container');
        newItem.innerHTML = `
                <input type="text" name="items[${itemIndex}][description]" class="form-input" placeholder="Item Description" required>
                <input type="number" name="items[${itemIndex}][quantity]" class="form-input" placeholder="Quantity" required>
                <input type="number" name="items[${itemIndex}][price]" class="form-input" placeholder="Price" required>
                <button type="button" class="btn btn-remove">Remove</button>
            `;
        itemsContainer.appendChild(newItem);
        itemIndex++;
    });

    document.addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('btn-remove')) {
            e.target.parentElement.remove();
        }
    });
</script>
</body>
</html>
