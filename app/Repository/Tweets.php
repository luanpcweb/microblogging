<?php

namespace App\Repository;

use App\Entity\Tweet;
use App\Tweet as TweetModel;

class Tweets
{


    public function last()
    {
        return TweetModel::orderBy('created_at', 'desc')->take(20)->get();
    }

    public function saveTweet(Tweet $twitter)
    {
        $create = TweetModel::create([
            'uuid' => $twitter->getUuid(),
            'username' => $twitter->getUsername(),
            'text' => $twitter->getBody()
        ]);

        return $create;
    }

    public function destroy($uuid)
    {
        $tweet = TweetModel::where('uuid', $uuid);
        return $tweet->delete();
    }

    public function getByHashtag($hashtag)
    {

        $hashtag = '#'.$hashtag;

        return TweetModel::where('hashtags.hashtag', $hashtag)
            ->leftJoin('hashtags', 'hashtags.tweets_uuid', '=', 'tweets.uuid')
            ->take(20)
            ->get();
    }

}
