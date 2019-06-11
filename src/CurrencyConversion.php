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
    /** @var string */
    private $from;
    /** @var string */
    private $to;
    /** @var float */
    private $rate;

    /**
     * @param RoundedNumber $number
     * @param string $from
     * @param string $to
     * @param float $rate
     */
    public function __construct(RoundedNumber $number, string $from, string $to, float $rate)
    {
        $this->baseAmount = $number;
        $this->from = $from;
        $this->to = $to;
        $this->rate = $rate;
    }

    /**
     * @return RoundedNumber
     */
    public function getBaseAmount() : RoundedNumber
    {
        return $this->baseAmount;
    }

    /**
     * @return string
     */
    public function getFrom() : string
    {
        return $this->from;
    }

    /**
     * @return string
     */
    public function getTo() : string
    {
        return $this->to;
    }

    /**
     * @return float
     */
    public function getRate() : float
    {
        return $this->rate;
    }

    /**
     * @param int $precision
     * @param int $mode
     * @return RoundedNumber
     */
    public function getAmount(int $precision = RoundedNumber::DEFAULT_PRECISION, int $mode = RoundedNumber::DEFAULT_ROUNDING_MODE) : RoundedNumber
    {
        $result = $this->getBaseAmount()->getRoundedAmount() * $this->getRate();

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
