<?php

namespace App\Services\BanksApiService;

use App\Helpers\CurrencyHelper;
use App\Interfaces\ApiDataActionInterface;
use App\Services\ApiService;

class MonoBankApiService extends ApiService implements ApiDataActionInterface
{
    public function getDataAction()
    {
        return CurrencyHelper::handleData(array_slice($this->send(env('MONO_BANK_API_ROUTE'), [], 'GET'), 0, 3));
    }
}
