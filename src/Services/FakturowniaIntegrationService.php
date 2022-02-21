<?php

namespace EscolaLms\FakturowniaIntegration\Services;

use Abb\Fakturownia\Exception\RequestErrorException;
use EscolaLms\Cart\Models\Order;
use EscolaLms\FakturowniaIntegration\Exceptions\InvoiceNotAddedException;
use EscolaLms\FakturowniaIntegration\Services\Contracts\FakturowniaIntegrationServiceContract;
use EscolaLms\FakturowniaIntegration\Dtos\FakturowniaDto;
use EscolaLms\FakturowniaIntegration\Utils\Fakturownia;

class FakturowniaIntegrationService implements FakturowniaIntegrationServiceContract
{
    /**
     * @throws InvoiceNotAddedException|RequestErrorException
     */
    public function import(Order $order): bool
    {
        $fakturownia = new Fakturownia();

        $invoiceDto = new FakturowniaDto($order);
        if ($fakturownia->createInvoice($invoiceDto->prepareData())->getStatus() !== 'SUCCESS') {
            throw new InvoiceNotAddedException();
        }

        return true;
    }
}
