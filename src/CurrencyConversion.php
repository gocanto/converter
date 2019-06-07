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

class CurrencyConversion
{
    /** @var float */
    private $amount;
    /** @var string */
    private $from;
    /** @var string */
    private $to;
    /** @var float */
    private $rate;

    /**
     * @param float $amount
     * @param string $from
     * @param string $to
     * @param float $rate
     */
    public function __construct(float $amount, string $from, string $to, float $rate)
    {
        $this->amount = $amount;
        $this->from = $from;
        $this->to = $to;
        $this->rate = $rate;
    }

    /**
     * @return float
     */
    public function getBaseAmount() : float
    {
        return $this->amount;
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
     * @return float
     */
    public function getAmount() : float
    {
        return $this->amount * $this->rate;
    }

    /**
     * @return Price
     */
    public function getPrice() : Price
    {
        return new Price($this->getAmount(), $this->to);
    }
}
