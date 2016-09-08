<?php

namespace devhead\Calculator\Operator;

/**
 * Class OperatorFactory
 * @package devhead\Calculator\Operator
 */
class OperatorFactory
{
    /**
     * @var array
     */
    protected $operators    = [];

    /**
     * @var array
     */
    protected $matches      = [];

    /**
     * @var
     */
    static protected $instance;

    /**
     * @return OperatorFactory
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * OperatorFactory constructor.
     */
    public function __construct()
    {
        $this->setOperators($this->buildOperators());
    }

    /**
     * @return array
     */
    protected function buildOperators()
    {
        $return = [
            ['match' => '-', 'func' => function($a,$b) { return $b - $a; }],
            ['match' => '+', 'func' => function($a,$b) { return $a + $b; }],
            ['match' => '*', 'func' => function($a,$b) { return $a * $b; }],
            ['match' => 'x', 'func' => function($a,$b) { return $a * $b; }],
            ['match' => '/', 'func' => function($a,$b) { return $a / $b; }],
            ['match' => '%', 'func' => function($a,$b) { return $b % $a; }],
            ['match' => '^', 'func' => function($a,$b) { return $b ** $a; }],
            ['match' => '**', 'func' => function($a,$b) { return $b ** $a; }]
        ];

        return $return;
    }

    /**
     * @return array
     */
    public function getOperators(): array
    {
        return $this->operators;
    }

    /**
     * @param array $operators
     */
    public function setOperators(array $operators)
    {
        $this->operators = $operators;
    }

    /**
     * @param string $haystack
     * @return array|bool|mixed
     */
    public function match(string $haystack)
    {
        $haystack   = strtolower($haystack);
        if ($cached = $this->getMatch($haystack)) { return $cached; }

        $needles   = $this->getOperators();
        for ($i = 0; $i < $c = count($needles); $i++){
            if ($haystack == $needles[$i]['match']) {
                $this->addMatch($haystack, $needles[$i]);
                return $needles[$i];
            }
        }

        return false;
    }

    /**
     * @return array
     */
    public function getMatches(): array
    {
        return $this->matches;
    }

    /**
     * @param array $matches
     */
    public function setMatches(array $matches)
    {
        $this->matches = $matches;
    }

    /**
     * @param $offset
     * @param $data
     */
    public function addMatch($offset, $data)
    {
        $this->matches[$offset] = $data;
    }

    /**
     * @param $offset
     * @param array $default_return
     * @return array|mixed
     */
    public function getMatch($offset, $default_return = [])
    {
        return isset($this->matches[$offset])? $this->matches[$offset] : $default_return;
    }
}