<?php

namespace EscolaLms\FakturowniaIntegration\Traits;


trait SetLocale
{
    public function setLocale(): void
    {
        $locale = substr(request()->header('invoice-language', 'pl'), 0, 2);
        app()->setLocale($locale);
    }
}
