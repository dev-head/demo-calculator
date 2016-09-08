<?php

namespace devhead\Calculator\Context;

use \devhead\Calculator\Context\Context;

/**
 * Class ContextFactory
 * @package devhead\Calculator\Context
 */
class ContextFactory
{
    /**
     * @var array
     */
    protected $matches      = [];

    /**
     * @var
     */
    static protected $contexts;

    /**
     * @param $string
     * @return mixed
     */
    public static function load($string)
    {
        if (!isset(self::$contexts[$string])) {
            self::$contexts[$string] = new Context($string);
        }
        return self::$contexts[$string];
    }

}