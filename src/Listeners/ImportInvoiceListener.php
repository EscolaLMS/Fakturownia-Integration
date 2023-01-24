<?php

namespace EscolaLms\FakturowniaIntegration\Listeners;

use EscolaLms\Cart\Events\OrderPaid;
use EscolaLms\FakturowniaIntegration\Exceptions\InvoiceNotAddedException;
use EscolaLms\FakturowniaIntegration\Services\Contracts\FakturowniaIntegrationServiceContract;
use EscolaLms\FakturowniaIntegration\Traits\SetLocale;

class ImportInvoiceListener
{
    use SetLocale;
    private FakturowniaIntegrationServiceContract $fakturowniaIntegrationService;

    public function __construct(
        FakturowniaIntegrationServiceContract $fakturowniaIntegrationService
    ) {
        $this->fakturowniaIntegrationService = $fakturowniaIntegrationService;
    }

    public function handle(OrderPaid $event): void
    {
        $this->setLocale();
        try {
            $this->fakturowniaIntegrationService->import($event->getOrder());
        } catch (InvoiceNotAddedException $e) {}
    }
}
