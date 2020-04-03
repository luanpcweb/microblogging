<?php

namespace App\Repositories;

use App\Tweet;
use App\Repositories\Interfaces\TweetRepositoryInterface;

class TweetRepository implements TweetRepositoryInterface
{
    public function last()
    {
        return Tweet::orderBy('id', 'desc')->take(20)->get();
    }

    public function store($request)
    {
        $request->only('username', 'tweet');

        $create = Tweet::create([
            'username' => $request->username,
            'text' => $request->tweet
        ]);

        $this->hashtag()->store($create->id, $create->text);

        return $create;
    }

    public function hashtag()
    {
        return new HashtagRepository();
    }

    public function destroy($id)
    {

        try {
            $tweet = Tweet::findOrFail($id);
            $tweet->delete();
            return true;
        } catch(Execption $e) {
            return false;
        }
    }

    public function getByHashtag($hashtag)
    {

        $hashtag = '#'.$hashtag;

        return Tweet::where('hashtags.hashtag', $hashtag)
            ->leftJoin('hashtags', 'hashtags.tweets_id', '=', 'tweets.id')
            ->take(20)
            ->get();
    }
}
