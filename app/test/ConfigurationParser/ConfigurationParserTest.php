<?php
/**
 * Created by PhpStorm.
 * User: johan
 * Date: 16-04-15
 * Time: 16:06
 */

namespace test\johi\SilexDemo\ConfigurationParser;

use johi\SilexDemo\ConfigurationParser\ConfigurationParser;

class ConfigurationParserTest
    extends \PHPUnit_Framework_TestCase
{
    const CONFIGURATION_DIRECTORY_UNDER_TEST = '../config';
    const CONFIGURATION_FILE_UNDER_TEST = 'database.yml';
    const BOGUS_CONFIGURATION_FILE_UNDER_TEST = 'nonvalidate.yml';

    /**
     * @test
     */
    public function givenConfigurationDir_shouldCreateConfigurationParser()
    {
        $this->assertInstanceOf(
            '\johi\SilexDemo\ConfigurationParser\ConfigurationParser',
            $this->configurationParserFixture()
        );
    }

    /**
     * @test
     * do we get back an array?
     */
    public function givenTargetAndFilename_returnsArrayOfContents()
    {
        $configurationParser = $this->configurationParserFixture();
        $this->assertTrue(
            is_array($configurationParser->parse('test', self::CONFIGURATION_FILE_UNDER_TEST)),
            'Failed asserting that $configuration is an array'
        );
    }

    /**
     * @test
     * what about a wrong config dir?
     * @expectedException \johi\SilexDemo\Exception\ArgumentException
     */
    public function givenWrongConfigDir_throwsArgumentException()
    {
        $configurationParser = new ConfigurationParser(__DIR__ . DIRECTORY_SEPARATOR . 'nonexistingdirectory');
    }

    /**
     * @test
     * An empty string as input would not do any good
     * @expectedException \johi\SilexDemo\Exception\ArgumentException
     */
    public function givenEmptyString_throwsArgumentException()
    {
        $configurationParser = new ConfigurationParser('');
    }

    /**
     * @test
     * Tests for non existing configuration file
     * @expectedException \johi\SilexDemo\Exception\ArgumentException
     */
    public function givenNonExistingConfigFile_throwsArgumentException()
    {
        $configurationParser = $this->configurationParserFixture();
        $configuration = $configurationParser->parse('test', '_' . self::CONFIGURATION_FILE_UNDER_TEST);
    }

    /**
     * @test
     * If the provided yaml file does not parse we should expect an FormatException
     * @expectedException \johi\SilexDemo\Exception\FormatException
     */
    public function givenANonValidatingYaml_throwsFormatException()
    {
        $configurationParser = new ConfigurationParser(__DIR__ . DIRECTORY_SEPARATOR . self::CONFIGURATION_DIRECTORY_UNDER_TEST);
        $configuration = $configurationParser->parse('test', self::BOGUS_CONFIGURATION_FILE_UNDER_TEST);
    }

    /**
     * @test
     * Test for non existing target
     * @expectedException \johi\SilexDemo\Exception\ArgumentException
     */
    public function givenWrongTarget_throwsArgumentException()
    {
        $configurationParser = $this->configurationParserFixture();
        $configuration = $configurationParser->parse('unknown', self::CONFIGURATION_FILE_UNDER_TEST);
    }

    /**
     * @test
     * We are testing if the contents of the expected array match, hurray!!
     */
    public function givenRightTarget_providesRightTarget()
    {
        $configurationParser = $this->configurationParserFixture();
        $configuration = $configurationParser->parse('dev', self::CONFIGURATION_FILE_UNDER_TEST);
        $this->assertTrue($configuration['host'] === 'a band of horses');
        $configuration = $configurationParser->parse('test', self::CONFIGURATION_FILE_UNDER_TEST);
        $this->assertTrue($configuration['host'] === '127.0.0.1');
    }

    /**
     * @test
     * @expectedException \johi\SilexDemo\Exception\ArgumentException
     */
    public function givenNonExistingTarget_throwsArgumentException()
    {
        $configurationParser = $this->configurationParserFixture();
        $configuration = $configurationParser->parse('gnyffenyf', self::CONFIGURATION_FILE_UNDER_TEST);
    }

    ////////////////////////////////////////////////////////////////////////
    //
    // END TESTS

    /**
     * @return ConfigurationParser
     */
    private function configurationParserFixture()
    {
        $configurationParser = new ConfigurationParser(__DIR__ . DIRECTORY_SEPARATOR . self::CONFIGURATION_DIRECTORY_UNDER_TEST);
        return $configurationParser;
    }
}
