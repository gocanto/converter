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

final class CurrencyValue
{
    /** @var string */
    private $name;
    /** @var string */
    private $code;
    /** @var string */
    private $symbol;
    /** @var float */
    private $rate;

    /**
     * @param string $name
     * @param string $code
     * @param string $symbol
     * @param float $rate
     */
    public function __construct(string $name, string $code, string $symbol, float $rate)
    {
        $this->name = $name;
        $this->code = $code;
        $this->symbol = $symbol;
        $this->rate = $rate;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getSymbol(): string
    {
        return $this->symbol;
    }

    /**
     * @return float
     */
    public function getRate(): float
    {
        return $this->rate;
    }
}
