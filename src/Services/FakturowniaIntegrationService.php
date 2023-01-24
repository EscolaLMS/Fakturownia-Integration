<?php

namespace EscolaLms\FakturowniaIntegration\Services;

use Abb\Fakturownia\Exception\RequestErrorException;
use Abb\Fakturownia\ResponseInterface;
use EscolaLms\FakturowniaIntegration\Exceptions\InvoiceNotAddedException;
use EscolaLms\Cart\Models\Order;
use EscolaLms\FakturowniaIntegration\Repositories\Contracts\FakturowniaOrderRepositoryContract;
use EscolaLms\FakturowniaIntegration\Services\Contracts\FakturowniaIntegrationServiceContract;
use EscolaLms\FakturowniaIntegration\Dtos\FakturowniaDto;
use EscolaLms\FakturowniaIntegration\Utils\Fakturownia;

class FakturowniaIntegrationService implements FakturowniaIntegrationServiceContract
{
    private CONST SUCCESS = 'SUCCESS';

    private FakturowniaOrderRepositoryContract $fakturowniaOrderRepository;
    private Fakturownia $fakturownia;

    public function __construct(FakturowniaOrderRepositoryContract $fakturowniaOrderRepository)
    {
        $this->fakturowniaOrderRepository = $fakturowniaOrderRepository;
        $this->fakturownia = new Fakturownia();
    }


    public function import(Order $order): ?ResponseInterface
    {
        if ($order->total > 0) {
            $invoiceDto = new FakturowniaDto($order);
            $response = $this->fakturownia->createInvoice($invoiceDto->prepareData());
            if ($response->getStatus() !== self::SUCCESS) {
                \Log::debug('import fakturownia', [
                    'dto' => $invoiceDto->prepareData(),
                    'response' => $response->toArray(),
                    'order' => $order
                ]);
                throw new InvoiceNotAddedException();
            }
            $this->fakturowniaOrderRepository->setFakturowniaIdToOrder($order->getKey(), $response->getData()['id']);
            $invoiceId = $response->getData()['id'];
            $this->fakturownia->sendInvoice($invoiceId);
            return $this->fakturownia->getInvoicePdf($invoiceId);
        }
        return null;
    }

    /**
     * @throws RequestErrorException
     */
    public function getInvoicePdf(Order $order): ?ResponseInterface
    {
        return $this->getFirstOrCreateFakturowniaIdByOrderId($order);
    }

    private function getFirstOrCreateFakturowniaIdByOrderId(Order $order): ?ResponseInterface
    {
        if ($order->total > 0) {
            $fakturowniaOrders = $this->fakturowniaOrderRepository->getFakturowniaOrdersByOrderId($order->getKey());
            if ($fakturowniaOrders->count() > 0) {
                foreach ($fakturowniaOrders as $fakturowniaOrder) {
                    $response = $this->fakturownia->getInvoicePdf($fakturowniaOrder->fakturownia_id);
                    if ($response->getStatus() !== self::SUCCESS) {
                        $this->fakturowniaOrderRepository->deleteFakturowniaOrder($fakturowniaOrder);
                    } else {
                        return $response;
                    }
                }
            }
            return $this->import($order);
        }
        return null;
    }
}
