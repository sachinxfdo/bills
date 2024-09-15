<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'client_name' => 'required|string|max:255',
            'client_address' => 'required|string',
            'client_email' => 'required|email',
            'items' => 'required|array',
            'shipping_method' => 'required|string',
            'total_amount' => 'required|numeric',
        ]);

        $items = json_encode($validatedData['items']);

        // Create the order
        $order = Order::create([
            'client_name' => $validatedData['client_name'],
            'client_address' => $validatedData['client_address'],
            'client_email' => $validatedData['client_email'],
            'items' => $items,
            'shipping_method' => $validatedData['shipping_method'],
            'total_amount' => $validatedData['total_amount'],
        ]);

        return response()->json($order, 201); // Return order details
    }
}
