<?php
namespace App\Repositories\Interfaces;

use App\Tweet;

interface TweetRepositoryInterface
{
    public function last();
    public function store($request);
    public function hashtag();
    public function destroy($id);
    public function getByHashtag($hashtag);
}
