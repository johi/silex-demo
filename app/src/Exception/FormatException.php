<?php

namespace johi\SilexDemo\Exception;
/**
 * The exception that is thrown when the format of an argument does not
 * meet the parameter specifications of the invoked method.
 */
class FormatException
    extends BaseException {

    const DEFAULT_MESSAGE = 'Unknown format exception';
    const EXCEPTION_CODE = 100;

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