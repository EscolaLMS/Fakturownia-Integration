<?php

namespace EscolaLms\FakturowniaIntegration\Helpers;

use Carbon\Carbon;

class TimeHelper
{
    public static function generateDateObject($date) : Carbon
    {
        return $date ? Carbon::make($date) : now();
    }

    public static function generateDateString($date, $format = 'Y-m-d') : string
    {
        return self::generateDateObject($date)->format($format);
    }
}
