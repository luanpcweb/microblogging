<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hashtag extends Model
{
    protected $table = 'hashtags';

    protected $fillable = ['uuid', 'hashtag', 'tweets_uuid'];
}
