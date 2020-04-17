<?php

namespace App\Exceptions;

use Exception;

class BodyLengthExceeded extends \UnexpectedValueException
{
    private $body;

    public function __construct($body)
    {
        $this->body = $body;
    }

}
