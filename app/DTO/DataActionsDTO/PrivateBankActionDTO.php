<?php

namespace App\DTO\DataActionsDTO;

use App\Interfaces\DataActionsType;
use App\Helpers\CurrencyHelper;
use App\Services\BanksApiService;

class PrivateBankActionDTO extends BanksApiService implements DataActionsType
{
    const PRIVATE_BANK_API_ROUTE = 'https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=5';

    public function getDataAction(): array
    {
       return CurrencyHelper::handleData($this->getPrivateBankData(self::PRIVATE_BANK_API_ROUTE, [], 'GET'));
    }
}
