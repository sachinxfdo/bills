<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\ShippingBillGenerateService;
use Illuminate\Http\Request;

class BillController extends Controller
{
    protected $shippingBillService;

    public function __construct(ShippingBillGenerateService $shippingBillService)
    {
        $this->shippingBillService = $shippingBillService;
    }

    public function generateBill(Order $order, Request $request)
    {
        return $this->shippingBillService->generateShippingBill($order, $request->get('template'));
    }
}
