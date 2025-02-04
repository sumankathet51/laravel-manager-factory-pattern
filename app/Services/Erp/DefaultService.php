<?php

namespace App\Services\Erp;

use App\Contracts\Erp\Drivers\ErpDriverContract;
use App\Enums\LedgerTypeEnum;

class DefaultService implements ErpDriverContract
{
    public function __construct(private readonly array $config)
    {
        // TODO: fetch token mechanism
    }
    public function getInvoices(): string
    {
        return "Default-Invoice";
    }

    public function createCustomer(array $data)
    {
        // TODO: Implement createCustomer() method.
    }

    public function update($post, $data)
    {
        // TODO: Implement update() method.
    }

    public function createInvoice(array $data): array
    {
        // TODO: Implement createInvoice() method.
    }

    public function createLedger(array $data, LedgerTypeEnum $ledgerType): array
    {
        // TODO: Implement createLedger() method.
    }
}
