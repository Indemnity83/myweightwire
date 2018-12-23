<?php

use Faker\Generator as Faker;

$factory->define(App\Weighin::class, function (Faker $faker) {
    return [
        'weighed_at' => $faker->unique()->date(),
        'weight' => $faker->randomFloat(1, 150, 265),
        'user_id' => function () {
            return factory(\App\User::class)->create()->id;
        },
    ];
});
