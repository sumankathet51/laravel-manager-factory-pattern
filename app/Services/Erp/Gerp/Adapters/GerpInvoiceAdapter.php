<?php

namespace App\Services\Erp\Gerp\Adapters;

use App\Contracts\Erp\Adapters\ErpInvoiceAdapterContract;
use App\Dtos\Erp\InvoiceDto;
use App\Dtos\Erp\InvoiceItemDto;
use App\Models\Customer;
use App\Models\Order;

class GerpInvoiceAdapter implements ErpInvoiceAdapterContract
{

    public function fromErpInvoice(array $data): InvoiceDto
    {
        $items = $data['items'];

        $data['items'] = array_map(function ($item) {
            return InvoiceItemDto::make(
                $item['qty'],
                $item['unit_price'],
                $item['total'],
                $item['name'],
                $item['group'],
                $item['desc'],
            );
        }, $items);

        return InvoiceDto::make(
            $data['name'],
            $data['id'],
            $data['total'],
            $data['amount'],
            $data['tax_amount'],
            $data['name'],
            $data['items'],
            $data['invoice_number'],
            $data['remarks'],
        );
    }

    public function toInvoice(InvoiceDto $invoice): array
    {
        return $invoice->toArray();
    }
}
