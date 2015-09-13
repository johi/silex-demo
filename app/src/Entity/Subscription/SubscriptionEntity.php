<?php

namespace johi\SilexDemo\Entity\Subscription;

use johi\SilexDemo\Entity\Entity;
use johi\SilexDemo\Exception\ArgumentException;

class SubscriptionEntity
    extends Entity
{

    protected $name;
    protected $email;

    /**
     * @param array $values
     * @throws ArgumentException
     */
    public function __construct(array $values){
        //checking for the existence of required attributes
        if (!array_key_exists('name', $values)) {
            throw new ArgumentException(sprintf(self::ERROR_MESSAGE_MISSING_ARRAY_INDEX, 'name'));
        }
        if (!array_key_exists('email', $values)) {
            throw new ArgumentException(sprintf(self::ERROR_MESSAGE_MISSING_ARRAY_INDEX, 'email'));
        }
        $this->setName($values);
        $this->setEmail($values);
    }

    /**
     * @param array $values
     * @throws ArgumentException
     */
    private function setName(array $values)
    {
        $this->checkString($values['name'], 'name', false);
        $this->name = $values['name'];
    }

    /**
     * @param array $values
     * @throws ArgumentException
     */
    private function setEmail(array $values)
    {
        $this->checkString($values['email'], 'email', false);
        $this->email = $values['email'];
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

}


