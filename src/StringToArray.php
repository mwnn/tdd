<?php

namespace TDD;

/**
 * Class StringToArray
 * @package TDD
 */
class StringToArray
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

    /**
     * Return an array from input separated by commas.
     * Explode input by NL (\n) to one-line strings, and
     * return a 2 dimensional array (lines, values)
     *
     * @param string $input
     *
     * @return array|null
     */
    public function multiLineStringInput($input)
    {
        $result = null;

        if (true === is_string($input))
        {
            $lines = explode("\n", $input);

            foreach ($lines as $line)
            {
                $result[] = $this->oneLineStringInput($line);
            }
        }

        return $result;
    }
}
