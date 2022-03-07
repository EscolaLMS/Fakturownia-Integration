<?php

namespace EscolaLms\FakturowniaIntegration\Tests\Services;

use EscolaLms\Cart\Models\Order;
use EscolaLms\Cart\Models\OrderItem;
use EscolaLms\Cart\Models\Product;
use EscolaLms\Cart\Models\ProductProductable;
use EscolaLms\Cart\Tests\Mocks\ExampleProductable;
use EscolaLms\Core\Models\User;
use EscolaLms\Core\Tests\CreatesUsers;
use EscolaLms\FakturowniaIntegration\Dtos\FakturowniaDto;
use EscolaLms\FakturowniaIntegration\Services\Contracts\FakturowniaIntegrationServiceContract;
use EscolaLms\FakturowniaIntegration\Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FakturowniaIntegrationServiceTest extends TestCase
{
    use DatabaseTransactions;
    use CreatesUsers;

    protected FakturowniaIntegrationServiceContract $service;

    private Order $order;
    private User $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->service = app(FakturowniaIntegrationServiceContract::class);
        $this->user =  $this->makeStudent();
        $this->order = Order::factory()->for($this->user)->create();

        $products = [
            ...Product::factory()->count(5)->create(),
        ];
        foreach ($products as $product) {
            $productable = ExampleProductable::factory()->create();
            $product->productables()->save(new ProductProductable([
                'productable_type' => ExampleProductable::class,
                'productable_id' => $productable->getKey()
            ]));
        }

        foreach ($products as $product) {
            $orderItem = new OrderItem();
            $orderItem->buyable()->associate($product);
            $orderItem->quantity = 1;
            $orderItem->order_id = $this->order->getKey();
            $orderItem->save();
        }
    }

    public function testSaveInvoices(): void
    {
        $invoiceDto = new FakturowniaDto($this->order);

        $this->assertEquals('SUCCESS', $this->fakturownia->createInvoice($invoiceDto->prepareData())->getStatus());
    }
}
