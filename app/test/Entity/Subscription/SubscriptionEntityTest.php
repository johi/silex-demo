<?php

namespace test\johi\SilexDemo\Entity\Subscription;

use johi\SilexDemo\Entity\Subscription\SubscriptionEntity;

class SubscriptionEntityTest
    extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function givenArrayOfValues_shouldConstruct() {
        $values = $this->getValues();
        $subscriptionEntity = new SubscriptionEntity($values);
        $this->assertInstanceOf('\johi\SilexDemo\Entity\Subscription\SubscriptionEntity', $subscriptionEntity);
    }

    /**
     * @test
     * @expectedException \johi\SilexDemo\Exception\ArgumentException
     */
    public function givenMissingName_shouldThrowArgumentException() {
        $values = $this->getValues();
        unset($values['name']);
        $subscriptionEntity = new SubscriptionEntity($values);
    }

    /**
     * @test
     * @expectedException \johi\SilexDemo\Exception\ArgumentException
     */
    public function givenMissingEmail_shouldThrowArgumentException() {
        $values = $this->getValues();
        unset($values['email']);
        $subscriptionEntity = new SubscriptionEntity($values);
    }

    /**
     * @test
     * @expectedException \johi\SilexDemo\Exception\ArgumentException
     */
    public function givenEmptyName_shouldThrowArgumentException() {
        $values = $this->getValues();
        $values['email'] = '';
        $subscriptionEntity = new SubscriptionEntity($values);
    }

    /**
     * @test
     * @expectedException \johi\SilexDemo\Exception\ArgumentException
     */
    public function givenEmptyEmail_shouldThrowArgumentException() {
        $values = $this->getValues();
        $values['email'] = '';
        $subscriptionEntity = new SubscriptionEntity($values);
    }

    /**
     * @test
     */
    public function givenValidValues_shouldSetValues() {
        $values = $this->getValues();
        $subscriptionEntity = new SubscriptionEntity($values);
        $this->assertEquals($values['name'], $subscriptionEntity->getName());
        $this->assertEquals($values['email'], $subscriptionEntity->getEmail());
    }

    /**
     * @return array
     */
    private function getValues()
    {
        $values = array(
            'name' => 'johan',
            'email' => 'johan.schulz@gmail.com'
        );
        return $values;
    }
}



