<?php

namespace App\Http\Controllers;

use App\Services\Erp\DefaultService;
use App\Services\Erp\GerpService;

class InvoiceController extends Controller
{
    public function index()
    {
        $erp = settings('erp');

        $erpService = match ($erp) {
            'gerp' => new GerpService(),
            default => new DefaultService(),
        };

        return response()->json(['data' => $erpService->getInvoices()]) ;
    }
}
