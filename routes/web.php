<?php

use App\Http\Controllers\BillController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [BillController::class, 'index'])->name('bill.index');
Route::post('/bill/generate', [BillController::class, 'generateBill'])->name('bill.generate');
Route::get('/orders/{order}', [BillController::class, 'show'])->name('orders.show');
