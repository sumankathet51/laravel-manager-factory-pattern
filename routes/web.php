<?php

use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LedgerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices.index');
Route::get('/ledgers', [LedgerController::class, 'index'])->name('ledgers.index');

