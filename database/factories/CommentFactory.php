<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Comment::class, function (Faker $faker) {
    return [
        'user_id' => randomElement([0, 100]),
        'question_id' => randomElement([0, 100]),
        'comment' => $faker->address,
    ];
});
