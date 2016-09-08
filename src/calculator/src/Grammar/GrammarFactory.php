<?php

namespace devhead\Calculator\Grammar;

/**
 * Class GrammarFactory
 * @package devhead\Calculator\Grammar
 */
class GrammarFactory
{
    /**
     * @var array
     */
    protected $matches      = [];

    /**
     * @var
     */
    static protected $grammars;

    /**
     * @param $grammar
     * @return mixed
     */
    public static function getInstance($grammar)
    {
        if (!isset(self::$grammars[$grammar])) {
            self::$grammars[$grammar] = self::getGrammarObject($grammar);
        }
        return self::$grammars[$grammar];
    }

    /**
     * @todo add inflector to improve normalization.
     * @param $grammar
     * @return mixed
     */
    public static function getGrammarObject($grammar)
    {
        $class  = __NAMESPACE__ . '\\' . $grammar;
        return new $class();
    }
}