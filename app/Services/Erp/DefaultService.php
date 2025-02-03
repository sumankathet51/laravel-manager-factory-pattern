<?php

namespace App\Services\Erp;

use App\Contracts\Erp\ErpServiceContract;

class DefaultService implements ErpServiceContract
{

    public function getInvoices(): string
    {
        return "Default-Invoice";
    }
}
