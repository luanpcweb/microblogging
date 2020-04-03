<?php

namespace App;

trait ExtractionTool
{

    public function getHashTagsOfText($text)
    {
        preg_match_all('/\B#\w\w+/u', $text, $matches, PREG_PATTERN_ORDER);
        return $matches[0];
    }

}
