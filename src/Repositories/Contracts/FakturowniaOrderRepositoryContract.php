<?php

namespace EscolaLms\FakturowniaIntegration\Repositories\Contracts;

use EscolaLms\FakturowniaIntegration\Models\FakturowniaOrder;

interface FakturowniaOrderRepositoryContract
{
    public function getFirstFakturowniaOrderByOrderId(int $orderId): FakturowniaOrder;
    public function setFakturowniaIdToOrder(int $orderId, int $fakturowniaId): FakturowniaOrder;
}
