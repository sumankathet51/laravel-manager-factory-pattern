<?php
declare(strict_types=1);

namespace App\Dtos\Erp;

use App\Helpers\MakeableDto;
use App\Models\Order;

readonly class InvoiceDto extends MakeableDto
{
    public function __construct(
        public string $customerName,
        public string $customerCode,
        public float $total,
        public float $amount,
        public float $taxAmount,
        public string $name,
        public array $items=[],
        public ?string $invoiceNumber="",
        public ?string $remarks="",
    ) {}

    public function toArray(): array
    {
        return [
            'customer_name' => $this->customerName,
            'customer_code' => $this->customerCode,
            'total' => $this->total,
            'amount' => $this->amount,
            'tax_amount' => $this->taxAmount,
            'name' => $this->name,
            'items' => $this->invoiceItemsToArray($this->items),
            'invoice_number' => $this->invoiceNumber,
            'remarks' => $this->remarks,
        ];
    }

    public function invoiceItemsToArray(array $items)
    {
        return array_map(function (InvoiceItemDto $item) {
            return $item->toArray();
        }, $items);
    }

    public static function fromOrder(Order $order): InvoiceDto
    {
        if (!$order->relationLoaded('items')) {
            $order->load('items');
        }

        $items = $order->items->map(function ($item) {
            return InvoiceItemDto::fromOrderItem($item);
        })->toArray();

        return InvoiceDto::make(
            $order->customer_name,
            $order->customer_code,
            $order->total,
            $order->amount,
            $order->tax_amount,
            $order->name,
            $items,
            $order->invoice_number,
            $order->remarks,
        );
    }
}
