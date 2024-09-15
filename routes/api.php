<?php

use App\Http\Controllers\BillController;
use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/orders', [OrderController::class, 'store']);
Route::post('/orders/{order}/bill', [BillController::class, 'generateBill']);

Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
