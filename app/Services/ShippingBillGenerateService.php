<?php

namespace App\Services;

use App\Models\Bill;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;

class ShippingBillGenerateService
{
    public function generateShippingBill(Order $order, $template = 'classic'): Response
    {
        $billNumber = 'BILL-' . time() . '-' . $order->id;
        $pdf = Pdf::loadView('bill-templates.'.$template, ['order' => $order, 'billNumber' => $billNumber]);
        $pdf->setPaper('A5');
        $pdfPath = 'bills/'.$billNumber.'.pdf';
        $pdf->save($pdfPath,'public');

        Bill::create([
            'order_id' => $order->id,
            'bill_number' => $billNumber,
            'bill_url' => $pdfPath
        ]);

        return $pdf->stream('invoice.pdf');
    }
}
