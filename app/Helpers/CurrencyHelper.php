<?php

namespace App\Helpers;

use App\Repository\ExchangeRatesRepository;
use Carbon\Carbon;

class CurrencyHelper
{
    public static function getCurrencyNameByCode(string $code)
    {
        if (!key_exists($code, self::currencyCodes())) {
            return;
        }

        return self::currencyCodes()[$code];
    }

    private static function currencyCodes(): array
    {
        return [
            '840' => 'USD',
            '978' => 'EUR',
            '826' => 'GBP',
            '392' => 'JPY',
            '756' => 'CHF',
            '156' => 'CNY',
        ];
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

    public static function addKeyToFields(array $fields): array
    {
        $combined = [];
        $keys = [
            'name',
            'sale',
            'buy'
        ];

        foreach (array_chunk($fields, 3) as $field)
        {
            $combined[] = array_combine($keys, $field);
        }

        return $combined;
    }

    public static function handleHistoryPeriod(string $period): array
    {
        $dateFrom = [];

        if ($period == ExchangeRatesRepository::WEEK_PERIOD) {
            $dateFrom['from'] = Carbon::today()->startOfWeek()->format('d-m-Y');
            $dateFrom['to'] = Carbon::today()->endOfWeek()->format('d-m-Y');
        }

        if ($period == ExchangeRatesRepository::MONTH_PERIOD) {
            $dateFrom['from'] = Carbon::today()->startOfMonth()->format('d-m-Y');
            $dateFrom['to'] = Carbon::today()->endOfMonth()->format('d-m-Y');
        }

        return $dateFrom;
    }
}
