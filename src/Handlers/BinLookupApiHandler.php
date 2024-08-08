<?php

namespace Wossnap\CommissionTask\Handlers;

use Exception;
use GuzzleHttp\Client;
use Wossnap\CommissionTask\Configs\Config;

class BinLookupApiHandler implements BinLookupHandlerInterface
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function fetchCountryAlpha2Code(string $bin): ?string
    {
        try{
            $response = $this->client->request('GET', Config::get('api_bin_url') . $bin);
        }catch(Exception $e){
            //we can add in a logger here
            throw $e;
        }
        $binData = json_decode($response->getBody());
        return $binData->country?->alpha2 ?? null;
    }
}   