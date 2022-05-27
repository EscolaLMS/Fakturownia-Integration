<?php

namespace EscolaLms\FakturowniaIntegration\Repositories\Contracts;

use EscolaLms\FakturowniaIntegration\Models\FakturowniaOrder;
use Illuminate\Support\Collection;

interface FakturowniaOrderRepositoryContract
{
    public function getFirstFakturowniaOrderByOrderId(int $orderId): ?FakturowniaOrder;
    public function getFakturowniaOrdersByOrderId(int $orderId): Collection;
    public function setFakturowniaIdToOrder(int $orderId, int $fakturowniaId): FakturowniaOrder;
}
