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
}
