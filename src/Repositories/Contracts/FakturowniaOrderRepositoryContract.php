<?php

namespace EscolaLms\FakturowniaIntegration\Repositories\Contracts;

use EscolaLms\FakturowniaIntegration\Models\FakturowniaOrder;

interface FakturowniaOrderRepositoryContract
{
    public function getFirstFakturowniaIdByOrderId(int $orderId): int;
    public function setFakturowniaIdToOrder(int $orderId, int $fakturowniaId): FakturowniaOrder;
}
