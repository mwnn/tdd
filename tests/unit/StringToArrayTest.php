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
     * Test oneLineStringInput method.
     *
     * @param $expected
     * @param $string
     *
     * @dataProvider dataForTestOneLineStringInput
     */
    public function testOneLineStringInput($string, $expected)
    {
        $result = $this->stringToArray->oneLineStringInput($string);

        $this->assertEquals($expected, $result);
    }

    /**
     * Test multiLineStringInput method.
     *
     * @param $expected
     * @param $string
     *
     * @dataProvider dataForTestMultiLineStringInput
     */
    public function testMultiLineStringInput($string, $expected)
    {
        $result = $this->stringToArray->multiLineStringInput($string);

        $this->assertEquals($expected, $result);
    }

    /**
     * Test multiLineStringInput method accept labels in first row.
     *
     * @param $expected
     * @param $string
     *
     * @dataProvider dataForTestMultiLineStringInputAcceptLabelsInFirstRow
     */
    public function testMultiLineStringInputAcceptLabelsInFirstRow($string, $expected)
    {
        $this->testMultiLineStringInput($string, $expected);
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

    /**
     * @return array
     */
    public function dataForTestMultiLineStringInput()
    {
        return array(
            array("211,22,35\n10,20,33", array(
                array("211", "22", "35"),
                array("10", "20", "33"),
            )),

            array("luxembourg,kennedy,44\nbudapest,expo ter,5-7\ngyors,fo utca,9", array(
                array("luxembourg", "kennedy", "44"),
                array("budapest", "expo ter", "5-7"),
                array("gyors", "fo utca", "9"),
            )),

            array("foo,bar\nbaz,bah", array(
                array("foo", "bar"),
                array("baz", "bah"),
            )),
        );
    }

    /**
     * @return array
     */
    public function dataForTestMultiLineStringInputAcceptLabelsInFirstRow()
    {
        return array(
            array(
                "#useFirstLineAsLabels\nName,Email,Phone\nMark,marc@be.com,998\nNoemi,noemi@ac.co.uk,888",
                array(
                    array(
                        "Name"  => "Mark",
                        "Email" => "marc@be.com",
                        "Phone" => "998",
                    ),

                    array(
                        "Name"  => "Noemi",
                        "Email" => "noemi@ac.co.uk",
                        "Phone" => "888",
                    ),
                )
            ),

            array("#useFirstLineAsLabels\ncol1,col2\nfoo,bar\nbaz,bah", array(
                array(
                    "col1" => "foo",
                    "col2" => "bar",
                ),
                array(
                    "col1" => "baz",
                    "col2" => "bah",
                ),
            )),
        );
    }
}
