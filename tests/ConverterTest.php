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

use Gocanto\Converter\Converter;
use PHPUnit\Framework\TestCase;

class ConverterTest extends TestCase
{
    /** @test */
    public function it_test_the_test_that_doesnt_work()
    {
        $converter = new Converter;

        $this->assertEquals('0.0.1', $converter->getVersion());
    }
}
