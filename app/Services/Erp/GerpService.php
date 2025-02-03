<?php

namespace App\Services\Erp;

use App\Contracts\Erp\ErpServiceContract;

class GerpService implements ErpServiceContract
{
    public function getInvoices(): string
    {
        return "GERP-Invoice";
    }
}
