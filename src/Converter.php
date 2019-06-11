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
    private const VERSION = '1.0.0';

    /** @var string */
    private $currencyCode;
    /** @var RoundedNumber */
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
    public function withCurrency(string $currency) : Converter
    {
        $converter = clone $this;
        $converter->currencyCode = $currency;

        return $converter;
    }

    /**
     * @param RoundedNumber $amount
     * @return Converter
     */
    public function withAmount(RoundedNumber $amount) : Converter
    {
        $converter = clone $this;
        $converter->amount = $amount;

        return $converter;
    }

    /**
     * @param string $toCurrency
     * @return CurrencyConversion
     */
    public function convertTo(string $toCurrency) : CurrencyConversion
    {
        $fromCurrency = $this->currencies->getCurrentRate($this->getCurrencyCode());

        return new CurrencyConversion($this->getAmount(), $fromCurrency, $toCurrency);
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
     * @return RoundedNumber
     */
    public function getAmount(): RoundedNumber
    {
        return $this->amount;
    }
}
