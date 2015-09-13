<?php

namespace test\johi\Mailer\Smtp\Swift;

use johi\SilexDemo\Mailer\Smtp\Swift\SwiftSmtpMailer;

class SwiftSmtpMailerTest
    extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function givenConfiguration_canConstruct() {
        $configuration = $this->getMinimalConfigurationArray();
        $swiftSmtpMailer = new SwiftSmtpMailer($configuration);
        $this->assertInstanceOf('johi\SilexDemo\Mailer\Smtp\Swift\SwiftSmtpMailer', $swiftSmtpMailer);
    }

    /**
     * @test
     * @expectedException \johi\SilexDemo\Exception\ArgumentException
     */
    public function givenConfigurationMissingHost_shouldThrowArgumentException() {
        $configuration = $this->getMinimalConfigurationArray();
        unset($configuration['host']);
        $swiftSmtpMailer = new SwiftSmtpMailer($configuration);
    }

    /**
     * @test
     * @expectedException \johi\SilexDemo\Exception\ArgumentException
     */
    public function givenConfigurationMissingPort_shouldThrowArgumentException() {
        $configuration = $this->getMinimalConfigurationArray();
        unset($configuration['port']);
        $swiftSmtpMailer = new SwiftSmtpMailer($configuration);
    }

    /**
     * @return array
     */
    private function getMinimalConfigurationArray() {
        return array(
            'host' => 'localhost',
            'port' => '1025'
        );
    }
}

