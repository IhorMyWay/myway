<?php

namespace App\Services\BanksApiService;

use App\Helpers\CurrencyHelper;
use App\Interfaces\ApiDataActionInterface;
use Goutte\Client;

class CredoBankApiService implements ApiDataActionInterface
{
    private array $courses = [];

    public function getDataAction(): array
    {
        return $this->parseCredoBankCourse();
    }

    private function parseCredoBankCourse(): array
    {
        $crawler = new Client();

        $crawler->request('GET',  env('CREDO_BANK_PARSE_URL'))->filterXPath('//div//table/tbody/tr')->each(function ($field) {
            $this->courses[] = preg_replace('/[^a-zA-Z]/', '', $field->filter('td')->eq(0)->text());
            $this->courses[] = $field->filter('td')->eq(2)->text();
            $this->courses[] = $field->filter('td')->eq(3)->text();
        });

        return CurrencyHelper::addKeyToFields($this->courses);
    }
}
