<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $erpService = app()->erpDriver();
        return response()->json(['data' => $erpService->getInvoices()]) ;
    }

    public function store(Request $request)
    {
        $order = Order::create($request->input('order'));
        $order->items()->createMany($request->input('order_items'));

        $erpService = app()->erpDriver();
        $res = $erpService->createInvoice($order);

        return response()->json(['data' => $res]);
    }
}
