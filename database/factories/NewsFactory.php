<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\News;
// use Faker\Generator as Faker;

$factory->define(News::class, function () {
    $faker = Faker\Factory::create('ru_RU');
    return [
        'news_title'=> $faker->realText(rand(20, 30)),
        'news_short' => $faker->realText(rand(100, 150)),
        'news_inform' => $faker->realText(rand(2000, 3000)),
        'news_private'=> false,
        'news_category' => rand(1,5),
        'news_important' => rand(0,1),
        'news_likes' => $faker->numberBetween(0, 364),
        'news_views' => $faker->numberBetween(70, 3654)
    ];
});
