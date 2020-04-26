<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Article;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    return [ 
        'tytul' => $faker->word,
        'tresc' => $faker->paragraph,
        'image' => $faker->image('public/storage/images',640,480, null, false),

    ];
});
