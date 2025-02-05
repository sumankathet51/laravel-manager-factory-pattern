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
        $data = collect($request->all());
        $orderDetails = $data['order_details'];
        $data->forget('order_details');

        $order = Order::create($data->toArray());
        $order->items()->createMany($orderDetails);

        $erpService = app()->erpDriver();
        $res = $erpService->createInvoice($order);

        return response()->json($res);
    }
}
