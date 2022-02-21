<?php

namespace EscolaLms\FakturowniaIntegration\Tests\Services;

use EscolaLms\Cart\Models\Order;
use EscolaLms\Cart\Models\OrderItem;
use EscolaLms\Core\Models\User;
use EscolaLms\Core\Tests\CreatesUsers;
use EscolaLms\FakturowniaIntegration\Services\Contracts\FakturowniaIntegrationServiceContract;
use EscolaLms\FakturowniaIntegration\Tests\Models\Course;
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
        $courses = [
            ...Course::factory()->count(5)->create(),
            ...Course::factory()->count(5)->create(),
        ];
        $this->order = Order::factory()->for($this->user)->create();
        foreach ($courses as $course) {
            $orderItem = new OrderItem();
            $orderItem->buyable()->associate($course);
            $orderItem->quantity = 1;
            $orderItem->order_id = $this->order->getKey();
            $orderItem->save();
        }
    }

    public function testSaveInvoices(): void
    {
        $this->assertTrue($this->service->import($this->order));
    }
}
