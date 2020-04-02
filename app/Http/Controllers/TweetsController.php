<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\TweetRepositoryInterface;
use App\Http\Requests\TweetStoreRequest;

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

    public function tweet()
    {
        return view('tweet');
    }

    public function store(TweetStoreRequest $request)
    {
        return $this->tweetRepository->store($request);
    }
}
