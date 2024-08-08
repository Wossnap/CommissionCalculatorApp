<?php

declare(strict_types=1);

namespace Wossnap\CommissionTask\Tests\Service;

use PHPUnit\Framework\TestCase;
use Wossnap\CommissionTask\Handlers\BinLookupHandlerInterface;
use Wossnap\CommissionTask\Handlers\ExchangeRateHandlerInterface;
use Wossnap\CommissionTask\Services\CommisionCalculator;

class CommisionCalculatorTest extends TestCase
{
    /**
     * @var CommisionCalculator
     */
    private $calculator;
    private $exchangeRateHandlerMock;
    private $binLookupHandlerMock;

    protected function setUp(): void
    {
        $this->exchangeRateHandlerMock = $this->createMock(ExchangeRateHandlerInterface::class);
        $this->binLookupHandlerMock = $this->createMock(BinLookupHandlerInterface::class);

        $this->calculator = new CommisionCalculator(
            $this->exchangeRateHandlerMock,
            $this->binLookupHandlerMock
        );
    }
    /**
     * @param string $alpha2
     * @param float $rate
     * @param float $amount
     * @param float $expectation
     *
     * @dataProvider dataProviderForAddTesting
     */
    public function testCalculate(?string $alpha2, ?float $rate, float $amount, float $expectation)
    {
        $this->binLookupHandlerMock
            ->method('fetchCountryAlpha2Code')
            ->willReturn($alpha2);
        
        $this->exchangeRateHandlerMock
            ->method('fetchRate')
            ->willReturn($rate);

        $this->assertEquals(
            $expectation,
            $this->calculator->calculate('xxxxx', $amount, 'XXX')
        );
    }

    public function dataProviderForAddTesting(): array
    {
        return [
            'calculate commision for EU country with EUR' => [
                'DK',
                1, 
                100, 
                1
            ],
            'calculate commision for EU country with USD' => [
                'LT', 
                1.095182, 
                50, 
                0.46
            ],
            'calculate commision for NON-EU country with JPY' => [
                'JP', 
                157.940396, 
                10000, 
                1.27
            ],
            'calculate commision for Non-EU country with USD' => [
                'US', 
                1.095182, 
                130, 
                2.38
            ],
            'calculate commision for EU country with GBP' => [
                'LT', 
                0.857024, 
                2000, 
                23.34
            ],
            'calculate commision for EU country with GBP' => [
                'LT', 
                null, 
                2000, 
                20
            ],//if rate not found use 1
            'calculate commision for NO country specified with JPY' => [
                null, 
                157.940396, 
                10000, 
                1.27
            ],// default outside of europe
        ];
    }
}
