<?php

namespace App\Services\Erp\Default\Adapters;

use App\Contracts\Erp\Adapters\ErpInvoiceAdapterContract;
use App\Dtos\Erp\InvoiceDto;
use App\Dtos\Erp\InvoiceItemDto;
use App\Models\Customer;
use App\Models\Order;

class ErpInvoiceAdapter implements ErpInvoiceAdapterContract
{

    public function fromErpInvoice(array $data): InvoiceDto
    {
        $items = $data['items'];

        $data['items'] = array_map(function ($item) {
            return new InvoiceItemDto(
                $item['quantity'],
                $item['unit_price'],
                $item['total'],
                $item['name'],
                $item['group'],
                $item['description'],
            );
        }, $items);

        return new InvoiceDto(
            $data['customer_name'],
            $data['customer_code'],
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
