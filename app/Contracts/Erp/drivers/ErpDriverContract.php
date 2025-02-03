<?php

namespace App\Contracts\Erp\drivers;

use App\Enums\LedgerTypeEnum;


interface ErpDriverContract
{
    public function getInvoices(): string;
    public function createCustomer(array $data);
    public function update($post, $data);
    public function createInvoice(array $data): array;

    public function createLedger(array $data, LedgerTypeEnum $ledgerType): array;
}
