<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

abstract class ApiService
{
    private Client $guzzle;

    public function __construct()
    {
        $this->guzzle = new Client();
    }

    protected function send(string $uri, array $options = [], string $method)
    {
        try {
            $request = $this->guzzle->request($method, $uri, $options);

            return json_decode($request->getBody()->getContents(), true);
        } catch (\Exception $e) {
            Log::critical("An error occurred while retrieving bank data: {$e->getMessage()}");
        }

        return false;
    }
}
