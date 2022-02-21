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

    public static function hourConverter($seconds)
    {
        $minutes = floor($seconds/60);
        $hours = floor($minutes/60);
        $result = [];
        if ($minutes) {
            if ($minutes < 10) {
                $result[] = '0' . $minutes;
            } else {
                $result[] = $minutes;
            }
        } else {
            $result[] = '00';
        }

        if ($hours) {
            if ($hours < 10) {
                $result[] = '0' . $hours;
            } else {
                $result[] = $hours;
            }
        } else {
            $result[] = '00';
        }

        if ($seconds) {
            if ($seconds < 10) {
                $result[] = '0' . $seconds;
            } else {
                $result[] = $seconds;
            }
        } else {
            $result[] = '00';
        }

        return implode(':', $result);
    }

    /**
     * @param $date
     * @param false $dayString
     * @param false $monthString
     * @param string $separator
     * @return string
     */
    public static function convertToPolish($date, $dayString = false, $monthString = false, $separator = ' ')
    {
        $dateObject = self::generateDateObject($date);
        $result = [];
        if ($dayString) {
            $result[] = __($dateObject->format('l'));
        } else {
            $result[] = $dateObject->format('d');
        }

        if ($monthString) {
            $result[] = mb_strtolower(__($dateObject->format('F')));
        } else {
            $result[] = $dateObject->format('m');
        }

        $result[] = $dateObject->format('Y');
        return implode($separator, $result);
    }
}
