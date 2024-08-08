<?php

namespace Wossnap\CommissionTask\Handlers;

use GuzzleHttp\Client;

class BinLookupApiHandler implements BinLookupHandlerInterface
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function fetchCountryAlpha2Code(int $bin): ?string
    {
        $response = $this->client->request('GET', 'https://lookup.binlist.net/' . $bin);
        $binData = json_decode($response->getBody());
        return $binData->country?->alpha2 ?? null;
    }
}   