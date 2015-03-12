<?php

namespace TDD\Test;

use TDD\OneLineParser;

/**
 * Class StringToArrayTest
 * @package TDD\Test
 */
class OneLineParserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var OneLineParser
     */
    private $oneLineParser;

// ##########################################
//                INIT TEST
// ##########################################

    /**
     * Init test.
     */
    public function setUp()
    {
        $this->oneLineParser = new OneLineParser();
    }

    /**
     * Cleanup.
     */
    public function tearDown()
    {
    }

// ##########################################
//                  TESTS
// ##########################################

    /**
     * Test oneLineStringInput method.
     *
     * @param $expected
     * @param $string
     *
     * @dataProvider dataForTestOneLineStringInput
     */
    public function testOneLineStringInput($string, $expected)
    {
        $result = $this->oneLineParser->oneLineStringInput($string);

        $this->assertEquals($expected, $result);
    }


// ##########################################
//             DATA PROVIDERS
// ##########################################

    /**
     * @return array
     */
    public function dataForTestOneLineStringInput()
    {
        return array(
            array(
                "a,b,c",
                array(
                    "a",
                    "b",
                    "c",
                ),
            ),

            array(
                "100,982,444,990,1",
                array(
                    "100",
                    "982",
                    "444",
                    "990",
                    "1",
                ),
            ),

            array(
                "Mark,Anthony,marka@lib.de",
                array(
                    "Mark",
                    "Anthony",
                    "marka@lib.de",
                ),
            ),

            array(
                "foo,bar,baz",
                array(
                    "foo",
                    "bar",
                    "baz",
                ),
            ),

            array(array(), null), // negative case: not string
        );
    }
}
