<?php

namespace App\Repository;

use App\Entity\Tweet;
use App\Tweet as TweetModel;

class Tweets
{

    public function saveTweet(Tweet $twitter)
    {
        $create = TweetModel::create([
            'uuid' => $twitter->getUuid(),
            'username' => $twitter->getUsername(),
            'text' => $twitter->getBody()
        ]);

        return $create;
    }

}
