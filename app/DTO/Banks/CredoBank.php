<?php

namespace App\DTO\Banks;

use App\Interfaces\BanksInterface;

class CredoBank implements BanksInterface
{
    public function getBankName(): string
    {
        return 'CredoBank';
    }

    public function getDataActionType(): string
    {
    }
}
