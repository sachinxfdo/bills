<?php

use App\Http\Controllers\BillController;
use Illuminate\Support\Facades\Route;

Route::post('/bill', [BillController::class, 'generateBill']);

