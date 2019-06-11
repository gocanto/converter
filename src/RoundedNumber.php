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

use InvalidArgumentException;

final class RoundedNumber
{
    public const DEFAULT_ROUNDING_MODE = PHP_ROUND_HALF_UP;
    public const DEFAULT_PRECISION = 4;

    /** @var int */
    private $number;
    /** @var string */
    private $decimals;
    /** @var int */
    private $precision;
    /** @var int */
    private $mode;

    /**
     * @param mixed $number
     * @return RoundedNumber
     * @throws InvalidArgumentException
     */
    public static function make($number) : RoundedNumber
    {
        if (is_int($number)) {
            return new static((int) $number, '');
        }

        if (is_float($number)) {
            return static::fromString(sprintf('%.14F', $number));
        }

        if (is_string($number)) {
            return static::fromString($number);
        }

        throw new InvalidArgumentException('The given number is invalid.');
    }

    /**
     * @param string $number
     * @return RoundedNumber
     */
    private static function fromString(string $number) : RoundedNumber
    {
        $values = strpos($number, '.');

        if ($values === false) {
            return new static((int) $number, '');
        }

        return new static(
            (int) substr($number, 0, $values),
            (string) rtrim(substr($number, $values + 1), '0')
        );
    }

    /**
     * @param int $precision
     * @return RoundedNumber
     */
    public function withPrecision(int $precision) : RoundedNumber
    {
        $number = clone $this;
        $number->precision = $precision;

        return $number;
    }

    /**
     * @param int $mode
     * @return RoundedNumber
     */
    public function withMode(int $mode) : RoundedNumber
    {
        $number = clone $this;
        $number->mode = $mode;

        return $number;
    }

    /**
     * @return string
     */
    public function toString() : string
    {
        if ($this->decimals === '') {
            return (string) $this->getNumber();
        }

        return (string) $this->getRoundedAmount();
    }

    /**
     * @return int
     */
    public function getNumber() : int
    {
        return $this->number;
    }

    /**
     * @return float
     */
    public function getAmount() : float
    {
        $decimals = $this->getDecimals() === '' ? '' : '.' . $this->getDecimals();

        return (float) ($this->getNumber() . $decimals);
    }

    /**
     * @return float
     */
    public function getRoundedAmount() : float
    {
        return round(
            $this->getAmount(),
            $this->isDecimal() ? $this->getPrecision() : 0,
            $this->isDecimal() ? $this->getMode() : static::DEFAULT_ROUNDING_MODE
        );
    }

    /**
     * @return string
     */
    public function getDecimals(): string
    {
        return $this->decimals;
    }

    /**
     * @return bool
     */
    public function isInteger() : bool
    {
        return $this->getDecimals() === '';
    }

    /**
     * @return bool
     */
    public function isDecimal() : bool
    {
        return $this->isInteger() === false;
    }

    /**
     * @return int
     */
    public function getPrecision(): int
    {
        return $this->precision === null ? static::DEFAULT_PRECISION : $this->precision;
    }

    /**
     * @return int
     */
    public function getMode(): int
    {
        return $this->mode === null ? static::DEFAULT_ROUNDING_MODE : $this->mode;
    }

    /**
     * @param int $number
     * @param string $decimals
     */
    private function __construct(int $number, string $decimals)
    {
        $this->number = $number;
        $this->decimals = $decimals;
    }
}
