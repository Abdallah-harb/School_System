<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Teacher;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

$factory->define(Teacher::class, function (Faker $faker) {
    return [

        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => Hash::make('password'),
        'specialize_id' => $faker->randomElement([1, 2,3,4,5,6]),
        'gender_id' => $faker->randomElement([1, 2]),
        'address' => $faker->address,
        'Joining_Date' => $faker->date(),
    ];
});
