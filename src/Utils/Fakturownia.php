<?php

namespace EscolaLms\FakturowniaIntegration\Utils;

class Fakturownia extends \Abb\Fakturownia\Fakturownia
{
    private string $host;
    private string $token;
    public $response;

    public function __construct()
    {
        $this->setHost();
        $this->setToken();
        parent::__construct($this->token . '/' . $this->host);
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
