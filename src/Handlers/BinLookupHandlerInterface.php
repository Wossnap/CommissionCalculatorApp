<?php

namespace Wossnap\CommissionTask\Handlers;

interface BinLookupHandlerInterface
{
    public function fetchCountryAlpha2Code(string $bin): ?string;
}
