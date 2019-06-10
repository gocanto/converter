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
    private $number;
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
        $this->number = $number;
        $this->from = $from;
        $this->to = $to;
        $this->rate = $rate;
    }

    /**
     * @return RoundedNumber
     */
    public function getBaseAmount() : RoundedNumber
    {
        return $this->number;
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
     * @return RoundedNumber
     */
    public function getAmount() : RoundedNumber
    {
        $result = $this->number->getRoundedNumber() * $this->rate;

        return RoundedNumber::make($result);
    }

    /**
     * @return Price
     */
    public function getPrice() : Price
    {
        return new Price($this->getAmount()->getRoundedNumber(), $this->to);
    }
}
