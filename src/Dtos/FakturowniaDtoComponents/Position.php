<?php

namespace EscolaLms\FakturowniaIntegration\Dtos\FakturowniaDtoComponents;

use EscolaLms\Cart\Models\OrderItem;

class Position
{
    private string $name;
    private int $tax;
    private float $totalPriceGross;
    private int $quantity;

    public function __construct(OrderItem $item)
    {
        $this->name = $item->name ?? $item->title ?? $item->buyable->name ?? $item->buyable->title;
        $this->tax = $item->vat ?? 0;
        $this->quantity = $item->quantity;
        $this->totalPriceGross = ($item->total_with_tax * $item->quantity) / 100;
    }

    public function prepareData()
    {
        return [
            'name' => $this->name,
            'tax' => $this->tax,
            'total_price_gross' => $this->totalPriceGross,
            'quantity' => $this->quantity,
        ];
    }
}
