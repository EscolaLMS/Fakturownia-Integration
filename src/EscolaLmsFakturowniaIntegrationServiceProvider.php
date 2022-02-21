<?php

namespace EscolaLms\FakturowniaIntegration;

use EscolaLms\FakturowniaIntegration\Services\Contracts\FakturowniaIntegrationServiceContract;
use EscolaLms\FakturowniaIntegration\Services\FakturowniaIntegrationService;
use Illuminate\Support\ServiceProvider;

/**
 * SWAGGER_VERSION
 */
class EscolaLmsFakturowniaIntegrationServiceProvider extends ServiceProvider
{
    public $bindings = [
        FakturowniaIntegrationServiceContract::class => FakturowniaIntegrationService::class,
    ];

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    public function register()
    {
        parent::register();

        $this->mergeConfigFrom(__DIR__ . '/config.php', 'fakturownia');
    }

    protected function bootForConsole(): void
    {
    }
}
