<?php

namespace App\Exceptions;

class BosyLengthExeeded extends \UnexpectedValueException
{
    private $body;

    public function __construct(string $body)
    {
        $this->body = $body;
    }
}
