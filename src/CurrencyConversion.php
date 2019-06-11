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

final class CurrencyConversion
{
    /** @var RoundedNumber */
    private $baseAmount;
    /** @var CurrencyValue */
    private $fromCurrency;
    /** @var string */
    private $toCurrency;

    /**
     * @param RoundedNumber $number
     * @param CurrencyValue $fromCurrency
     * @param string $toCurrency
     */
    public function __construct(RoundedNumber $number, CurrencyValue $fromCurrency, string $toCurrency)
    {
        $this->baseAmount = $number;
        $this->fromCurrency = $fromCurrency;
        $this->toCurrency = $toCurrency;
    }

    /**
     * @return RoundedNumber
     */
    public function getBaseAmount() : RoundedNumber
    {
        return $this->baseAmount;
    }

    /**
     * @return CurrencyValue
     */
    public function getFrom() : CurrencyValue
    {
        return $this->fromCurrency;
    }

    /**
     * @return string
     */
    public function getTo() : string
    {
        return $this->toCurrency;
    }

    /**
     * @param int $precision
     * @param int $mode
     * @return RoundedNumber
     */
    public function getAmount(int $precision = RoundedNumber::DEFAULT_PRECISION, int $mode = RoundedNumber::DEFAULT_ROUNDING_MODE) : RoundedNumber
    {
        $result = $this->getBaseAmount()->getRoundedAmount() * $this->getFrom()->getRate();

        return RoundedNumber::make($result)->withMode($mode)->withPrecision($precision);
    }

    /**
     * @return FormattedAmount
     */
    public function getFormattedAmount() : FormattedAmount
    {
        return new FormattedAmount(
            $this->getAmount(),
            $this->getTo()
        );
    }
}
