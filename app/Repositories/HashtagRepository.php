<?php

namespace App\Repositories;

use App\Hashtag;
use App\Repositories\Interfaces\HashtagRepositoryInterface;
use \App\ExtractionTool;

class HashtagRepository implements HashtagRepositoryInterface
{
    use ExtractionTool;

    public function store($tweets_id, $text)
    {

        $hashtags = $this->getHashTagsOfText($text);
        $qtdHashTags = count($hashtags);

        if ($qtdHashTags > 0) {
           for($i=0; $i < $qtdHashTags; $i++){
                Hashtag::create([
                    'hashtag' => $hashtags[$i],
                    'tweets_id' => $tweets_id
                ]);
           }
        }

        return $hashtags;
    }
}
