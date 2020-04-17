<?php

namespace App\Entity;

use App\Exceptions\BodyLengthExceeded;

class Tweet
{
    const MAX_BODY_LENGTH = 280;

    private $uuid;
    private $username;
    private $body;
    private $createdAt;

    public function __construct(string $uuid, string $username, string $body, \DateTime $createdAt)
    {
        $this->ensureIntegrity($body);

        $this->uuid = $uuid;
        $this->username = $username;
        $this->body = $body;
        $this->createdAt = $createdAt;
    }

    private function ensureIntegrity(string $body) :void
    {
        if (mb_strlen($body) > self::MAX_BODY_LENGTH) {
            throw new BodyLengthExceeded($body);
        }
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getTags()
    {
        $tags = [];
        preg_match_all('/#[0-9a-zA-Z_]+/', $this->body, $tags);

        if (count($tags) == 1 && count($tags[0]) == 0) {
            return [];
        }

        return array_unique($tags[0]);

    }
}
