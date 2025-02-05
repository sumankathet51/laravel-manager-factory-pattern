<?php


use App\Factories\ErpDriverFactory;
use App\Managers\ErpManager;
use App\Services\Erp\Default\DefaultService;
use App\Services\Erp\Gerp\GerpService;

it('tests ErpDriverFactory for correct driver instance initialization', function () {
    $factory = new ErpDriverFactory();

    $vendorOne = $factory->make('gerp');
    expect($vendorOne)->toBeInstanceOf(GerpService::class);

    $vendorTwo = $factory->make('default');
    expect($vendorTwo)->toBeInstanceOf(DefaultService::class);
});

it('tests ErpManager for correct driver instance initialization', function () {
    $factory = app(ErpDriverFactory::class);
    $manager = new ErpManager($factory);

    $driver = $manager->driver();
    expect($driver)->toBeInstanceOf(DefaultService::class);

    app()->instance('settings', collect([
        'erp' => 'gerp'
    ]));
    $driver = $manager->driver();
    expect($driver)->toBeInstanceOf(GerpService::class);
});
