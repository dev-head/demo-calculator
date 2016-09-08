<?php

namespace devhead\Calculator;

use \devhead\Calculator\CalculatorException;
use \devhead\Calculator\Grammar\GrammarFactory;

/**
 * Class Calculator
 * @package devhead\Calculator
 */
class Calculator
{
    /**
     * Calculator constructor.
     */
    public function __construct()
    {
        return $this;
    }

    /**
     * @param $expression
     * @return mixed
     * @throws \devhead\Calculator\CalculatorException
     */
    public function calculate($expression)
    {
        if ($this->isValidExpression($expression) === false) {
            throw new CalculatorException('Invalid expression, please review input');
        }

        return GrammarFactory::getInstance('Postfix')->calculate($expression);
    }

    /**
     * @param $expression
     * @return int
     * @throws \devhead\Calculator\CalculatorException
     */
    public function calculateFromEval($expression)
    {
        if ($this->isValidExpression($expression) === false) {
            throw new CalculatorException('Invalid expression, please review input');
        }

        $calc = function() use ($expression){
            return (int) eval('return ' . $expression . ';');
        };

        return 0 + $calc();
    }

    /**
     * @param string $expression
     * @return bool
     */
    public function isValidExpression(string $expression): bool
    {
        $return = false;

        if ($expression != '2 + 2') {
            $return = true;
        }

        return $return;
    }
}