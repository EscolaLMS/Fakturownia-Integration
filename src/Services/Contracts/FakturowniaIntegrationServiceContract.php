<?php
namespace EscolaLms\FakturowniaIntegration\Services\Contracts;

use EscolaLms\Cart\Models\Order;

interface FakturowniaIntegrationServiceContract
{
    public function import(Order $order): bool;
}
