<?php

namespace EscolaLms\FakturowniaIntegration\Tests\Api;

use EscolaLms\Cart\Models\Order;
use EscolaLms\Cart\Models\OrderItem;
use EscolaLms\Cart\Models\Product;
use EscolaLms\Cart\Models\ProductProductable;
use EscolaLms\Cart\Tests\Mocks\ExampleProductable;
use EscolaLms\Core\Models\User;
use EscolaLms\Core\Tests\CreatesUsers;
use EscolaLms\FakturowniaIntegration\Models\FakturowniaOrder;
use EscolaLms\FakturowniaIntegration\Services\Contracts\FakturowniaIntegrationServiceContract;
use EscolaLms\FakturowniaIntegration\Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class InvoicesApiTest extends TestCase
{
    use DatabaseTransactions;
    use CreatesUsers;

    protected FakturowniaIntegrationServiceContract $service;

    private Order $order;
    private User $user;
    private User $user2;

    public function setUp(): void
    {
        parent::setUp();
        $this->service = app(FakturowniaIntegrationServiceContract::class);
        $this->user =  $this->makeStudent();
        $this->user2 =  $this->makeStudent();
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

        FakturowniaOrder::factory()->create([
            'order_id' => $this->order->getKey(),
            'fakturownia_id' => 146487636,
        ]);
    }

    public function testCanReadInvoices(): void
    {
        $response = $this->actingAs($this->user, 'api')->getJson('api/invoices/'.$this->order->getKey());
        $response->assertOk();
    }

    public function testCannotFindMissingOrder(): void
    {
        $response = $this->actingAs($this->user, 'api')->getJson('api/invoices/999999');

        $response->assertStatus(404);
    }

    public function testOtherUsersCannotReadInvoicesOtherUser(): void
    {
        $response = $this->actingAs($this->user2, 'api')->getJson('api/invoices/'.$this->order->getKey());

        $response->assertForbidden();
    }

    public function testGuestCannotReadInvoices(): void
    {
        $response = $this->getJson('api/invoices/'.$this->order->getKey());

        $response->assertForbidden();
    }
}
