<?php

namespace App\DTO\Banks;

use App\Interfaces\BanksInterface;

class MonoBank implements BanksInterface
{
    public function getBankName(): string
    {
        return 'MonoBank';
    }

    public function getDataActionType(): string
    {
    }

    public function test()
    {
        return 'tesg';
    }
}
