<?php

namespace App\Service\SyncService\Helper;

use DateTime;
use DateTimeZone;
use Exception;

class DateTimeConverter
{
    /**
     * @param string $dateToConvert
     * @param bool $milliseconds
     * @return float|int
     * @throws Exception
     */
    public function convertDateToTimeStamp(string $dateToConvert, bool $milliseconds = true)
    {
        $date = new DateTime($dateToConvert);
        $date->modify('+1 day'); //for some reason hubspot converts these to the day previous. the only workaround is to increase them by a day.
        if ($milliseconds) {
            return $date->getTimestamp()*1000;
        }
        return $date->getTimestamp();
    }

    /**
     * @param string $timestamp
     * @param bool $milliseconds
     * @return DateTime
     */
    public function convertTimeStampToDate(string $timestamp, bool $milliseconds = true): DateTime
    {
        $date = new DateTime();

        if ($milliseconds) {
            $timestamp = $timestamp / 1000;
        }

        $date->setTimestamp($timestamp);
        return $date;
    }
}
