<?php
namespace EscolaLms\FakturowniaIntegration\Services\Contracts;

use Abb\Fakturownia\ResponseInterface;
use EscolaLms\Cart\Models\Order as CartOrder;
use EscolaLms\FakturowniaIntegration\Models\Order;

interface FakturowniaIntegrationServiceContract
{
    public function import(Order $order): bool;
    public function getInvoicePdf(CartOrder $order): ResponseInterface;
    public function addInvoiceId(Order $order, int $invoiceId): bool;
    public function getOrderFromCartOrder(CartOrder $order): Order;
}
