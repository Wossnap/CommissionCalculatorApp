<?php

namespace Wossnap\CommissionTask\Handlers;

use GuzzleHttp\Client;

class ExchangeRateApiHandler implements ExchangeRateHandlerInterface
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function fetchRate(string $currency): ?float
    {
        $response = $this->client->request('GET', 'https://api.exchangeratesapi.io/latest');
        $rates = json_decode($response->getBody(), true)['rates'];
        return $rates[$currency] ?? null;
    }
}