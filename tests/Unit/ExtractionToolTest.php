<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\ExtractionTool;

class ExtractionToolTest extends TestCase
{
    use ExtractionTool;

    public function test_get_hashtag_of_text()
    {

        $text = "Sed ut perspiciatis #text omnis iste natus error sit voluptatem";

        $extractionTool = $this->getHashTagsOfText($text);
        $this->assertEquals($extractionTool[0], '#text');
    }

    public function test_get_many_hashtag_of_text()
    {

        $text = "Sed ut perspiciatis #text omnis iste #test error #six6 voluptatem";

        $extractionTool = $this->getHashTagsOfText($text);
        $this->assertEquals($extractionTool, ['#text', '#test', '#six6']);
    }

    public function test_get_hashtag_of_text_without_hashtag()
    {

        $text = "Sed ut perspiciatis omnis iste error voluptatem";

        $extractionTool = $this->getHashTagsOfText($text);
        $this->assertEquals($extractionTool, []);
    }
}
