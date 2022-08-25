<?php

namespace App\Helpers;

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
        dump($data);
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
}
