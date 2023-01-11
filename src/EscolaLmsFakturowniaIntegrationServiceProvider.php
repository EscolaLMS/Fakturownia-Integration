<?php

namespace EscolaLms\FakturowniaIntegration;

use EscolaLms\FakturowniaIntegration\Providers\EventServiceProvider;
use EscolaLms\FakturowniaIntegration\Repositories\Contracts\FakturowniaOrderRepositoryContract;
use EscolaLms\FakturowniaIntegration\Repositories\FakturowniaOrderRepository;
use EscolaLms\FakturowniaIntegration\Services\Contracts\FakturowniaIntegrationServiceContract;
use EscolaLms\FakturowniaIntegration\Services\FakturowniaIntegrationService;
use EscolaLms\Settings\Facades\AdministrableConfig;
use Illuminate\Support\ServiceProvider;

/**
 * SWAGGER_VERSION
 */
class EscolaLmsFakturowniaIntegrationServiceProvider extends ServiceProvider
{
    public $bindings = [
        FakturowniaIntegrationServiceContract::class => FakturowniaIntegrationService::class,
        FakturowniaOrderRepositoryContract::class => FakturowniaOrderRepository::class,
    ];

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes.php');

        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    public function register()
    {
        parent::register();
        $this->app->register(EventServiceProvider::class);

        $this->mergeConfigFrom(__DIR__ . '/config.php', 'fakturownia');

        AdministrableConfig::registerConfig('fakturownia.host', ['nullable', 'string'], false);
        AdministrableConfig::registerConfig('fakturownia.token', ['nullable', 'string'], false);
        AdministrableConfig::registerConfig('fakturownia.seller.name', ['nullable', 'string'], false);
        AdministrableConfig::registerConfig('fakturownia.seller.nip', ['nullable', 'string'], false);
        AdministrableConfig::registerConfig('fakturownia.seller.bank', ['nullable', 'string'], false);
        AdministrableConfig::registerConfig('fakturownia.seller.bank_account', ['nullable', 'string'], false);
        AdministrableConfig::registerConfig('fakturownia.seller.email', ['nullable', 'string'], false);
        AdministrableConfig::registerConfig('fakturownia.seller.street', ['nullable', 'string'], false);
        AdministrableConfig::registerConfig('fakturownia.seller.city', ['nullable', 'string'], false);
        AdministrableConfig::registerConfig('fakturownia.seller.zip_code', ['nullable', 'string'], false);
    }

    protected function bootForConsole(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }
}
