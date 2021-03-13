<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Message::class, function (Faker $faker) {
    return [
        'date' => $faker->dateTimeThisYear('now', 'NZDT'),
        'from' => $faker->name,
        'too' => $faker->name,
        'message' => $faker->sentence(8),
        'source' => $faker->word,
        'status' => 'Sent',
    ];
});