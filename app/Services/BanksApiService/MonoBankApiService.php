<?php

namespace App\Services\BanksApiService;

use App\Helpers\CurrencyHelper;
use App\Interfaces\ApiDataActionInterface;
use App\Services\ApiService;

class MonoBankApiService extends ApiService implements ApiDataActionInterface
{
    public function getDataAction(): array
    {
        return CurrencyHelper::handleData($this->send(env('MONO_BANK_API_ROUTE'), [], 'GET'));
    }
}
