<?php

namespace Wossnap\CommissionTask\Handlers;

use Exception;
use GuzzleHttp\Client;
use Wossnap\CommissionTask\Configs\Config;

class ExchangeRateApiHandler implements ExchangeRateHandlerInterface
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function fetchRate(string $currency): ?float
    {
        try{
            $response = $this->client->request('GET', Config::get('api_exchange_url'));
        }catch(Exception $e){
            //we can add in a logger here
            throw $e;
        }
        $responseData = json_decode($response->getBody(), true);
        return isset($responseData['rates'][$currency]) ? $responseData['rates'][$currency] : null;
    }
}