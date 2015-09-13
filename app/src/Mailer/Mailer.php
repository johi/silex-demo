<?php

namespace johi\SilexDemo\Mailer;

interface Mailer
{
    public function send($subject, $from, $to, $body);
}