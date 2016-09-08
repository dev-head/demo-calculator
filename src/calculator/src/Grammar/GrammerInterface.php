<?php

namespace devhead\Calculator\Grammar;

/**
 * Interface GrammarInterface
 * @package devhead\Calculator\Grammar
 */
interface GrammarInterface
{
    /**
     * @param $list
     * @return mixed
     */
    public function calculate($list);
}