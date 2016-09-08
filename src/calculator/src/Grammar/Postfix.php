<?php

namespace devhead\Calculator\Grammar;

use devhead\Calculator\CalculatorException;
use \devhead\Calculator\Grammar\Grammar;
use \SplDoublyLinkedList;

/**
 * Class Postfix
 * @package devhead\Calculator\Grammar
 */
class Postfix extends Grammar
{
    /**
     * @param $expression
     * @return int
     * @throws CalculatorException
     */
    public function calculate($expression): int
    {
        $list   = $this->getStack($expression);
        $list->rewind();

        if ($list->count() > 1) {
            throw new CalculatorException('expression has too many values');
        }

        return $list->current()->getValue();
    }

    /**
     * @param $expression
     * @return SplDoublyLinkedList
     * @throws CalculatorException
     */
    public function getStack($expression)
    {
        $list   = new SplDoublyLinkedList();
        $list->setIteratorMode(SplDoublyLinkedList::IT_MODE_FIFO);

        // @todo: improve via regex.
        $parts  = explode(' ', preg_replace('/\s+/', ' ', $expression));

        for ($i = 0; $i < $c = count($parts); $i++) {
            $value      = $parts[$i];
            $context    = $this->getContext($value);

            switch ($context->getValueType()) {
                case 'operand':
                    $list->push($context);
                    break;
                case 'operator':
                    $operator   = $context->getOperator();
                    $func       = isset($operator['func'])? $operator['func'] : null;
                    $count      = $list->count();
                    $info       = new \ReflectionFunction($func);
                    $num_args   = isset($operator['num_args'])? (int) $operator['num_args'] : $info->getNumberOfParameters();

                    if ($count == 1) {
                        continue 1;
                    } elseif ($count < $num_args) {
                        throw new CalculatorException('[insufficient values in the expression]::[' . $count . ']::[of]::[' . $num_args . ']');
                    } else {
                        $operands   = [];
                        for ($i = 0; $i < $num_args; $i++) {
                            $item       = $list->pop();
                            $operands[] = $item->getValue();
                        }

                        if ($func) {
                            $result = (int) call_user_func_array($func, $operands);

                            if ($result) {
                                $result    = $this->getContext($result);
                                $list->push($result);
                            }
                        }
                    }

                    break;
                case 'space':
                    break;
            }
        }

        return $list;
    }
}