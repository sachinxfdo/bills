<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\ShippingBillGenerateService;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function __construct(protected ShippingBillGenerateService $shippingBillService)
    {
    }

    public function index()
    {
        return view('bill.index');
    }

    public function test()
    {
        return view('bill.test');
    }

    public function generateBill(Request $request)
    {
        $validatedData = $request->validate([
            'client_name' => 'required|string|max:255',
            'client_address' => 'required|string',
            'client_email' => 'required|email',
            'items' => 'required|array',
            'shipping_method' => 'required|string',
            'total_amount' => 'required|numeric',
        ]);

        $items = json_encode($validatedData['items']);

        $order = Order::create([
            'client_name' => $validatedData['client_name'],
            'client_address' => $validatedData['client_address'],
            'client_email' => $validatedData['client_email'],
            'items' => $items,
            'shipping_method' => $validatedData['shipping_method'],
            'total_amount' => $validatedData['total_amount'],
        ]);

        return $this->shippingBillService->generateShippingBill($order, $request->get('template'));
    }

    public function show(Order $order)
    {
        return view('bill.show', compact('order'));
    }
}
