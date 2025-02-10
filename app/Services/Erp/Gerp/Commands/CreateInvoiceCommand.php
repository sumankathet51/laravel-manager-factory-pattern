<?php

namespace App\Services\Erp\Gerp\Commands;

use App\Contracts\Command;
use App\Helpers\Makeable;
use Illuminate\Support\Facades\Http;

class CreateInvoiceCommand extends Makeable implements Command
{
    private array $response;
    public function __construct(protected array $invoiceData, protected string $apiKey, protected string $apiSecret, protected string $url)
    {}


    public function execute(): void
    {
        $response = Http::fake(fn() => Http::response(['message' => "Response From GERP Service", 'data' => $this->invoiceData], 200))->withHeaders([
            'api-key' => $this->apiKey,
            'api-secret' => $this->apiSecret,
        ])->post($this->url . '/invoices', $this->invoiceData);

        $this->response = $response->json();
    }
    public function undo()
    {
        Http::fake(fn() => Http::response(['message' => "Response From GERP Service", 'data' => $this->invoiceData], 200))->withHeaders([
            'api-key' => $this->apiKey,
            'api-secret' => $this->apiSecret,
        ])->delete($this->url . '/invoices/' . $this->response['data']['id'], $this->invoiceData);
    }

    public function redo()
    {
        $this->execute();
    }


    public function getResponse(): array
    {
        return $this->response;
    }
}
