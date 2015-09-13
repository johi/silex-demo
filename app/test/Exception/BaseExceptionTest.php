<?php
/**
 * Created by PhpStorm.
 * User: johan
 * Date: 14-04-15
 * Time: 11:28
 */

namespace test\johi\SilexDemo\Exception;

// Use directives (A...Z)
use johi\SilexDemo\Exception\BaseException;

/**
 * @coversDefaultClass \kd\lib\Exception\BaseException
 */
class BaseExceptionTest
    extends \PHPUnit_Framework_TestCase
{
    const SUBJECT_UNDER_TEST_TYPE =
        '\johi\SilexDemo\Exception\BaseException';

    /**
     * @test
     * @covers ::__construct
     */
    public function __construct_ReturnsNewInstance()
    {
        $baseException = new BaseException();
        $this->assertInstanceOf(
            self::SUBJECT_UNDER_TEST_TYPE,
            $baseException
        );
    }

    /**
     * @test
     * @covers ::getCode
     */
    public function getCode_ReturnsExceptionCode()
    {
        $baseException = new BaseException();
        $this->assertEquals(
            BaseException::EXCEPTION_CODE,
            $baseException->getCode()
        );
    }

    /**
     * @test
     * @covers ::getCode
     */
    public function code_ReturnsExceptionCode()
    {
        $baseException = new BaseException();
        $this->assertEquals(
            BaseException::EXCEPTION_CODE,
            $baseException->getCode()
        );
    }

    /**
     * @test
     * @covers ::__construct
     * @covers ::getMessage
     */
    public function getMessage_ReturnsDefaultMessage()
    {
        $baseException = new BaseException();
        $this->assertEquals(
            BaseException::DEFAULT_MESSAGE,
            $baseException->getMessage()
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
        $baseException = new BaseException( $message );
        $this->assertEquals( $message, $baseException->getMessage() );
    }


    /**
     * @test
     * @covers ::__construct
     * @covers ::getPrevious
     */
    public function getPrevious_ReturnsConstructorSetPreviousException()
    {
        $previousException = new \Exception();
        $baseException = new BaseException( NULL, $previousException );
        $this->assertEquals(
            $previousException,
            $baseException->getPrevious()
        );
    }
}

