<?php

namespace EscolaLms\FakturowniaIntegration\Utils;

use Abb\Fakturownia\Fakturownia as FakturowaniaCore;
use Abb\Fakturownia\RestClientInterface as RestClientInterfaceCore;
use Abb\Fakturownia\FakturowniaRestClient as FakturowniaRestClientCore;

class Fakturownia extends FakturowaniaCore
{
    private string $host;

    private string $token;

    public $response;

    public function __construct(RestClientInterfaceCore $restClient = null)
    {
        $this->setHost();
        $this->setToken();
        parent::__construct($this->token . '/' . $this->host, $restClient ?: new FakturowniaRestClientCore());
    }

    private function setHost()
    {
        $this->host = config('fakturownia.host');
    }

    private function setToken()
    {
        $this->token = config('fakturownia.token');
    }
}
