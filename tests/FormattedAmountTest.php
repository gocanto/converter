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
use PHPUnit\Framework\TestCase;

class FormattedAmountTest extends TestCase
{
    /** @test */
    public function it_build_a_valid_price_value()
    {
        $amount = new FormattedAmount(10, 'USD');

        $this->assertEquals('USD 10.00', $amount->toString());
        $this->assertEquals('USD', $amount->getCurrencyCode());
        $this->assertEquals(10.0, $amount->getAmount());
    }

    /** @test */
    public function it_allows_custom_precisions()
    {
        $amount = (new FormattedAmount(1.3657636576, 'USD'))
            ->withPrecision(4);

        $this->assertEquals('USD 1.3658', $amount->toString());
    }

    /** @test */
    public function it_allows_rounded_numbers()
    {
        $amount = new FormattedAmount(RoundedNumber::make(10), 'USD');

        $this->assertEquals('USD 10', $amount->toString());
        $this->assertEquals('USD', $amount->getCurrencyCode());
        $this->assertEquals(10.0, $amount->getAmount()->getRoundedAmount());
    }
}
