<?php

namespace App\Http\Controllers;

class InvoiceController extends Controller
{
    public function index()
    {
        $erpService = app()->erpDriver();
        return response()->json(['data' => $erpService->getInvoices()]) ;
    }
}
