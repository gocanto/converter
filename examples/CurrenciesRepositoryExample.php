<?php

namespace Gocanto\Converter\Examples;

use Gocanto\Converter\CurrencyValue;
use Gocanto\Converter\Interfaces\CurrenciesRepositoryInterface;

class CurrenciesRepositoryExample implements CurrenciesRepositoryInterface
{
    /**
     * @param string $code
     * @return CurrencyValue
     */
    public function getCurrentRate(string $code) : CurrencyValue
    {
        //here, you need to write any related logic to query your DB. Once you have this info,
        //you will have to create the currency value object with the valid info as so:

        return new CurrencyValue('U.S. Dollars', 'USD', '$', 0.731271);
    }
}
