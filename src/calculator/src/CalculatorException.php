<?php

namespace devhead\Calculator;

/**
 * Class CalculatorException
 * @package devhead\Calculator
 */
class CalculatorException extends \Exception
{
    /**
     * CalculatorException constructor.
     * @param string $message
     * @param int $code
     * @param \Exception|null $previous
     */
    public function __construct($message = "", $code = 0, \Exception $previous = null)
    {
        $message    = '[ERROR]::[' . $this->getFile() . ':' . $this->getLine() . ']::' . $message;
        return parent::__construct($message, $code, $previous);
    }
}
