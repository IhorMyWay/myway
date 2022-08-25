<?php

namespace App\DTO\DataActionsDTO;

use App\Interfaces\DataActionsType;
use App\Services\BanksCoursesParseService;
use Goutte\Client;

class CredoBankDTO extends BanksCoursesParseService implements DataActionsType
{
    public function getDataAction(): array
    {
        return $this->parseCredoBankCourse();
    }
}
