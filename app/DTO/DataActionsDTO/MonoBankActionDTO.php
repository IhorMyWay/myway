<?php

namespace App\DTO\DataActionsDTO;

use App\Interfaces\DataActionsType;
use App\Services\BanksApiService;
use App\Helpers\CurrencyHelper;

class MonoBankActionDTO extends BanksApiService implements DataActionsType
{
    const MONO_BANK_API_ROUTE = 'https://api.monobank.ua/bank/currency';

    public function getDataAction()
    {
        return CurrencyHelper::handleData(array_slice($this->getMonoBankData(self::MONO_BANK_API_ROUTE, [], 'GET'), 0, 3));
    }
}
