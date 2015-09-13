<?php
/**
 * Created by PhpStorm.
 * User: johan
 * Date: 14-04-15
 * Time: 11:38
 */
namespace test\johi\SilexDemo\Exception;
// Use directives (A...Z)
use johi\SilexDemo\Exception\ArgumentException;

/**
 * @coversDefaultClass \kd\lib\Exception\ArgumentException;
 */
class ArgumentExceptionTest
    extends \PHPUnit_Framework_TestCase
{
    const SUBJECT_UNDER_TEST_TYPE =
        '\johi\SilexDemo\Exception\ArgumentException';

    /**
     * @test
     * @covers ::__construct
     */
    public function __construct_ReturnsNewInstance()
    {
        $FormatException = new ArgumentException();
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
        $FormatException = new ArgumentException();
        $this->assertEquals( ArgumentException::EXCEPTION_CODE, $FormatException->getCode() );
    }

    /**
     * @test
     * @covers ::__construct
     * @covers ::getMessage
     */
    public function getMessage_ReturnsDefaultMessage()
    {
        $FormatException = new ArgumentException();
        $this->assertEquals(
            ArgumentException::DEFAULT_MESSAGE,
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
        $FormatException = new ArgumentException( $message );
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
        $FormatException = new ArgumentException( NULL, $previousException );
        $this->assertEquals(
            $previousException,
            $FormatException->getPrevious()
        );
    }
}
