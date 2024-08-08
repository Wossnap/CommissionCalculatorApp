<?php

namespace Wossnap\CommissionTask\Handlers;

interface ExchangeRateHandlerInterface
{
    public function fetchRate(string $currency): ?float;
}
