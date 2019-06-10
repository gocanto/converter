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
use Gocanto\Converter\Examples\CurrenciesRepositoryExample;
use PHPUnit\Framework\TestCase;

class CurrenciesRepositoryExampleTest extends TestCase
{
    /** @test */
    public function dummy_example_test()
    {
        $currency = (new CurrenciesRepositoryExample)->getCurrentRate('USD');

        $this->assertInstanceOf(CurrencyValue::class, $currency);
    }
}
