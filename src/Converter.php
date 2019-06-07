<?php

/*
 * This file is part of the Gocanto Converter
 *
 * (c) Gustavo Ocanto <gustavoocanto@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gocanto\Converter;

use Gocanto\Converter\Interfaces\CurrenciesRepositoryInterface;

class Converter
{
    /** @var string */
    private const VERSION = '0.0.1';

    /** @var string */
    private $currencyCode;
    /** @var float */
    private $amount;
    /** @var CurrenciesRepositoryInterface */
    private $currencies;

    /**
     * @param CurrenciesRepositoryInterface $currencies
     */
    public function __construct(CurrenciesRepositoryInterface $currencies)
    {
        $this->currencies = $currencies;
    }

    /**
     * @param string $currency
     * @return Converter
     */
    public function usingCurrency(string $currency) : Converter
    {
        $converter = clone $this;
        $converter->currencyCode = $currency;

        return $converter;
    }

    /**
     * @param float $amount
     * @return Converter
     */
    public function usingAmount(float $amount) : Converter
    {
        $converter = clone $this;
        $converter->amount = $amount;

        return $converter;
    }

    /**
     * @param Price $price
     * @return Converter
     */
    public function usingPrice(Price $price) : Converter
    {
        $converter = clone $this;

        $converter->currencyCode = $price->getCurrencyCode();
        $converter->amount = $price->getAmount();

        return $converter;
    }

    /**
     * @param string $currencyCode
     * @return CurrencyConversion
     */
    public function convertTo(string $currencyCode) : CurrencyConversion
    {
        $currency = $this->currencies->getCurrentRate($this->getCurrencyCode());

        return new CurrencyConversion($this->getAmount(), $this->getCurrencyCode(), $currencyCode, $currency->getRate());
    }

    /**
     * @return string
     */
    public function getVersion() : string
    {
        return static::VERSION;
    }

    /**
     * @return string
     */
    public function getCurrencyCode(): string
    {
        return $this->currencyCode;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }
}
