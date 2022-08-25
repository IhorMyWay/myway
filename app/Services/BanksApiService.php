<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

abstract class BanksApiService
{
    const MONO_BANK_API_ROUTE = 'https://api.monobank.ua/bank/currency';

    const PRIVATE_BANK_API_ROUTE = 'https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=5';

    private Client $apiClient;

    public function __construct()
    {
        $this->apiClient = new Client();
    }

    public function getPrivateBankData(string $uri, array $options = [], string $method)
    {
        return $this->send($uri, $options, $method);
    }

    public function getMonoBankData(string $uri, array $options = [], string $method)
    {
        return $this->send($uri, $options, $method);
    }

    private function send(string $uri, array $options = [], string $method)
    {
        try {
            $request = $this->apiClient->request($method, $uri, $options);

            return json_decode($request->getBody()->getContents(), true);
        } catch (\Exception $e) {
            Log::critical("An error occurred while retrieving bank data: {$e->getMessage()}");
        }

        return false;
    }
}
