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

final class FormattedAmount
{
    /** @var string */
    private $currencyCode;
    /** @var float|RoundedNumber */
    private $amount;
    /** @var int */
    private $precision = 2;

    /**
     * @param float|RoundedNumber $amount
     * @param string $currencyCode
     */
    public function __construct($amount, string $currencyCode)
    {
        $this->amount = $amount;
        $this->currencyCode = $currencyCode;
    }

    /**
     * @param int $precision
     * @return FormattedAmount
     */
    public function withPrecision(int $precision) : FormattedAmount
    {
        $amount = clone $this;
        $amount->precision = $precision;

        return $amount;
    }

    /**
     * @return float|RoundedNumber
     */
    public function getAmount()
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
     * @return int
     */
    public function getPrecision(): int
    {
        return $this->precision;
    }

    /**
     * @return string
     */
    public function toString() : string
    {
        if ($this->getAmount() instanceof RoundedNumber) {
            return $this->getCurrencyCode() . ' ' . $this->getAmount()->toString();
        }

        $amount = number_format($this->getAmount(), $this->getPrecision());

        return $this->getCurrencyCode() . ' ' . $amount;
    }
}
