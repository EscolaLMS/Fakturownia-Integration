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

    public function __construct(FakturowniaOrderRepositoryContract $fakturowniaOrderRepository)
    {
        $this->fakturowniaOrderRepository = $fakturowniaOrderRepository;
    }

    /**
     * @throws InvoiceNotAddedException|RequestErrorException
     */
    public function import(Order $order): bool
    {
        $fakturownia = new Fakturownia();

        $invoiceDto = new FakturowniaDto($order);
        $response = $fakturownia->createInvoice($invoiceDto->prepareData());

        if ($response->getStatus() !== self::SUCCESS) {
            throw new InvoiceNotAddedException();
        }
        $this->fakturowniaOrderRepository->setFakturowniaIdToOrder($order->getKey(), $response->getData()['id']);

        return true;
    }

    public function getInvoicePdf(Order $order): ResponseInterface
    {
        $fakturownia = new Fakturownia();

        $response = $fakturownia->getInvoicePdf(
            $this->fakturowniaOrderRepository->getFirstFakturowniaIdByOrderId($order->getKey())
        );

        if ($response->getStatus() !== self::SUCCESS) {
            throw new InvoiceNotAddedException();
        }

        return $response;
    }
}
