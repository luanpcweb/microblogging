<?php

namespace App\Service;

use App\Entity\Tweet;
use App\Entity\Hashtag;
use Ramsey\Uuid\Uuid;
use App\Repository\Tweets;
use App\Repository\Hashtags;

class TweetPost
{
    private $tweetRepository;
    private $hashtagRepository;

    public function __construct(Tweets $tweetRepository, Hashtags $hashtagRepository)
    {
        $this->tweetRepository = $tweetRepository;
        $this->hashtagRepository = $hashtagRepository;
    }

    public function post(string $username, string $body)
    {
        $now = new Datetime('now', new \DateTimeZone('UTC'));
        $uuid = Uuid::uuid5(Uuid::NAMESPACE_URL, $username . $body . $now->format('Ymdims'));

        $tweet = new Tweet($uuid, $username, $body, $now);

        $this->tweetRepository->saveTweet($tweet);

        $countTags = count($tweet->getTags());
        for($i=0; $i < $countTags; $i++){

            $tag = $tweet->getTags()[$i];
            $tweetUuid = Uuid::uuid5(Uuid::NAMESPACE_URL, $username . $tag . $now->format('Ymdims'));

            $hashtag = new Hashtag($uuid, $tag, $uuid);
            $this->hashtagRepository->saveHashtag($hashtag);

        }

    }
}
