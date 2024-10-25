<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill Generation</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen p-4">
<div class="bg-white p-8 rounded-lg shadow-md w-full max-w-2xl relative">
    <!-- Dropdown for selecting template -->
    <form action="{{ route('bill.generate') }}" method="POST">
        @csrf
        <div class="absolute top-4 right-4">
            <select name="template" class="p-2 border border-gray-300 rounded">
                <option value="classic">Classic</option>
                <option value="qr">QR</option>
                <option value="barcode">Barcode</option>
            </select>
        </div>

        <h2 class="text-2xl font-bold mb-4">Bill Generation</h2>
        <p class="mb-6 text-gray-600">Please fill in the details below to generate your bill.</p>

        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-3">Personal Info</h3>
            <div class="space-y-3">
                <input type="text" name="client_name" class="w-full p-2 border border-gray-300 rounded"
                       placeholder="Client Name" required>
                <input type="text" name="client_address" class="w-full p-2 border border-gray-300 rounded"
                       placeholder="Client Address" required>
                <input type="email" name="client_email" class="w-full p-2 border border-gray-300 rounded"
                       placeholder="Client Email" required>
            </div>
        </div>

        <div id="items-container" class="space-y-4">
            <!-- Items will be added here dynamically -->
        </div>

        <button type="button" id="add-item"
                class="w-full mb-4 py-2 px-4 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition duration-200">
            Add Item
        </button>

        <div class="mb-4">
            <select name="shipping_method" class="w-full p-2 border border-gray-300 rounded" required>
                <option value="">Select Shipping Method</option>
                <option value="delivery">Delivery</option>
                <option value="pickup">Pickup</option>
            </select>
        </div>

        <div class="mb-6">
            <input type="number" name="total_amount" class="w-full p-2 border border-gray-300 rounded"
                   placeholder="Total Amount" required>
        </div>

        <div class="flex justify-between">
            <button type="submit"
                    class="py-2 px-4 bg-yellow-400 text-white rounded hover:bg-yellow-500 transition duration-200">
                Generate Bill
            </button>
        </div>
    </form>
</div>

<script>
    let itemIndex = 0;

    document.getElementById('add-item').addEventListener('click', function () {
        const itemsContainer = document.getElementById('items-container');
        const newItem = document.createElement('div');
        newItem.classList.add('space-y-2');
        newItem.innerHTML = `
                <input type="text" name="items[${itemIndex}][description]" class="w-full p-2 border border-gray-300 rounded" placeholder="Item Description" required>
                <input type="number" name="items[${itemIndex}][quantity]" class="w-full p-2 border border-gray-300 rounded" placeholder="Quantity" required>
                <input type="number" name="items[${itemIndex}][price]" class="w-full p-2 border border-gray-300 rounded" placeholder="Price" required>
                <button type="button" class="remove-item w-full py-1 px-2 bg-red-500 text-white rounded hover:bg-red-600 transition duration-200">Remove</button>
            `;
        itemsContainer.appendChild(newItem);
        itemIndex++;
    });

    document.addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('remove-item')) {
            e.target.parentElement.remove();
        }
    });
</script>
</body>
</html>
