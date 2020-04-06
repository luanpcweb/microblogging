<?php

use Faker\Generator as Faker;
use App\Tweet;

$factory->define(Tweet::class, function (Faker $faker) {
    return [
        'username' => '@'.$faker->firstName,
        'text' => 'Sed ut perspiciatis #'.$faker->word.' omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, #test ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.'
    ];
});
