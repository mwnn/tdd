<?php

namespace TDD\Test;

use TDD\OneLineParser;
use TDD\StringToArray;

/**
 * Class StringToArrayTest
 *
 * @package TDD\Test
 */
class StringToArrayTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var OneLineParser
     */
    private $oneLineParser;

    /**
     * @var StringToArray
     */
    private $stringToArray;

// ##########################################
//                INIT TEST
// ##########################################

   /**
     * Init test.
     */
    public function setUp()
    {
        $this->oneLineParser = new OneLineParser();
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
     * Test multiLineStringInput method.
     *
     * @param $expected
     * @param $string
     *
     * @dataProvider dataForTestMultiLineStringInput
     */
    public function testMultiLineStringInput($string, $expected)
    {
        $result = $this->stringToArray->multiLineStringInput($string, $this->oneLineParser);

        $this->assertEquals($expected, $result);
    }

    /**
     * Test that multiLineStringInput calls exactly 2 times the OneLineParser object's
     * oneLineStringInput method in correct order with the exploded input \$string parts,
     *
     * @dataProvider dataForTestMultiLineCallsOneLineForExtract
     */
    public function testMultiLineCallsOneLineForExtract($string, $expected)
    {
        if (2 < count($expected))
        {
            // Testing at least 2 part input strings, and we dispose unneeded
            // data, if received greater array from dataForTestMultiLineStringInput
            $parts  = explode("\n", $string);
            $string = sprintf("%s\n%s", $parts[0], $parts[1]);

            $expected = array_slice($expected,0,2);
        }

        $oneLineParserMock = $this->getMockBuilder('OneLineParser')
            ->setMethods(array('oneLineStringInput'))
            ->getMock();

        $oneLineParserMock->expects($this->exactly(2))
            ->method("oneLineStringInput")
            ->withConsecutive(
                array($this->equalTo(implode(',', $expected[0]))),
                array($this->equalTo(implode(',', $expected[1])))
            );
        ;

        $this->stringToArray->multiLineStringInput($string, $oneLineParserMock);
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
    public function dataForTestMultiLineStringInput()
    {
        return array(
            array(
                "211,22,35\n10,20,33", array(
                    array("211", "22", "35"),
                    array("10", "20", "33"),
                )
            ),

            array(
                "luxembourg,kennedy,44\n"
                . "budapest,expo ter,5-7\n"
                . "gyors,fo utca,9",
                array(
                    array("luxembourg", "kennedy", "44"),
                    array("budapest", "expo ter", "5-7"),
                    array("gyors", "fo utca", "9"),
                )
            ),

            array("foo,bar\nbaz,bah", array(
                array("foo", "bar"),
                array("baz", "bah"),
            )),

            array(array(), null), // negative case: not string
        );
    }

    /**
     * @return array
     */
    public function dataForTestMultiLineCallsOneLineForExtract()
    {
        $data = $this->dataForTestMultiLineStringInput();

        // remove negative testcase data (not needed for testing calls on mock)
        unset($data[3]);

        return $data;
    }

    /**
     * @return array
     */
    public function dataForTestMultiLineStringInputAcceptLabelsInFirstRow()
    {
        return array(
            array(
                "#useFirstLineAsLabels\n"
                . "Name,Email,Phone\n"
                . "Mark,marc@be.com,998\n"
                . "Noemi,noemi@ac.co.uk,888",
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

            array(
                "#useFirstLineAsLabels\n"
                . "col1,col2\n"
                . "foo,bar\n"
                . "baz,bah",
                array(
                    array(
                        "col1" => "foo",
                        "col2" => "bar",
                    ),
                    array(
                        "col1" => "baz",
                        "col2" => "bah",
                    ),
                ),
            ),

            array(array(), null),           // negative case: not string

            array(                          // negative case: column size mismatch
                "#useFirstLineAsLabels\n"
                . "col1,col2,col3\n"
                . "foo,bar\n"
                . "baz,bah",
                null),
        );
    }
}
