<?php

namespace App\Factories;

use App\Contracts\Erp\Drivers\ErpDriverContract;

class ErpDriverFactory
{
    protected $config;

    public function __construct() {
        $this->config = config('erp.drivers');
    }

    public function make(string $driver): ErpDriverContract {
        // Check if the driver exists in the configuration
        if (!isset($this->config[$driver])) {
            throw new \InvalidArgumentException("ERP driver [{$driver}] is not supported.");
        }

        // Get the driver configuration
        $driverConfig = $this->config[$driver];

        // Resolve the service class from the container
        $serviceClass = $driverConfig['class'];

        // Instantiate the service class with its configuration
        return app($serviceClass, [
            'config' => $driverConfig['config'],
            'adapters' => $driverConfig['adapters'],
        ]);
    }
}
