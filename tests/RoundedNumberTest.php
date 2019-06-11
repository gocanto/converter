<?php
/*
 * This file is part of the Gocanto Converter
 *
 * (c) Gustavo Ocanto <gustavoocanto@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gocanto\Converter\Tests;

use Gocanto\Converter\FormattedAmount;
use Gocanto\Converter\RoundedNumber;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class RoundedNumberTest extends TestCase
{
    /** @test */
    public function it_parses_the_right_float_number()
    {
        $number = RoundedNumber::make(1.3657636576);

        $this->assertSame('1.3658', $number->toString());
        $this->assertSame(1.3658, $number->getRoundedAmount());
        $this->assertSame($number->getNumber(), 1);
        $this->assertSame($number->getDecimals(), '3657636576');
        $this->assertSame(4, $number->getPrecision());
        $this->assertSame(PHP_ROUND_HALF_UP, $number->getMode());
        $this->assertTrue($number->isDecimal());
    }

    /** @test */
    public function it_parses_the_right_string_number()
    {
        $number = RoundedNumber::make('1.3657636576');

        $this->assertSame('1.3658', $number->toString());
        $this->assertSame(1.3658, $number->getRoundedAmount());
        $this->assertSame($number->getNumber(), 1);
        $this->assertSame($number->getDecimals(), '3657636576');
        $this->assertSame(4, $number->getPrecision());
        $this->assertSame(PHP_ROUND_HALF_UP, $number->getMode());
        $this->assertTrue($number->isDecimal());
    }

    /** @test */
    public function it_takes_the_precision_and_mode()
    {
        $number = RoundedNumber::make('1.3657636576')->withPrecision(2)->withMode(PHP_ROUND_HALF_UP);

        $this->assertSame('1.37', $number->toString());
    }

    /** @test */
    public function it_parses_the_right_integer_number()
    {
        $number = RoundedNumber::make('1');

        $this->assertSame('1', $number->toString());
        $this->assertSame(1.0, $number->getRoundedAmount());
        $this->assertSame($number->getNumber(), 1);
        $this->assertSame($number->getDecimals(), '');
        $this->assertSame(4, $number->getPrecision());
        $this->assertSame(PHP_ROUND_HALF_UP, $number->getMode());
        $this->assertTrue($number->isInteger());
    }

    /** @test */
    public function it_does_not_allow_invalid_numbers()
    {
        $this->expectException(InvalidArgumentException::class);

        RoundedNumber::make(new FormattedAmount(10, 'SGD'));
    }
}
