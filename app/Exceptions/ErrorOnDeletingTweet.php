<?php

namespace App\Exceptions;

use Exception;

class ErrorOnDeletingTweet extends Exception
{
    private $uuid;

    public function __construct(string $uuid)
    {
        $this->uuid = $uuid;
    }
}
