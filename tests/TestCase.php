<?php

namespace EscolaLms\FakturowniaIntegration\Tests;

use Abb\Fakturownia\Fakturownia;
use Abb\Fakturownia\FakturowniaResponse;
use EscolaLms\Cart\CartServiceProvider;
use EscolaLms\Core\Models\User;
use EscolaLms\Courses\EscolaLmsCourseServiceProvider;
use EscolaLms\FakturowniaIntegration\EscolaLmsFakturowniaIntegrationServiceProvider;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Passport\PassportServiceProvider;
use PHPUnit\Framework\MockObject\MockObject;
use Spatie\Permission\PermissionServiceProvider;

class TestCase extends \EscolaLms\Core\Tests\TestCase
{
    use DatabaseTransactions;
    private string $apiToken = '123456/my-subdomain';

    protected function setUp(): void
    {
        parent::setUp();
        $this->fakturownia = new Fakturownia($this->apiToken, $this->mockRestClient());
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();
        unset($this->fakturownia);
    }

    /**
     * Mock REST client
     *
     * @return MockObject|\Abb\Fakturownia\RestClientInterface
     */
    private function mockRestClient(): MockObject
    {
        $restClient = $this->createMock('Abb\Fakturownia\RestClientInterface');

        $responseCallback = function (int $code) {
            return function (string $url, array $params) use ($code) {
                $params['url'] = $url;
                return new FakturowniaResponse($code, $params);
            };
        };

        $restClient->expects($this->any())
            ->method('get')
            ->willReturnCallback($responseCallback(200));

        $restClient->expects($this->any())
            ->method('post')
            ->willReturnCallback($responseCallback(201));

        $restClient->expects($this->any())
            ->method('put')
            ->willReturnCallback($responseCallback(202));

        $restClient->expects($this->any())
            ->method('delete')
            ->willReturnCallback($responseCallback(203));

        return $restClient;
    }

    protected function getPackageProviders($app): array
    {
        return [
            ...parent::getPackageProviders($app),
            PassportServiceProvider::class,
            PermissionServiceProvider::class,
            EscolaLmsFakturowniaIntegrationServiceProvider::class,
            CartServiceProvider::class,
            EscolaLmsCourseServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('auth.providers.users.model', User::class);
        $app['config']->set('passport.client_uuids', true);
    }
}
