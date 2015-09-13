<?php

namespace johi\SilexDemo\Exception;
/**
 * The exception that is thrown when the an argument does not
 * meet the parameter specifications of the invoked method.
 *
 * @package kd\mdb\Application\Exception
 */
class ArgumentException
    extends BaseException {

    const DEFAULT_MESSAGE = 'Unknown argument exception';
    const EXCEPTION_CODE = 200;

    /**
     * @param string $message
     * @param \Exception $previousException
     */
    public function __construct($message = '', \Exception $previousException = NULL) {
        $this->code = self::EXCEPTION_CODE;
        $this->message = self::DEFAULT_MESSAGE;
        $this->setMessage($message);
        parent::__construct(
          $this->getMessage(),
          $previousException
        );
    }
}