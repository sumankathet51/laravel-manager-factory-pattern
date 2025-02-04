<?php

namespace Tests\Feature;

use App\Http\Middleware\TenantMiddleware;

it('tests invoices API returns response from DefaultService driver when no erp driver is set ', function () {
    $this->withoutMiddleware(TenantMiddleware::class);

    $response = $this->getJson('api/invoices');
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

    $response = $this->getJson('api/invoices');
    $response->assertStatus(200);
    $responseContent = $response->getContent();

    expect($responseContent)
        ->toContain('GERP-Invoice');
});

it('tests invoice creation API returns response from DefaultService driver when no erp driver is set ', function () {
    $this->withoutMiddleware(TenantMiddleware::class);

    $response = $this->postJson('api/invoices', getInvoiceData());
    $response->assertStatus(200);
    $responseContent = $response->getContent();

    expect($responseContent)
        ->toContain('Response From Default Service');
});

it('tests invoice create API returns response from GerpService driver when no erp driver is set ', function () {
    $this->withoutMiddleware(TenantMiddleware::class);

    app()->instance('settings', collect([
        'erp' => 'gerp'
    ]));

    $response = $this->postJson('api/invoices', getInvoiceData());
    $response->assertStatus(200);
    $responseContent = $response->getContent();

    expect($responseContent)
        ->toContain('Response From GERP Service');
});

function getInvoiceData()
{
    return [
        "customer_name" => "John Doe",
        "customer_code" => "CUST001",
        "total" => 1500,
        "amount" => 1350,
        "tax_amount" => 150,
        "name" => "Order #001",
        "invoice_number" => "INV-001",
        "remarks" => "Urgent delivery",
        "order_details" => [
            [
                "quantity" => 2,
                "unit_price" => 500,
                "total" => 1000,
                "name" => "Product A",
                "group" => "Electronics",
                "description" => "High-end smartphone"
            ],
            [
                "quantity" => 1,
                "unit_price" => 350,
                "total" => 350,
                "name" => "Product B",
                "group" => "Accessories",
                "description" => "Wireless headphones"
            ]
        ]
    ];
}
