<?php
declare(strict_types=1);

namespace App\Dtos\Erp;

use App\Helpers\MakeableDto;
use App\Models\OrderItem;

readonly class InvoiceItemDto extends MakeableDto
{
    public function __construct(
        public int $quantity,
        public float $unitPrice,
        public float $total,
        public string $name,
        public string $group,
        public ?string $description=null,
    ) {}

    public function toArray(): array
    {
        return [
            'quantity' => $this->quantity,
            'unit_price' => $this->unitPrice,
            'total' => $this->total,
            'name' => $this->name,
            'group' => $this->group,
            'description' => $this->description,
        ];
    }

    public static function fromOrderItem(OrderItem $item): InvoiceItemDto
    {
        return InvoiceItemDto::make(
            $item->quantity,
            $item->unit_price,
            $item->total,
            $item->name,
            $item->group,
            $item->description,
        );
    }
}
