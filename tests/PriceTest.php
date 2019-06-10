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

use Gocanto\Converter\Price;
use PHPUnit\Framework\TestCase;

class PriceTest extends TestCase
{
    /** @test */
    public function it_build_a_valid_price_value()
    {
        $price = new Price(10, 'USD');

        $this->assertEquals('USD 10.00', $price->toString());
        $this->assertEquals('USD', $price->getCurrencyCode());
        $this->assertEquals(10.0, $price->getAmount());
    }
}
