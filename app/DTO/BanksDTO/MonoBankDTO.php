<?php

namespace App\DTO\BanksDTO;

use App\Interfaces\BanksInterface;

class MonoBankDTO implements BanksInterface
{
    public function getBankName(): string
    {
        return 'MonoBank';
    }
}
