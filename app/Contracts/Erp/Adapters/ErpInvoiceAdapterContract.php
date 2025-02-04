<?php

namespace App\Contracts\Erp\Adapters;

use App\Dtos\Erp\InvoiceDto;
use App\Models\Customer;
use App\Models\Order;

interface ErpInvoiceAdapterContract
{
    public function fromErpInvoice(array $data): InvoiceDto;
    public function toInvoice(InvoiceDto $invoice): array;
}
