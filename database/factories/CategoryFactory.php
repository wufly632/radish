<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Category::class, function (Faker $faker) {
    $time = date('Y-m-d H:i:s',time());
    return [
        'title' => $faker->name,
        'name' => $faker->name,
        'name_en' => $faker->name,
        'parent_id' => 0,
        'is_show' => rand(0,1), // secret
        'icon' => str_random(10),
        'sort' => rand(1,50),
        'created_at'  => $time,
        'updated_at'  => $time,
    ];
});
