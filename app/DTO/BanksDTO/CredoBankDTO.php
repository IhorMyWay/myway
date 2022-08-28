<?php

namespace App\DTO\BanksDTO;

use App\Interfaces\BanksInterface;

class CredoBankDTO implements BanksInterface
{
    public function getBankName(): string
    {
        return 'CredoBank';
    }
}
