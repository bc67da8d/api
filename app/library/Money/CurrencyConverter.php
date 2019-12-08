<?php
namespace Lackky\Money;

use Brick\Math\RoundingMode;
use Brick\Money\CurrencyConverter as BrickConverter;
use Brick\Money\ExchangeRateProvider\ConfigurableProvider;
use Brick\Money\Money;
use Phalcon\Mvc\User\Component;

class CurrencyConverter extends Component
{
    /**
     * @return BrickConverter
     */
    private function createCurrencyConverter()
    {
        $exchangeRateProvider = new ConfigurableProvider();
        $exchangeRateProvider->setExchangeRate('EUR', 'USD', '1.1');
        $exchangeRateProvider->setExchangeRate('USD', 'EUR', '10/11');
        $exchangeRateProvider->setExchangeRate('BSD', 'USD', 1);
        $exchangeRateProvider->setExchangeRate('USD', 'JPY', '106.632');
        $exchangeRateProvider->setExchangeRate('JPY', 'USD', '0.009378');

        return new BrickConverter($exchangeRateProvider);
    }
    /**
     * @param $amount
     * @param string $sourceCurrencyCode
     * @param string $targetCurrencyCode
     *
     * @return string
     */
    public function convert($amount, string $sourceCurrencyCode, string $targetCurrencyCode)
    {

        try {
            $money = Money::of($amount, $sourceCurrencyCode);
            $money = $this->createCurrencyConverter()->convert($money, $targetCurrencyCode, RoundingMode::DOWN);
            return  (string) $money->formatTo('en_US');
        } catch (\Exception $e) {
            return $this->getDI()->get('logger')->error($e->getMessage());
        }
    }
}
