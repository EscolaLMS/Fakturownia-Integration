<?php

namespace EscolaLms\FakturowniaIntegration\Dtos\FakturowniaDtoComponents;

use EscolaLms\Cart\Enums\ProductType;
use EscolaLms\Cart\Models\OrderItem;
use EscolaLms\Cart\Models\Product;

class Position
{
    private string $name;
    private int $tax;
    private float $totalPriceGross;
    private int $quantity;
    private string $prefix = '';

    public function __construct(OrderItem $item)
    {
        $this->name = $item->name ?? $item->title ?? $item->buyable->name ?? $item->buyable->title;
        $this->tax = $item->tax_rate ?? 0;
        $this->quantity = $item->quantity;
        $this->totalPriceGross = ($item->total_with_tax * $item->quantity) / 100;
        $this->setPrefix($item);
    }

    public function prepareData()
    {
        return [
            'name' => implode(' - ', [$this->getPrefix(), $this->name]),
            'tax' => $this->tax,
            'total_price_gross' => $this->totalPriceGross,
            'quantity' => $this->quantity,
        ];
    }

    private function getPrefix(): string
    {
        return $this->prefix ? __($this->prefix) : '';
    }

    private function setPrefix(OrderItem $item): void
    {
        if ($item->buyable instanceof Product) {
            $product = $item->buyable;
            if ($product->type === ProductType::SINGLE) {
                $productable = $product->productables()->first();
                $class = $productable->productable_type ?? '';
            } else {
                $class = 'DevelopmentProgram';
            }
        } else {
            $class = $item->buyable_type ?? '';
        }
        $this->prefix = preg_replace('/^.*\\\(.*)$/', '$1', $class);
    }
}
