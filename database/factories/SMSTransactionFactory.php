<?php

use Faker\Generator as Faker;

$factory->define(App\Models\SMSTransaction::class, function (Faker $faker) {
    return [
        'created_at' => $faker->dateTimeThisYear('now', 'NZDT'),
        'from' => $faker->name,
        'too' => $faker->name,
        'message' => $faker->sentence(8),
        'source' => $faker->word,
        'status' => 'Sent',
    ];
});