<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TweetStoreRequest;
use App\Repository\Tweets;
use App\Service\TweetPost;
use App\Exceptions\BodyLengthExceeded;
use App\Exceptions\ErrorOnDeletingTweet;

class TweetsController extends Controller
{
    private $tweetsRepository;

    private $tweetPost;

    public function __construct(Tweets $tweetsRepository, TweetPost $tweetPost)
    {
        $this->tweetsRepository = $tweetsRepository;
        $this->tweetPost = $tweetPost;
    }

    public function index()
    {
        $tweets = $this->tweetsRepository->last();
        return view('home')->withTweets($tweets);
    }

    public function tweet()
    {
        return view('tweet');
    }

    public function store(TweetStoreRequest $request)
    {
        $username = $request->input('username');
        $body = $request->input('body');

        try {
            $this->tweetPost->post($username, $body);
        } catch (BodyLengthExceeded $exception) {
            return redirect()->back()->with('message', 'Tweet não pode ultrapassar de 280 caracteres!');
        }

        return redirect('/')->with('message', 'Tweet publicado com sucesso!');

    }

    public function destroy($uuid)
    {
        $destroy = $this->tweetsRepository->destroy($uuid);

        if (!$destroy) {
            throw new ErrorOnDeletingTweet('Erro em remover tweet');
        }

        return redirect('/')->with('message', 'Tweet removido!');
    }

    public function getByHashtag($hashtag)
    {
        $tweets = $this->tweetsRepository->getByHashtag($hashtag);
        return view('home')->withTweets($tweets);
    }
}
