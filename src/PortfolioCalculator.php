<?php

declare(strict_types=1);

namespace SpaceX\App;

class PortfolioCalculator
{
    private ServiceFeeProvider $serviceFeeProvider;
    private CurrencyManager $currencyManager;
    private PortfolioModel $model;

    public function __construct()
    {
        $this->serviceFeeProvider = new ServiceFeeProvider();
        $this->currencyManager  = new CurrencyManager();
        $this->model = new PortfolioModel();
    }

    public function calculate(string $classicCurrency, string $cryptoCurrency = null): float
    {
        $result  = $this->model->getPortfolio($cryptoCurrency);
        $sum = 0;
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $sum += $this->currencyManager->getCryptoCurrencyRate($classicCurrency, $row['name']) * $row['amount'];
        }

        $serviceFee = $this->serviceFeeProvider->getServiceFee($sum, $classicCurrency);

        return $sum - $serviceFee;
    }
}
