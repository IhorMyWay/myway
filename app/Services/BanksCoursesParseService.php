<?php

namespace App\Services;

use Goutte\Client;

abstract class BanksCoursesParseService
{
    private array $fields = [];

    const CREDO_BANK = 'https://kredobank.com.ua/info/kursy-valyut/commercial';

    public function parseCredoBankCourse(): array
    {
        $crawler = new Client();

         $crawler->request('GET',  self::CREDO_BANK)->filterXPath('//div//table/tbody/tr')->each(function ($field) {
            $this->fields[] = preg_replace('/[^a-zA-Z]/', '', $field->filter('td')->eq(0)->text());
            $this->fields[] = $field->filter('td')->eq(2)->text();
            $this->fields[] = $field->filter('td')->eq(3)->text();
        });

         return $this->addKeyToFields();
    }

    private function addKeyToFields(): array
    {
        $combined = [];
        $keys = ['name', 'buy', 'sale'];

        foreach (array_chunk($this->fields, 3) as $field)
        {
            $combined[] = array_combine($keys, $field);
        }

        return $combined;
    }
}
