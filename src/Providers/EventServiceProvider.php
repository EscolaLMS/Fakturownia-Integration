<?php

namespace EscolaLms\FakturowniaIntegration\Providers;

use EscolaLms\Cart\Events\OrderCreated;
use EscolaLms\FakturowniaIntegration\Listeners\ImportInvoiceListener;

class EventServiceProvider extends \Illuminate\Foundation\Support\Providers\EventServiceProvider
{
    protected $listen = [
        OrderCreated::class => [
            ImportInvoiceListener::class,
        ],
    ];
}
