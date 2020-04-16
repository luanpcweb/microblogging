<?php

namespace App\Entity;

class Hashtag
{
    private $uuid;
    private $hashtag;
    private $tweetUuid;

    public function __construct(string $uuid, string $hashtag, string $tweetUuid)
    {
        $this->uuid = $uuid;
        $this->hashtag = $hashtag;
        $this->tweetUuid = $tweetUuid;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getHashtag(): string
    {
        return $this->hashtag;
    }

    public function getTweetUuid(): string
    {
        return $this->tweetUuid;
    }
}
