<?php
namespace App\Repositories\Interfaces;

use App\Tweet;

interface HashtagRepositoryInterface
{
    public function store($tweets_id, $text);

}
