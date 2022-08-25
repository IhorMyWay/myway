<?php

namespace App\Jobs;

use App\Models\BanksModel;
use App\Models\CurrenciesModel;
use App\Models\ExchangeRatesModel;
use App\Services\Handler;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class ExchangerRateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct()
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle($banks, $dto)
    {
        foreach ($banks as $bank) {
            $bankModel = BanksModel::firstOrCreate([
                'name' => $bank->getBankName(),
            ]);

            foreach ($dto[$bank->getBankName()]->getDataAction() as $item)
            {
                $currencyModel = CurrenciesModel::firstOrCreate([
                    'name' => $item['name'],
                    'bank_id' => $bankModel->id,
                ]);

                ExchangeRatesModel::create([
                    'buy' => $item['buy'],
                    'sale' => $item['sale'],
                    'currency_id' => $currencyModel->id,
                ]);
            }

        }
    }
}
