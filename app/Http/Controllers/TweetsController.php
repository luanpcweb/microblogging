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
        $result = $this->tweetRepository->store($request);

        if ($result) {
            return redirect('/')->with('message', 'Tweet publicado com sucesso!');
        }

        return redirect()->back()->with('message', 'Tweet não pode ser publicado!');
    }

    public function destroy($id)
    {
        $destroy = $this->tweetRepository->destroy($id);

        if ($destroy) {
            return redirect('/')->with('message', 'Tweet removido com sucesso!');
        }

        return redirect('/')->with('message', 'Tweet não encontrado!');
    }

    public function getByHashtag($hashtag)
    {
        $tweets = $this->tweetRepository->getByHashtag($hashtag);
        return view('home')->withTweets($tweets);
    }
}
