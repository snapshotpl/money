<?php

/**
 * This file is part of the Money library.
 *
 * Copyright (c) 2011-2014 Mathias Verraes
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Money;

/**
 * Currency Value Object
 *
 * Holds Currency specific data
 *
 * @author Mathias Verraes
 */
class Currency
{
    /**
     * ISO 4217 currency code
     *
     * @var string
     */
    private $code;

    /**
     * Known currencies
     *
     * @var array
     */
    private static $currencies;

    /**
     * @param string $code
     *
     * @throws UnknownCurrencyException If currency is not known
     */
    public function __construct($code)
    {
        // @codeCoverageIgnoreStart
        if(!isset(static::$currencies)) {
           static::$currencies = require __DIR__.'/currencies.php';
        }
        // @codeCoverageIgnoreEnd

        if (!array_key_exists($code, static::$currencies)) {
            throw new UnknownCurrencyException($code);
        }
        $this->code = $code;
    }

    /**
     * Returns the ISO 4217 currency code
     *
     * @return string
     *
     * @deprecated Use getCode() instead
     */
    public function getName()
    {
        return $this->code;
    }

    /**
     * Returns the ISO 4217 currency code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Checks whether this currency is the same as an other
     *
     * @param Currency $other
     *
     * @return boolean
     */
    public function equals(Currency $other)
    {
        return $this->code === $other->code;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getCode();
    }
}