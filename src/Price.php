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

class Price
{
    /** @var string ISO 4217 3-letter currency code */
    private $currencyCode;
    /** @var float */
    private $amount;
    /** @var int */
    protected $precision = 2;

    /**
     * @param float $amount
     * @param string $currencyCode
     */
    public function __construct(float $amount, string $currencyCode)
    {
        $this->amount = $amount;
        $this->currencyCode = $currencyCode;
    }

    /**
     * @param int $precision
     * @return Price
     */
    public function withPrecision(int $precision) : Price
    {
        $newPrice = clone $this;
        $newPrice->precision = $precision;

        return $newPrice;
    }

    /**
     * @return float
     */
    public function getAmount() : float
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getCurrencyCode() : string
    {
        return $this->currencyCode;
    }

    /**
     * @return string
     */
    public function toString() : string
    {
        $amount = number_format($this->getAmount(), $this->precision);

        return $this->getCurrencyCode() . ' ' . $amount;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->toString();
    }
}
