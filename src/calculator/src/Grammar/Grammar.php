<?php

namespace devhead\Calculator\Grammar;

use \devhead\Calculator\Grammar\GrammarInterface;
use \devhead\Calculator\Context\ContextFactory;

/**
 * Class Grammar
 * @package devhead\Calculator\Grammar
 */
abstract class Grammar implements GrammarInterface
{
    /**
     * @param string $string
     * @return mixed
     */
    public function getContext(string $string)
    {
        return ContextFactory::load($string);
    }
}