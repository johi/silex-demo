<?php

namespace johi\SilexDemo\Entity;
use johi\SilexDemo\Exception\ArgumentException;

abstract class Entity
{
    const ERROR_MESSAGE_PROPERTY_DOES_NOT_EXIST = 'Property %s does not exist';
    const ERROR_MESSAGE_UNEXPECTED_TYPE = 'Type of %s expected %s but is %s';
    const ERROR_MESSAGE_MISSING_ARRAY_INDEX = 'Missing array index: %s';
    const ERROR_MESSAGE_ARGUMENT_MAY_NOT_BE_NULL = 'Argument %s may not be null';
    const ERROR_MESSAGE_ARGUMENT_MAY_NOT_BE_EMPTY_STRING = 'Argument %s may not be a empty string';
    const ERROR_MESSAGE_ARGUMENT_MAY_NOT_BE_ZERO_OR_LESS = 'Argument %s may not be a zero or less, given: %s';
    const ERROR_MESSAGE_INVALID_EMAIL = 'Email %s is invalid';
    const ERROR_MESSAGE_ILLEGAL_ARGUMENT = 'Argument value %s is illegal for property %s';

    /**
     * @param string $string
     * @param string $name
     * @param bool $canBeEmpty
     * @throws ArgumentException
     */
    protected function checkString($string, $name, $canBeEmpty = true)
    {
        if ($canBeEmpty && (null === $string)) {
            return;
        }
        if (!is_string($string)) {
            throw new ArgumentException(sprintf(self::ERROR_MESSAGE_UNEXPECTED_TYPE, $name, 'string',
                gettype($string)));
        }
        if (!$canBeEmpty && $string === '') {
            throw new ArgumentException(sprintf(self::ERROR_MESSAGE_ARGUMENT_MAY_NOT_BE_EMPTY_STRING, $name));
        }
    }

    /**
     * @param $value
     * @param $name
     * @param bool $canBeEmpty
     * @param bool $canBeZeroOrLess
     * @throws ArgumentException
     */
    protected function checkInt($value, $name, $canBeEmpty = true, $canBeZeroOrLess = true)
    {
        if ($canBeEmpty && (null === $value || ($canBeZeroOrLess && $value === 0))) {
            return;
        }
        if (!is_int($value) && !is_numeric($value)) {
            throw new ArgumentException(sprintf(self::ERROR_MESSAGE_UNEXPECTED_TYPE, $name, 'integer',
                gettype($value)));
        }
        if (!$canBeZeroOrLess && ($value < 1)) {
            throw new ArgumentException(sprintf(self::ERROR_MESSAGE_ARGUMENT_MAY_NOT_BE_ZERO_OR_LESS, $name, $value));
        }
    }

    /**
     * @param $value
     * @param $name
     * @param bool $canBeEmpty
     * @throws ArgumentException
     */
    protected function checkDecimal($value, $name, $canBeEmpty = true)
    {
        if ($canBeEmpty && (null === $value || 0 === $value)) {
            return;
        }
        if ($value && !filter_var($value, FILTER_VALIDATE_FLOAT)) {
            throw new ArgumentException(sprintf(self::ERROR_MESSAGE_UNEXPECTED_TYPE, $name, 'decimal',
                $value));
        }
        if (!$canBeEmpty && !$value && $value !== 0) {
            throw new ArgumentException(sprintf(self::ERROR_MESSAGE_ILLEGAL_ARGUMENT, $value, $name));
        }
    }

    /**
     * @param $email
     * @param $name
     * @param bool $canBeEmpty
     * @throws ArgumentException
     */
    protected function checkEmail($email, $name, $canBeEmpty = true)
    {
        if ($canBeEmpty && (null === $email || '' === $email)) {
            return;
        }
        if (!is_string($email)) {
            throw new ArgumentException(sprintf(self::ERROR_MESSAGE_UNEXPECTED_TYPE, $name, 'string',
                gettype($email)));
        }
        if (!$canBeEmpty && $email === '') {
            throw new ArgumentException(sprintf(self::ERROR_MESSAGE_ARGUMENT_MAY_NOT_BE_EMPTY_STRING, $name));
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new ArgumentException(sprintf(self::ERROR_MESSAGE_INVALID_EMAIL, $email));
        }
    }

    /**
     * @param mixed $boolean
     * @param string $name
     * @param bool $canBeNull
     * @throws ArgumentException
     */
    protected function checkBoolean($boolean, $name, $canBeNull = true)
    {
        if ($canBeNull && null === $boolean) {
            return;
        }
        if (!is_bool($boolean)) {
            throw new ArgumentException(sprintf(self::ERROR_MESSAGE_UNEXPECTED_TYPE, $name, 'boolean',
                gettype($boolean)));
        }
    }
}