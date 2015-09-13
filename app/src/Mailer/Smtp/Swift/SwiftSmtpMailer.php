<?php

namespace johi\SilexDemo\Mailer\Smtp\Swift;

use johi\SilexDemo\Exception\ArgumentException;
use johi\SilexDemo\Mailer\Mailer;

/**
 * Class SwiftSmtpMailer
 * Is a Swift_Mailer adapter class to our own Mailer interface using SMTP
 * @package johi\SilexDemo\Mailer\Smtp\Swift
 */
class SwiftSmtpMailer
    implements Mailer
{
    const ERROR_MESSAGE_MISSING_ARRAY_INDEX = 'Property %s does not exist';

    private $transport;

    /**
     * @param $configuration
     * @throws ArgumentException
     */
    public function __construct($configuration) {
        if (!array_key_exists('host', $configuration)) {
            throw new ArgumentException(sprintf(self::ERROR_MESSAGE_MISSING_ARRAY_INDEX, 'host'));
        }
        if (!array_key_exists('port', $configuration)) {
            throw new ArgumentException(sprintf(self::ERROR_MESSAGE_MISSING_ARRAY_INDEX, 'port'));
        }
        $this->transport = \Swift_SmtpTransport::newInstance('localhost', 1025, '')
            ->setUsername('')
            ->setPassword('');
    }

    /**
     * @param string $subject
     * @param array|string $from
     * @param array|string $to
     * @param string $body
     * @return int
     */
    public function send($subject, $from, $to, $body) {
        $mailer = \Swift_Mailer::newInstance($this->transport);
        $message = \Swift_Message::newInstance($subject)
            ->setFrom($from)
            ->setTo($to)
            ->setBody($body);
        return $mailer->send($message);
    }
}



