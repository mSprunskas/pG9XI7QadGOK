<?php

namespace SpaceX\App;

use RuntimeException;

class Application
{
    private PortfolioCalculator $calculator;

    public function __construct()
    {
        $this->calculator = new PortfolioCalculator();
    }

    public function run(array $argv)
    {
        if (!isset($argv[1])) {
            throw new RuntimeException('Currency is argument required');
        }

        if (!in_array($argv[1], array_keys(CurrencyManager::CONVERSION_RATES), true)) {
            throw new RuntimeException(sprintf('Currency %s is not supported', $argv[1]));
        }

        $cryptoCurrency = isset($argv[2]) ? $argv[2] : null;

        if ($cryptoCurrency !== null && !in_array($cryptoCurrency, array_keys(CurrencyManager::RATE_MAP), true)) {
            throw new RuntimeException(sprintf('Crypto currency %s is not supported', $cryptoCurrency));
        }

        echo $this->calculator->calculate($argv[1], $cryptoCurrency);
    }
}
