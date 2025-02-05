<?php

namespace App\Services\Erp\Default\Commands;

use App\Contracts\Command;
use App\Helpers\Makeable;
use Illuminate\Support\Facades\Http;

class CreateInvoiceCommand extends Makeable implements Command
{
    private array $response;
    public function __construct(protected array $invoiceData)
    {}


    public function execute(): void
    {
        // Some DB Operations
        $this->response = ['message' => "Response From Default Service", 'data' => $this->invoiceData];
    }
    public function undo()
    {
        // 
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
