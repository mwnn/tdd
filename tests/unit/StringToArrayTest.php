<?php

namespace TDD\Test;

use TDD\StringToArray;

/**
 * Class StringToArrayTest
 * @package TDD\Test
 */
class StringToArrayTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var StringToArray
     */
    private $stringToArray;

// ##########################################
//                INIT TEST
// ##########################################

    /**
     * Constructs a test case with the given name.
     *
     * @param string $name
     * @param array  $data
     * @param string $dataName
     */
    public function __construct($name = null, array $data = array(), $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
    }


    /**
     * Init test.
     */
    public function setUp()
    {
        $this->stringToArray = new StringToArray();
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
     * @param $expected
     * @param $string
     * @dataProvider dataForTestOneLineStringInput
     */
    public function testOneLineStringInput($string, $expected)
    {
        $result = $this->stringToArray->oneLineStringInput($string);

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
            array("a,b,c", array(
                "a",
                "b",
                "c",
            )),

            array("100,982,444,990,1", array(
                "100",
                "982",
                "444",
                "990",
                "1",
            )),

            array("Mark,Anthony,marka@lib.de", array(
                "Mark",
                "Anthony",
                "marka@lib.de",
            )),

            array("foo,bar,baz", array(
                "foo",
                "bar",
                "baz",
            )),
        );
    }
}
