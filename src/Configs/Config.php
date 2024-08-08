<?php

namespace Wossnap\CommissionTask\Configs;

use DI;
use Dotenv\Dotenv;
use GuzzleHttp\Client;
use Wossnap\CommissionTask\Handlers\BinLookupApiHandler;
use Wossnap\CommissionTask\Handlers\BinLookupHandlerInterface;
use Wossnap\CommissionTask\Handlers\ExchangeRateApiHandler;
use Wossnap\CommissionTask\Handlers\ExchangeRateHandlerInterface;
use Wossnap\CommissionTask\Services\CommisionCalculator;
use Wossnap\CommissionTask\Utils\HttpClientUtils;

class Config
{
    private static $config = null;

    public static function load()
    {
        if (self::$config === null) {
            $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
            $dotenv->load();

            self::$config = [
                'api_bin_url' => $_ENV['BINLIST_API_URL'] ?: 'https://lookup.binlist.net/',
                'api_exchange_url' => $_ENV['EXCHANGE_RATE_API_URL'] ?: 'https://api.exchangeratesapi.io/latest',
                'use_mocked_http_client' => $_ENV['USE_MOCKED_HTTP_CLIENT'] == 'true' ? true : false,
            ];
        }

        return self::$config;
    }

    public static function get($key)
    {
        $config = self::load();
        return $config[$key] ?? null;
    }

    public static function containerDefinitions()
    {
        return [
                Client::class => self::get('use_mocked_http_client') ?
                    HttpClientUtils::getMockedClient() :
                    DI\create(Client::class),//Used mocked client as the bin lookup & exchange service were not reliable
                BinLookupHandlerInterface::class => DI\autowire(BinLookupApiHandler::class),
                ExchangeRateHandlerInterface::class => DI\autowire(ExchangeRateApiHandler::class),
                CommisionCalculator::class => DI\autowire(CommisionCalculator::class)
                    ->constructor(
                        DI\get(ExchangeRateHandlerInterface::class),
                        DI\get(BinLookupHandlerInterface::class)
                    ),
            ];
    }
}
