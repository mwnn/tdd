<?php

namespace TDD;

/**
 * Class StringToArray
 * @package TDD
 */
class StringToArray
{
    /**
     * Pattern used to identify multi line
     * input strings with specified array keys.
     */
    const FIRST_LABEL_SIGN = "#useFirstLineAsLabels";

    /**
     * Constructor.
     */
    public function __construct()
    {
    }

    /**
     * Return an array from input separated by commas.
     * Explode input by NL (\n) to one-line strings, and
     * return a 2 dimensional array (lines, values).
     *
     * If first line is "#useFirstLineAsLabels" then use the next line as labels.
     *
     * @param string $input
     * @param OneLineParser $parser
     *
     * @return array|null
     */
    public function multiLineStringInput($input, $parser)
    {
        $result    = null;
        $arrayKeys = null;

        if (true === is_string($input))
        {
            $lines = explode("\n", $input);

            if ($lines[0] === self::FIRST_LABEL_SIGN)
            {
                $arrayKeys = $parser->oneLineStringInput($lines[1]);
                $lines = array_slice($lines, 2);
            }

            foreach ($lines as $line)
            {
                $result[] = $parser->oneLineStringInput($line);
            }

            if (true === is_array($arrayKeys) && count($result))
            {
                if (count($arrayKeys) !== count($result[0]))
                {
                    $result = null;
                }
                else
                {
                    $tmp = array_map(function($line) use ($arrayKeys)
                    {
                        return array_combine($arrayKeys, $line);
                    }, $result);

                    $result = $tmp;
                }

            }
        }

        return $result;
    }
}
