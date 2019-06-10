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

use Gocanto\Converter\CurrencyValue;
use PHPUnit\Framework\TestCase;

class CurrencyValueTest extends TestCase
{
    /** @test */
    public function it_build_a_valid_currency_value()
    {
        $currency = new CurrencyValue('U.S. Dollars', 'USD', '$', 0.731271);

        $this->assertEquals('U.S. Dollars', $currency->getName());
        $this->assertEquals('USD', $currency->getCode());
        $this->assertEquals('$', $currency->getSymbol());
        $this->assertSame(0.731271, $currency->getRate());
    }
}
