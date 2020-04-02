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

        return $create;
    }
}
