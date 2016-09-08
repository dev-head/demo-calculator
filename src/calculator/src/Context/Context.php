<?php

namespace devhead\Calculator\Context;

use devhead\Calculator\Operator\OperatorFactory;
use devhead\Calculator\Number\NumberFactory;

/**
 * Class Context
 * @package devhead\Calculator\Context
 */
class Context
{
    /**
     * @var string
     */
    protected $value    = '';

    /**
     * @var string
     */
    protected $value_type   = '';

    /**
     * @var int
     */
    protected $weight   = 0;

    /**
     * @var
     */
    protected $operator;

    /**
     * @var
     */
    protected $number;

    /**
     * @var
     */
    protected $space;

    /**
     * Context constructor.
     * @param $string
     */
    public function __construct($string)
    {
        $this->setValue($string);
        $this->determineValueContext($string);
    }

    /**
     * @param string $string
     */
    public function determineValueContext(string $string = '')
    {
        $matched    = false;
        $operator   = $matched === false? OperatorFactory::getInstance()->match($string) : null;
        if ($operator) {
            $this->setOperator($operator);

            if (isset($operator['weight'])) {
                $this->setWeight($operator['weight']);
            }

            $this->setValueType('operator');
            $matched    = true;
        }

        $number = $matched === false? NumberFactory::getInstance()->match($string) : null;
        if ($number) {
            $this->setNumber($number);
            $this->setValueType('operand');
        }

        if ($matched === false && $string === ' ') {
            $this->setSpace(' ');
            $this->setValueType('space');
        }
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue(string $value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValueType(): string
    {
        return $this->value_type;
    }

    /**
     * @param string $value_type
     */
    public function setValueType(string $value_type)
    {
        $this->value_type = $value_type;
    }

    /**
     * @return int
     */
    public function getWeight(): int
    {
        return $this->weight;
    }

    /**
     * @param int $weight
     */
    public function setWeight(int $weight)
    {
        $this->weight = $weight;
    }

    /**
     * @return mixed
     */
    public function getOperator()
    {
        return $this->operator;
    }

    /**
     * @param mixed $operator
     */
    public function setOperator($operator)
    {
        $this->operator = $operator;
    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param mixed $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * @return mixed
     */
    public function getSpace()
    {
        return $this->space;
    }

    /**
     * @param mixed $space
     */
    public function setSpace($space)
    {
        $this->space = $space;
    }
}