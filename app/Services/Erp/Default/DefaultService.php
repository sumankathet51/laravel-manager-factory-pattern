<?php

namespace App\Services\Erp\Default;

use App\Contracts\Erp\Adapters\ErpInvoiceAdapterContract;
use App\Contracts\Erp\Drivers\ErpDriverContract;
use App\Dtos\Erp\InvoiceDto;
use App\Enums\LedgerTypeEnum;
use App\Models\Order;

final readonly class DefaultService implements ErpDriverContract
{
    public function __construct(private array $config, private array $adapters)
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

    public function createInvoice(Order $order): array
    {
        $adapter = $this->adapters['invoice'] ? app($this->adapters['invoice']) : app(ErpInvoiceAdapterContract::class);

        $invoiceData = InvoiceDto::fromOrder($order);
        $data = $adapter->toInvoice($invoiceData);

        // Some Database Operations

        return ['message' => "Response From Default Service", 'data' => $data];
    }
    public function createLedger(array $data, LedgerTypeEnum $ledgerType): array
    {
        // TODO: Implement createLedger() method.
    }
}
