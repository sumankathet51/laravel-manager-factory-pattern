<?php

namespace App\Services\Erp\Gerp;

use App\Contracts\Erp\Adapters\ErpInvoiceAdapterContract;
use App\Contracts\Erp\Drivers\ErpDriverContract;
use App\Dtos\Erp\InvoiceDto;
use App\Enums\LedgerTypeEnum;
use App\Models\Order;
use Illuminate\Support\Facades\Http;

final readonly class GerpService implements ErpDriverContract
{
    public function __construct(private array $config, private array $adapters)  {}
    public function getInvoices(): string
    {
        return "GERP-Invoice";
    }

    public function createCustomer(array $data)
    {
        Http::fake(fn() => Http::response(['data' => $data, 'message' => 'Success'], 200))->withHeaders([
            'api-key' => $this->config['api_key'],
            'api-secret' => $this->config['api_secret'],
        ])->post($this->config['api_url'] . '/customers', $data);

        return true;
    }

    public function update($post, $data)
    {
        Http::fake(fn() => Http::response(['data' => $data, 'message' => 'Success'], 200))->withHeaders([
            'api-key' => $this->config['api_key'],
            'api-secret' => $this->config['api_secret'],
        ])->patch($this->config['api_url'] . '/customers', $data);

        return true;
    }

    public function createInvoice(Order $order): array
    {
        $adapter = $this->adapters['invoice'] ? app($this->adapters['invoice']) : app(ErpInvoiceAdapterContract::class);

        $invoiceData = InvoiceDto::fromOrder($order);
        $data = $adapter->toInvoice($invoiceData);

        $response = Http::fake(fn() => Http::response(['message' => "Response From GERP Service", 'data' => $data], 200))->withHeaders([
            'api-key' => $this->config['api_key'],
            'api-secret' => $this->config['api_secret'],
        ])->post($this->config['api_url'] . '/invoices', $data);

        return $response->json();
    }

    public function createLedger(array $data, LedgerTypeEnum $ledgerType): array
    {
        $response = Http::fake(fn() => Http::response(['data' => $data, 'message' => 'Success'], 200))->withHeaders([
            'api-key' => $this->config['api_key'],
            'api-secret' => $this->config['api_secret'],
        ])->post($this->config['api_url'] . '/ledgers', $data);

        return $response->json();
    }
}
