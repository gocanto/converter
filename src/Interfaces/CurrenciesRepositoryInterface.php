<?php

/*
 * This file is part of the Gocanto Converter
 *
 * (c) Gustavo Ocanto <gustavoocanto@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gocanto\Converter\Interfaces;

use Gocanto\Converter\CurrencyValue;

interface CurrenciesRepositoryInterface
{
    /**
     * @param string $code
     * @return CurrencyValue
     */
    public function getCurrentRate(string $code) : CurrencyValue;
}
