<?php

namespace johi\SilexDemo\Exception;

/**
 * Class BaseException
 * This Exception is not meant to be thrown at all, it just exists to facilitate common base functionality for our concrete Exception classes
 *
 * @package kd\mdb\Application\Exception
 */
class BaseException
    extends \Exception {
    const DEFAULT_MESSAGE = 'Unknown base exception';
    const EXCEPTION_CODE = 0;

    /**
     * @param string $message
     * @param \Exception $previousException
     */
    public function __construct($message = '', \Exception $previousException = NULL) {
        $this->message = self::DEFAULT_MESSAGE;
        $this->setMessage($message);
        parent::__construct(
            $this->getMessage(),
            $this->getCode(),
            $previousException
        );
    }

    /**
     * Set the message property
     *
     * @param string $message
     */
    protected function setMessage( $message )
    {
        $this->message =
            ( $message === NULL || '' === $message )
                ? $this->message
                : $message;
    }
}