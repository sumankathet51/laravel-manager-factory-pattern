<?php

namespace App\Services\Erp;

use App\Contracts\Erp\drivers\ErpDriverContract;
use App\Enums\LedgerTypeEnum;
use Illuminate\Support\Facades\Http;

class GerpService implements ErpDriverContract
{
    public function __construct(private readonly array $config)
    {
        // TODO: fetch token mechanism
    }
    public function getInvoices(): string
    {
        return "GERP-Invoice";
    }

    public function createCustomer(array $data)
    {
        Http::withHeaders([
            'api-key' => $this->config['api_key'],
            'api-secret' => $this->config['api_secret'],
        ])->post($this->config['api_url'] . '/customers', $data);

        return true;
    }

    public function update($post, $data)
    {
        Http::withHeaders([
            'api-key' => $this->config['api_key'],
            'api-secret' => $this->config['api_secret'],
        ])->patch($this->config['api_url'] . '/customers', $data);

        return true;
    }

    public function createInvoice(array $data): array
    {
        $response = Http::withHeaders([
            'api-key' => $this->config['api_key'],
            'api-secret' => $this->config['api_secret'],
        ])->post($this->config['api_url'] . '/invoices', $data);

        return $response->json();
    }

    public function createLedger(array $data, LedgerTypeEnum $ledgerType): array
    {
        $response = Http::withHeaders([
            'api-key' => $this->config['api_key'],
            'api-secret' => $this->config['api_secret'],
        ])->post($this->config['api_url'] . '/ledgers', $data);

        return $response->json();
    }
}
