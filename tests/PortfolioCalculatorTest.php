<?php

declare(strict_types=1);

use SpaceX\App\PortfolioCalculator;
use PHPUnit\Framework\TestCase;

final class PortfolioCalculatorTest extends TestCase
{
    private $calculator;

    public function setUp(): void
    {
        $this->calculator = new PortfolioCalculator();
    }

    /**
     * @param string $currency
     * @param float $expectation
     *
     * @dataProvider dataProviderForWholePortfolioTest
     */
    public function testWholePortfolio(string $currency, float $expectation)
    {
        $this->assertEquals($expectation, $this->calculator->calculate($currency));
    }

    public function dataProviderForWholePortfolioTest(): array
    {
        return [
            'case EUR' => [
                'EUR',
                55.5826098515
            ],
            'case USD' => [
                'USD',
                51.43324092
            ],
        ];
    }

    /**
     * @param string $currency
     * @param string $crypto
     * @param float $expectedAmount
     *
     * @dataProvider dataProviderForRatesTest
     */
    public function testEachCryptoCurrency(string $currency, string $crypto, float $expectedAmount): void
    {
        $this->assertEquals($expectedAmount, $this->calculator->calculate($currency, $crypto));
    }

    public function dataProviderForRatesTest(): array
    {
        return [
            'case EUR BTC' => [
                'EUR',
                'BTC',
                19.1729299715
            ],
            'case USD BTC' => [
                'USD',
                'BTC',
                18.67569792
            ],
            'case EUR ETH' => [
                'EUR',
                'ETH',
                32.70967988
            ],
            'case USD ETH' => [
                'USD',
                'ETH',
                28.317543
            ],
        ];
    }
}
