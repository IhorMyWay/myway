<?php

namespace App\Http\Controllers;

use App\Helpers\CurrencyHelper;
use App\Jobs\ExchangerRateJob;
use App\Models\BanksModel;
use App\Repository\ExchangeRatesRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;

class IndexController extends Controller
{
    public function index()
    {
        return view('index/index', [
            'banks' => BanksModel::all()
        ]);
    }

    public function courses(string $name, string $period, ExchangeRatesRepository $exchangeRatesRepository)
    {
        ExchangerRateJob::dispatch();

        if (!in_array($period, [ExchangeRatesRepository::DAY_PERIOD, ExchangeRatesRepository::MONTH_PERIOD, ExchangeRatesRepository::WEEK_PERIOD])) {
            return Redirect::to('/');
        }

        return view('index/exchange_rates', [
            'rates' => $exchangeRatesRepository->findExchangeRatesByBankNameAndPeriod($name, $period)->groupBy('title'),
            'name' => $name,
            'period' => $period,
            'dateFromAndTo' => CurrencyHelper::handleHistoryPeriod($period),
            'today' => Carbon::today()->format('d-m-Y')
        ]);
    }
}
