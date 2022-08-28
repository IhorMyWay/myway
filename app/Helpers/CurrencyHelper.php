<?php

namespace App\Helpers;

use App\Enum\ExchangeRatesNameWithCodeEnum;
use App\Repository\ExchangeRatesRepository;
use Carbon\Carbon;

class CurrencyHelper
{
    public static function getCurrencyNameByCode(string $code)
    {
        if (!key_exists($code, ExchangeRatesNameWithCodeEnum::toArray())) {
            return;
        }

        return ExchangeRatesNameWithCodeEnum::toArray()[$code];
    }

    public static function handleData(array $data): array
    {
        foreach ($data as $key => $course)
        {
            if (key_exists('ccy', $course)) {
                $data[$key]['name'] = $course['ccy'];
                unset($data[$key]['ccy']);
            }

            if (key_exists('rateBuy', $course)) {
                $data[$key]['buy'] = $course['rateBuy'];
                unset($data[$key]['rateBuy']);
            }

            if (key_exists('rateSell', $course)) {
                $data[$key]['sale'] = $course['rateSell'];
                unset($data[$key]['rateSell']);
            }

            if (key_exists('currencyCodeA', $course)) {
                $data[$key]['name'] = is_numeric($course['currencyCodeA'])
                    ? self::getCurrencyNameByCode($course['currencyCodeA'])
                    : $course['currencyCodeA'];
                unset($data[$key]['currencyCodeA']);
            }

        }

        return $data;
    }

    public static function addKeyNamesToFields(array $courses): array
    {
        $combined = [];

        $keyNames = [
            'name',
            'sale',
            'buy'
        ];

        foreach (array_chunk($courses, 3) as $course)
        {
            $combined[] = array_combine($keyNames, $course);
        }

        return $combined;
    }

    public static function handleHistoryPeriod(string $period): array
    {
        $dateFromAndTo = [];

        if ($period == ExchangeRatesRepository::WEEK_PERIOD) {
            $dateFromAndTo['from'] = Carbon::today()->startOfWeek()->format('d-m-Y');
            $dateFromAndTo['to'] = Carbon::today()->endOfWeek()->format('d-m-Y');
        }

        if ($period == ExchangeRatesRepository::MONTH_PERIOD) {
            $dateFromAndTo['from'] = Carbon::today()->startOfMonth()->format('d-m-Y');
            $dateFromAndTo['to'] = Carbon::today()->endOfMonth()->format('d-m-Y');
        }

        return $dateFromAndTo;
    }
}
