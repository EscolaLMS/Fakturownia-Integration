<?php

namespace EscolaLms\FakturowniaIntegration\Services;

use Abb\Fakturownia\Exception\RequestErrorException;
use Abb\Fakturownia\ResponseInterface;
use EscolaLms\FakturowniaIntegration\Exceptions\InvoiceNotAddedException;
use EscolaLms\Cart\Models\Order as CartOrder;
use EscolaLms\FakturowniaIntegration\Models\Order;
use EscolaLms\FakturowniaIntegration\Services\Contracts\FakturowniaIntegrationServiceContract;
use EscolaLms\FakturowniaIntegration\Dtos\FakturowniaDto;
use EscolaLms\FakturowniaIntegration\Utils\Fakturownia;

class FakturowniaIntegrationService implements FakturowniaIntegrationServiceContract
{
    /**
     * @throws InvoiceNotAddedException|RequestErrorException
     */
    public function import(CartOrder $order): bool
    {
        $fakturownia = new Fakturownia();

        $invoiceDto = new FakturowniaDto($order);
        $response = $fakturownia->createInvoice($invoiceDto->prepareData());

        if ($response->getStatus() !== 'SUCCESS') {
            throw new InvoiceNotAddedException();
        }
        $this->addInvoiceId($this->getOrderFromCartOrder($order), $response->getData()['id']);

        return true;
    }

    public function getInvoicePdf(CartOrder $order): ResponseInterface
    {
        $fakturownia = new Fakturownia();

        $fakturowniaOrder = $this->getOrderFromCartOrder($order);
        $response = $fakturownia->getInvoicePdf($fakturowniaOrder->invoice_id);

        if ($response->getStatus() !== 'SUCCESS') {
            throw new InvoiceNotAddedException();
        }

        return $response;
    }

    public function addInvoiceId(Order $order, int $invoiceId): bool
    {
        $order->invoice_id = $invoiceId;

        return $order->save();
    }

    public function getOrderFromCartOrder(CartOrder $order): Order
    {
        return Order::query()->findOrFail($order->id);
    }
}
