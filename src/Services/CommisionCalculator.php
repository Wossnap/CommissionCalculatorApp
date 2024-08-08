<?php

declare(strict_types=1);

namespace Wossnap\CommissionTask\Services;

use Wossnap\CommissionTask\Handlers\BinLookupHandlerInterface;
use Wossnap\CommissionTask\Handlers\ExchangeRateHandlerInterface;
use Wossnap\CommissionTask\Utils\CountryUtils;

class CommisionCalculator
{
    private $exchangeRateHandler;
    private $binLookupHandler;

    public function __construct(
        ExchangeRateHandlerInterface $exchangeRateHandler, 
        BinLookupHandlerInterface $binLookupHandler
    ) {
        $this->exchangeRateHandler = $exchangeRateHandler;
        $this->binLookupHandler = $binLookupHandler;
    }

    public function calcualte(int $bin, float $amount, string $currency): float
    {
        $alpha2Code = $this->binLookupHandler->fetchCountryAlpha2Code($bin);
        $isEu = CountryUtils::isEu($alpha2Code);
        $rate = $this->exchangeRateHandler->fetchRate($currency);
        $amountFixed = $currency === 'EUR' ? $amount : $amount / $rate;
        return $amountFixed * ($isEu ? 0.01 : 0.02);//.env
    }
}
