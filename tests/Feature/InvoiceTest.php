<?php

namespace Tests\Feature;

use App\Http\Middleware\TenantMiddleware;

it('tests invoices API returns response from DefaultService driver when no erp driver is set ', function () {
    $this->withoutMiddleware(TenantMiddleware::class);

    $response = $this->getJson('/invoices');
    $response->assertStatus(200);
    $responseContent = $response->getContent();

    expect($responseContent)
        ->toContain('Default-Invoice');
});

it('tests invoices API returns response from GerpService driver when no erp driver is set ', function () {
    $this->withoutMiddleware(TenantMiddleware::class);

    app()->instance('settings', collect([
        'erp' => 'gerp'
    ]));

    $response = $this->getJson('/invoices');
    $response->assertStatus(200);
    $responseContent = $response->getContent();

    expect($responseContent)
        ->toContain('GERP-Invoice');
});
