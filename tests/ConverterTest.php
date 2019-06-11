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
use Gocanto\Converter\CurrencyValue;
use Gocanto\Converter\Interfaces\CurrenciesRepositoryInterface;
use Gocanto\Converter\RoundedNumber;
use Mockery;
use PHPUnit\Framework\TestCase;

class ConverterTest extends TestCase
{
    /** @var CurrenciesRepositoryInterface|Mockery\MockInterface */
    private $currencies;
    /** @var Converter */
    private $converter;

    protected function setUp(): void
    {
        $this->currencies = Mockery::mock(CurrenciesRepositoryInterface::class);
        $this->converter = new Converter($this->currencies);
    }

    /** @test */
    public function it_returns_the_valid_version()
    {
        $this->assertEquals('0.0.1', $this->converter->getVersion());
    }

    /** @test */
    public function it_accepts_the_evaluating_currency()
    {
        $newConverter = $this->converter->withCurrency('USD');

        $this->assertNotEquals($this->converter, $newConverter);
        $this->assertEquals('USD', $newConverter->getCurrencyCode());
    }

    /** @test */
    public function it_accepts_the_evaluating_amount()
    {
        $newConverter = $this->converter->withAmount(RoundedNumber::make(10));

        $this->assertNotEquals($this->converter, $newConverter);
        $this->assertSame(10, $newConverter->getAmount()->getNumber());
    }

    /** @test */
    public function it_properly_converts_the_given_amount()
    {
        $currency = new CurrencyValue('U.S. Dollars', 'USD', '$', 0.731271);
        $this->currencies->shouldReceive('getCurrentRate')->once()->with('SGD')->andReturn($currency);

        $conversion = $this->converter
            ->withAmount(RoundedNumber::make(10))
            ->withCurrency('SGD')
            ->convertTo('USD');

        $this->assertInstanceOf(RoundedNumber::class, $conversion->getBaseAmount());
        $this->assertInstanceOf(RoundedNumber::class, $conversion->getAmount());

        $this->assertSame(0.731271, $conversion->getRate());
        $this->assertSame('SGD', $conversion->getFrom());
        $this->assertSame('USD', $conversion->getTo());

        $amount = $conversion->getAmount();
        $this->assertSame('7.3127', $amount->toString());
        $this->assertSame(7.3127, $amount->getRoundedAmount());

        $baseAmount = $conversion->getBaseAmount();
        $this->assertSame('10', $baseAmount->toString());
        $this->assertSame(10.0, $baseAmount->getRoundedAmount());

        $formattedAmount = $conversion->getFormattedAmount();
        $this->assertSame('USD', $formattedAmount->getCurrencyCode());
        $this->assertSame(7.3127, $formattedAmount->getAmount()->getRoundedAmount());
        $this->assertEquals('USD 7.3127', $formattedAmount->toString());
    }
}
