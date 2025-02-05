<?php

namespace App\Contracts\Erp\Drivers;

use App\Enums\LedgerTypeEnum;
use App\Models\Order;


interface ErpDriverContract
{
    public function getInvoices(): string;
    public function createCustomer(array $data);
    public function update($post, $data);
    public function createInvoice(Order $order): array;

    public function createLedger(array $data, LedgerTypeEnum $ledgerType): array;
}
