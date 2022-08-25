<?php

namespace App\Interfaces;

interface BanksInterface
{
    public function getBankName(): string;

    public function getDataActionType(): string;
}
