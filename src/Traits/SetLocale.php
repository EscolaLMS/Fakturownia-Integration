<?php

namespace EscolaLms\FakturowniaIntegration\Traits;


trait SetLocale
{
    public function setLocale(): void
    {
        $locale = substr(request()->header('accept-language', app()->getLocale()), 0, 2);
        app()->setLocale($locale);
    }
}
