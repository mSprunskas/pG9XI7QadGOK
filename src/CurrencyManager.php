<?php

namespace SpaceX\App;

use InvalidArgumentException;

class CurrencyManager
{
    const EUR = 'EUR';
    const USD = 'USD';
    const BTC = 'BTC';
    const ETH = 'ETH';

    const CONVERSION_RATES = [
        self::EUR => 1,
        self::USD => 1.2,
    ];

    const RATE_MAP = [
        self::BTC => [
            self::EUR => 51498.21,
            self::USD => 52044.80,
        ],
        self::ETH => [
            self::EUR => 1603.88,
            self::USD => 1443.0,
        ],
    ];

    public function getCryptoCurrencyRate(string $classicCurrency, string $cryptoCurrency): float
    {
        if (isset(self::RATE_MAP[$cryptoCurrency][$classicCurrency])) {
            return self::RATE_MAP[$cryptoCurrency][$classicCurrency];
        }

        throw new InvalidArgumentException(sprintf('Unsupported params %s %s', $classicCurrency, $cryptoCurrency));
    }

    public function getClassicCurrencyRate(string $currency): float
    {
        if (isset(self::CONVERSION_RATES[$currency])) {
            return self::CONVERSION_RATES[$currency];
        }

        throw new InvalidArgumentException(sprintf('Rate for "%s" currency is missing', $currency));
    }
}
