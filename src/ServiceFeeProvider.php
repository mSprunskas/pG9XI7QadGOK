<?php

namespace SpaceX\App;

class ServiceFeeProvider
{
    private CurrencyManager $currencyManager;

    public function __construct()
    {
        $this->currencyManager = new CurrencyManager();
    }

    public function getServiceFee(float $sum, string $currency): float
    {
        $ratio = $this->currencyManager->getClassicCurrencyRate($currency);

        return $ratio * $this->getServiceFeeRatio($sum) + $this->getCurrencyExchangeTaxFee($sum);
    }

    private function getCurrencyExchangeTaxFee(float $sum): float
    {
        return $sum * 0.013;
    }

    private function getServiceFeeRatio(float $sum): float
    {
        // discount for large sums
        if ($sum >= 1000) {
            return 1.7;
        }

        return 3.70;
    }
}
