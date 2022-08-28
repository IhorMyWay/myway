<?php

namespace App\DTO\BanksDTO;

use App\Interfaces\BanksInterface;

class PrivateBankDTO implements BanksInterface
{
    public function getBankName(): string
    {
        return 'PrivateBank';
    }
}
