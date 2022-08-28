<?php

namespace App\Repository;

use App\Models\CurrenciesModel;
use Carbon\Carbon;

class ExchangeRatesRepository
{
    const DAY_PERIOD = 'day';

    const WEEK_PERIOD = 'week';

    const MONTH_PERIOD = 'month';

    public function findExchangeRatesByBankNameAndPeriod(string $bankName, string $period)
    {
        $rates = CurrenciesModel::join('banks_models', 'currencies_models.bank_id', '=', 'banks_models.id')
            ->join('exchange_rates_models', 'currencies_models.id', '=', 'exchange_rates_models.currency_id')
            ->where('banks_models.name', '=', $bankName);

        if ($period == self::DAY_PERIOD) {
            $rates->whereBetween('exchange_rates_models.created_at', [
                Carbon::today()->startOfDay(),
                Carbon::today()->endOfDay()
            ]);
        }

        if ($period == self::WEEK_PERIOD) {
            $rates->whereBetween('exchange_rates_models.created_at', [
                Carbon::today()->startOfWeek(),
                Carbon::today()->endOfWeek()
            ]);
        }

        if ($period == self::MONTH_PERIOD) {
            $rates->whereBetween('exchange_rates_models.created_at', [
                Carbon::today()->startOfMonth(),
                Carbon::today()->endOfMonth()
            ]);
        }

        return $rates->get();
    }
}
