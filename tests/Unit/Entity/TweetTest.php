<?php

namespace Tests\Unit;

use App\Entity\Tweet;
use Tests\TestCase;
use App\Exceptions\BodyLengthExceeded;

class TweetTest extends TestCase
{
    /**
     * @test
    */
    public function shouldHaveEmptyTags()
    {
        $tweet = $this->buildTweetWithBody('There is no hashtag here');
        $this->assertEmpty($tweet->getTags());
    }

    /**
     * @test
    */
    public function shouldHaveOneTag()
    {
        $tweet = $this->buildTweetWithBody('There is #one hashtag here');
        $this->assertEquals(['#one'], $tweet->getTags());
    }

    /**
    * @test
    */
    public function shloudParseManyTags()
    {
        $tweet = $this->buildTweetWithBody('#There #4r5 #hashTags_ #here #h_3');
        $this->assertEquals(['#There', '#4r5', '#hashTags_', '#here', '#h_3'], $tweet->getTags());
    }

    /**
    * @test
    */
    public function shoudNotParseAsAwholeTag()
    {
        $tweet = $this->buildTweetWithBody('There is #one_@StrangeTag hashtag here');
        $this->assertEquals(['#one_'], $tweet->getTags());
    }

    /**
     * @test
    */
    public function shouldNotGetRepetitiveTags()
    {
        $tweet = $this->buildTweetWithBody('There is the same #tag #twice. What #tag is that?');
        $this->assertEquals(['#tag', '#twice'], $tweet->getTags());
    }

    /**
     * @test
    */
    public function shouldThrowErrorWhenBodyGreaterThan280()
    {
        $bodyGreater280Chars = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries.';

        $this->expectException(BodyLengthExceeded::class);

        new Tweet('uuid', 'username', $bodyGreater280Chars, new \DateTime('now'));
    }

    private function buildTweetWithBody(string $body): Tweet
    {
        return new Tweet(
            $uuid = 'something-that-is-uuid',
            'anyusername',
            $body,
            new \DateTime('now')
        );
    }
}
