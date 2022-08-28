<?php

namespace App\Jobs;

use App\Models\BanksModel;
use App\Models\CurrenciesModel;
use App\Models\ExchangeRatesModel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ExchangerRateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle($banksDTO, $apiServices)
    {
        foreach ($banksDTO as $bank) {
            $bankModel = BanksModel::firstOrCreate([
                'name' => $bank->getBankName(),
            ]);

            if ($courses = $apiServices[$bank->getBankName()]->getDataAction()) {
                foreach ($courses as $course) {
                    $currencyModel = CurrenciesModel::firstOrCreate(
                        [
                            'title' => $course['name'],
                            'bank_id' => $bankModel->id,
                        ]
                    );

                    ExchangeRatesModel::create(
                        [
                            'buy' => (float)$course['buy'],
                            'sale' => (float)$course['sale'],
                            'currency_id' => $currencyModel->id,
                        ]
                    );
                }
            }
        }
    }
}
