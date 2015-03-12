<?php

namespace TDD;

/**
 * Class StringToArray\
 *
 * @package TDD
 */
class OneLineParser
{
    /**
     * Constructor.
     */
    public function __construct()
    {
    }

    /**
     * Return an array from input separated by commas.
     *
     * @param string $input
     *
     * @return array|null
     */
    public function oneLineStringInput($input)
    {
        $result = null;

        if (true === is_string($input))
        {
            $result = explode(',', $input);
        }

        return $result;
    }
}
