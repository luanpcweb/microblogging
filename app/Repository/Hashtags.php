<?php

namespace App\Repository;

use App\Entity\Hashtag;

class Hashtags
{

    public function saveHashtag(Hashtag $hashtag)
    {

        App\Hashtag::create([
                'uuid' => $hashtag->getUuid(),
                'hashtag' => $hashtag->getHashtag(),
                'tweets_uuid' => $hashtag->getTweetUuid()
            ]);

    }

}
