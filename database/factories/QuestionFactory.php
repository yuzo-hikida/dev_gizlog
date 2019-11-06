<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Question::class, function (Faker $faker) {
    return [
        'user_id' => $faker->randomElement([1, 100]),
        'tag_category_id' => $faker->randomElement([1, 100]),
        'title' => $faker->title,
        'content' => $faker->text,
    ];
});
