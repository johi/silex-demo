<?php
/**
 * Created by PhpStorm.
 * User: johan
 * Date: 14-04-15
 * Time: 11:38
 */

// Use directives (A...Z)
use johi\SilexDemo\Exception\FormatException;

class FormatExceptionTest
    extends \PHPUnit_Framework_TestCase
{
    const SUBJECT_UNDER_TEST_TYPE =
        '\johi\SilexDemo\Exception\FormatException';

    /**
     * @test
     * @covers ::__construct
     */
    public function __construct_ReturnsNewInstance()
    {
        $FormatException = new FormatException();
        $this->assertInstanceOf(
            self::SUBJECT_UNDER_TEST_TYPE,
            $FormatException
        );
    }

    /**
     * @test
     * @covers ::getCode
     */
    public function getCode_ReturnsExceptionCode()
    {
        $FormatException = new FormatException();
        $this->assertEquals( FormatException::EXCEPTION_CODE, $FormatException->getCode() );
    }

    /**
     * @test
     * @covers ::__construct
     * @covers ::getMessage
     */
    public function getMessage_ReturnsDefaultMessage()
    {
        $FormatException = new FormatException();
        $this->assertEquals(
            FormatException::DEFAULT_MESSAGE,
            $FormatException->getMessage()
        );
    }

    /**
     * @test
     * @covers ::__construct
     * @covers ::getMessage
     */
    public function getMessage_ReturnsConstructorSetMessage()
    {
        $message = 'My exception message';
        $FormatException = new FormatException( $message );
        $this->assertEquals( $message, $FormatException->getMessage() );
    }

    /**
     * @test
     * @covers ::__construct
     * @covers ::getPrevious
     */
    public function getPrevious_ReturnsConstructorSetPreviousException()
    {
        $previousException = new \Exception();
        $FormatException = new FormatException( NULL, $previousException );
        $this->assertEquals(
            $previousException,
            $FormatException->getPrevious()
        );
    }
}
