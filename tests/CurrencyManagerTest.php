<?php

use PHPUnit\Framework\TestCase;
use SpaceX\App\CurrencyManager;

class CurrencyManagerTest extends TestCase
{
    private CurrencyManager $currencyManager;

    public function setUp() : void
    {
        $this->currencyManager = new CurrencyManager();
    }

    public function testMissingClassicCurrencyRate()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->currencyManager->getClassicCurrencyRate('XXX');
    }

    /**
     * @param string $classicCurrency
     * @param string $cryptoCurrency
     *
     * @dataProvider dataProviderForMissingCryptoCurrencyRateTest
     */
    public function testMissingCryptoCurrencyRate(string $classicCurrency, string $cryptoCurrency)
    {
        $this->expectException(InvalidArgumentException::class);
        $this->currencyManager->getCryptoCurrencyRate($classicCurrency, $cryptoCurrency);
    }

    public function dataProviderForMissingCryptoCurrencyRateTest(): array
    {
        return [
            'case missing classic currency' => [
                'LTL',
                'BTC',
            ],
            'case missing crypto currency' => [
                'EUR',
                'XXX',
            ],
        ];
    }
}
