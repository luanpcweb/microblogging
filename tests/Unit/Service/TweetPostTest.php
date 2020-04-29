<?php

namespace Tests\Unit;

use App\Repository\Tweets;
use App\Repository\Hashtags;
use App\Entity\Tweet;
use App\Service\TweetPost;
use PHPUnit\Framework\TestCase;
use App\Exceptions\BodyLengthExceeded;

class TweetPostTest extends TestCase
{

    private $tweetPost;
    private $tweetsRepository;
    private $hashtagsRepository;

    public function setUp(): void
    {
        $this->tweetsRepository = $this->getMockBuilder(Tweets::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->hashtagsRepository = $this->getMockBuilder(Hashtags::class)
        ->disableOriginalConstructor()
        ->getMock();

        $this->tweetPost = new TweetPost(
            $this->tweetsRepository,
            $this->hashtagsRepository
        );
    }

    /**
     * @test
    */
    public function shloudPersistTweetOnDatabase()
    {
        $this->tweetsRepository->expects($this->once())->method('saveTweet');
        $this->tweetPost->post($username = 'username', $body = 'wakanda foerever');
    }

    /**
     * @test
    */
    public function shouldPersistAGeneratedUuid()
    {
        $lambda = function (Tweet $tweet) {
            return !empty($tweet->getUuid());
        };

        $this->tweetsRepository->expects($this->once())->method('saveTweet')
            ->with($this->callback($lambda));

        $this->tweetPost->post($username = 'username', $body = 'Wakanda foerever');
    }

    /**
     * @test
    */
    public function shouldNotPersistTweetWithBodyGreaterThan280()
    {
        $this->tweetsRepository->expects($this->never())->method('saveTweet');

        $body = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries.';
        $this->expectException(BodyLengthExceeded::class);

        $this->tweetPost->post($username = 'username', $body);
    }

    /**
     * @test
    */
    public function shloudPersistHashtagOnDatabase()
    {
        $this->hashtagsRepository->expects($this->once())->method('saveHashtag');
        $this->tweetPost->post($username = 'username', $body = 'wakanda #test foerever');
    }

    /**
     * @test
    */
    public function shloudNotPersistWithoutHashtagOnDatabase()
    {
        $this->hashtagsRepository->expects($this->never())->method('saveHashtag');
        $this->tweetPost->post($username = 'username', $body = 'wakanda test foerever');
    }
}
