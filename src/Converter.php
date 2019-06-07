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

class Converter
{
    private const VERSION = '0.0.1';

    /**
     * @return string
     */
    public function getVersion() : string
    {
        return static::VERSION;
    }
}
