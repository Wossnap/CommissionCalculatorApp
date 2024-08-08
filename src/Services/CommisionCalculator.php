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

    public function calculate(string $bin, float $amount, string $currency): float
    {
        $alpha2Code = $this->binLookupHandler->fetchCountryAlpha2Code($bin);
        $isEu = false;
        if($alpha2Code) {
            $isEu = CountryUtils::isEu($alpha2Code);
        }

        $rate = $this->exchangeRateHandler->fetchRate($currency);
        $amountFixed = $amount;
        if($currency !== 'EUR' && $rate) {
            $amountFixed = $amount / $rate;
        }

        $commision = $amountFixed * ($isEu ? 0.01 : 0.02);//.env

        return ceil($commision * 100) / 100;
    }
}
