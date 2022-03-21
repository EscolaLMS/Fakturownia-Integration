<?php

namespace EscolaLms\FakturowniaIntegration\Listeners;

use EscolaLms\Cart\Events\OrderCreated;
use EscolaLms\FakturowniaIntegration\Services\Contracts\FakturowniaIntegrationServiceContract;

class ImportInvoiceListener
{
    private FakturowniaIntegrationServiceContract $fakturowniaIntegrationService;

    public function __construct(
        FakturowniaIntegrationServiceContract $fakturowniaIntegrationService
    ) {
        $this->fakturowniaIntegrationService = $fakturowniaIntegrationService;
    }

    public function handle(OrderCreated $event): void
    {
        $this->fakturowniaIntegrationService->import($event->getOrder());
    }
}
