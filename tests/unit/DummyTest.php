<?php

namespace TDD\Test;

use TDD\Dummy;

/**
 * Class DummyTest
 * @package TDD\Test
 */
class DummyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Dummy
     */
    private $dummy;


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
         $this->dummy = new Dummy();
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
     * @dataProvider dataForTestDummyFoo
     */
    public function testDummyFoo($expected)
    {
        $this->assertEquals($expected, $this->dummy->foo());
    }


// ##########################################
//             DATA PROVIDERS
// ##########################################


    public function dataForTestDummyFoo()
    {
        return array(
            array('foo'),
        );
    }
}
