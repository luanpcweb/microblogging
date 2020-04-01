<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\TweetRepositoryInterface;

class TweetsController extends Controller
{
    private $tweetRepository;

    public function __construct(TweetRepositoryInterface $tweetRepository)
    {
        $this->tweetRepository = $tweetRepository;
    }

    public function index()
    {
        $tweets = $this->tweetRepository->last();
        return view('home')->withTweets($tweets);
    }
}
