<?php

namespace App\Managers;

use App\Contracts\Erp\drivers\ErpDriverContract;
use App\Factories\ErpDriverFactory;

class ErpManager
{
    protected array $drivers = [];

    public function __construct( private readonly ErpDriverFactory $driverFactory) {}

    public function driver(): ErpDriverContract {
        $driverName = settings('erp', 'default');

        // Use the factory to create the driver if it doesn't exist
        if (!isset($this->drivers[$driverName])) {
            $this->drivers[$driverName] = $this->driverFactory->make($driverName);
        }

        return $this->drivers[$driverName];
    }

}
