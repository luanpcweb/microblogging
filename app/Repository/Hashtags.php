<?php

namespace App\Repository;

use App\Entity\Hashtag;
use App\Hashtag as HashtagModel;

class Hashtags
{

    public function saveHashtag(Hashtag $hashtag)
    {

            HashtagModel::create([
                        'uuid' => $hashtag->getUuid(),
                        'hashtag' => $hashtag->getHashtag(),
                        'tweets_uuid' => $hashtag->getTweetUuid()
                    ]);
    }

}
