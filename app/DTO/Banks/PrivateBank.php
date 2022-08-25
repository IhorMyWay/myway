<?php

namespace App\DTO\Banks;

use App\Interfaces\BanksInterface;

class PrivateBank implements BanksInterface
{
    public function getBankName(): string
    {
        return 'PrivateBank';
    }

    public function getDataActionType(): string
    {
    }
}
