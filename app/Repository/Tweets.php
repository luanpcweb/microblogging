<?php

namespace App\Repository;

use App\Entity\Tweet;

class Tweets
{

    public function last()
    {
        return App\Tweet::orderBy('created_at', 'desc')->take(20)->get();
    }

    public function saveTweet(Tweet $twitter)
    {
        $create = App\Tweet::create([
            'uuid' => $twitter->getUuid(),
            'username' => $twitter->getUsername(),
            'text' => $twitter->getBody()
        ]);

        return $create;
    }

    public function destroy($uuid)
    {
        $tweet = App\Tweet::where('uuid', $uuid);
        return $tweet->delete();
    }

    public function getByHashtag($hashtag)
    {

        $hashtag = '#'.$hashtag;

        return App\Tweet::where('hashtags.hashtag', $hashtag)
            ->leftJoin('hashtags', 'hashtags.tweets_uuid', '=', 'tweets.uuid')
            ->take(20)
            ->get();
    }

}
