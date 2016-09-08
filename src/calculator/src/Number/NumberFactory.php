<?php

namespace devhead\Calculator\Number;

/**
 * Class NumberFactory
 * @package devhead\Calculator\Number
 */
class NumberFactory
{
    /**
     * @var array
     */
    protected $matches  = [];

    /**
     * @var
     */
    static protected $instance;

    /**
     * @return NumberFactory
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * @param string $haystack
     * @return array|bool|mixed
     */
    public function match(string $haystack)
    {
        if ($cached = $this->getMatch($haystack)) { return $cached; }

        $is_number  = is_string($haystack) || is_int($haystack) || is_float($haystack);

        if ($is_number) {
            $this->addMatch($haystack, $is_number);
        }

        return $is_number;
    }

    /**
     * @param $string
     * @return bool
     */
    public function is($string): bool
    {
        return $this->match($string)? true : false;
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